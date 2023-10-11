<?
/* --------------------------------------------------------------------- */
/* @author  Jeff Turcotte [jt] <jeff@imarc.net>

// ADDS PROPER LIST ORDERING TO HELP TOPICS AND HELP PAGES

/* --------------------------------------------------------------------- */



include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php');



$db = $objects->Database;
$db->setDebug(TRUE);


$versions_languages = array();

$result = $db->query("SELECT DISTINCT help_version_id, language_id FROM help_topics");
while($row = $db->getRow($result)) {
	$versions_languages[] = $row;
}

foreach($versions_languages as $key => $row) {
	$result = $db->query("SELECT help_topic_id FROM help_topics WHERE help_version_id = '" . $row['help_version_id'] . "' AND language_id = '" . $row['language_id'] .  "'");
	$list_order = 1;
	while($row = $db->getRow($result)) {
		$db->query("UPDATE help_topics SET list_order = '$list_order' WHERE help_topic_id = '" . $row['help_topic_id'] . "'");
		$list_order++;
	}
}

$topics = array();
$result = $db->query("SELECT DISTINCT help_topic_id FROM help_pages");
while($row = $db->getRow($result)) {
	$topics[] = $row;
}

foreach($topics as $key => $row) {
	$result = $db->query("SELECT help_page_id FROM help_pages WHERE help_topic_id = '" . $row['help_topic_id'] . "'");
	$list_order = 1;
	while($row = $db->getRow($result)) {
		$db->query("UPDATE help_pages SET list_order = '$list_order' WHERE help_page_id = '" . $row['help_page_id'] . "'");
		$list_order++;
	}
}

$db->query("ALTER TABLE help_topics MODIFY list_order INT NOT NULL");
$db->query("ALTER TABLE help_pages MODIFY list_order INT NOT NULL");


 