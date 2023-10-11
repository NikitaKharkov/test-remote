<?php
/************************************************
  EBSCO
  Rui Francisco (rfrancisco@ebscohost.com)
  
  Description : EDS API functions on php
  Date        : 2012-12-06
	
 ***********************************************/

	function cURLcheckBasicFunctions()
	{
	  if( !function_exists("curl_init") &&
		  !function_exists("curl_setopt") &&
		  !function_exists("curl_exec") &&
		  !function_exists("curl_close") ) return false;
	  else return true;
	} 
	
	//************************************************
	//  authenticate by username and password
	//************************************************
	
	function authenticateUser($endPoint, $username, $password)
	{
		$token="";
		
		if (!cURLcheckBasicFunctions())
			die("No curl function support on php. Please check your configuration");
			
		// construct the parameters to authenticate
		$v1 = Array(
			"UserId" => $username,
			"Password" => $password,
			"InterfaceId" => "wsapi"
		);
		
		$xmlRequest = "<UIDAuthRequestMessage xmlns=\"http://www.ebscohost.com/services/public/AuthService/Response/2012/06/01\" xmlns:i=\"http://www.w3.org/2001/XMLSchema-instance\"> "
					. "<UserId>$username</UserId> "
  					. "<Password>$password</Password>"
					. "<InterfaceId>WSapi</InterfaceId>"
					. "</UIDAuthRequestMessage> "
					;
		$headers = array(
			"Content-Type: text/xml",
			"Content-Length: ".strlen($xmlRequest),
			"Connection: close"
		);
		$ch = curl_init($endPoint);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		
	
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlRequest);
		curl_setopt($ch, CURLOPT_POST, true); // force the post
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);			
		$res= curl_exec($ch);		
		
		$info = curl_getinfo($ch);	

		curl_close($ch);

				
		$errno          = @curl_errno($ch);
		$error          = @curl_error($ch);

		if( $errno != CURLE_OK) {
			die($errno." - ".$error);
		}
		if ($info['http_code']!='200')
		{
			return false;
			//var_dump($info);
			//var_dump($res);
		}

		return $res;
		
	}

	//************************************************
	//  authenticate by IP
	//************************************************
	
	function authenticateIP($endPoint)
	{
		if (!cURLcheckBasicFunctions())
			die("No curl function support on php. Please check your configuration");
			
		$headers = array(
			"Content-Type: text/xml",
			"Connection: close"
		);
		$ch = curl_init($endPoint);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_POST, true); // force the post
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);	
		$res= curl_exec($ch);		
		
		$info = curl_getinfo($ch);
		curl_close($ch);

		$errno          = @curl_errno($ch);
		$error          = @curl_error($ch);

		if( $errno != CURLE_OK) {
			die($errno." - ".$error);
		}
		if ($info['http_code']!='200')
		{
			return false;
		}
		return $res;
	}

	//************************************************
	//  create a session for the user
	//************************************************
	
	function createSession($endPoint, $authToken, $profile, $guest="n", $organization="")
	{
		if (!cURLcheckBasicFunctions())
			die("No curl function support on php. Please check your configuration");

		$xmlRequest ="<CreateSessionRequestMessage xmlns=\"http://epnet.com/webservices/EbscoApi/Contracts\" xmlns:i=\"http://www.w3.org/2001/XMLSchema-instance\"> "
					."<Profile>$profile</Profile>"
					."<Guest>$guest</Guest>"
					."<Org>$organization</Org>"
					."</CreateSessionRequestMessage> "
					;
		$headers = array(
			"x-authenticationToken: $authToken",
			"Content-Type: text/xml",
			"Content-Length: ".strlen($xmlRequest),
			"Connection: close"
		);

		$ch = curl_init($endPoint);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		
	
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlRequest);
		curl_setopt($ch, CURLOPT_POST, true); // force the post
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		$res= curl_exec($ch);		
		$info = curl_getinfo($ch);	

		curl_close($ch);

		$errno          = @curl_errno($ch);
		$error          = @curl_error($ch);


		if( $errno != CURLE_OK) {
			die($errno." - ".$error);
		}
		if ($info['http_code']!='200')
		{
			return false;
		}
		return $res;			
	}
	
	// terminates the session and frees tokens for concurrent databases
	function endSession($endPoint, $sessiontoken)
	{
		if (!cURLcheckBasicFunctions())
			die("No curl function support on php. Please check your configuration");

		$url=$endPoint."?sessiontoken=".urlencode($sessiontoken);
		
		$headers = array(
			"Content-Type: text/xml",
			"Connection: close"
		);
		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);		
		$res= curl_exec($ch);		
		$info = curl_getinfo($ch);	
		curl_close($ch);

		$errno          = @curl_errno($ch);
		$error          = @curl_error($ch);
		if( $errno != CURLE_OK) {
			die($errno." - ".$error);
		}
		if ($info['http_code']!='200')
		{
			return false;
		}
		$xml=simplexml_load_string($res);
		$s=(String)$xml->IsSuccessful;
		if ($s=="y")
			{return true;}
		else
			{return false;}
	}


	//****************************************************************
	// gets the list of options to  be shown to on the search
	//****************************************************************
	function infoFields ($endPoint, $authToken, $sessionToken)
	{
		if (!cURLcheckBasicFunctions())
			die("No curl function support on php. Please check your configuration");

		$headers = array(
			"x-authenticationToken: $authToken",
			"x-sessionToken: $sessionToken",
			"Content-Type: text/xml",
			"Connection: close"
		);
		$ch = curl_init($endPoint);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		//headers with the authentication and session token
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		$res= curl_exec($ch);		
		$info = curl_getinfo($ch);	
		curl_close($ch);

		$errno          = @curl_errno($ch);
		$error          = @curl_error($ch);
		if( $errno != CURLE_OK) {
			die($errno." - ".$error);
		}
		if ($info['http_code']!='200')
		{
			return false;
		}
		return $res;
	}



	//****************************************************************
	// performs the search at the EDS server
	//****************************************************************	
	function search ($endPoint, $authToken, $sessionToken, $searchTerm, $facets="y", $searchMode="all",$sort="relevance", $expanders="fulltext", $page="1", $recordPage=5, $action="")
	{
		if (!cURLcheckBasicFunctions())
			die("No curl function support on php. Please check your configuration");

		$xmlRequest ="<SearchRequestMessage xmlns=\"http://epnet.com/webservices/EbscoApi/Contracts\" xmlns:i=\"http://www.w3.org/2001/XMLSchema-instance\">"
					."<SearchCriteria>"
					."<Queries>"
					."<Query>"
					."<Term>".$searchTerm."</Term>"
					."</Query>"
					."</Queries>"
					."<SearchMode>$searchMode</SearchMode>"
					."<IncludeFacets>$facets</IncludeFacets>"
					."<Expanders>"
					."<Id>$expanders</Id>"
					."</Expanders>"
					."<Sort>$sort</Sort>"
					."</SearchCriteria>"
					."<RetrievalCriteria>"
					."<View>detailed</View>"
					."<ResultsPerPage>$recordPage</ResultsPerPage>"
					."<PageNumber>$page</PageNumber>"
					."<Highlight>n</Highlight>"
					."</RetrievalCriteria>"
					;

		// for facet filters
		if ($action!="")
		{
			$xmlRequest.="<Actions>"
						."<Action>".urldecode($action)."</Action>"
						."</Actions>"
						;
		}
		$xmlRequest.="</SearchRequestMessage>  "
					;
		//echo htmlentities($xmlRequest);					
		$headers = array(
			"x-authenticationToken: $authToken",
			"x-sessionToken: $sessionToken",
			"Content-Type: text/xml",
			"Content-Length: ".strlen($xmlRequest),
			"Connection: close"
		);

		$ch = curl_init($endPoint);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		
	
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlRequest);
		curl_setopt($ch, CURLOPT_POST, true); // force the post
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		$res= curl_exec($ch);		
		$info = curl_getinfo($ch);	

		curl_close($ch);

		$errno          = @curl_errno($ch);
		$error          = @curl_error($ch);


		if( $errno != CURLE_OK) {
			die($errno." - ".$error);
		}
		if ($info['http_code']!='200')
		{
			return false;
		}

		return $res;			

	}	
	
	//************************************************	
	// retrieves information about a record
	//************************************************
	function retrieve ($endPoint, $authToken, $sessionToken, $dbID, $AN)
	{
		if (!cURLcheckBasicFunctions())
			die("No curl function support on php. Please check your configuration");

		$xmlRequest ="<RetrieveRequestMessage xmlns=\"http://epnet.com/webservices/EbscoApi/Contracts\" xmlns:i=\"http://www.w3.org/2001/XMLSchema-instance\">"
					."<An>$AN</An>"
					."<DbId>$dbID</DbId>"
					."</RetrieveRequestMessage>"
					;

		$headers = array(
			"x-authenticationToken: $authToken",
			"x-sessionToken: $sessionToken",
			"Content-Type: text/xml",
			"Content-Length: ".strlen($xmlRequest),
			"Connection: close"
		);

		$ch = curl_init($endPoint);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 5);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlRequest);
		curl_setopt($ch, CURLOPT_POST, true); // force the post
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		$res= curl_exec($ch);		
		$info = curl_getinfo($ch);	

		curl_close($ch);

		$errno          = @curl_errno($ch);
		$error          = @curl_error($ch);


		if( $errno != CURLE_OK) {
			die($errno." - ".$error);
		}
		if ($info['http_code']!='200')
		{
			return false;
		}

		return $res;				
	}


?>