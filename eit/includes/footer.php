<?php
// set the default timezone
date_default_timezone_set('UTC');

?>

</div>
		<div style="clear: both"></div>

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
<div class="footer_background">
	<div id="footer">
		<ul>
			
			<li>
				<h1>EBSCO Connect</h1>
				Technical support, Tutorials,<br>Training, FAQs, Help sheets, User<br>guides and more
				<br><br>
				<a target="_new" href="https://connect.ebsco.com/"><img style="border: 0px;" src="img/readmore.png" alt=""></a>
			</li>
			<li>
				<h1>EBSCO</h1>
				Read about all of EBSCO's<br>available products and<br>databases.
				<br><br>
				<a target="_new" href="http://www.ebscohost.com/"><img style="border: 0px;" src="img/readmore.png" alt=""></a>
			</li>
		</ul>
		<div class="shadow_left"></div>
		<div class="shadow_right"></div>
		<div class="shadow_fade_left"></div>
		<div class="shadow_fade_right"></div>
	</div>
</div>
<br>
<div class="copyright">
	<br>
	&copy; <?php echo date("Y") ?> EBSCO. All Rights Reserved.
	<br>
	<br>
</div>
<?php

if( isset( $page_footer) )
	echo $page_footer;

?>
<!-- ClickTale Bottom part -->
<div id="ClickTaleDiv" style="display: none;"></div>
<script type='text/javascript'>
document.write(unescape("%3Cscript%20src='"+
(document.location.protocol=='https:'?
  'https://clicktale.pantherssl.com/':
  'http://s.clicktale.net/')+
"WRc9.js'%20type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var ClickTaleSSL=1;
if(typeof ClickTale=='function') ClickTale(50352,0.1,"www");
</script>
<!-- ClickTale end of Bottom part -->
<script>
    try {
      const unique = Date.now();
      let scriptFile = document.createElement('script');
      scriptFile.setAttribute('src', 'https://www.ebsco.com/files/gdpr/gdpr.js?' + unique);
      document.getElementsByTagName('head')[0].appendChild(scriptFile);
    } catch(e) {
      window.console.log('GDPR not loaded. Error was ', e);
    }
  </script>
</body>
</html>
