<?php
/* --------------------------------------------------------------------- */
/* @author  Jeff Turcotte [jt] <jeff@imarc.net>
/* --------------------------------------------------------------------- */
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 
	
$page_function = page_function(array( "show_form", "search" ), request_value('page_function'));

$template->setHtmlTitle('Search Knowledge Base');
$template->setStyle('site');
$template->setColumn("left", "knowledge.php");
$template->printHeader();

$keyword           = request_value('keyword');
$document_type     = urldecode(request_value('document_type'));
$language_id       = request_value('language_id');
$kb_topic_id       = request_value('topic');
$kb_interface_id   = request_value('interface_id');
$ebsco_database_id = request_value('ebsco_database_id');
$page              = request_value('page', 'integer', 1);
$kb_status_filter  = array('public', 'private');

$error   = NULL;
$message = NULL;

// Search
//--------------
if ($page_function == "search") {

	try {
		
		/*$suggested_spelling = NULL;
		
		if ($keyword) {
			$suggested_spelling = correct_spelling($keyword, _PERSONAL_SEARCH_DICTIONARY);
		}
		
		if($suggested_spelling) {
			$link = $_SERVER['PHP_SELF'] . "?page_function=search&amp;keyword=" . urlencode($suggested_spelling);
			$link .= ($document_type) ? "&amp;document_type=" . url_encode($document_type) : '';
			$link .= ($kb_topic_id) ? "&amp;topic=" . $kb_topic_id : '';
			$link .= ($ebsco_database_id) ? "&amp;ebsco_database_id=" . $ebsco_database_id : '';
			$link .= ($kb_interface_id) ? "&amp;interface_id=" . $kb_interface_id : '';
			echo "<div class=\"suggestion\">Did you mean <strong><a href=\"" . $link . "\">" . $suggested_spelling . "</a></strong>?</div>\n";
		}*/
		
		// moved from line 31
		$kb_page_ids = $kb_controller->findKbPages('last_updated_desc', NULL, $kb_interface_id, $kb_topic_id, $language_id, $kb_status_filter, $document_type, $keyword, $ebsco_database_id);
		
		
		// implement page walker
		$total_per_page = 50;
		$total_kb_page_ids = count($kb_page_ids);
		$print_page_walker = ($total_kb_page_ids > $total_per_page) ? TRUE : FALSE;

		$paginator   = new Paginator($total_kb_page_ids, $page, $total_per_page);

		$first_item = (($page*$total_per_page)-$total_per_page)+1;
		$last_item = (($page*$total_per_page) > $total_kb_page_ids) ? $total_kb_page_ids : $page * $total_per_page;

		$kb_page_ids = array_slice($kb_page_ids, $first_item-1, $total_per_page); 

		$page_display = "Displaying <strong>${first_item} - ${last_item}</strong> of <strong>${total_kb_page_ids}</strong>";	
		
		?>
		<h1>Search Results<?= ($keyword) ? ' For: <em>' . $keyword . '</em>' : '' ?></h1>
		<br />
		<?
			
		echo $page_display;
	
		foreach($kb_page_ids as $kb_page_id) {
			$kb_page = new KbPage($kb_page_id);
			
			$short_description = ($kb_page->getContent()) ? substr(strip_tags($kb_page->getContent()), 0, 256) . "..." : '';
			
			$link = '#';
			if ($kb_page->getContent()) {
				$link = "/knowledge_base/detail.php?topic=${kb_topic_id}&amp;id=${kb_page_id}&amp;page=" . $page;				
			} else if ($kb_page->getFile() && file_exists($_SERVER['DOCUMENT_ROOT'] . $kb_page->getFile(TRUE))) {
				$link = $kb_page->getFile(TRUE);
			}
			?>
			
			<hr class="clear_floats" />
			<div class="newsblock">
				<strong><a href="<?= $link; ?>"><?= strip_tags($kb_page->getTitle()) ?></a></strong><br />
				<div class="float_right"><a href="<?= $link; ?>" class="orange">Read More</a> </div>
				<div class="detail_block"><strong>Last Updated:</strong> <?= $kb_page->getLastUpdated('F Y') ?>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
				<strong>Document Type:</strong> <?= $kb_page->getDocumentType() ?></div>
				<?= $short_description ?>
			</div>
		
			<?
		}
		?>
		<hr class="clear_floats" />
		
		<?
		if ($print_page_walker) {
			?>
			<div class="paginator">
				<? $paginator->printTemplate('page_walker'); ?>
			</div>
			<?
		}
	} catch (NoResultsException $e) {
		$error = "Your search found <strong>0</strong> results.  Please try again.";
		$page_function = "show_form";
	}
}


// Show Form
//---------------
if ($page_function == "show_form") {
?>

	<h1>Knowledge Base: Advanced Search</h1>
	<br />

	<? 
	$kb_page_info = $objects->Database->getStructure('kb_pages'); 
	
	if ($error)	   echo "<div class=\"error\">" . $error . "</div>";    $error = '';
	if ($message)  echo "<div class=\"message\">". $message . "</div>"; $message = '';
	
	$suggested_spelling = NULL;
	if($suggested_spelling){
		$link = $_SERVER['PHP_SELF'] . "?page_function=search&amp;keyword=" . urlencode($suggested_spelling);
		$link .= ($document_type) ? "&amp;document_type=" . url_encode($document_type) : '';
		$link .= ($kb_topic_id) ? "&amp;topic=" . $kb_topic_id : '';
		$link .= ($ebsco_database_id) ? "&amp;ebsco_database_id=" . $ebsco_database_id : '';
		$link .= ($kb_interface_id) ? "&amp;interface_id=" . $kb_interface_id : '';
		echo "<div class=\"suggestion\">Did you mean <strong><a href=\"" . $link . "\">" . $suggested_spelling . "</a></strong>?</div>\n";
	}
	?>

	<div class="center_table">
		<form id="search" action="<?= $_SERVER['PHP_SELF']; ?>" method="get">
			<table cellpadding="13" cellspacing="0" class="form_table">
				<tr>
					<th colspan="4" class="browse_header">Knowledge Base: Advanced Search</th>
				</tr>
				<tr>
					<td><strong>Keyword</strong></td>
					<td><input type="text" name="keyword" value="<?= $keyword ?>" /></td>

					<td><strong>Language</strong></td>
					<td>
						<select name="language_id">
							<?
							try {
								print_option($language_id, '', 'All Languages');
								$languages = $language_controller->listLanguages('name_asc');
								foreach($languages as $id => $language) {
									print_option($language_id, $id, $language->getName());
								}
							} catch (Exception $e) {}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td><strong>Document Type</strong></td>
					<td>
						<select name="document_type">
							<? 
							
							print_option($document_type, '', 'All Document Types');
							foreach ($kb_page_info['document_type']['valid_values'] as $valid_doc_type) {
								print_option($document_type, $valid_doc_type, $valid_doc_type);
							}
							
							?>
						</select>
					</td>
			
					<td><strong>Topic</strong></td>
					<td>
						<select name="topic">
							<? 
							try {
								print_option($kbt_id_filter, '', 'All Topics');
								$kb_topics = $kb_controller->listKbTopics('list_order_asc');
								foreach($kb_topics as $kb_topic_id => $kb_topic) {
									print_option($kbt_id_filter, $kb_topic_id, $kb_topic->getName());
								}
							} catch (Exception $e) {}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td><strong>Service</strong></td>
					<td>
						<select name="interface_id">
							<?
							try {
								print_option($kb_interface_id, '', 'All Services');
								$kb_interfaces = $kb_controller->listKbInterfaces('name_asc', 'live');
								foreach($kb_interfaces as $kb_interface_id => $kb_interface) {
									print_option($kbi_id_filter, $kb_interface_id, $kb_interface->getName());
								}
							} catch (Exception $e) {}
							?>
						</select>					
					</td>
					</td>
					<td><strong>EBSCO Database</strong></td>
					<td>
						<select name="ebsco_database_id">
							<?
							try {
								print_option($ebsco_database_id, '', 'All Databases');
								$ebsco_databases = $ebsco_database_controller->listEbscoDatabases('name_asc', 'active');
								foreach($ebsco_databases as $id => $ebsco_database) {
									print_option($ebsco_database_id, $id, $ebsco_database->getName());
								}
							} catch (Exception $e) {}
							?>
						</select>
					</td>
				</tr>
		
				<tr>
					<td style="text-align:center;" colspan="4">
						<input type="hidden" name="page_function" value="search" />
						<input type="image" src="/images/but_submitsearch.gif" value="Search" class="graphic_button" />
					</td>
				</tr>
			</table>
		</form>
	</div>
<br />
<br />
<br />
<br />
<br />
<br />

<?
}

# ----------------------------------- #
#	FOOTER
# ----------------------------------- #
$template->printFooter();
?>
