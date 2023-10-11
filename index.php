
<?php
header("HTTP/1.1 301 Moved Permanently");
header( 'Location: https://connect.ebsco.com' ) ;
?>

<?
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php');

$page_function = page_function(
	array( "list" ), request_value('page_function')
);

$template->setStyle('site');
$template->setHtmlTitle('Support Site');

$template->printHeaderMT();



# ----------------------------------- #
#	BODY
# ----------------------------------- #

?>


	<div id="lm">

		<div class="left">
			<div class="left_articles_title">
				<img src="/images/newspaper_icon.gif" />
				<a style="position: relative; top: -4px;" href="/rss/topstories.xml"><img src="/images/icons/feed-icon-16x16.gif" border="none" /></a>

					<div class="small" style="float:right; padding-top:4px; #position:relative; top:-26px;">
					<a href="/support_news/index.php">full archive</a>
				</div>

			</div>


				<?
				try {
					$news_items = $news_item_controller->listNewsItems('display_date_desc', 'Support News', array('public'), 3);

					foreach($news_items as $news_item_id => $news_item) {
						$link = "/support_news/detail.php?id=" . $news_item_id . "&amp;t=h";
						$short_description = substr(strip_tags($news_item->getContent()), 0, 220) . "...";

						?>

						<div class="left_articles">
							<a href="<?= $link; ?>"><?= $news_item->getTitle() ?></a>
							<br />
							<?= $short_description; ?>
							<a href="<?= $link; ?>" class="green">More</a>
						</div>
						<?
						}
				} catch (Exception $e) {
					?>
					<div class="left_articles">
						No top stories available. <em>Please check back soon...</em>
					</div>
					<?
					}
				?>


				<?
			try {
				$news_items = $news_item_controller->listNewsItems('display_date_desc', 'Release Notes', array('public'), 1);

				foreach($news_items as $news_item_id => $news_item) {
					$link = "/support_news/detail.php?id=" . $news_item_id . "&amp;t=h";
					$short_description = substr(strip_tags($news_item->getContent()), 0, 220) . "...";
				?>



		<div class="sysalertstop"><a style="padding:0px; left: 135px; position: relative;" href="/rss/system_alerts.xml"><img src="/images/icons/feed-icon-16x16.gif" border="none" /></a>
				</div>
			<div id="sysAlerts">
				<img style="vertical-align:middle;" src="/images/icons/alerts.png"> There are active system alerts posted. <a href="/support_news/alerts">View affected products and services.</a>
         <form action="https://feedburner.google.com/fb/a/mailverify" method="post" style="padding: 20px 0 0;" target="popupwindow" onsubmit="window.open('https://feedburner.google.com/fb/a/mailverify?uri=EbscoSystemAlerts', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
            <input type="text" style="width:400px; height: 19px; float: left; margin-right: 10px; border: 1px solid #156619; text-indent: 4px;" placeholder="Email Address" name="email"/><input type="hidden" value="EbscoSystemAlerts" name="uri"/>
            <input type="hidden" name="loc" value="en_US"/><input class="feedburner" type="submit" value="Subscribe to System Alerts" />
         </form>
			</div>
		<div class="sysalertsbottom"></div>



				<?
						}
				} catch (Exception $e) {
					?>
					<div class="sysalertstop"><a style="padding:0px; left: 135px; position: relative;" href="/rss/system_alerts.xml"><img src="/images/icons/feed-icon-16x16.gif" border="none" /></a></div>
						<div id="sysAlerts">
							<img style="vertical-align:middle;" src="/images/icons/no_alerts.png"> There are no active system alerts at this time. To report an issue please <a href="/contact/askus.php">contact Customer Support.</a>
                <form action="https://feedburner.google.com/fb/a/mailverify" method="post" style="padding: 20px 0 0;" target="popupwindow" onsubmit="window.open('https://feedburner.google.com/fb/a/mailverify?uri=EbscoSystemAlerts', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
                  <input type="text" style="width:400px; height: 19px; float: left; margin-right: 10px; border: 1px solid #156619; text-indent: 4px;" placeholder="Email Address" name="email"/><input type="hidden" value="EbscoSystemAlerts" name="uri"/>
                  <input type="hidden" name="loc" value="en_US"/><input class="feedburner" type="submit" value="Subscribe to System Alerts" />
                </form>
						</div>
					<div class="sysalertsbottom"></div>
					<?
					}
				?>

		</div>

		<div id="right">

			<div class="boxtoptutorials"></div>
				<div class="box">

							<table border="0" cellspacing="0" cellpadding="4">
								<tr>
									<td><img src="images/tutvid.gif" /></td>
									<td><a class="tutlink" href="/training/flash_videos/intro_to_ehost/intro_to_ehost.html" target="_blank" alt="Introduction to EBSCO<i>host</i> - Flash Tutorial" title="Introduction to EBSCO<i>host</i> - Flash Tutorial">Introduction to EBSCO<i>host</i></a></td>
								</tr>
								<tr>
									<td><img src="images/tutvid.gif" /></td>
									<td><a class="tutlink" href="/training/flash_videos/eds/eds.html" target="_blank" alt="EBSCO Discovery Service Tutorial - Flash" title="EBSCO Discovery Service Tutorial - Flash">EBSCO Discovery Service</a></td>
								</tr>
								<tr>
									<td>&nbsp;<img src="images/icons/youtube_icon.gif" /></td>
									<td><a class="sclink" href="http://www.youtube.com/c/EBSCOSupportTutorials" target="_blank">EBSCO YouTube Channel</a></td>
								</tr>

							</table>



				<a href="/tutorials">View all tutorials</a>
				</div>

				<div style="height:7px;"></div>
				<div class="boxtoptraining"></div>
				<div class="scbox">

							<table border="0" cellspacing="0" cellpadding="4">
								<tr>
								  <td><img src="images/ebookmini.png" alt="eBooks and Audiobooks" /></td>
								  <td><a class="sclink" href="/ebooks">eBooks &amp; Audiobooks</a></td>
							  </tr>
								<tr>
									<td><img src="images/edsmini.gif" /></td>
									<td><a class="sclink" href="/eds">EBSCO Discovery Service</a></td>
								</tr>
								<tr>
									<td><img src="images/ftfmini.gif" /></td>
									<td><a class="sclink" href="/fulltextfinder">Full Text Finder Migration</a></td>
								</tr>
								<tr>
									<td><img src="images/enetscmini.gif" /></td>
									<td><a class="sclink" href="/ejournals">Journal &amp; E-Package Services</a></td>
								</tr>
								<tr>
									<td><img src="images/novmini.gif" /></td>
									<td><a class="sclink" href="/novelist">NoveList Support Center</a></td>
								</tr>

								<tr>
									<td><img src="images/cinahlmini.gif" /></td>
									<td><a class="sclink" href="/cinahl">CINAHL Support Center</a></td>
								</tr>

								<tr>

								<td><img src="images/ehistoolkitmini.gif" /></td>
								<td><a class="sclink" href="/eit">EBSCO<i>host</i> Integration Toolkit</a></td>


								</tr>



							</table>

				</div>

		</div>


	</div>

	<div id="shade"></div>


	<div id="bottomsection">

		<div class="topfaqs">
		<img src="images/topfaqs.gif" />

				<?
				try {
					$kb_pages = $kb_controller->listKbPages('last_updated_desc', NULL, NULL, NULL, NULL, array('public','private'), NULL, NULL, NULL, TRUE, 5);

					$c = 1;
					?>


					<?
					foreach($kb_pages as $kbp_id => $kbp) {

						$link = "/knowledge_base/detail.php?id=" . $kbp_id . "&amp;t=h";

						// $link .= ($private) ? "&amp;private=true" : "";

						if (!$kbp->getContent() && $kbp->getFile()) {
							$link = $kbp->getFile(TRUE);
						}
						?>

					<ul><li><a href="<?= $link; ?>"><?= $kbp->getTitle() ?></a></li></ul>



						<?
						$c++;
					}
					?>

					<?
				} catch (Exception $e) {}
				?>


		</div>
	 <div class="supportcenters">
		<img src="images/supportcenters.gif" />
			<ul>
				<li><a href="https://ebscotraining.webex.com/tc0506l/trainingcenter/record/navRecordAction.do?siteurl=ebscotraining&firstEnter=1" target="_blank">On-Demand Training</a></li>
				<li><a href="http://ebscotraining.webex.com" target="_blank">View Schedule & Register For Training</a></li>
				<li><a href="/training/TNSignup.php">Get our Training Newsletter</a></li>
				<li><a href="/knowledge_base/search.php?keyword=&language_id=&document_type=Trainer+%2F+Teacher+Guide&topic=&interface_id=&ebsco_database_id=&page_function=search&x=43&y=5">Trainer Guides/Outlines</a></li>
				<li><a href="/training/index.php">Visit our Training Page</a></li>
			</ul>
		</div>
	<div class="custsuccess">
		<img src="images/eadmin_header.png" />
				<p>EBSCO<em>admin</em> allows library administrators to customize the look and available features of EBSCO interfaces as well as access usage reports for EBSCO products.</p>
        <p>Learn how to use EBSCO<em>admin</em>:<br /><a href="/tutorials/ebscoadmin">EBSCO<em>admin</em> Tutorials</a></p>

		</div>
		<!--<div class="promotion">
		<img src="images/promotion.gif" />
			<ul>
				<li><a href="/promotion">Promotion Tools</a></li>
				<li><a href="/knowledge_base/search.php?keyword=buttons&language_id=&document_type=Marketing+Resource&topic=&interface_id=&ebsco_database_id=&page_function=search">Product Buttons</a></li>
				<li><a href="/knowledge_base/search.php?keyword=logo&interface_id=&document_type=Marketing+Resource&page_function=search">Product Logos</a></li>
				<li><a href="/knowledge_base/search.php?keyword=try+it+now+ads&interface_id=&document_type=Marketing+Resource&page_function=search">Try It Now! Ads</a></li>
				<li><a href="/knowledge_base/detail.php?id=3955">Search Box Builder</a></li>
			</ul>
		</div>-->

	</div>


<?php
# ----------------------------------- #
# FOOTER
# ----------------------------------- #
$template->printFooterMT();
?>
