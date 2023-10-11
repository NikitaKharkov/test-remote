<?php

/************************************************
*  EBSCO
*  Alvet Miranda (amiranda@ebscohost.com)
*  Description : EHIS to EIT Widget
*  
*  Date        : 2013-Feb-08
*  Notes       : Connects to a eHost database and returns results based on ep.SearchTerm*
*	
************************************************/

?>
<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
	include(__DIR__. DIRECTORY_SEPARATOR .'httpful-0.2.0.phar');
	
		$protect = $_REQUEST["protect"];
		$numrec = $_REQUEST["numrec"];
		$query = urlencode($_REQUEST["query"]);
		$pwd = ($protect=="yes")? base64_decode($_REQUEST["pwd"]): $_REQUEST["pwd"];
		$prof = ($protect=="yes")? base64_decode($_REQUEST["prof"]):$_REQUEST["prof"];
		$db = $_REQUEST["db"];
		$title = $_REQUEST["title"];
		$format = $_REQUEST["format"];
		$loaded = $_REQUEST["loaded"];
		
		$url = "http://eit.ebscohost.com/Services/SearchService.asmx/Search?prof=".$prof."&pwd=".$pwd."&query=".$query."&db=".$db."&numrec=".$numrec;
		
		
		if($loaded !="y" and $format !="xml"){
            ?>
            <center>
            <img src="loader.gif" width="32" height="32" onload='window.location="http://<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"] ?>&loaded=y";' />
			<iframe src="<?php echo $url ?>" frameborder="0" width="1" height="1" />
            </center>
            <?php
		}else{		
			$response = \Httpful\Request::get($url)->send();
			$response = str_replace("<ehisInfo>Y","<ehisInfo>",$response);
			$xml = simplexml_load_string(str_replace("<ehisInfo>\nY","<ehisInfo>",$response));
			
			if($format=="xml"){
				echo $response;
				exit();
			}else{
				?>
					<style>
						body{
							font-family:Arial, Helvetica, sans-serif;
							font-size:12px;
						}
						div{
							padding:5px;
						}
					</style>
				<?php
				echo '<h4>'.str_replace("+"," ",$title).'</h4>';
				if(strpos($response,'<ehisInfo')===false){
					echo 	'<p> 0 results found. </p>';
				}else{
					foreach ($xml->SearchResults->records->rec as $record) {
						echo '<div> <a title="'.$record->header->controlInfo->jinfo->jtl.'" 
									target="_blank" href="'.$record->header->controlInfo->ehisInfo->url.'"'.'>';
						echo $record->header->controlInfo->artinfo->tig->atl.'</a></div>';
					}
					echo 	'<p>'
							.$xml->Statistics->Statistic->Hits
							.' results found.'
							.'</p>';
				}
				
			}
		}
?>