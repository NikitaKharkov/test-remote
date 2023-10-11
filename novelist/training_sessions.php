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
    <div class="head">Archived Training Sessions <a href="http://nov-partners1.epnet.com/NovSupportRss/ArchivedTrainingSessions.xml"><img src="/images/icons/feed-icon-16x16.gif" border="none" /></a></div>
   
  <div class="body_textarea">

		
		<?php 
	
	# INSTANTIATE CURL.
	$curl = curl_init();

	# CURL SETTINGS.
	curl_setopt($curl, CURLOPT_URL, "http://nov-partners1.epnet.com/NovSupportRss/ArchivedTrainingSessions.xml");
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
		if ( $tempCounter < 10 )
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