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
    <div class="head">News <a href="http://feeds.feedburner.com/NovelistBlog-News"><img src="/images/icons/feed-icon-16x16.gif" border="none" /></a><div style="font-family: arial; font-size:14px; float:right;"><a href="https://www.ebscohost.com/novelist-the-latest/category/novelist-news">See All News</a></div></div>
  
  <div class="body_textarea">
	<p>
		
		<?php 
	
	//INSTANTIATE CURL.
	$curl = curl_init();

	//CURL SETTINGS.
        // @todo very strange: feed has a link to a new resource but new one is not secure and doesn't give any info ¯\_(ツ)_/¯
	curl_setopt($curl, CURLOPT_URL, "http://feeds.feedburner.com/NovelistBlog-News");
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 0);

	//GRAB THE XML FILE.
	$xmlRSS = curl_exec($curl);

	curl_close($curl);

	//SET UP XML OBJECT.
	$xmlObjRSS = simplexml_load_string( $xmlRSS );

	$tempCounter = 0;

	foreach ( $xmlObjRSS->channel->item ?? [] as $item )
	{                    
		//DISPLAY ONLY 1 ITEM.
		if ( $tempCounter < 1 )
	{
        echo "<br /><a href=\"{$item -> guid}\" target='_blank'>{$item -> title}</a><br />{$item -> description} <a href=\"{$item -> guid}\" target='_blank'>More</a><br />";
    }

    $tempCounter += 1;
	}
	
	 ?> 
	
	</p><br /><br />

	<div id="headlink" style="text-align:center;"><a href="http://www.ebscohost.com/novelist/our-products/novelist-complete"  target="_blank">The NoveList Complete Solution</a></div>
		
	<div id="wrap">
   <ul id="mycarousel" class="jcarousel-skin-NoveList">
    <li><img src="images/carousel1.gif" width="570" height="392" alt="" /></li>
    <li><img src="images/carousel2.gif" width="570" height="392" alt="" /></li>
    <li><img src="images/carousel3.gif" width="570" height="392" alt="" /></li>
  </ul>

</div>	
		
  </div>


</div>
</div>

<?php include("footer.php"); ?>
