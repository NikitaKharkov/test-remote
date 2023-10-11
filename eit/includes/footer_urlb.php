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
				<a target="_new" href="https://connect.ebscohost.com/"><img style="border: 0px;" src="img/readmore.png" alt=""></a>
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
