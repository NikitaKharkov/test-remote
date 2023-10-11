<?
//ini_set('display_errors', '1'); 

require('config/cmeSettings.php');
require('components/utils.php');

//Fix a couple issues with the REQUEST parameters generated  by PHP
fixRequest();


require('components/submit/prepareData.php');


/* 2009-12-02 msanchez:
* customerSelect sets $customer to a string that identifies a customer, by matching the email in URL 
* This string is used to suffix include files to customize application for specific customers.
* Add a new entry to customerSelect and necessary files to create a new customer profile
* If none, defaults to $defaultCustomer
*/
require('components/customerSelect.php');
?>

<?
require('components/header.php');
require('components/submit/submit'.$customer.'.php');
require('components/footer.php');
?>
