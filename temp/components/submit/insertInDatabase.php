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
	$db = mysqli_connect($dbServer, $dbUsername, $dbPassword)
    OR die("Could not connect to database: ".mysqli_error());
	mysqli_select_db($dbSchema, $db)
		OR die ("Could not connect to database: ".mysqli_error());
	
	// Convert submitted arrays into strings
	$sections = join($selectedSections, ";");
	$learningID = join($selectedLearningsIDs, ";");
	$learning = join($selectedLearningsStrings, ";");
	
	
	// Sanitize user-provided data - helps prevent security holes
	$custID = mysqli_real_escape_string($custID);
	$cmeEmail = mysqli_real_escape_string($cmeEmail);
	$firstName = mysqli_real_escape_string($firstName);
	$lastName = mysqli_real_escape_string($lastName);
	$userEmail = mysqli_real_escape_string($userEmail);
	$userTypeID = mysqli_real_escape_string($userTypeID);//added 2009-03-12, tufts only
	$userType = mysqli_real_escape_string($userType);//added 2009-03-12, tufts only
	$ccEmail = mysqli_real_escape_string($ccEmail);
	$type = mysqli_real_escape_string($type);
	$title = mysqli_real_escape_string($title);
	$searching = mysqli_real_escape_string($searching);
	$sections = mysqli_real_escape_string($sections);
	$found = mysqli_real_escape_string($found);
	$learningID = mysqli_real_escape_string($learningID); //added 2009-03-13
	$learning = mysqli_real_escape_string($learning);
	$date = mysqli_real_escape_string($date);
	$creditTypeID = mysqli_real_escape_string($creditTypeID);//added 2009-03-12
	$creditType = mysqli_real_escape_string($creditType);
	$feedback = mysqli_real_escape_string($feedback);
	$phoneNumber = mysqli_real_escape_string($phoneNumber);//added 2009-12-05
	$address = mysqli_real_escape_string($address);
	$city = mysqli_real_escape_string($city);
	$state = mysqli_real_escape_string($state);
	$zip = mysqli_real_escape_string($zip);
	
	
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
	mysqli_query($insert)
		OR die ("Could not insert to the database: ".mysqli_error());
	
	// Close DB connection
	mysqli_close($db);
}
?>