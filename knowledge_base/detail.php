<? require('_drawrating.php'); ?>
<?
# ----------------------------------- #
#	SETUP
# ----------------------------------- #
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 
//$title= request_value('id');

$template->setStyle('site');
$template->setColumn("left", "knowledge.php");
//$template->setHtmlTitle('Knowledge Base');
//$template->printHeader();

$kb_topic_id = request_value('topic');


// the old site passed knowledge base ids in the query string as 'faq=[id]'
// the new site passes them as 'id=[id]'. So old bookmarks work, Apache Mod_Rewrite 
// forwards old urls to this page, and we'll deal with either querystring type
if (isset($_REQUEST['id'])) {
	$kb_page_id = request_value('id');
} elseif (isset($_REQUEST['faq'])) {
	$kb_page_id = request_value('faq');
} else {
	$kb_page_id = NULL;
}

// NOTES be sure to let admins see inactive pages

	
# ----------------------------------- #
#	BODY
# ----------------------------------- #
//include($_SERVER['DOCUMENT_ROOT'] . "/library/searchboxes/searchbox.php");

try {
	$kb_page = new KbPage($kb_page_id);
	
	if ( !isset( $_SESSION['kbids'] ) ) {
		$_REQUEST['id'] = array();
		echo "<script language=JavaScript>";
		echo "window.location.reload()";
		echo "</script>";
		}
		session_start();
		$ids = $_REQUEST['id'];
		$_SESSION['kbids'][$ids] = $ids;
	?>

<? include("kb_header.php"); ?>

<?php

if (false !== stripos($_SERVER['HTTP_REFERER'], "3866")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>EBSCOhost</b></a>'; }
   
elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "4513")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Biography Reference Center</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "4107")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Business Search Interface</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "3677")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>DynaMed</b></a>'; }


elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "7549")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>DynaMed Plus</b></a>'; }


elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "5507")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Audiobooks</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "4581")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Digital Archives</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "4706")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>EBSCO Discovery Service</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "5358")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>eBooks</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "4009")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>EBSCO Personalization</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "4007")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>EBSCO Print/Email/Save</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "4008")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>EBSCO Search/Alerts</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "2507")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>EBSCO<i>admin</i></b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "5892")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>EBSCO<i>host</i> Collection Manager</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "4481")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>EHIS</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "4869")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Expert Publishing</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "6869")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Full Text Finder</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "5022")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>History Reference Center</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "6593")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Hobbies & Crafts</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "3392")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Home Improvement</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "2749")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Literary Reference Center</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "4171")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Nursing Reference Center</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "3952")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Patient Education Reference Center</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "6465")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Poetry & Short Story</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "3287")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Points of View</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "4653")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Read It!</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "4183")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Rehabilitation Reference Center</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "5021")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Science Reference Center</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "4808")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Small Business Reference Center</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "3422")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Small Engine Repair</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "6731")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Social Work Reference Center</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "5336")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Auto Repair Reference Center</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "7634")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Flipster</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "4707")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>EDS Customization Guide</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "4482")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>EHIS Customization Guide</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "4851")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Digital Archives User Guide</b></a>'; }

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "4788")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>EBSCO Searching Tips User Guide</b></a>'; }
   
elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "6869")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Full Text Finder User Guide</b></a>'; }   
  
elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "6870")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Full Text Finder Administrator Guide</b></a>'; }   
  
elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "7431")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Nursing Reference Center Plus User Guide</b></a>'; }   
  
elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "4165")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Nursing Reference Center User Guide</b></a>'; }   
  
elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "3614")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>How to link to LinkSource</b></a>'; } 

elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "7364")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>Flipster</b></a>'; } 

  
elseif  (false !== stripos($_SERVER['HTTP_REFERER'], "4916")){
echo '<a class="back" href="javascript:goback()">&laquo; Back to <b>CustomLinks Best Practices</b></a>'; } 
   
else
   
{ echo ""; } 

?>

<img src="/images/logos/ebscoprint.png" class="printlogo" />
<div id="detail">	
<div id="icons">

<div class="date_float_left">

	<a href="javascript:window.print();"><span data-tooltip="PRINT"><img src="/images/icons/printmgr_22x22.png" /></span></a>&nbsp;&nbsp;
	<!--<a href="#"><span data-tooltip="EXPORT TO PDF"><img src="/images/icons/export-icon.png" /></span></a>-->
</div>	
<div class="date_float_right">
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style">
<!--<a class="addthis_button_preferred_1"></a>-->
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>

</div>
<!--BEGIN: Javascript to handle elements related to form processing =============================== -->
<script type="text/javascript">
//<![CDATA[
function limittoFullText(myForm) {
	if (myForm.fulltext_checkbox.checked) myForm.clv0.value = "Y";
	else myForm.clv0.value = "N";
}
function limittoScholarly(myForm) {
	if(myForm.scholarly_checkbox.checked) myForm.clv1.value = "Y";
	else myForm.clv1.value = "N";
}
function limittoCatalog(myForm) {
	if(myForm.catalog_only_checkbox.checked) myForm.clv2.value = "Y";
	else myForm.clv2.value = "N";
}
function limittoIR(myForm) {
	if(myForm.IR_only_checkbox.checked) myForm.clv3.value = "Y";
	else myForm.clv3.value = "N";
}
function ebscoPreProcess(myForm) {
	myForm.bquery.value = myForm.search_prefix.value + myForm.uquery.value;
}
function limittoArticles(myForm) {
	myForm.bquery.value += ' AND ZT Article';
}
function limittoBooks(myForm) {
	myForm.bquery.value += ' AND PT Book';
}
//]]>
</script>
<!--END: Javascript to handle elements related to form processing =============================== -->
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e5d39fd07c56e3a"></script>
<!-- AddThis Button END -->
	</div>
</div>
	<div id="kbtitle"><h3><?= $kb_page->getTitle() ?></h3></div>
	<hr />
	
	<?= $kb_page->getContent() ?>
	
	<?
	try {
		$kb_topics = $kb_page->createKbTopics();
		$topic_array = array();
		foreach ($kb_topics as $kbt_id => $kbt) {
			array_push($topic_array, $kbt->getName());
		}
		$topic_names = join(", ", $topic_array);
	} catch (Exception $e) {
		$topic_names = NULL;
	}
	
	try {
		$kb_interfaces = $kb_page->createKbInterfaces();
		$services_array = array();
		foreach ($kb_interfaces as $kbi_id => $kbi) {
			array_push($services_array, $kbi->getName());
		}
		$service_names = join(", ", $services_array);
	} catch (Exception $e) {
		$service_names = NULL;
	}
	?>

	<table class="description">
	<? if ($kb_page->getFile() && file_exists($_SERVER['DOCUMENT_ROOT'] . $kb_page->getFile(TRUE))) { ?>
			<tr>
				<td class="bold">Document Download:</td>
				<td>
					<a href="<?= $kb_page->getFile(TRUE) ?>" class="ExLink"><?= $kb_page->getFile() ?></a>
				</td>
			</tr>
		<? } ?>
		<tr>
			<td class="bold">ID:</td>
			<td><?= $kb_page->getPrimaryKey() ?></td>
		</tr>

		<? 
		if ($topic_names) { 
			?>
			<tr>
				<td class="bold">Topic:</td>
				<td><?= $topic_names ?></td>
			</tr>
			<? 
		} 
		?>

		<? 
		if ($service_names) { 
			?>
			<tr>
				<td class="bold">Services:</td>
				<td><?= $service_names ?></td>
			</tr>
			<?
		} 
		?>
		
		<tr>
			<td class="bold">Link:</td>
			<td><a href="<?= server_address() . $_SERVER['PHP_SELF'] ?>?id=<?= $kb_page->getPrimaryKey() ?>"><?= server_address() . $_SERVER['PHP_SELF'] ?>?id=<?= $kb_page->getPrimaryKey() ?></a></td>
		</tr>

		
<tr><td class="bold">Updated:</td>
	<td><?= $kb_page->getLastUpdated('F Y') ?></td>
</tr>
	</table>
	<br />
	
	<? echo rating_bar($kb_page->getPrimaryKey(),5); ?>
	<?
	if ( !isset( $_SESSION['ratings'] ) ) {
	$_REQUEST['q'] = array();
	}
	$rid = $_REQUEST['q'];
	$_SESSION['ratings'][$rid] = $rid;
	?>
<?
/*	if(in_array($_REQUEST['id'],$_SESSION['kbids'])){
	echo "Its in kbids<br />";}
	else{ echo "It's not in kbids<br />";}
	
	if(in_array($_REQUEST['id'],$_SESSION['ratings'])){
	echo "Its in rating<br />";}
	else{ echo "It's not in ratings<br />";}
	
	if(in_array($_REQUEST['id'],$_SESSION['comment'])){
	echo "Its in comments";}
	else{ echo "It's not in comments<br />";}
	
	echo "<pre>";
	print_r($_SESSION);
	echo "</pre>";	
*/
?>
	<div class="url">Find tutorials, FAQs, help sheets, user guides, and more at <span class="blue">http://support.ebsco.com</span>.</div>
	<div class="hr"><hr /></div>
	<script>
function goback() {
    history.go(-1);
}
</script>
	<!--<a href="#" onclick="window.history.back(-1)">&laquo; Back</a>-->
	<a class="back" href="javascript:goback()">&laquo; Back</a>
	</div>
<?
} catch (Exception $e) {
	 $template->printHeader();
	 include($_SERVER['DOCUMENT_ROOT'] . "/library/searchboxes/searchbox.php");
	 echo "<br />We are sorry; the page you requested no longer exists, as we occasionally remove pages during updates.<br /><br />
	 Please use the search box above to find current information, or contact <a href='/contact/askus.php'>Support</a> for assistance.";
}
?>

<?php if (Session::getLoggedInUserId()) { ?>
	<hr />
	<div>
		<strong><a href="/admin/kb_pages.php">Administer Knowledge Base</a></strong> | 
		<strong><a href="/admin/kb_pages.php?kb_page_id=<?= $kb_page->getPrimaryKey() ?>&amp;page_function=edit">Edit This Item</a></strong>
	</div> 
<?php } ?>



<?
# ----------------------------------- #
#	FOOTER
# ----------------------------------- #
	$template->printFooter();
?>
