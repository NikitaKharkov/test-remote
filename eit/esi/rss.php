<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_howto.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'rss_feeds';
$page = 'rss';
include( 'includes/navbar.php' );


?>
<a name="top"></a>
<h2>RSS Feeds</h2>
<p>
	 All EBSCOhost databases and interfaces support RSS ("Really Simple Syndication")
	 Feeds for search alerts and journal alerts.  An RSS feed will allow a user to see the 
	 latest in results for any search.  The RSS feed is in XML format, and can be displayed
	 using various methods, such as in an RSS reader, or using an XSL stylesheet in a browser.
</p>
<p>
	An RSS feed can be setup using any database interface you prefer.  RSS feeds can be setup
	for basic searches, advanced searches, and publications. 
</p>


<div class="hr"></div>

<a name="publication"></a>
<h3>How To: RSS Feeds for Publications</h3>
<p>
	Setting up an RSS feed with publications is useful, for example, if you want to track a specific magazine or journal. 
	Every time a new article from that publication is added, it will appear on the RSS feed. 
</p>
<table class="howto_table">
	<tr class="howto_tr">
		<td class="howto_left">
			<span style="font-weight: bold">Step 1</span>
		</td>
		<td class="howto_middle">
			Perform a search on any interface, with the keywords and limiters you'd like to use.
		<td>
		<td class="howto_right">
			<a href="javascript: popupImage( 'img/content/rss_search_full.png', 1000 )">
				<img src="img/content/rss_search.png" class="howto_img" alt="">
			</a>
		</td>
	</tr>
	<tr class="howto_tr">
		<td class="howto_left">
			<span style="font-weight: bold">Step 2</span>
		</td>
		<td class="howto_middle">
			On the top of the search screen, select "Publications", and choose the database from which
			you'd like to use publications from.
		<td>
		<td class="howto_right">
			<a href="javascript: popupImage( 'img/content/rss_pub_select_full.png', 1000 )">
				<img src="img/content/rss_pub_select.png" class="howto_img" alt="">
			</a>
		</td>
	</tr>
	<tr class="howto_tr">
		<td class="howto_left">
			<span style="font-weight: bold">Step 3</span>
		</td>
		<td class="howto_middle">
			Find the publication you'd like to use from the list, and select
			the RSS Feed button.
		<td>
		<td class="howto_right">
			<a href="javascript: popupImage( 'img/content/rss_pub_page_full.png', 1000 )">
				<img src="img/content/rss_pub_page.png" class="howto_img" alt="">
			</a>
		</td>
	</tr>
	<tr class="howto_tr">
		<td class="howto_left">
			<span style="font-weight: bold">Step 4</span>
		</td>
		<td class="howto_middle">
			In the "Create Alert" box, select the options you'd like to use for the alert, copy
			the "RSS Feed" link, and press "Save Alert".
		<td>
		<td class="howto_right">
			<a href="javascript: popupImage( 'img/content/rss_pub_rss_full.png', 1000 )">
				<img src="img/content/rss_pub_rss.png" class="howto_img" alt="">
			</a>
		</td>
	</tr>
</table>

<div class="hr"></div>
<a class="top" href="#top">Back to Top</a>
<a name="search"></a>
<h3>How To: RSS Feeds for Searches</h3>
<p>
	When setting up an RSS feed with searches, you can use any search terms and limiters that you like, and the RSS feed will 
	return the latest results for that search. 
</p>
<table class="howto_tr">

	<tr class="howto_tr">
		<td class="howto_left">
			<span style="font-weight: bold">Step 1</span>
		</td>
		<td class="howto_middle">
			Perform a search on any interface, with the keywords and limiters you'd like to use.
		<td>
		<td class="howto_right">
			<a href="javascript: popupImage( 'img/content/rss_search_full.png', 1000 )">
				<img src="img/content/rss_search.png" class="howto_img" alt="">
			</a>
		</td>
	</tr>
	
	<tr class="howto_tr">
		<td class="howto_left">
			<span style="font-weight: bold">Step 2</span>
		</td>
		<td class="howto_middle">
			On the top-right of the search results area, click on the "Alert / Save / Share" button to bring up the menu.
		<td>
		<td class="howto_right">
			<a href="javascript: popupImage( 'img/content/rss_alert_full.png', 1000 )">
				<img src="img/content/rss_alert.png" class="howto_img" alt="">
			</a>
		</td>
	</tr>
	<tr class="howto_tr">
		<td class="howto_left">
			<span style="font-weight: bold">Step 3</span>
		</td>
		<td class="howto_middle">
			On the "Alert / Save / Share" menu, click on the "RSS Feed" button to bring up the "Create an Alert" popup.
		<td>
		<td class="howto_right">
			<a href="javascript: popupImage( 'img/content/rss_button_full.png', 1000 )">
				<img src="img/content/rss_button.png" class="howto_img" alt="">
			</a>
		</td>
	</tr>
	<tr class="howto_tr">
		<td style="border-top: 1px solid #000000;">
			<span style="font-weight: bold">Step 4</span>
		</td>
		<td class="howto_middle">
			In the "Create Alert" box, select the options you'd like to use for the alert, copy
			the "RSS Feed" link, and press "Save Alert".
		<td>
		<td class="howto_right">
			<a href="javascript: popupImage( 'img/content/rss_box_full.png', 1000 )">
				<img src="img/content/rss_box.png" class="howto_img" alt="">
			</a>
		</td>
	</tr>
</table>

<?php 

include( 'includes/image_popup.php' );
include( 'includes/footer.php' );

?>