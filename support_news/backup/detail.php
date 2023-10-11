<?
/* --------------------------------------------------------------------- */
/* @author  Jeff Turcotte [jt] <jeff@imarc.net>
/* --------------------------------------------------------------------- */
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 

$news_item_id  = request_value('id');
$from          = request_value('t', 'string', '');
$page          = request_value('page');
	
try {
	if (!$news_item_id) {
		throw new Exception();
	}
	$news_item = new NewsItem($news_item_id);
	if (!$logged_in_user || !$logged_in_user->canEditNews()) {
		if ($news_item->getStatus() == 'inactive') {
			throw new Exception();
		}
	}
} catch (Exception $e) {
	if ($from == 'r') {
		redirect_site('/support_news/release_info.php');
	} else if ($from == 'h') {
		redirect_site('/index.php');
	} else {
		redirect_site('/support_news/index.php');		
	}
}
	
# ----------------------------------- #
#	HEADER
# ----------------------------------- #
// HEADER template(db, title, (int) colums, section, page, style)
$template->setStyle('site');
$template->setHtmlTitle('Release Information');
$template->setColumn("left", "news.php");
$template->printHeader();
	
# ----------------------------------- #
#	BODY
# ----------------------------------- #
if ($from == "r") {
	$header      = "Release Information";
	$return_link = "<a href=\"/support_news/release_info.php?page=" . $page . "\"><strong>Back to Release Information</strong></a>";
} else if ($from == "h"){
	$header      = "Support News";
	$return_link = "<a href=\"/index.php\"><strong>Back to Home Page</strong></a>";
} else {
	$header      = "Support News";
	$return_link = "<a href=\"/support_news/index.php?page=" . $page . "\"><strong>Back to Support News</strong></a>";
}
?>

<h1><?= $header; ?></h1>

<br />

<div class="date_float_right"><?= convert_date($news_item->getDisplayDate(), "php|F Y"); ?></div>
<h2><?= $news_item->getTitle() ?></h2>
<hr />
<?= $news_item->getContent() ?>

<?php if ($news_item->getUrl()) { ?>
	<div class="external_link">
		<strong>More Info: <a href="<?= $news_item->getUrl() ?>"><?= substr(trim($news_item->getUrl()), 0, 60) ?>
	</div>
<?php } ?>

<hr />

<?= $return_link ?>


<?
//  Links for administrator to go back to the admin section
if ($logged_in_user && $logged_in_user->canEditNews()) {
	?>
	<hr />
	<div>
		<strong><a href="/admin/news.php">Administer News</a></strong> | 
		<strong><a href="/admin/news.php?page_function=edit&amp;news_item_id=<?= $news_item_id ?>">Edit This Item</a></strong>
	</div> 
	<?
}
?>



<?
# ----------------------------------- #
#	FOOTER
# ----------------------------------- #
$template->printFooter();
?>