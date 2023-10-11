<? header('Content-type: text/html; charset=utf-8');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<title>EBSCO Support: <?= $this->getData('title'); ?></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="EBSCO SUPPORT: EBSCO's Industry Leading Support Site &amp; Knowledge Base offers customers 24x7 access to FAQs, User Guides, Product Marketing Sheets, Help Sheets, Best Practice Guides, a library of Tutorials, and the latest product News." />
		<link rel="icon" href="/images/favicon.ico" />
		<link href="/stylesheets/default.css" rel="stylesheet" type="text/css" media="all" />
		<link href="/stylesheets/site.css" rel="stylesheet" type="text/css" media="all" />
		<link href="/stylesheets/paginator.css" rel="stylesheet" type="text/css" media="all" />
		<link href="/stylesheets/print_faq.css" rel="stylesheet" type="text/css" media="print" />
		<link rel="stylesheet" href="/customer_success/requests/screensaver.css" type="text/css" media="screen" />
        <link rel="stylesheet" type="text/css" href="/knowledge_base/css/rating.css" media="all" />

		<script type="text/javascript" src="/javascripts/mootools-release-1.11.js"></script>
		<script type="text/javascript" src="/javascripts/reorder.js"></script>
		<script type="text/javascript" src="/javascripts/site.js"></script>
		<script type="text/javascript" src="/javascripts/main.js"></script>
		<script type="text/javascript" src="/javascripts/style.js"></script>
		<script type="text/javascript" src="/javascripts/flashobject.js"></script>
        <script type="text/javascript" src="/knowledge_base/js/behavior.js"></script> 
        <script type="text/javascript" src="/knowledge_base/js/rating.js"></script>

		<!--[if lt IE 7]>
        	<script type="text/javascript" src="/javascripts/unitpngfix.js"></script>
		<![endif]-->
		
		<link type="application/rss+xml" rel="alternate" title="Top Stories" href="/rss/topstories.xml"/>
		<!--<link type="application/rss+xml" rel="alternate" title="Podcasts" href="/support_news/podcasts/podcasts.xml"/>-->
	
		</head>

	<body>

	<?
	$q = request_value('q');
	?>

	<div class="frame" id="frame_top">
	
	<div class="inner_frame_top">
		<a href="/index.php"><img class="logo_img" src="/images/logo_top.png" alt="EBSCO logo" /></a>

			<div style="float:right; position:relative; top:4px;">
			
				<select id="int_res" style="width: 200px;" onchange="window.open(this.options[this.selectedIndex].value,'_top')">
					<option value="international resources">International Resources</option>
                    <option value="/training/lang/bahasa/ba.php">Bahasa ID</option>
                    <option value="/training/lang/cs/cs.php">Čeština</option>
                    <option value="/training/lang/dk/dk.php">Dansk</option>
                    <option value="/training/lang/de/de.php">Deutsch</option>
                    <option value="/training/lang/el/el.php">Ελληνικά</option>
					<option value="/training/lang/es/es.php">Español</option>
					<option value="/training/lang/fr/fr.php">Français</option>
					<option value="/training/lang/he/he.php">Hebrew</option>
					<option value="/training/lang/it/it.php">Italiano</option>
                    <option value="/training/lang/hu/hu.php">Magyar</option>
                    <option value="/training/lang/pl/pl.php">Polski</option>
					<option value="/training/lang/pt/pt.php">Português</option>
                    <option value="/training/lang/pa/pa.php">Punjabi</option>
                    <option value="/training/lang/ru/ru.php">Русский</option>
                    <option value="/training/lang/ro/ro.php">Română</option>
                    <option value="/training/lang/sk/sk.php">Slovenský</option>
                    <option value="/training/lang/sv/sv.php">Svenska</option>
                    <option value="/training/lang/th/th.php">Thai</option>
					<option value="/training/lang/tr/tr.php">Türkçe</option>
                    <option value="/training/lang/uk/uk.php">Українська</option>
                    <option value="/training/lang/ar/ar.php">عربي</option>
					<option value="/training/lang/zh/zh-tw-t.php">中文資源</option>
                    <option value="/training/lang/zh/zh-cn-s.php">中文资源</option>
					<option value="/training/lang/ko/ko.php">한국어</option>
					<option value="/training/lang/ja/ja.php">日本語資料</option>
                </select>
				
				<div style="padding-top: 8px;">
					<a href="/contact/askus.php" class="wtlinks" onclick="popUpSizable('/contact/askus.php'); return false;">Email Support</a> <span class="wt">|</span>
					<a href="http://www2.ebsco.com/en-us/app/training/Pages/TrainingForm.aspx" class="wtlinks" onclick="popUpSizable('http://training.ebsco.com'); return false;">Sign Up For Training</a>
				</div>
						
			</div>
            
		<!--<form id="search" action="/knowledge_base/search.php" method="get">
			<div class="global_search">
				<input type="hidden" name="page_function" value="search" />
				<input type="text" name="keyword" value="<?= ($_REQUEST['q']) ? htmlentities(stripslashes($_GET['q'])) : "Search This Site"; ?>" type="text" class="global_search_box" onfocus="this.value='';" /><input type="image" src="/images/but_go.gif" class="global_search_button" alt="Go" />
			</div>
		</form>-->
		
	
	</div>
	<div style="float:left; position:relative; left: 40px; top: 16px; *left: 500px; *top:-35px;"><a  href="/support_news/detail.php?id=644&t=h"><img src="/images/supportButton220x35.gif" width="220" height="35" /></a></div>
</div>

	<?
	function isMenuOn($url) {
		if(strstr($_SERVER["PHP_SELF"],$url))
			return "active";
		else
			return "inactive";
	} 
	function isSubOn($sub) {
		if(strstr($_SERVER["PHP_SELF"],$sub))
			return "on";
		else
			return "off";		
	} 
	?>

<div class="frame" id="frame_navigation">
	<div class="inner_frame_navigation">
		
		<!--<div class="text_navigation">
			<a href="/contact/askus.php" class="orange">E-Mail Support</a> &nbsp;|&nbsp; <a href="http://training.ebsco.com" class="orange" onclick="popUpSizable('http://training.ebsco.com'); return false;">Sign Up For Training</a>
		</div>-->
		
			<div id="divNav">
				<ul id="navtest">
				
				<li id="knowledgebase" class="<?= isSubOn("/knowledge_base") ?>"><a href="/knowledge_base/index.php" onmouseover="ch_img(this);" onmouseout="ch_img(this);"><img src="/images/nav_knowledge_base_<?=isMenuOn("/knowledge_base")?>.gif" alt="Knowledge Base" /></a>
				<ul>
					<li><a href="/knowledge_base/index.php">Browse Services</a><img src="/images/pipe.gif" alt="pipe" /></li>
					<li><a href="/knowledge_base/search_db.php">Search by Database</a><img src="/images/pipe.gif" alt="pipe" /></li>
					<li><a href="/knowledge_base/search.php">Advanced Search</a></li>
				</ul></li>
				<li id="training" class="<?= isSubOn("/training") ?>"><a href="/training/index.php" onmouseover="ch_img(this);" onmouseout="ch_img(this);"><img src="/images/nav_training_<?=isMenuOn("/training")?>.gif" alt="Training" /></a>
				<ul>
					<li><a href="http://training.ebsco.com" onclick="popUpSizable('http://training.ebsco.com'); return false;">Sign Up For Training</a><img src="/images/pipe.gif" alt="pipe" /></li>
					<li><a href="/training/tutorials.php">Tutorials</a><img src="/images/pipe.gif" alt="pipe" /></li>
					<li><a href="/training/resources.php">International Resources</a><img src="/images/pipe.gif" alt="pipe" /></li>
					<li><a href="/training/TNSignup.php">EBSCO Training Mailing List</a></li>
				</ul></li>
				<li id="news" class="<?= isSubOn("/support_news") ?>"><a href="/support_news/index.php" onmouseover="ch_img(this);" onmouseout="ch_img(this);"><img src="/images/nav_support_news_<?=isMenuOn("/support_news")?>.gif" alt="Support News" /></a>
				<ul>
					<li><a href="/support_news/index.php">Support News</a><img src="/images/pipe.gif" alt="pipe" /></li>
					<li><a href="/support_news/release_info.php">Release Information</a><img src="/images/pipe.gif" alt="pipe" /></li>
					<!--<li><a href="/support_news/podcasts.php">Podcasts</a><img src="/images/pipe.gif" alt="pipe" /></li>-->
					<li><a href="http://twitter.com/EBSCOPublishing" onclick="window.open(this.href); return false;">Follow us on Twitter</a>
				</ul></li>
				<li id="promotion" class="<?= isSubOn("/promotion") ?>"><a href="/promotion/promo.php" onmouseover="ch_img(this);" onmouseout="ch_img(this);"><img src="/images/nav_promotion_<?=isMenuOn("/promotion")?>.gif" alt="Promotion" /></a>
				<ul>
					<li><a href="/promotion/promo.php">Promote Your Online Resources</a><img src="/images/pipe.gif" alt="pipe" /></li>
					<li><a href="http://www.ebscohost.com/customerSuccess/default.php?par=254&id=188" onclick="popUpSizable('http://www.ebscohost.com/customerSuccess/default.php?par=254&id=188'); return false;">Product Logos / Buttons</a><img src="/images/pipe.gif" alt="pipe" /></li>
					<li><a href="http://www.ebscohost.com/customerSuccess/default.php?id=814" onclick="popUpSizable('http://www.ebscohost.com/customerSuccess/default.php?id=814'); return false;">Try It Now! Ads</a><img src="/images/pipe.gif" alt="pipe" /></li>
					<li><a href="/knowledge_base/detail.php?id=3955">Search Box Builder</a></li>
				</ul></li>
				<li id="success" class="<?= isSubOn("/customer_success") ?>"><a href="http://www.ebscohost.com/customerSuccess/" onmouseover="ch_img(this);" onmouseout="ch_img(this);" onclick="popUpSizable('http://www.ebscohost.com/customerSuccess/'); return false;"><img src="/images/nav_customer_success_<?=isMenuOn("/customer_success")?>.gif" alt="Customer Success" /></a>
				<ul>
					<li><a href="http://www.ebscohost.com/customerSuccess/default.php?id=249" onclick="popUpSizable('http://www.ebscohost.com/customerSuccess/default.php?id=249'); return false;">Colleges/Universities</a><img src="/images/pipe.gif" alt="pipe" /></li>
					<li><a href="http://www.ebscohost.com/customerSuccess/default.php?id=250" onclick="popUpSizable('http://www.ebscohost.com/customerSuccess/default.php?id=250'); return false;">Medical</a><img src="/images/pipe.gif" alt="pipe" /></li>
					<li><a href="http://www.ebscohost.com/customerSuccess/default.php?id=251" onclick="popUpSizable('http://www.ebscohost.com/customerSuccess/default.php?id=251'); return false;">Corporations</a><img src="/images/pipe.gif" alt="pipe" /></li>
					<li><a href="http://www.ebscohost.com/customerSuccess/default.php?id=252" onclick="popUpSizable('http://www.ebscohost.com/customerSuccess/default.php?id=252'); return false;">Government</a><img src="/images/pipe.gif" alt="pipe" /></li>
					<li><a href="http://www.ebscohost.com/customerSuccess/default.php?id=253" onclick="popUpSizable('http://www.ebscohost.com/customerSuccess/default.php?id=253'); return false;">K-12 Schools</a><img src="/images/pipe.gif" alt="pipe" /></li>
					<li><a href="http://www.ebscohost.com/customerSuccess/default.php?id=254" onclick="popUpSizable('http://www.ebscohost.com/customerSuccess/default.php?id=254'); return false;">Public Libraries</a></li>
				</ul></li>
				<li id="contact" class="<?= isSubOn("/contact")?>"><a href="/contact/index.php" onmouseover="ch_img(this);" onmouseout="ch_img(this);"><img src="/images/nav_contact_us_<?=isMenuOn("/contact")?>.gif" alt="Contact Us" /></a>
				<ul>
					<li><a href="/contact/about_us.php">About Us</a><img src="/images/pipe.gif" alt="pipe" /></li>
					<li><a href="/contact/mailing_list.php">Join Mailing List</a><img src="/images/pipe.gif" alt="pipe" /></li>
					<li><a href="/contact/ill.php">Request Custom ILL Form</a><img src="/images/pipe.gif" alt="pipe" /></li>
					<li><a href="/contact/materials.php">Request Printed Materials</a><img src="/images/pipe.gif" alt="pipe" /></li>
					<li><a href="/contact/askus.php">Email Support</a></li>
				</ul></li>
			</ul>
		</div>
	</div>
</div>
	<div class="frame" id="frame_content">

	<?
	if ($this->isColumnSet('left')) {
		$this->printColumn("left");
		?>

		<div class="inner_frame_content_border1">
		<div class="inner_frame_content_border2">
		<div class="inner_frame_content_border3">
		<div class="inner_frame_content_border4">
			<div class="bodycontent">
				<div style="clear:both;"></div>

		<?
	} 
	?>
