<? session_start(); ?>
<? require('_drawrating.php'); ?>
<?
# ----------------------------------- #
#	SETUP
# ----------------------------------- #
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 

$template->setStyle('site');
$template->setColumn("left", "knowledge.php");
$template->printHeader();
	
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

try {
	$kb_page = new KbPage($kb_page_id);
	
	if ( !isset( $_SESSION['kbids'] ) ) {
		$_REQUEST['id'] = array();
		echo "<script language=JavaScript>";
		echo "window.location.reload()";
		echo "</script>";
		}
		$ids = $_REQUEST['id'];
		$_SESSION['kbids'][$ids] = $ids;
	?>

<h4>
	<span class="detail" style="float:left; #padding-top: 25px; margin: 18px 0 0px 0; #margin: -10px 0 0px 0;">Detail</span>
	<span class="detail" style="float:right; margin: 10px 0 0px 0; #padding-top: 10px; #margin: 0px 0 0px 0;">
		<a href="javascript:window.print();"><img src="/images/icons/printFAQ.gif"></a>
	</span>
</h4>
<br />
	<div class="date_float_right">Last Updated: <?= $kb_page->getLastUpdated('F Y') ?></div>
	<h2><?= $kb_page->getTitle() ?></h2>
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

	<table>
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

		<? if ($kb_page->getFile() && file_exists($_SERVER['DOCUMENT_ROOT'] . $kb_page->getFile(TRUE))) { ?>
			<tr>
				<td class="bold">Document Download:</td>
				<td>
					<a href="<?= $kb_page->getFile(TRUE) ?>" class="ExLink"><?= $kb_page->getFile() ?></a>
				</td>
			</tr>
		<? } ?>

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
	<hr />
	<script>
function goback() {
    history.go(-1);
}
</script>
	<!--<a href="#" onclick="window.history.back(-1)">&laquo; Back</a>-->
	<a href="javascript:goback()">&laquo; Back</a>
	
<?
} catch (Exception $e) {
	
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
