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
    <div class="head">Webcasts</div>
    <div class="body_textarea"><br />
	<span class="greybold">Upcoming</span><br />
	<?php 
	
	# INSTANTIATE CURL.
	$curl = curl_init();

	# CURL SETTINGS.
	curl_setopt($curl, CURLOPT_URL, "http://nov-partners1.epnet.com/NovSupportRss/WebcastsUpcoming.xml");
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
		# DISPLAY ONLY 15 ITEMS.
		if ( $tempCounter < 15 )
	{
		if ( $item->guid != null && $item->guid != "" )
		{
			echo "<br /><a href=\"{$item -> guid}\" target='_blank'>{$item -> title}</a><br />{$item -> description}<br />";
		}
		else
		{
			echo "<br /><u>{$item -> title}</u><br />{$item -> description}<br /><br />";
		}
    }

    $tempCounter += 1;
	}
	
	?>
	<br />
	<span class="greybold">Archived</span><br /><br />
	Select a link below to view one of our archived webcasts.<br />
	
	<?php 
	
	# INSTANTIATE CURL.
	$curl = curl_init();

	# CURL SETTINGS.
	curl_setopt($curl, CURLOPT_URL, "http://nov-partners1.epnet.com/NovSupportRss/WebcastsArchived.xml");
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
		# DISPLAY ONLY 15 ITEMS.
		if ( $tempCounter < 15 )
	{
		if ( $item->guid != null && $item->guid != "")
		{
			echo "<br /><a href=\"{$item -> guid}\" target='_blank'>{$item -> title}</a><br />{$item -> description}<br />";
		}
		else
		{
			echo "<br /><u>{$item -> title}</u><br />{$item -> description}<br /><br />";
		}
    }

    $tempCounter += 1;
	}
	
	?>
	
	</div>

 

  
    </div>


<?php include("footer.php"); ?>
