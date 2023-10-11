<?
/*
 * 2009-03-12, msanchez: 
 * Added new values to the DBInsert method invocation
 */
//Insert into the database
//Non-exiting form paramters will generate an empty string
dbInsert(
	$submitTime, $data["custid"], $data["email"], $data['firstName'], $data['lastName'],
	$data["userType"], $userTypeString, //2009-03-12
	$data["yourEmail"], $data["CC"], 
	$data["title"], $data["type"], $data["searching"], 
	$selectedSections, $data["found"], $selectedLearningsIDs, $selectedLearningsStrings, $data["date"], 
	$data["credit"], $creditString, //2009-03-12
	$data["feedback"],
	$data["yourPhone_areaCode"].$data["yourPhone_group1"].$data["yourPhone_group2"], //2009-12-05
	$data["address"], $data["city"], $data["state"], $data["zip"]
);


/*
 * 2009-03-13 msanchez:
 * Updated dbInsert method to receive:
 * $learningID
 * 
 * 2009-03-12 msanchez:
 * Updated dbInsert method to receive:
 * $userTypeID, $userType, $creditID
 * Updated insert statements to insert new values when present
 */
function dbInsert(
	$submitDate, $custID, $cmeEmail, $firstName, $lastName, 
	$userTypeID, $userType,
	$userEmail, $ccEmail, 
	$title, $type, $searching, 
	$selectedSections, $found, $selectedLearningsIDs, $selectedLearningsStrings, $date, 
	$creditTypeID, $creditType, 
	$feedback,
	$phoneNumber,
	$address, $city, $state, $zip 
	) {
	

	
	global $dbServer, $dbUsername, $dbPassword, $dbSchema;

	// Open DB connection
	$db = mysql_connect($dbServer, $dbUsername, $dbPassword)
    OR die("Could not connect to database: ".mysql_error());
	mysql_select_db($dbSchema, $db)
		OR die ("Could not connect to database: ".mysql_error());
	
	// Convert submitted arrays into strings
	$sections = join($selectedSections, ";");
	$learningID = join($selectedLearningsIDs, ";");
	$learning = join($selectedLearningsStrings, ";");
	
	
	// Sanitize user-provided data - helps prevent security holes
	$custID = mysql_real_escape_string($custID);
	$cmeEmail = mysql_real_escape_string($cmeEmail);
	$firstName = mysql_real_escape_string($firstName);
	$lastName = mysql_real_escape_string($lastName);
	$userEmail = mysql_real_escape_string($userEmail);
	$userTypeID = mysql_real_escape_string($userTypeID);//added 2009-03-12, tufts only
	$userType = mysql_real_escape_string($userType);//added 2009-03-12, tufts only
	$ccEmail = mysql_real_escape_string($ccEmail);
	$type = mysql_real_escape_string($type);
	$title = mysql_real_escape_string($title);
	$searching = mysql_real_escape_string($searching);
	$sections = mysql_real_escape_string($sections);
	$found = mysql_real_escape_string($found);
	$learningID = mysql_real_escape_string($learningID); //added 2009-03-13
	$learning = mysql_real_escape_string($learning);
	$date = mysql_real_escape_string($date);
	$creditTypeID = mysql_real_escape_string($creditTypeID);//added 2009-03-12
	$creditType = mysql_real_escape_string($creditType);
	$feedback = mysql_real_escape_string($feedback);
	$phoneNumber = mysql_real_escape_string($phoneNumber);//added 2009-12-05
	$address = mysql_real_escape_string($address);
	$city = mysql_real_escape_string($city);
	$state = mysql_real_escape_string($state);
	$zip = mysql_real_escape_string($zip);
	
	
	// Convert the submitted date into a format MySQL understands
	$date = date("Y-m-d H:i:s",strtotime($date));
	
	// Build SQL insert statement
	$fields = "submitDate, custID, cmeEmail, firstName, lastName, userEmail, 
			ccEmail, title, type, searching,
			sections, found, learningID, learning, date, creditTypeID, creditType, feedback";
	$values = "'$submitDate', '$custID', '$cmeEmail', '$firstName', '$lastName', '$userEmail', '$ccEmail',
			'$title', '$type', '$searching', '$sections', '$found', '$learningID', '$learning',
			'$date', '$creditTypeID', '$creditType', '$feedback'";
			
	if($phoneNumber != "") {
		$fields .= ", phoneNumber";
		$values .= ", '$phoneNumber'";
	}
	if($address != "" && city != "" && state != "" &zip != "") {
		$fields .= ", address, city, state, zip";
		$values .= ", '$address', '$city', '$state', '$zip'";
	}
	if($userTypeID != "" && userType != "") {
		$fields .= ", userTypeID, userType";
		$values .= ", '$userTypeID', '$userType'";
	}
			
	$insert = "INSERT INTO cmeData (".$fields.") VALUES (".$values.");";
			
	
	// Execute Query
	mysql_query($insert)
		OR die ("Could not insert to the database: ".mysql_error());
	
	// Close DB connection
	mysql_close($db);
}
?>