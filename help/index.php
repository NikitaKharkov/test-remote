<?php
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php');

/*  HELP PAGES

Acceptable url parameters:
----------------------------------------
    + int=[string]        = REQUIRED LAUNCH PARAM set interface to string, interface.ebsco_code 
    + lang=[string]       = REQUIRED LAUNCH PARAM set language to string, language.ebsco_code
    + ver=[string]        = defaults to 'live' if not passed
    + feature_id=[string] = set feature_id to string, feature.feature
    + dbs=[string]        = colon separated string of database codes, from ebsco_database.ebsco_code. 
	                        if set, 'Database' navigation appears in the table of contents
   
    + help_id=[int]       = page content displays a single page (help.help_id)
    + help_topic_id=[int] = page content displays table of contents (TOC) for a single help topic

REQURED LAUNCH PARAM: these paramaters must be sent when help is launched. Once launched, the 
help page saves these params as cookies, and subsequent internal links do not require 

On subsequent requests (after the initial launch):
    + int's value is translated from interface.ebsco_code to interface.interface_id 
	  and passed as cookie, cookie_interface_id
	+ lang's value is translated from language.language_id to language.language_id 
	  and passed as cookie, cookie_language_id

A specific page can be targeted by passing either:
    1) help_id (after int and lang are already set)
    2) int, lang, and feature_id
	
*/

$help_interface_ebsco_code = request_value('int');
$help_version_ebsco_code   = request_value('ver');
$language_ebsco_code       = request_value('lang', 'string', 'en'); // default to English 
$feature_ebsco_code        = request_value('feature_id');
$help_page_id              = request_value('help_id');
$help_topic_id             = request_value('help_topic_id');

$database_help_page_id = NULL;
if (str_starts_with($help_page_id ?? '', 'DB:')) {
	$database_help_page_id = substr($help_page_id, 3);
}
$ebsco_database_ids = $ebsco_database_controller->parseRequestedEbscoDatabaseIds();
$disabled_toc_ids   = $help_controller->parseDisabledTocIds();

$template->setStyle('help');
$template->setHtmlTitle('EBSCO Help');
$template->setColumn("left", "news.php");

try {
	$help_interface 	 = $help_controller->findHelpInterfaceFromCode($help_interface_ebsco_code);
	$language            = $help_controller->findLanguageFromCode($language_ebsco_code);
	$help_version        = $help_controller->findHelpVersionFromCode(
        $help_interface->getPrimaryKey(),
        $help_version_ebsco_code
    );
	$database_help_pages = $database_help_controller->findLiveDatabaseHelpPages($ebsco_database_ids, $language->getPrimaryKey());
	
	$feature_id = NULL;
	if ($feature_ebsco_code == 'none') {
		$feature_ebsco_code = NULL;
	} else if ($feature_ebsco_code) {
		try {
			
			// feature_id = Databases, only access to one or more db help pages
			if ($feature_ebsco_code == "Databases" && (count($database_help_pages))) {
				$featured_database_page = current($database_help_pages);
				//$database_help_page_id  = $featured_database_page->getPrimaryKey();
				$help_topic_id = 'DB';
								
			// all other (non "Databases") feature_ids
			} else {
				$feature_ids = $feature_controller->findFeatures('feature_id_asc', $feature_ebsco_code, $help_interface->getPrimaryKey());
				$feature_id = $feature_ids[0];
			}			
		} catch (Exception $e) { }
	}
	
	$title   = $help_interface->getName();
	$content = $help_interface->getDefaultContent();
		
	$featured_help_page_id  = NULL;
	$featured_help_topic_id = NULL;
	if ($feature_id) {
		try {
			$featured_help_page_ids = $help_controller->findHelpPages(NULL, $help_version->getPrimaryKey(), $feature_id, $language->getPrimaryKey(), 'live');
			
			$featured_help_page = new HelpPage($featured_help_page_ids[0]);
			$featured_help_page_id = $featured_help_page->getPrimaryKey();
			$featured_help_topic_id = $featured_help_page->getHelpTopicId();
			
			$title   = $featured_help_page->getTitle();
			$content = $featured_help_page->getContent();
		} catch (Exception $e) { }
	}

	try {
		if ($help_page_id && substr($help_page_id, 0, 3) != 'DB:')   {
	
			$help_page = new HelpPage($help_page_id);
			
			if ($help_page->getStatus() != 'live') {
				throw new Exception();
			}
		
			if (in_array($help_page->getTocId(), $disabled_toc_ids)) {
				throw new Exception();
			}
			
			$help_topic     = $help_page->createHelpTopic();
			$help_topic_id  = $help_topic->getPrimaryKey();
			$help_version   = $help_topic->createHelpVersion();
			$help_interface = $help_version->createHelpInterface();
			$language       = $help_topic->createLanguage();
	
			if ($help_interface->getPrimaryKey() != $_COOKIE['cookie_interface_id'] || $language->getPrimaryKey() != $_COOKIE['cookie_language_id']) {
				throw new Exception();
			}
	
			$title   = $help_page->getTitle();
			$content = $help_page->getContent();
	
		} else if ($help_topic_id && $help_topic_id != 'DB') {

			$help_topic     = new HelpTopic($help_topic_id);
			$help_version   = $help_topic->createHelpVersion();
			$help_interface = $help_version->createHelpInterface();
			$language       = $help_topic->createLanguage();
			
			if ($help_interface->getPrimaryKey() != $_COOKIE['cookie_interface_id'] || $language->getPrimaryKey() != $_COOKIE['cookie_language_id']) {
				throw new Exception();				
			}

			try {
				$help_page_ids = $help_controller->findHelpPages(NULL, $help_version->getPrimaryKey(), NULL, $help_topic->getLanguageId(), 'live', $help_topic->getPrimaryKey());
				$help_page     = new HelpPage($help_page_ids[0]);
				$title         = $help_page->getTitle();
				$content       = $help_page->getContent();
			} catch (Exception $e) {
				$title   = $help_topic->getName();
				$content = '<em>There are no pages associated with this topic.</em>';
			}

		} else if ($database_help_page_id) {
			$database_help_page = new DatabaseHelpPage($database_help_page_id);
			$title = $database_help_page->getName();
			$content = $database_help_page->getContent();
			$help_topic_id = 'DB'; // highlight database section in nav
	
		} else if ($help_topic_id == 'DB') {
			
			if (count($database_help_pages) == 1) {
					$page    = current($database_help_pages);
					$title   = $page->getName();
					$content = $page->getContent();
			
			} elseif (count($database_help_pages) > 1) {
			
				reset($database_help_pages);
				$title   = "Select A Database";
				$content = '<ul>';
				foreach($database_help_pages as $dbhp_id => $dbhp) {
					$content .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?help_id=DB:' . $dbhp_id . '">' . $dbhp->getName() . '</a></li>';
				}
				$content .= '</ul>';
				reset($database_help_pages);
			}
		} else {
			// error messaging
		}
	} catch (Exception $e) {
		//echo $e->getMessage();
	}
	
	$help_topic_id = ($help_topic_id) ? $help_topic_id : $featured_help_topic_id;
	$help_page_id  = ($help_page_id)  ? $help_page_id  : $featured_help_page_id;
	
	$help_topic_ids      = $help_controller->findHelpTopics('list_order_asc', $help_version->getPrimaryKey(), $language->getPrimaryKey());
	$help_topics         = $help_controller->createHelpTopics($help_topic_ids);

	$logo = ($help_version->getLogo()) ? $help_version->getLogo(TRUE) : NULL;
	$template->setData('interface_logo', $logo);
	
	$template->printHeader();
	
	if ($help_interface->getPrimaryKey() == '1114') {
		include($_SERVER['DOCUMENT_ROOT'] . '/help/templates/navigation_template_mobi.php');
	}
	else {
			
	include($_SERVER['DOCUMENT_ROOT'] . '/help/templates/navigation_template.php');
	}
		
	if (!empty($_GET['q'])) {
		//echo "|".$help_interface->getPrimaryKey()."|";
		require 'search.php';  
	 
}	else {
	include($_SERVER['DOCUMENT_ROOT'] . '/help/templates/content_template.php');
}
	$template->printFooter();
		
} catch (Exception $e) {
	
	// language was sent in the URL
	// but it's invalid and not english. reload the page with english
	if (strlen($language_ebsco_code) && $language_ebsco_code != 'en') {
		redirect_site(preg_replace('/lang=' . $language_ebsco_code . '/', 'lang=en', $_SERVER['REQUEST_URI']));
	}
	if (strlen($help_version_ebsco_code ?? '') && $help_version_ebsco_code != 'live') {
		redirect_site(preg_replace('/ver=' . $help_version_ebsco_code . '/', 'ver=live', $_SERVER['REQUEST_URI']));	
	}	
	
	$template->printHeader();
	include($_SERVER['DOCUMENT_ROOT'] . '/help/templates/select_interface_template.php');
	$template->printFooter();
	
}
?>