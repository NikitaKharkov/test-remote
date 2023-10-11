<STYLE TYPE="text/css">
body {
 background-color:#f7fcf8; }
</STYLE>
<div>
<?
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 
	
$page_function = page_function(array( "show_form", "search" ), request_value('page_function'));

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

		//$page_display = "Displaying <strong>${first_item} - ${last_item}</strong> of <strong>${total_kb_page_ids}</strong>";	
		
		?>
	
		<?
		
		echo $page_display;
	
		foreach($kb_page_ids as $kb_page_id) {
			$kb_page = new KbPage($kb_page_id);
			
			$short_description = ($kb_page->getContent()) ? substr(strip_tags($kb_page->getContent()), 0, 250) . "..." : '';
			
			$link = '#';
			if ($kb_page->getContent()) {
				$link = "/knowledge_base/detail.php?topic=${kb_topic_id}&amp;id=${kb_page_id}&amp;page=" . $page;				
			} else if ($kb_page->getFile() && file_exists($_SERVER['DOCUMENT_ROOT'] . $kb_page->getFile(TRUE))) {
				$link = $kb_page->getFile(TRUE);
			}
			?>
			
				<a href="<?= $link; ?>" target="_blank" style="font-family: Arial, Helvetica; font-size: 14px; font-style: normal; line-height: 1.4em;"><?= strip_tags($kb_page->getTitle()) ?></a><br />
		
		
			<?
		}
		?>
	
		
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
?>
</div>