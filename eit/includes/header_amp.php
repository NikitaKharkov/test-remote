<?php

if ($html5)
{
	echo '<!doctype html>';
}
else
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "https://www.w3.org/TR/html4/loose.dtd">';
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>EBSCOhost Integration Toolkit Support Center</title>
<?php echo $head; ?>
<?php

if ($newJQuery) {
	echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js" type="text/javascript"></script>';
}
else {
	echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js" type="text/javascript"></script>';
}

?>
<!--Amplitude -->
<script type="text/javascript">
  (function(e,t){var n=e.amplitude||{_q:[],_iq:{}};var r=t.createElement("script")
  ;r.type="text/javascript"
  ;r.integrity="sha384-d/yhnowERvm+7eCU79T/bYjOiMmq4F11ElWYLmt0ktvYEVgqLDazh4+gW9CKMpYW"
  ;r.crossOrigin="anonymous";r.async=true
  ;r.src="https://cdn.amplitude.com/libs/amplitude-5.2.2-min.gz.js"
  ;r.onload=function(){if(!e.amplitude.runQueuedFunctions){
  console.log("[Amplitude] Error: could not load SDK")}}
  ;var i=t.getElementsByTagName("script")[0];i.parentNode.insertBefore(r,i)
  ;function s(e,t){e.prototype[t]=function(){
  this._q.push([t].concat(Array.prototype.slice.call(arguments,0)));return this}}
  var o=function(){this._q=[];return this}
  ;var a=["add","append","clearAll","prepend","set","setOnce","unset"]
  ;for(var u=0;u<a.length;u++){s(o,a[u])}n.Identify=o;var c=function(){this._q=[]
  ;return this}
  ;var l=["setProductId","setQuantity","setPrice","setRevenueType","setEventProperties"]
  ;for(var p=0;p<l.length;p++){s(c,l[p])}n.Revenue=c
  ;var d=["init","logEvent","logRevenue","setUserId","setUserProperties","setOptOut","setVersionName","setDomain","setDeviceId","setGlobalUserProperties","identify","clearUserProperties","setGroup","logRevenueV2","regenerateDeviceId","groupIdentify","onInit","logEventWithTimestamp","logEventWithGroups","setSessionId","resetSessionId"]
  ;function v(e){function t(t){e[t]=function(){
  e._q.push([t].concat(Array.prototype.slice.call(arguments,0)))}}
  for(var n=0;n<d.length;n++){t(d[n])}}v(n);n.getInstance=function(e){
  e=(!e||e.length===0?"$default_instance":e).toLowerCase()
  ;if(!n._iq.hasOwnProperty(e)){n._iq[e]={_q:[]};v(n._iq[e])}return n._iq[e]}
  ;e.amplitude=n})(window,document);

  amplitude.getInstance().init("f82a504a3b09b6fd2166939568a28ac3");
</script>

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

<!-- Firing Amplitude shown event -->
<script>
	amplitude.getInstance().logEvent('Form - shown',{});
</script>

<!-- End Firing Amplitude shown event-->

<div class="header_background">
	<div class="header">
		<div style="padding: 3px">
			<div class="link_area">
				<div id="header_links">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="faq.php">FAQ</a></li>

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
