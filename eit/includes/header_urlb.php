<?php
echo '<!doctype html>';
?>

<html>
    <head>
    <meta charset="ISO-8859-1">
    <title>EBSCOhost Integration Toolkit Support Center</title>
    <?php echo $head; ?>
    <?php
    
    if ($newJQuery) {
        echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js" type="text/javascript"></script>';
    }
    else {
        echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js" type="text/javascript"></script>';
    }
    
    echo '<script src="./js/urlbFunctions.js" type="text/javascript"></script>';
    echo '<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>';
    
    ?>
    
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
    
    </head>
<body >

<!-- Preloading Images -->
<a href="../index.php"><img src="img/btn_background_hover.png" alt="" style="display: none"></a>
<!-- End Preloading Images -->

<div class="header_background">
	<div class="header">
		<div style="padding: 3px">
			<div class="link_area">
				<div id="header_links">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="urlb_faq.php">FAQ</a></li>
						<!--<li><a href="urlb_examples.php">Samples</a></li>-->
						<li><a href="support.php">Support</a></li>
					</ul>
				</div>
			</div>
		</div>
		
		<div class="shadow_left"></div>
		<div class="shadow_right"></div>
	</div>
</div>
<div class="header_separator_background">
	<div class="header_separator">
		<div class="shadow_left"></div>
		<div class="shadow_right"></div>
	</div>
</div>
<div class="body_background">
	<div class="body">
		<div id="navarea" class="left_bar">
			<div class="left_bar_content">