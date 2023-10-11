<?php include("topheader.php"); ?>
<?php include("topmenu.php"); ?>
 

<div id="body_area">
  <div class="left">
	<div class="left_menu_area">
      <div align="right">
	  	  <?php include("menu.php"); ?>
       </div>
    </div>

  </div>
  <div class="midarea">
    <div class="head">Success Stories <a href="http://novelistpls1.epnet.com/rss/NoveListSuccessStories.xml"><img src="/images/icons/feed-icon-16x16.gif" border="none" /></a></div>
   
  <div class="body_textarea">
<br />
	This section features examples of how libraries across the United States and in Canada are successfully using NoveList products--the NoveList databases, NoveList Select, and 
	NextReads--to meet their needs. Content is added regularly, so check back often for new and interesting stories about the value of NoveList products from your colleagues!<br /><br />
	
	Do you have a NoveList success story that you would like to share with us? Contact us at <a href="mailto:NoveList@ebscohost.com">NoveList@ebscohost.com</a>. Send us your name, your library's name, your contact information,
	and a brief description of the challenge you faced, the solution you devised, and the benefits received from your program. We'd love to hear from you!
<br />
		
		<?php 
	
	# INSTANTIATE CURL.
	$curl = curl_init();

	# CURL SETTINGS.
	curl_setopt($curl, CURLOPT_URL, "http://novelistpls1.epnet.com/rss/NoveListSuccessStories.xml");
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 0);

	# GRAB THE XML FILE.
	$xmlRSS = curl_exec($curl);

	curl_close($curl);

	# SET UP XML OBJECT.
	$xmlObjRSS = simplexml_load_string( $xmlRSS );

	$tempCounter = 0;

	foreach ( $xmlObjRSS->channel->item as $item )
	{                    
		# DISPLAY ONLY 10 ITEMS.
		if ( $tempCounter < 50 )
	{
        echo "<br /><a href=\"{$item -> guid}\" target='_blank'>{$item -> title}</a><br />{$item -> description}<br />";
    }

    $tempCounter += 1;
	}
	
	?>
	
	
  </div>
	
   
  </div>

</div>

<?php include("footer.php"); ?>