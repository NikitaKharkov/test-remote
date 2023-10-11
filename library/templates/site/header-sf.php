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
    <link rel="stylesheet" href="/stylesheets/connect.css" type="text/css" media="all" />



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
<div id="logoContainer"><a class="logo" href="https://connect.ebsco.com" title=""><img alt="EBSCO Support logo" src="/images/EBSCOConnect_logo.png"></a></div>

<nav class="skin_main-nav no-nav-js" id="mainNav">
<ul class="nav-menu">
	<li class="nav-item"><a target="_blank" href="https://connect.ebsco.com/s/contactsupport" class="nav-link">Contact Us</a></li>
	<li class="nav-item has-drop "><a class="nav-link mobi-heading" href="#">Product Help <span class="chevron bottom"></span></a>
	<ul class="nav-menu">
		<li class="nav-item submobile"><a class="nav-link" href="https://connect.ebsco.com/s/topic/0TO1H000000HHeqWAG/discovery-search?language=en_US" target="_blank">Discovery & Search</a></li>
		<li class="nav-item submobile"><a class="nav-link" href="https://connect.ebsco.com/s/topic/0TO1H000000HHeuWAG/public-library-resources?language=en_US" target="_blank">Public Library Resources</a></li>
		<li class="nav-item submobile"><a class="nav-link" href="https://connect.ebsco.com/s/topic/0TO1H000000HHewWAG/school-resources?language=en_US" target="_blank">School Resources</a></li>
		<li class="nav-item submobile"><a class="nav-link" href="https://connect.ebsco.com/s/topic/0TO1H000000HHexWAG/ebooks-audiobooks-magazines?language=en_US" target="_blank">eBooks, Audiobooks & Magazines</a></li>
		<li class="nav-item submobile"><a class="nav-link" href="https://connect.ebsco.com/s/topic/0TO1H000000HHepWAG/clinical-decision-support?language=en_US" target="_blank">Clinical Decision Support</a></li>
		<li class="nav-item submobile"><a class="nav-link" href="https://connect.ebsco.com/s/topic/0TO1H000000HHesWAG/medical-resources?language=en_US" target="_blank">Medical Resources</a></li>
		<li class="nav-item submobile"><a class="nav-link" href="https://connect.ebsco.com/s/topic/0TO1H000000HHeoWAG/career-skills-development?language=en_US" target="_blank">Career & Skills Development</a></li>
		<li class="nav-item submobile"><a class="nav-link" href="https://connect.ebsco.com/s/topic/0TO1H000000HHevWAG/research-databases?language=en_US" target="_blank">Research Databases</a></li>
		<li class="nav-item submobile"><a class="nav-link" href="https://connect.ebsco.com/s/topic/0TO1H000000HHenWAG/administrative-tools?language=en_US" target="_blank">Administrative Tools</a></li>
		<li class="nav-item submobile"><a class="nav-link" href="https://connect.ebsco.com/s/topic/0TO1H000000HHetWAG/news-information?language=en_US" target="_blank">News & Information</a></li>
		<li class="nav-item submobile"><a class="nav-link" href="https://connect.ebsco.com/s/topic/0TO1H000000HHerWAG/international-resources?language=en_US" target="_blank">International Resources</a></li>
		<li class="nav-item submobile"><a class="nav-link" href="https://connect.ebsco.com/s/topiccatalog" target="_blank">More Topics...</a></li>
	</ul>
	</li>
	<li class="nav-item"><a target="_blank" href="https://status.ebsco.com/" class="nav-link">System Status</a></li>
	<li class="nav-item"><a href="/training" class="nav-link">Training</a></li>
	<li class="nav-item has-drop "><a class="nav-link mobi-heading" href="http://support.ebscohost.com/promotion">Tools & Resources <span class="chevron bottom"></span></a>
	<ul class="nav-menu">
		<li class="nav-item submobile"><a target="_blank" href="https://cloud.ebsco.com" class="nav-link">App Store</a></li>
		<li class="nav-item submobile"><a target="_blank" href="http://support.ebscohost.com/eit/urlb.php" rel="external nofollow" class="nav-link">Direct URL Builder</a></li>
		<li class="nav-item submobile"><a href="/promotion" class="nav-link">Promotion Kits</a></li>
		<li class="nav-item submobile"><a target="_blank" href="http://support.ebscohost.com/eit/sbb.php" class="nav-link">Build a Custom Search Box</a></li>
	</ul>
	</li>
</ul>
</nav>
</div>
