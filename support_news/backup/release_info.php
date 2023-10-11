<?php
/* --------------------------------------------------------------------- */
/* @author  Jeff Turcotte [jt] <jeff@imarc.net>
/* --------------------------------------------------------------------- */
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 

$page_function = page_function(
	array( "list", "detail" ), request_value('page_function')
);

$template->setStyle('site');
$template->setHtmlTitle('Release Information');
$template->setColumn("left", "news.php");
$template->printHeader();

$news_id = request_value('news_id');
$page    = request_value('page', 'integer', 1);


$error   = '';
$message = '';
	
# ----------------------------------- #
#	BODY
# ----------------------------------- #
?>

<h1>Release Information</h1>
<br />

<?
// LIST
if ($page_function == "list") {
	
	// errors, messages
	$show_message = TRUE;
	if ($error){
		echo "<div class=\"error\">" . $error . "</div>";
		$error = '';
		$show_message = FALSE;
	}
	if ($message){
		echo "<div class=\"message\">". $message . "</div>";
		$message = '';
		$show_message = FALSE;
	}
	
	if ($show_message) {
		?>
		<div>
			Want to get a head start on new product features?  Prepare in advance for each new software release, including newly-designed interfaces, by tuning in to the Release Information section often.  Check here to see what enhancements and features will be introduced with the next release and how your institution can maximize their benefits.  Or review key features of past releases dating as far back as February of 2003. 
		</div>
		<hr />
		<?
	}

	try {
		$news_item_ids = $news_item_controller->findNewsItems('display_date_desc', 'Release Notes', array('public', 'private'));

		// implement page walker
		$total_per_page = 20;
		$total_news_item_ids = count($news_item_ids);
		$print_page_walker = ($total_news_item_ids > $total_per_page) ? TRUE : FALSE;
				
		$paginator   = new Paginator($total_news_item_ids, $page, $total_per_page);
		$first_item = (($page*$total_per_page)-$total_per_page)+1;
		$last_item = (($page*$total_per_page) > $total_news_item_ids) ? $total_news_item_ids : $page * $total_per_page;

		$news_item_ids = array_slice($news_item_ids, $first_item-1, $total_per_page); 
		
		$page_display = "Displaying <strong>${first_item} - ${last_item}</strong> of <strong>${total_news_item_ids}</strong>";
		?>
	
		<div class="pagination">
			<?= $page_display ?>
		</div>
	
		<?
		foreach($news_item_ids as $news_item_id) {
			$news_item = new NewsItem($news_item_id);
			$short_description = ($news_item->getContent()) ? substr(strip_tags($news_item->getContent()), 0, 250) . "..." : '';
			$link =  ($news_item->getContent()) ? "/support_news/detail.php?id=${news_item_id}&amp;t=r&amp;page=${page}" : $news_item->getUrl();
			
			?>
			<hr class="clear_floats" />
			<div class="newsblock">
				<strong>
					<a href="<?= $link ?>"><?= strip_tags($news_item->getTitle()) ?></a>
				</strong><br />
				<div class="float_right">
					<a href="<?= $link ?>" class="orange">Read More</a> 
				</div>
				<em><?= convert_date($news_item->getDisplayDate(), "php|F Y"); ?></em>
				<br />
				<?= $short_description ?>
			</div>
			<?
		}
	
		?>
		<hr class="clear_floats" />
		<div class="paginator">
			<? $paginator->printTemplate('page_walker'); ?>
		</div>
		<?
	} catch (NoResultsException $e) { 
		?>
		There is no Release Information at this time.  Please check back soon.
		<?
	}
}

# ----------------------------------- #
#	FOOTER
# ----------------------------------- #
$template->printFooter();
?>