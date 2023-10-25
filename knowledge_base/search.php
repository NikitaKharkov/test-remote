<?php
/* --------------------------------------------------------------------- */
/* @author  Jeff Turcotte [jt] <jeff@imarc.net>
/* --------------------------------------------------------------------- */
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 
	
$page_function = page_function(array( "show_form", "search" ), request_value('page_function'));

$template->setHtmlTitle('Knowledge Base Advanced Search');
$template->setStyle('site');
$template->setColumn("left", "knowledge.php");
$template->printHeader();
$kb_page_info = $objects->Database->getStructure('kb_pages'); 	


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

		$page_display = "<div id='resultsright'>Displaying <strong>${first_item} - ${last_item}</strong> of <strong>${total_kb_page_ids}</strong><br />";	
				
		
		include($_SERVER['DOCUMENT_ROOT'] . "/library/searchboxes/searchbox_results.php");
		//echo $_REQUEST['interface_id'];
		
		?>
		<div id="page_title">Search Results</div>	
		
		<div id="resultsleft" >
		
			<div id="rnd_container_results">
				<b class="rnd_top"><b class="rnd_b1"></b><b class="rnd_b2"></b><b class="rnd_b3"></b><b class="rnd_b4"></b></b>
			<div class="rnd_content_results"> 

				<div class="right-element_results">
				<?= $total_kb_page_ids." Results"?> <?= ($keyword) ? ' for: <em>' . $keyword . '</em>' : '' ?>
				</div>		
			
			</div>
				<b class="rnd_bottom"><b class="rnd_b4"></b><b class="rnd_b3"></b><b class="rnd_b2"></b><b class="rnd_b1"></b></b>
			</div>
			
			
			
				<div class="doctype">
				
					<h3>Document Type</h3>
					<ul>
						<li><input type="radio" name="document_type" value="" <?php if (($_GET['document_type']) == '') echo 'checked'; ?>>All Documents</li>
						<li><input type="radio" name="document_type" value="FAQ" <?php if (($_GET['document_type']) == 'FAQ') echo 'checked'; ?>>FAQ</li>
						<li><input type="radio" name="document_type" value="Help Sheet" <?php if (($_GET['document_type']) == 'Help Sheet') echo 'checked'; ?>>Help Sheets</li>
						<li><input type="radio" name="document_type" value="Marketing Resource" <?php if (($_GET['document_type']) == 'Marketing Resource') echo 'checked'; ?>>Marketing Resources</li>
						<li><input type="radio" name="document_type" value="Promotion Kit" <?php if (($_GET['document_type']) == 'Promotion Kit') echo 'checked'; ?>>Promotion Kits</li>
						<li><input type="radio" name="document_type" value="Trainer / Teacher Guide" <?php if (($_GET['document_type']) == 'Trainer / Teacher Guide') echo 'checked'; ?>>Trainer Guides</li>
						<li><input type="radio" name="document_type" value="Tutorial" <?php if (($_GET['document_type']) == 'Tutorial') echo 'checked'; ?>>Tutorials</li>
						<li><input type="radio" name="document_type" value="Reference / User Guide" <?php if (($_GET['document_type']) == 'Reference / User Guide') echo 'checked'; ?>>User Guides</li>
						<li><input type="radio" name="document_type" value="Success Tool" <?php if (($_GET['document_type']) == 'Success Tool') echo 'checked'; ?>>Success Tools</li>
					</ul>
											
					<h3>Other Limiters</h3>
									    
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
					<select id="topic" name="topic">
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
				<script type="text/javascript">
						document.getElementById('topic').value = "<?php echo $_GET['topic'];?>";
				</script>				
				
			</div>
					<div style="padding:4px;">
					 <input type="hidden" name="page_function" value="search" />
					<input type="submit" class="greenbtn" value="Update" />
					</div>
		</div>				
				</form>
	
		
		
		
		<?
	
		echo $page_display;
	
		foreach($kb_page_ids as $kb_page_id) {
			$kb_page = new KbPage($kb_page_id);
			
			//$short_description = ($kb_page->getContent()) ? substr(strip_tags($kb_page->getContent()), 0, 256) . "..." : '';
			$short_description = ($kb_page->getContent()) ? substr(strip_tags($kb_page->getContent(),"<img><a><br />"), 0, 256) . "..." : '';
			
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
				<?= $short_description ?> <a href="<?= $link; ?>" style="color:#1D7020; font-weight:600;">More</a><br />
				<div class="detail_block"><strong>Last Updated:</strong> <?= $kb_page->getLastUpdated('F Y') ?>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
				<strong>Document Type:</strong> <?= $kb_page->getDocumentType() ?></div>
				
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
	</div>
	

			<?
		}
	} catch (NoResultsException $e) {
		$error = "<br />Your search found <strong>0</strong> results.  Please try again.<br /><br />";
		$page_function = "show_form";
	}
}



// Show Form
//---------------
if ($page_function == "show_form") {
?>
	
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
<div id="page_title">Knowledge Base: Advanced Search</div>
	<?	include($_SERVER['DOCUMENT_ROOT'] . "/library/searchboxes/searchbox_advanced.php"); ?>


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
