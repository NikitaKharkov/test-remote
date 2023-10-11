<?
/* --------------------------------------------------------------------- */
/* @author  Jeff Turcotte [jt] <jeff@imarc.net>
/* --------------------------------------------------------------------- */
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 

$page_function = page_function(
	array( "list" ), request_value('page_function')
);

$template->setStyle('site');
$template->setHtmlTitle('Support News');
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


<h1>Support News</h1>

<br />

<?

/**
* list
*/
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
			<strong>Top Stories &amp; Customer Communications</strong><br />
			See our top story and announcement archives below, which date back to 2003.<br /><br />
		
			<a href="/support_news/release_info.php">Release Information </a> <img src="/images/lock.gif" alt="Accessible to EBSCO customers only" /><br />
			Browsable database of key product release features - past, present, and future.<br /><br />
		
			<a href="/contact/mailing_list.php">Join Our Mailing List</a><br />
			Get connected!  Make sure you are receiving the latest updates and announcements from EBSCO Information Services.<br /><br />
			
			Follow <a href="http://twitter.com/EBSCOPublishing" onclick="window.open(this.href); return false;">EBSCO Publishing <img src="/images/icons/twitter.png" alt="Twitter icon" /></a> and <a href="http://twitter.com/EBSCOInfoSvcs" onclick="window.open(this.href); return false;">EBSCO Information Services <img src="/images/icons/twitter.png" alt="Twitter icon" /></a> on Twitter  for all the latest updates.<br /><br />
			
			
		</div>
		<hr />
		<?
	}

	try {
		$news_item_ids = $news_item_controller->findNewsItems('display_date_desc', 'Support News', array('public', 'private'));

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
			$link =  ($news_item->getContent()) ? "/support_news/detail.php?id=${news_item_id}&amp;page=${page}" : $news_item->getUrl();
			
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
		There are no Support News items available at this time.  Please check back soon.
		<?
	}
}

# ----------------------------------- #
#	FOOTER
# ----------------------------------- #
$template->printFooter();
?>
