<?

$accountEmail = $_GET["email"].$_POST["email"];
$defaultCustomer = "Generic";

/* Set global variable is email address is matched
*/
switch( $accountEmail ){
	case "support@thci.org":
		$customer = "Tufts";
		break;
	case "baycarecme@ebscohost.com":
		$customer = "Baycare";
		break;
	default:
		$customer = $defaultCustomer;
}
?>
