<?php include("topheader.php"); ?>
<?php include("topmenu.php"); ?>

 <div id="body_areasearch">
	<div class="left">
		<div class="left_menu_area">
			<div align="right">
				<?php include("menu.php"); ?>
			</div>
		</div>
	</div>

<div class="midareasearch">
<div class="body_textarea">
<div class="head">Search Support Site</div>	
<?

// Search
//--------------
if ($page_function == "search") {
		try
		{
		
				
			$selection= $_GET['interface_id'];
			if( !is_array($selection)){
			// NoveList Plus, NoveList, NoveList K8 Plus, NoveList K8, NoveList Select, NextReads, NoveList Plus Mobile, LibraryAware
			$kb_interface_ids=array("1077","1007","1078","1029","1125","1059","1124","1140");
			}
				
		// 0 is the value for All interfaces, but we don't want to pass 0 to the search because it is not a valid interface ID
		// Instead, $kb_interface_ids is set with a new array that includes all the interface ids desired.
		if (in_array("0",$kb_interface_ids))
		{
			// NoveList Plus, NoveList, NoveList K8 Plus, NoveList K8, NoveList Select, NextReads, NoveList Plus Mobile, LibraryAware
			$kb_interface_ids=array("1077","1007","1078","1029","1125","1059","1124","1140");
		}
		else 
		{
			// If we are searching NoveList Plus (id:1077) also search NoveList (id:1007)
			if (in_array("1077",$kb_interface_ids))
			{
				$kb_interface_ids[] = "1007"; //adds to the end of the array
			}
			// If we are searching NoveList K8 Plus (id:1078) also search NoveList K8 (id:1039)
			if (in_array("1078",$kb_interface_ids))
			{
				$kb_interface_ids[] = "1029"; //adds to the end of the array
			}
			// If we are searching NextReads (id:1059) also search LibraryAware (id:1140)
			if (in_array("1059",$kb_interface_ids))
			{
				$kb_interface_ids[] = "1140"; //adds to the end of the array
			}
		}
		$kb_page_ids = $kb_controller->findKbPagesMultiInterface('last_updated_desc', NULL, $kb_interface_ids, $kb_topic_id, $language_id, $kb_status_filter, $document_type, $keyword, $ebsco_database_id);
		
		// implement page walker
		$total_per_page = 20;
		$total_kb_page_ids = count($kb_page_ids);
		$print_page_walker = ($total_kb_page_ids > $total_per_page) ? TRUE : FALSE;

		$paginator   = new Paginator($total_kb_page_ids, $page, $total_per_page);

		$first_item = (($page*$total_per_page)-$total_per_page)+1;
		$last_item = (($page*$total_per_page) > $total_kb_page_ids) ? $total_kb_page_ids : $page * $total_per_page;

		$kb_page_ids = array_slice($kb_page_ids, $first_item-1, $total_per_page); 

		$page_display = "Displaying <strong>${first_item} - ${last_item}</strong> of <strong>${total_kb_page_ids}</strong>";	
		
		?>
		<br />
		<h3>Search Results<?= ($keyword) ? ' For: <em>' . $keyword . '</em>' : '' ?></h3>
		
		<br />
		
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
			
			<hr class="clear_floats" />
			<div>
				<strong><a href="<?= $link; ?>" target="_blank"><?= strip_tags($kb_page->getTitle()) ?></a></strong><br />
				<?= $short_description ?><a href="<?= $link; ?>" class="orange" target="_blank">Read More</a>
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
		$error = "<br /><h2>Your search found <strong>0</strong> results.  Please try again.</h2>";
		$page_function = "search";
		echo "<br />Your search found <strong>0</strong> results.  Please try again.";
	}
}
?>
</div>
</div>
</div>
<?php include("footer.php"); ?>
