<?php
/************************************************
  EBSCO
  Rui Francisco (rfrancisco@ebscohost.com)
  Description : Flicker Widget for EDS
  
  Date        : 2012-12-06
  Notes       : Just CC license images 
	
 ***********************************************/

?>

<html >
  <head>
	<title>Flicker widget</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<style type="text/css">
		fl.a:visited, fl.a:active, fl.a:hover, fl.a:link{ border : none;} 	
		.lic {font-size:9px; text-decoration:none;}		
	</style>
  </head>
  <body>
	<?php
		ini_set('default_charset', 'UTF-8');
		
		
		$key = "be12a6f93713a2a15b2aa9608e967789";
		$nrpics = 8;
		//options: m,s,t,z,b
		$sizePic ="s";
		
		function getLicense($id)
		{
			$licence ="";
		/*
			License Types
			  4 - Attribution License, http://creativecommons.org/licenses/by/2.0/
			  6 - Attribution-NoDerivs License http://creativecommons.org/licenses/by-nd/2.0/
			  3 - Attribution-NonCommercial-NoDerivs License http://creativecommons.org/licenses/by-nc-nd/2.0/
			  2 - Attribution-NonCommercial License http://creativecommons.org/licenses/by-nc/2.0/
			  1 - Attribution-NonCommercial-ShareAlike License http://creativecommons.org/licenses/by-nc-sa/2.0/
			  5 - Attribution-ShareAlike License http://creativecommons.org/licenses/by-sa/2.0/
			  7 - No known copyright restrictions http://flickr.com/commons/usage/
		*/	
			$txt="Unknown";
			$url="http://creativecommons.org/licenses/by/2.0/";

			switch (intval($id))
			{
				case 1: 
					$txt="Attribution-NonCommercial-ShareAlike License";
					$url="http://creativecommons.org/licenses/by-nc-sa/2.0/";
					break;
				case 2: 
					$txt="Attribution-NonCommercial License";
					$url="http://creativecommons.org/licenses/by-nc/2.0/";
					break;
				case 3: 
					$txt="Attribution-NonCommercial-NoDerivs";
					$url="http://creativecommons.org/licenses/by-nc-nd/2.0/";
					break;
				case 4: 
					$txt="Attribution License";
					$url="http://creativecommons.org/licenses/by/2.0/";
					break;
				case 5: 
					$txt="Attribution-ShareAlike License";
					$url="http://creativecommons.org/licenses/by-sa/2.0/";
					break;
				case 6: 
					$txt="Attribution-NoDerivs License";
					$url="http://creativecommons.org/licenses/by-nd/2.0/";
					break;
				case 7: 
					$txt="No known copyright restrictions";
					$url="http://flickr.com/commons/usage/";
					break;
				default:
					$txt="Unknown";
					$url="http://creativecommons.org/licenses/by/2.0/";
					break;
			}
			$licenseText = "<a href ='".$url."' title='".$txt."' target='_blank'> License</a>" ;
			$license=$licenseText;
			return $license;
		}
		
		function cURLcheckBasicFunctions()
		{
		  if( !function_exists("curl_init") &&
			  !function_exists("curl_setopt") &&
			  !function_exists("curl_exec") &&
			  !function_exists("curl_close") ) return false;
		  else return true;
		} 

		if (!cURLcheckBasicFunctions())
		{
			die("The server has no support for php curl functions. Please review it to continue.");
		}
		
		if (count($_GET)==0)
		{
			die("You need to specify the search term");
		}
		
		if (!isset($_GET["q"]))
		{
			die("You need to specify the search term in the 'q' parameter.");
		}
		$termo=str_replace(" ",",",$_GET["q"]);
		
		if (!isset($_GET["extra"]))
		{
			die("You need to specify the flicker key in the 'extra' parameter.");
		}
		$key=$_GET["extra"];
		
		
		if (isset($_GET["t"]))
		{
			$sizePic=$_GET["t"];
		}
		
		
		if (isset($_GET["nrPics"]))
		{
			$nrpics=intval($_GET["nrPics"]);
		}

		
		/*
			License Types
			  4 - Attribution License, http://creativecommons.org/licenses/by/2.0/
			  6 - Attribution-NoDerivs License http://creativecommons.org/licenses/by-nd/2.0/
			  3 - Attribution-NonCommercial-NoDerivs License http://creativecommons.org/licenses/by-nc-nd/2.0/
			  2 - Attribution-NonCommercial License http://creativecommons.org/licenses/by-nc/2.0/
			  1 - Attribution-NonCommercial-ShareAlike License http://creativecommons.org/licenses/by-nc-sa/2.0/
			  5 - Attribution-ShareAlike License http://creativecommons.org/licenses/by-sa/2.0/
			  7 - No known copyright restrictions url="http://flickr.com/commons/usage/
		*/		
		$license = "1,2,5,7";		
		if (isset($_GET["lic"]))
		{
			$license=$_GET["lic"];
		}
		
		$sort="relevance";
		if (isset($_GET["sort"]))
		{
			$sort=$_GET["sort"];
		}		

		
		$baseURL="http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=$key"
															."&format=rest"
															."&per_page=$nrpics"
															//."&extras=".urlencode("license,description,url_t,url_s,url_q,url_m,url_n,url_z,url_c,url_l,url_o")
															."&extras=".urlencode("license,description")
															."&sort=".urlencode($sort)
															."&license=".urlencode($license)
															."&tags=".urlencode($termo);
															
		//echo $baseURL."<br/>";
		
		$ch = curl_init($baseURL);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		
		$res= curl_exec($ch);		
		curl_close($ch);

				
		$errno          = @curl_errno($ch);
		$error          = @curl_error($ch);

		if( $errno != CURLE_OK) {
			die($errno." - ".$error);
		}

		
		
		$resObj=simplexml_load_string($res);
		
		if ($resObj[0]->attributes()->stat !="ok") {
			die ("Error retrieving images :".$b);
		}
		
		$css2="float:left;width:45%;border:none; padding:2px;margin:0px;";
		
		echo "<div>";
		foreach ($resObj->photos->photo as $image)
		{
			$id=$image->attributes()->id;
			$owner=$image->attributes()->owner;
			$farm=$image->attributes()->farm;
			$serverID=$image->attributes()->server;
			$sec= $image->attributes()->secret;
			$title=htmlentities(utf8_decode($image->attributes()->title));	
			$iURL="http://farm".$farm.".staticflickr.com/".$serverID."/".$id."_".$sec."_".$sizePic.".jpg";
			$url2="http://www.flickr.com/photos/".$owner."/".$id;
			echo "<div style='".$css2."'>";
			echo "<a href='".$url2."' title='".$title."' class='fl' target='_blank' >";
			echo "<image src='".$iURL."' alt='".$title."' title='".$title."'/>";
			echo "</a>";
			echo "<p class='lic ccInc ccIncSmall'>".getLicense($image->attributes()->license)."</p>";
			echo "</div>";
		}
		echo "<div>";
		
		
	?>
  </body>
  
</html>