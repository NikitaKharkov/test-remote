<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>EBSCO NetLibrary Support Center</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="search">
		<a href="http://www.netlibrary.com" target="_blank">NetLibrary</a> | <a href="http://training.ebsco.com/" target="_blank">Sign up for Training</a>
	</div>
<div id="header">
	<div id="logo">
		<h1><a href="/netlibrary" title="Home"></a></h1>
	</div>
	
</div>
<div id="menu">
	<ul>
		<li><a href="/netlibrary">Home</a></li>
		<li><a href="/netlibrary/eBooks_faqs.php">eBooks</a></li>
		<li><a href="/netlibrary/eAudiobooks_faqs.php">audiobooks</a></li>
		<li><a href="/netlibrary/support.php">Support</a></li>
	</ul>
</div>
<hr />
<div id="page">
	<div id="content">

<?	include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 
	
$page_function = page_function(array( "show_form", "search" ), request_value('page_function'));
$page_function = "search";

$template->setHtmlTitle('Search Knowledge Base');
$template->setStyle('site');
$template->setColumn("left", "knowledge.php");


$keyword           = request_value('keyword');
$document_type     = urldecode(request_value('document_type'));
$language_id       = request_value('language_id');
$kb_topic_id       = request_value('topic');
$kb_interface_ids   = request_value('interface_id','array');
$ebsco_database_id = request_value('ebsco_database_id');
$page              = request_value('page', 'integer', 1);
$kb_status_filter  = array('public', 'private');
$error   = NULL;
$message = NULL;

// Search
//--------------
if ($page_function == "search") {
		try
		{
		
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
		
		
		// 0 is the value for All interfaces, but we don't want to pass 0 to the search because it is not a valid interface ID
		// Instead, $kb_interface_ids is set with a new array that includes all the interface ids desired.
		if (in_array("0",$kb_interface_ids))
		{
			$kb_interface_ids=array("1077","1007","1078","1029","1125","1059");
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
				$kb_interface_ids[] = "1039"; //adds to the end of the array
			}
		}
		$kb_page_ids = $kb_controller->findKbPagesMultiInterface('last_updated_desc', NULL, $kb_interface_ids, $kb_topic_id, $language_id, $kb_status_filter, $document_type, $keyword, $ebsco_database_id);
		
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
				<?= $short_description ?><a href="<?= $link; ?>" class="orange" target="_blank">Read More</a><br /><br />
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
		$page_function = "search";
		echo "Your search found <strong>0</strong> results.  Please try again.";
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


?>


	</div>
	<div id="sidebar">
		<div>
			<form id="search" action="search_novelist_JD.php" method="get">
			<strong>Search NetLibrary Support</strong>
				<select multiple name="interface_id[]">
						<option value="0"> All </option>
						<option value="1077">NoveList Plus</option>
						<option value="1078">NoveList K8 Plus</option>
						<option value="1059">NextReads</option>
						<option value="1125">NoveList Select</option>
					</select><br />
					
			<input type="hidden" name="page_function" value="search" />
			<input type="text" size="25" name="keyword" />&nbsp;<input type="image" src="images/icontexto-webdev-search-30x30.gif" alt="Go Search" class="submit" /><br /><br />
			</form>
		</div>
		<ul>
			<li>
				<h2>Links</h2>
				<ul>
					<li><a href="http://www.netlibrary.com" target="_blank">NetLibrary.com</a></li>
					<li><a href="/promotion/promo.php" target="_blank">Promotional Materials</a></li>
					<li><a href="http://support.ebsco.com" target="_blank">EBSCO Support Site</a></li>
					<li><a href="http://www.ebscohost.com/thisTopic.php?marketID=1&topicID=1419" target="_blank">EBSCOhost.com NetLibrary Page</a></li>
					
				</ul>
			</li>
			<li>
				<h2>Training</h2>
				<ul>
					<li>
						<h3>Sign up for free online training at <a style="text-decoration:underline;" href="http://training.ebsco.com/" target="_blank">training.ebsco.com</a>:</h3>
							Setup & Administration<br />
							Using audiobooks<br />
							Using eBooks<br />
					</li>
					
				</ul>
			</li>
		</ul>
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<hr />
<div id="footer">
	<p id="legal">Copyright &copy; <? echo date("Y") ?> EBSCO Publishing. All Rights Reserved</p>
	<p id="links"><a href="http://support.ebsco.com" target="_blank">EBSCO Support Site</a> | <a href="/netlibrary/support.php">Contact</a></a></p>
</div>
  <!-- Google Analytics -->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-12843232-1");
pageTracker._trackPageview();
} catch(err) {}
</script>
<!-- End Google Analytics -->
</body>
</html>
