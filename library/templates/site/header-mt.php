<? header('Content-type: text/html; charset=utf-8');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<title>EBSCO Support: <?= $this->html_title ?></title>
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="EBSCO SUPPORT: EBSCO's Industry Leading Support Site &amp; Knowledge Base offers customers 24x7 access to FAQs, User Guides, Product Marketing Sheets, Help Sheets, Best Practice Guides, a library of Tutorials, and the latest product News." />
		<link rel="shortcut icon" href="favicon.ico" />

		<link href="/stylesheets/style_NEW.css" rel="stylesheet" type="text/css" media="screen, handheld" />
		<link rel="stylesheet" href="/stylesheets/print_faq.css" type="text/css" media="print" />
		<link href="/stylesheets/paginator.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="/knowledge_base/css/rating.css" media="all" />
    <link rel="stylesheet" href="/stylesheets/mindtouch.css" type="text/css" media="all" />



		<script type="text/javascript" src="/javascripts/mootools-release-1.11.js"></script>
		<script type="text/javascript" src="/javascripts/reorder.js"></script>
		<script type="text/javascript" src="/javascripts/site.js"></script>
		<script type="text/javascript" src="/javascripts/main.js"></script>
		<script type="text/javascript" src="/javascripts/style.js"></script>
		<script type="text/javascript" src="/javascripts/flashobject.js"></script>
    <script type="text/javascript" src="/knowledge_base/js/behavior.js"></script>
    <script type="text/javascript" src="/knowledge_base/js/rating.js"></script>
		<script type="text/javascript" src="/javascripts/jquery.js"></script>
		<script type="text/javascript" src="/javascripts/jquery.placeholder.js"></script>

		<!--[if lt IE 7]>
        	<script type="text/javascript" src="/javascripts/unitpngfix.js"></script>
		<![endif]-->

		<link type="application/rss+xml" rel="alternate" title="Top Stories" href="/rss/topstories.xml"/>

		<!-- Google Analytics -->
		<script type="text/javascript">
			if (typeof jQuery != 'undefined') {
				jQuery(document).ready(function($) {
					var filetypes = /\.(zip|exe|pdf|doc*|xls*|ppt*|mp3)$/i;
					var baseHref = '';
					if (jQuery('base').attr('href') != undefined)
						baseHref = jQuery('base').attr('href');
					jQuery('a').each(function() {
						var href = jQuery(this).attr('href');
						if (href && (href.match(/^https?\:/i)) && (!href.match(document.domain))) {
							jQuery(this).click(function() {
								var extLink = href.replace(/^https?\:\/\//i, '');
								_gaq.push(['_trackEvent', 'External', 'Click', extLink]);
								if (jQuery(this).attr('target') != undefined && jQuery(this).attr('target').toLowerCase() != '_blank') {
									setTimeout(function() { location.href = href; }, 200);
									return false;
								}
							});
						}
						else if (href && href.match(/^mailto\:/i)) {
							jQuery(this).click(function() {
								var mailLink = href.replace(/^mailto\:/i, '');
								_gaq.push(['_trackEvent', 'Email', 'Click', mailLink]);
							});
						}
						else if (href && href.match(filetypes)) {
							jQuery(this).click(function() {
								var extension = (/[.]/.exec(href)) ? /[^.]+$/.exec(href) : undefined;
								var filePath = href;
								_gaq.push(['_trackEvent', 'Download', 'Click-' + extension, filePath]);
								if (jQuery(this).attr('target') != undefined && jQuery(this).attr('target').toLowerCase() != '_blank') {
									setTimeout(function() { location.href = baseHref + href; }, 200);
									return false;
								}
							});
						}
					});
				});
			}
		</script>

		<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-12843232-1']);
		  _gaq.push(['_trackPageview']);

		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		</script>
		<!-- End Google Analytics -->

    <script>
$("form input#mt-site-search-input.mt-text.mt-search.search-field").attr("placeholder", "Search EBSCO Help").val("");
</script>

  <style>
  .contact_title { font-size: 34px; color: #454545; margin: 40px 10px; }

  hr.style-six { border: 0; height: 0; border-top: 1px solid rgba(0, 0, 0, 0.1); border-bottom: 1px solid rgba(255, 255, 255, 0.3); width: 980px; }
  </style>
	
		<script src='https://www.google.com/recaptcha/api.js'></script>
		</head>
<body>

<!-- ClickTale Top part -->
<script type="text/javascript">
var WRInitTime=(new Date()).getTime();
</script>
<!-- ClickTale end of Top part -->

<?
$q = request_value('q');
?>
<div id="content">
<div class="logoNavContainer">
<div id="logoContainer"><a class="logo" href="https://help.ebsco.com" title=""><img alt="EBSCO Support logo" src="/images/ebsco-help-logo.png"></a></div>

<nav class="skin_main-nav no-nav-js" id="mainNav">

<ul class="nav-menu">
	<li class="nav-item has-drop "><a class="nav-link mobi-heading" href="#">Institution Type<span class="drop-menu"> </span></a>

	<ul class="nav-menu">
		<li class="nav-item submobile"><a class="nav-link" href="https://help.ebsco.com/colleges_universities" target="_blank">Colleges/Universities</a></li>
		<li class="nav-item submobile"><a class="nav-link" href="https://help.ebsco.com/schools" target="_blank">Schools</a></li>
		<li class="nav-item submobile"><a class="nav-link" href="https://help.ebsco.com/public_libraries" target="_blank">Public Libraries</a></li>
		<li class="nav-item submobile"><a class="nav-link" href="https://help.ebsco.com/healthcare_medical" target="_blank">Healthcare/Medical</a></li>
		<li class="nav-item submobile"><a class="nav-link" href="https://help.ebsco.com/corporate" target="_blank">Corporate</a></li>
		<li class="nav-item submobile"><a class="nav-link" href="https://help.ebsco.com/government" target="_blank">Government</a></li>
		<li class="nav-item submobile"><a class="nav-link" href="https://help.ebsco.com/international" target="_blank">International</a></li>
		<li class="nav-item submobile"><a class="nav-link" href="https://help.ebsco.com/administrators" target="_blank">Administrators</a></li>
	</ul>
	</li>
	<li class="nav-item"><a target="_blank" href="http://support.ebscohost.com/training" class="nav-link">Training</a></li>
	<li class="nav-item has-drop "><a class="nav-link mobi-heading" href="http://support.ebscohost.com/promotion">Promote Your Resources<span class="drop-menu"> </span></a>
	<ul class="nav-menu">
		<li class="nav-item submobile"><a target="_blank" href="http://support.ebscohost.com/eit/sbb.php" class="nav-link">Build a Custom Search Box</a></li>
		<li class="nav-item submobile"><a target="_blank" href="http://support.ebscohost.com/eit/urlb.php" rel="external nofollow" class="nav-link">Build a Direct URL</a></li>
		<li class="nav-item submobile"><a target="_blank" href="http://support.ebscohost.com/promotion" rel="external nofollow" class="nav-link">Find Posters, Flyers, and Web Graphics</a></li>
	</ul>
	</li>
	<li class="nav-item hide-lt-900"><a target="_blank" href="http://support.ebscohost.com/contact/askus.php" class="nav-link button">Contact Support</a></li>
	<!--<li class="nav-item hide-lt-900-globe"><a target="_blank" href="http://support.ebscohost.com/training/resources.php"><img alt="globe-icon-menu.png" src="/images/globe-icon-menu.png"></a></li>-->
</ul>
</nav>
</div>

<nav class="elm-header-user-nav elm-nav">
<div class="elm-nav-container">
<ol>
<li class="elm-global-search">
<a class="mt-icon-site-search mt-toggle-form" title="Search site" href="#">Search site</a>
<div class="mt-quick-search-container mt-toggle-form-container">
<form action="https://help.ebsco.com/Special:Search">
<input id="mt-qid-skin" type="hidden" value="" name="qid">
<input id="mt-search-filter-id" type="hidden" value="230" name="fpid">
<input id="mt-search-filter-path" type="hidden" name="fpth">
<input id="mt-search-path" type="hidden" value="" name="path">
<label class="mt-label" for="mt-site-search-input"> Search </label>
<input id="mt-site-search-input" class="mt-text mt-search search-field" type="search" tabindex="1" placeholder="Search EBSCO Help" name="search">
<button class="mt-button ui-button-icon mt-icon-site-search-button search-button" type="submit" tabindex="2"> Search </button>
</form>
</div>
</div>
<div class="elm-search-back">
</li>
<li class="elm-user-menu">
</ol>
</div>
</nav>
