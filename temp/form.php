<?
//for debugging purposes
//ini_set('display_errors', '1'); 

require('config/cmeSettings.php');
require('components/utils.php');

//Fix a couple issues with the REQUEST parameters generated  by PHP
fixRequest();


/* 2009-12-02 msanchez:
* customerSelect sets $customer to a string that identifies a customer, by matching the email in URL 
* This string is used to suffix include files to customize application for specific customers.
* Add a new entry to customerSelect and necessary files to create a new customer profile
* If none, defaults to $defaultCustomer
*/
//sets $customer global variable
require('components/customerSelect.php');

//Header includes custom js and css. If further customization is required, use commented line below and rename header.php to headerGeneric.php
require('components/header.php');
//require('components/form/header'.$customer.'.php');

require('components/objects.php');

//SET FORM BASED ON CUSTOMER
// Default customer is defined in $defaultCustomer
require('components/form/form'.$customer.'.php');
	
//SET FOOTER
require('components/footer.php')
?>
