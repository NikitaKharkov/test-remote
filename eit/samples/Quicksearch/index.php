<?php
/***************************************************************
  EBSCO
  Rui Francisco (rfrancisco@ebscohost.com)
  
  Description : Simple SearchBox with link results per database
  Date        : 2013-01-09
  Notes       : main file
				the system uses sessions to maintain lifetime
	
 ***************************************************************/ 
 
	header('Content-type: text/html; charset=utf-8'); 
	
	include("eds_functions.php");
	
	doEDSQuickSearch();
	
?>
