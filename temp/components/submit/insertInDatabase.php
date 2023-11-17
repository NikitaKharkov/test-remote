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
    OR die("Could not connect to database: ".mysqli_errno($db));
	mysqli_select_db($db, $dbSchema)
		OR die ("Could not connect to database: ".mysqli_errno($db));
	
	// Convert submitted arrays into strings
	$sections = join($selectedSections, ";");
	$learningID = join($selectedLearningsIDs, ";");
	$learning = join($selectedLearningsStrings, ";");
	
	
	// Sanitize user-provided data - helps prevent security holes
	$custID = mysqli_real_escape_string($db, $custID);
	$cmeEmail = mysqli_real_escape_string($db, $cmeEmail);
	$firstName = mysqli_real_escape_string($db, $firstName);
	$lastName = mysqli_real_escape_string($db, $lastName);
	$userEmail = mysqli_real_escape_string($db, $userEmail);
	$userTypeID = mysqli_real_escape_string($db, $userTypeID);//added 2009-03-12, tufts only
	$userType = mysqli_real_escape_string($db, $userType);//added 2009-03-12, tufts only
	$ccEmail = mysqli_real_escape_string($db, $ccEmail);
	$type = mysqli_real_escape_string($db, $type);
	$title = mysqli_real_escape_string($db, $title);
	$searching = mysqli_real_escape_string($db, $searching);
	$sections = mysqli_real_escape_string($db, $sections);
	$found = mysqli_real_escape_string($db, $found);
	$learningID = mysqli_real_escape_string($db, $learningID); //added 2009-03-13
	$learning = mysqli_real_escape_string($db, $learning);
	$date = mysqli_real_escape_string($db, $date);
	$creditTypeID = mysqli_real_escape_string($db, $creditTypeID);//added 2009-03-12
	$creditType = mysqli_real_escape_string($db, $creditType);
	$feedback = mysqli_real_escape_string($db, $feedback);
	$phoneNumber = mysqli_real_escape_string($db, $phoneNumber);//added 2009-12-05
	$address = mysqli_real_escape_string($db, $address);
	$city = mysqli_real_escape_string($db, $city);
	$state = mysqli_real_escape_string($db, $state);
	$zip = mysqli_real_escape_string($db, $zip);
	
	
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
    // @todo very strange that "city" and other was used as const... Check the commit. Maybe just a mistake.
	if($address != "" && $city != "" && $state != "" &$zip != "") {
		$fields .= ", address, city, state, zip";
		$values .= ", '$address', '$city', '$state', '$zip'";
	}
	if($userTypeID != "" && $userType != "") {
		$fields .= ", userTypeID, userType";
		$values .= ", '$userTypeID', '$userType'";
	}
			
	$insert = "INSERT INTO cmeData (".$fields.") VALUES (".$values.");";
			
	
	// Execute Query
	mysqli_query($db, $insert)
		OR die ("Could not insert to the database: ".mysqli_errno($db));
	
	// Close DB connection
	mysqli_close($db);
}
?>