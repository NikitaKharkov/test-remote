<?php  
/***************************************************************
  EBSCO
  Rui Francisco (rfrancisco@ebscohost.com)
  
  Description : Simple SearchBox with link results per database
  Date        : 2013-01-09
  Notes       : config file
	
 ***************************************************************/ 
 
//URLs to access the API
$config['endPointAuth'] = "https://eds-api.ebscohost.com/authservice/rest/UIDAuth";
$config['endPointSession'] = "http://eds-api.ebscohost.com/edsapi/rest/CreateSession";
$config['endPointSearch'] = "http://eds-api.ebscohost.com/edsapi/rest/Search";

//credentials to access the API 
$config['eds_profile'] = "edsapi"; // the id of the profile
$config['username'] = "eds_academic";
$config['password'] = "ebsco";

// the tag <expression> will contain the search expression
$config['zero_results'] ='No results found searching for <expression>';
// the tag <hits> will contain the number of results, the tag <expression> will contain the search expression
$config['results_text'] ='<strong>Have you considered searching EBSCO Discovery Service?</strong><br/><hits> hits for <expression> are waiting... '; 

//if we show databases or not
$config['showdb'] = false;
//max number of databases/content providers to show in the results with links
$config['nr_databases'] = 5;

//if we show types or not
$config['showtypes'] = true;

//thousands separator
$config['sep_thousands'] = ',';

$config['baseEDSUrl'] = 'http://search.ebscohost.com/login.aspx?direct=true&AuthType=ip,uid'; 
$config['custID'] ="ns187805";
$config['groupID'] ="edslatin";
$config['profileID'] ="edsnoehis";



?>