	<?
	if ($this->isColumnSet('left')) { 
		?>
		<br />
		</div>
		</div>
		</div>
		</div>
		</div>
		<?
	}
	?>
</div>
	

<div class="frame" id="frame_footer">
	<div class="inner_frame_footer">
		<a href="/contact/" class="gray">Contact Us</a>  &nbsp;|&nbsp;  
		<a href="/sitemap.php" class="gray">Site Map</a>  &nbsp;|&nbsp;  
		<a href="/contact/mailing_list.php" class="gray">Join Our Mailing List</a>  &nbsp;|&nbsp; 
		<a href="http://www.ebsco.com" class="ExLink">www.ebsco.com</a>  &nbsp;|&nbsp;
		<a href="http://www.ebscohost.com" class="ExLink">www.ebscohost.com</a>  &nbsp;|&nbsp;
		<a href="javascript:popUpSurvey('http://support.epnet.com/contact/surveys/index.php?sid=78&lang=en')" class="gray">Support site feedback?</a>
		<? if (Session::getLoggedInUserId()) { ?>
			&nbsp;|&nbsp;  <a href="/admin/index.php" class="gray"><strong>Admin</strong></a>
			&nbsp;|&nbsp;  <a href="/login/?page_function=logout" class="gray">Log Out</a>
		<? } ?>
	</div>
</div>

<div class="frame" id="frame_bottom">
</div>


<div>
	<map name="Map" id="Map">
		<area shape="rect" coords="3,5,102,27"   href="/knowledge_base/" alt="Knowlede Base" />
		<area shape="rect" coords="108,5,183,28" href="/training/" alt="Training" />
		<area shape="rect" coords="188,5,289,28" href="/support_news/" alt="Support News" />
		<area shape="rect" coords="296,6,408,28" href="/customer_success/" alt="Customer Success" />
		<area shape="rect" coords="414,4,491,27" href="/contact/" alt="Contact" />
	</map>
</div>

<!-- Google Analytics -->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-12843232-1");
pageTracker._trackPageview();
} catch(err) {}
</script>
<!-- End Google Analytics -->

</body>
</html>