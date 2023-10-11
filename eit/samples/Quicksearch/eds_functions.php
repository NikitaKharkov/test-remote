<?php

/***************************************************************
  EBSCO
  Rui Francisco (rfrancisco@ebscohost.com)
  
  Description : Simple SearchBox with link results per database
  Date        : 2013-01-09
  Notes       : main functions file
	
 ***************************************************************/ 
	
    function validEDSSession()
    {
		// if the session variables were not set, request new session
		if (!isset($_SESSION['eds_token']))
			return false;
		if (!isset($_SESSION['eds_session_id']))
			return false;
		if (!isset($_SESSION['eds_session_expiration']))
			return false;
		
		// check if the session expired
		$t=intval($_SESSION['eds_session_expiration']);
		//if has expired
		if(intval(time())>$t)
		{
			return false;
		}
		
		return true;
    }
	

	function getNewSession($endpointAuth,$endpointSession, $user, $pass, $profile)
	{
			
		$token=authenticateUser($endpointAuth, $user, $pass, $profile);
		$_SESSION["eds_token"]=$token;
		if ($token==false)
		{
			echo "Error authenticating on the EDS API server<br/>";
		}
		else
		{  // get session ID for the anonymous user
			
			$xml=simplexml_load_string($token);
			$s=(String)$xml->AuthToken;
			
			//set session variable
			$_SESSION["eds_token"]=$s;
		
			$sessionEDS=createSession($endpointSession, 
								   $_SESSION["eds_token"], 
								   $profile, 
								   "n",  //guests ?
								   "SearchBox"); //empty institution, no need for this parameter at this time
			$xml=simplexml_load_string($sessionEDS);
			if (!$xml)
			{
				echo "<p>Impossible to get new session from EDS</p>";
				return false;
			}
			$s=(String)$xml->SessionToken;

			// calculate the expiration timestamp
			$_SESSION['eds_session_id']=$s;
			$_SESSION['eds_session_expiration']=time()+5;  //5 min for session expire
		}
	}
	
	
		


	function doEDSQuickSearch()
	{
		include("eds_config.php");
		include("eds_helper.php");
	
		//parameters will be passed by GET
		$searchTerm="";
		if (isset($_GET["edsST"]))
		{
			$searchTerm=trim(urldecode($_GET["edsST"]));
		}
		
		// the form
		echo "
			<link rel='stylesheet' type='text/css' href='edsquicksearch.css'>
			<div class='searchBox'>
				<form action='' method='GET' name='edsQuickSearch'>

					<h2 class='searchTitle'>EDS QuickSearch</h2>
					<input type='text' width='20' maxlength='50' class='searchInput' name='edsST' id='edsST'><br/>
					<input type='submit' class='searchButton' value='Search@EDS'>
				</form>
			";
		session_start();
		//start session on the eds even if the user has not searched anything yet, to make searches faster
		if (!validEDSSession())
		{
			getNewSession($config['endPointAuth'], 
						  $config['endPointSession'],
						  $config['username'], 
						  $config['password'],
						  $config['eds_profile']);
		}	
		
		//process the results if any
		if($searchTerm!="")
		{
			$searchResults=search ($config['endPointSearch'], 
							$_SESSION['eds_token'], 
							$_SESSION['eds_session_id'],
							$searchTerm, 
							"y", // i want facets 
							"", // search in all fields
							"relevance", //sort
							"fulltext", //expander
							1, //page
							1  //records per page
							); 
			//if session failed in the moment, get a new one
			if (!$searchResults)
			{
				getNewSession($config['endPointAuth'], 
							  $config['endPointSession'],
							  $config['username'], 
							  $config['password'],
							  $config['eds_profile']);
				$searchResults=search ($config['endPointSearch'], 
								$_SESSION['eds_token'], 
								$_SESSION['eds_session_id'],
								$searchTerm, 
								"y", // i want facets 
								"", // search in all fields
								"relevance", //sort
								"fulltext", //expander
								1, //page
								1  //records per page
								); 
			}
			if ($searchResults)
			{	//process the xml results
				$xml=simplexml_load_string($searchResults);
				$nrResults = intval($xml->SearchResult->Statistics->TotalHits);
				$s=str_replace(array ('<expression>','<hits>'),
							   array("<span class='searchTerm'>'".htmlentities($searchTerm)."'</span>",number_format($nrResults,0,".",$config['sep_thousands'])),
							   $config['results_text']);
				$url=$config["baseEDSUrl"]."&custid=".$config["custID"]."&group=".$config["groupID"]."&profile=".$config["profileID"];
				$url.="&bquery=".urlencode($searchTerm);
				$s2= "<a href='$url' title='Search \"".htmlentities($searchTerm)."\" in EBSCO Discovery Service' class='searchLink' target='_blank'>$s</a>";
				echo "<p>$s2</p>";
				
				if ($config['showdb']==true)
				{
					//print the number of defined results
					if (!isset($config['nr_databases']))
					{ $nr =0;} // all the results
					else
					{ $nr=$config['nr_databases']; }
					
					$i=0;
					echo "<ul class='resultList'>";
					foreach ($xml->SearchResult->Statistics->Databases->Database as $d)
					{
						$i++;
						$s=sprintf("%s (%s)",$d->Label, number_format(intval($d->Hits),0,".",$config['sep_thousands']));
						$url=$config["baseEDSUrl"]."&custid=".$config["custID"]."&group=".$config["groupID"]."&profile=".$config["profileID"];
						$url.="&bquery=".urlencode($searchTerm);
						$url.="&db=".$d->Id;
						echo "<li class='resultItem'><a href='$url' title='Search \"".htmlentities($searchTerm)."\" in ".$d->Label."' class='searchLink' target='_blank'>$s</a></li>";
						// limit the results to present
						if (($nr!=0) && ($i>=$nr))
						{
							break; // we reached the limit
						}
					}
					echo "</ul><br/>";
				}		
				
				//process the types
				if ($config['showtypes']==true)
				{

					echo "<ul class='resultList'>";
					foreach ($xml->SearchResult->AvailableFacets->AvailableFacet as $f)
					{
						if ($f->Id=="SourceType")
						{
							foreach($f->AvailableFacetValues->AvailableFacetValue as $fv)
							{
								$s=sprintf("%s (%s)",$fv->Value, number_format(intval($fv->Count),0,".",$config['sep_thousands']));
								$url=$config["baseEDSUrl"]."&custid=".$config["custID"]."&group=".$config["groupID"]."&profile=".$config["profileID"];
								$url.="&bquery=".urlencode($searchTerm);
								//$url.="&db=".$d->Id;
								echo "<li class='resultItem'><a href='$url' title='Search \"".htmlentities($searchTerm)."\" in ".$fv->Value."' class='searchLink' target='_blank'>$s</a></li>";
							}
						}
					}
					echo "</ul>";
				}
				
				
				
			}
			else
			{
				$s=str_replace('<expression>',"'".htmlentities($searchTerm)."'",$config['zero_results']);
				echo "<p class='noresults'><span class='searchTerm'>$s</span></p>";
			}
		}
	 
		echo "</div>";
	}
	
	
?>