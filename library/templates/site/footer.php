<br /><br />
<div id="footer">

	<div class="content">
		<a href="/contact/" class="gray">Contact Us</a>  &nbsp;|&nbsp;
		<a href="mailto:customersuccess@ebscohost.com" class="gray">Training Info</a>  &nbsp;|&nbsp;
		<!--<a href="/contact/mailing_list.php" class="gray">Join Our Mailing List</a>  &nbsp;|&nbsp;-->
		<a href="http://www.ebsco.com" class="ExLink">www.ebsco.com</a>  &nbsp;|&nbsp;
		<a href="http://www.ebscohost.com" class="ExLink">www.ebscohost.com</a>
		<? if (Session::getLoggedInUserId()) { ?>
			&nbsp;|&nbsp;  <a href="/admin/index.php" class="gray"><strong>Admin</strong></a>
			&nbsp;|&nbsp;  <a href="/login/?page_function=logout" class="gray">Log Out</a><br />
		<? } ?>
	</div>
<div id="copyrights">&copy; <? echo date("Y") ?> EBSCO. All Rights Reserved.</div>
		</div> <!-- end footer -->




<div>
	<map name="Map" id="Map">
		<area shape="rect" coords="3,5,102,27"   href="/knowledge_base/" alt="Knowlede Base" />
		<area shape="rect" coords="108,5,183,28" href="/training/" alt="Training" />
		<area shape="rect" coords="188,5,289,28" href="/support_news/" alt="Support News" />
		<area shape="rect" coords="296,6,408,28" href="/customer_success/" alt="Customer Success" />
		<area shape="rect" coords="414,4,491,27" href="/contact/" alt="Contact" />
	</map>
</div>

</div> <!-- end wrapperA -->

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
</body>
</html>
