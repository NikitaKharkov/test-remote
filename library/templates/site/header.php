<? header('Content-type: text/html; charset=utf-8');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<title>EBSCO Support: <?= $this->html_title ?></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="EBSCO SUPPORT: EBSCO's Industry Leading Support Site &amp; Knowledge Base offers customers 24x7 access to FAQs, User Guides, Product Marketing Sheets, Help Sheets, Best Practice Guides, a library of Tutorials, and the latest product News." />
		<link rel="shortcut icon" href="favicon.ico" />

		<link href="/stylesheets/style_NEW.css" rel="stylesheet" type="text/css" media="screen, handheld" />
		<link rel="stylesheet" href="/stylesheets/print_faq.css" type="text/css" media="print" />
		<link href="/stylesheets/paginator.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="/knowledge_base/css/rating.css" media="all" />

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
<div id="header">
			<div id="menu">
			<div id="contact">
					<!--<div style="float:left; padding:8px 0 0 35px; #padding:8px 0 0 35px;"><a href="/contact">Contact</a></div>-->
					<div style="float:left; padding:8px 0 0 40px; #padding:8px 0 0 40px;"><a href="/contact">Email Support</a></div>
				</div>

	<ul class="top-level">



		<li class="top-level-li"><a class="top-level-a down" href="/training"><b>Training</b></a></li>

		<li class="top-level-li"><a class="top-level-a down" href="/tutorials" target="_blank"><b>Tutorials</b></a></li>

		<li class="top-level-li"><a class="top-level-a down" href="/promotion"><b>Promotion Tools</b></a></li>

		<li class="top-level-li"><a class="top-level-a down" href="/knowledge_base/detail.php?id=3955"><b>Search Box Builder</b></a>
		</li>

		<li class="top-level-li"><a class="top-level-a" href="/training/resources.php"><b>International Resources</b></a></li>


      <li class="top-level-li"><a class="top-level-a" href="//eadmin.ebscohost.com" target="_blank"><b>EBSCO<em>admin</em> Login</b></a>
		</li>

		<li class="top-level-li"><a class="top-level-a" href="http://ebsco.libguides.com/home" target="_blank"><b>EBSCO LibGuides</b></a>
		</li>


	</ul>
</div>

		</div> <!-- end header -->
