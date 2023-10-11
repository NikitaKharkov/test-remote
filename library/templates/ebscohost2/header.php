<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="EBSCO SUPPORT: EBSCO's Industry Leading Support Site &amp; Knowledge Base offers customers 24x7 access to FAQs, User Guides, Product Marketing Sheets, Help Sheets, Best Practice Guides, a library of Tutorials, and the latest product News." />
	<title>EBSCOHost 2.0 Support Center: <?= $this->getData('title'); ?></title>

	<style type="text/css" media="all">@import "/stylesheets/default.css";</style>
	<link rel="stylesheet" href="/stylesheets/ebscohost2.css" type="text/css" media="all" />
	<script type="text/javascript" src="/javascripts/site_ehost2.js"></script>
	<script type="text/javascript" src="/javascripts/add-event.js"></script>
	<script type="text/javascript" src="/ebscohost2/popup.js"></script>
	<link type="application/rss+xml" rel="alternate" title="Top Stories" href="/rss/topstories.xml"/>
	<link type="application/rss+xml" rel="alternate" title="Podcasts" href="/support_news/podcasts/podcasts.xml"/>
</head>

<body>

<div class="frame" id="frame_top">
	<div class="inner_frame_top">
		<a href="/ebscohost2/index.php"><img src="/images/ehost2/e2_100.gif" class="logo_img" alt="EBSCOhost 2.0" /></a>
		<div style="float:right; padding: 12px;">
		<a href="http://www.ebscohost.com/flashViewer2.php?marketID=1&topicID=981" class="wtlinks" rel="popup standard 800 600 noicon">View EBSCO<i>host</i>&nbsp; 2.0 demo</a> <span class="wt">|</span> <a href="/" class="wtlinks" rel="popup standard 800 600 noicon">support.ebsco.com</a>
		</div>
		
		</form>
	</div>
</div>

<?
function isMenuOn($url) {
	if(strstr($_SERVER["PHP_SELF"],$url))
		return "_active";
	else
		return "_inactive";
}

?>

<div class="frame" id="frame_navigation">
	<div class="inner_frame_navigation">
			
				
		<div id="home_stage">
		
		<a href="/ebscohost2/feedback.php" onmouseover="ch_img(this);" onmouseout="ch_img(this);"><img src="/images/ehost2/feedback<?=isMenuOn("/feedback")?>.gif" alt="Feedback" /></a>
		<a href="/ebscohost2/training.php" onmouseover="ch_img(this);" onmouseout="ch_img(this);"><img src="/images/ehost2/training<?=isMenuOn("/training")?>.gif" alt="Training" /></a>
		<a href="/ebscohost2/getting_ready.php" onmouseover="ch_img(this);" onmouseout="ch_img(this);"><img src="/images/ehost2/getting_ready<?=isMenuOn("/getting_ready")?>.gif" alt="Getting Ready" /></a>
		<a href="/ebscohost2/faqs.php" onmouseover="ch_img(this);" onmouseout="ch_img(this);"><img src="/images/ehost2/faqs<?=isMenuOn("/faqs")?>.gif" alt="FAQs" /></a>
		<a href="/ebscohost2/index.php" onmouseover="ch_img(this);" onmouseout="ch_img(this);"><img src="/images/ehost2/updates<?=isMenuOn("/index")?>.gif" alt="Latest Updates" /></a>
		
		</div>
	</div>
</div>

<div class="frame" id="frame_content">
<?php if ($this->columns > 0) { ?>

	<?php if ($this->columns > 1 && isset($this->left_column)) { ?>
		<?php $this->print_column("left"); ?>
	<?php } ?>

	<div class="inner_frame_content_border1">
	<div class="inner_frame_content_border2">
	<div class="inner_frame_content_border3">
	<div class="inner_frame_content_border4">
		<div class="bodycontent">

<?php } /* columns > 0 */ ?>
		