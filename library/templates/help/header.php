<? header('Content-type: text/html; charset=utf-8');?>
<?php error_reporting(E_ALL); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

	<title><?= $this->getHtmlTitle() ?></title>

	<link rel="stylesheet" href="/stylesheets/help.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/stylesheets/print_help.css" type="text/css" media="print" />
	<link rel="shortcut icon" href="favicon.ico" />
	<script type="text/javascript"  src="/javascripts/help.js"></script>

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
		  _gaq.push(['_setAccount', 'UA-12843232-3']);
		  _gaq.push(['_trackPageview']);

		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>
	<!-- End Google Analytics -->
</head>

<body onload="frontage();">

<?
$logo = (strlen($this->getData('interface_logo'))) ? $this->getData('interface_logo') : _DEFAULT_HELP_LOGO;
?>

<div id="header">
	<div class="close">
		<a style="font-family: arial,helvetica,sans-serif; color: white; text-decoration: none; font-weight: bold;" href="javascript:window.close();"><img src="/images/icons/close.gif" alt="Close page" /><!--<img src="/images/btn_close_window.gif" alt="Close Window" />--></a>
	</div>
	<div class="print">
		<a style="font-family: arial,helvetica,sans-serif; color: white; text-decoration: none; font-weight: bold;" href="javascript:window.print();"><img src="/images/icons/print.gif" alt="Print page" /></a>
	</div>
	<a href="<?= $_SERVER['PHP_SELF'] ?>"><img src="<?= $logo ?>" alt="EBSCO Help and Support Site" class="logo" /></a>
</div>
