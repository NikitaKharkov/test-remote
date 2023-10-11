  <a href="http://www.ebscohost.com/novelist/support-training/libraryaware-support" style="text-decoration:none;" target="_blank">Looking for LibraryAware Support?</a>
<div class="left_head">Search NoveList Support</div>
	<form id="search" style="padding-bottom:12px;" action="/novelist/search_novelist.php" method="get">
		<input type="hidden" name="page_function" value="search" />
		<input type="text" size="25" value="<?php if (isset($_GET['keyword'])) echo $_GET['keyword']; ?>" name="keyword" />&nbsp;<input style="vertical-align:bottom;" type="image" src="images/searchbut.gif" alt="Search" /><br /><br />
			<select name="interface_id[]" multiple="multiple">
				<option value="0" <?php if(($kb_interface_ids == null || count($kb_interface_ids) == 0 ) || ($kb_interface_ids != null && in_array("0",$kb_interface_ids))) { echo "selected";} ?>> All </option>
				<option value="1077" <?php if($kb_interface_ids != null && in_array("1077",$kb_interface_ids)) { echo "selected";} ?>>NoveList Plus</option>
				<option value="1078" <?php if($kb_interface_ids != null && in_array("1078",$kb_interface_ids)) { echo "selected";} ?>>NoveList K8 Plus</option>
				<option value="1124" <?php if($kb_interface_ids != null && in_array("1124",$kb_interface_ids)) { echo "selected";} ?>>NoveList Plus Mobile</option>
				<option value="1125" <?php if($kb_interface_ids != null && in_array("1125",$kb_interface_ids)) { echo "selected";} ?>>NoveList Select</option>
				<option value="1059" <?php if($kb_interface_ids != null && in_array("1059",$kb_interface_ids)) { echo "selected";} ?>>NextReads/LibraryAware</option>
			</select>
	</form>
 <div class="left_head">What's Happening?</div>
	  <a href="https://www.ebscohost.com/novelist-the-latest/category/novelist-news" target="_blank" class="left_menu" style="padding-bottom:12px;">See All News</a>
	   <!--<a href="/novelist/success_stories.php" class="left_menu" style="padding-bottom:12px;">Success Stories</a>-->
		<div class="left_head">Helping Your Readers</div>
		  <a href="http://www.ebscohost.com/novelist/novelist-special/subscribe-to-newsletters" class="left_menu" target="_blank">Our Newsletters</a>
		  <a href="/novelist/beyondsubjectheadings.php" class="left_menu">Beyond Subject Headings</a>
		  <a href="/novelist/recommendations.php" class="left_menu">Reading Recommendations</a>
		   <a href="http://www.ebscohost.com/novelist/our-products/novelist-complete" class="left_menu" style="padding-bottom:12px;" target="_blank">What is NoveList Complete?</a>
		<div class="left_head">Webcasts</div>
		 <a href="https://www.ebscohost.com/novelist-the-latest/category/novelist-events" class="left_menu" style="padding-bottom:12px;" target="_blank">View All Webcasts</a>
		 <div class="left_head">Connect With Us</div>
		  
		 <div class="left_menu_connect">
			<div style="float:right;"><a href="http://www.twitter.com/NoveListRA" target="_blank"><img src="images/twitter.png" border="0" /></a>
				</div>
			<div>
				<a href="https://www.facebook.com/EBSCONoveList" target="_blank"><img src="images/facebook.png" border="0" /></a>&nbsp;
			</div>
		 </div>