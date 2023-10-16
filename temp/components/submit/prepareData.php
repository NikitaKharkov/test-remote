<?
// Clean up XSS/Injection attacks
$data = $_POST;
foreach ($data as &$item) {
	$item = urldecode($item);
	if (preg_match("#(\r|\n)#i", $item)) {
		die("Invalid characters in submitted input, please go back and try again.");
	}
	$item = htmlspecialchars($item);
}
unset($item);


require('components/objects.php');

//Get the submission time of the form - Current Time
$submitTime = date("Y-m-d H:i:s");

//Get an array of selected options for each of the lists in the form
$selectedLearningsIDs = filterHash($_POST, "learned_");
$selectedSections = filterHash($_POST, "sections_");

/*
 * 	2009-03-13, msanchez: 
 *	selectedLearnings are now integers
 *	Equivalent text is encoded in the same form inside the input's title attribute.
 *	Below, an equivalent array is created with the corressponding strings for backwards compatibility
  */
foreach($selectedLearningsIDs as $value){
	$equiv = $learnedItems->xpath(
		"/learned/item//input[@value='".$value."']/@title"
	);
	$selectedLearningsStrings[] = $equiv[0];
}


//If "all sections" was checked, override the other checked options
if($data['allSections'] == "on" || $selectedSections == null)
	$selectedSections = Array("All Sections");

//Full Name
$name = "{$data['firstName']} {$data['lastName']}";

/*
 * 	2009-03-12, msanchez: 
 *	credit is now passed as integer value. 
 *	Equivalent text is encoded in the same form inside the input's title attribute.
 *	Reconstructed for backwards compatibility.
  */
//code string
$res = $creditTypes->xpath(
	"/credits/credit//input[@value='".$data["credit"]."']/@title"
	);
$creditString = $res[0];

/*
 * 	2009-03-12, msanchez: 
 *	userTypeID is  passed as integer value. 
 *	Equivalent text is encoded in the same form inside the input's title attribute.
  */
$res = $userTypes->xpath(
	"/users/user//input[@value='".$data["userType"]."']/@title"
	);
$userTypeString = $res[0];


?>