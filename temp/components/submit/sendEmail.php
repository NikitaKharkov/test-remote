<?
//Send Email
sendConfirmation(
	$emailMessage, 
	$name, 
	$data["email"], 
	$creditString,
	$data['yourEmail'], 
	$data["CC"]);
	
//TEST1
/*
sendConfirmation(
	"Originally for: ".$data["email"]." || ".$emailMessage, //message
	$name, //name
	"msanchez@ebscohost.com", //to
	$creditString, //credit type requested
	"msanchez@ebscohost.com", //requestor's email
	"msanchez@ebscohost.com" //CC
	);
*/

//Send the confirmation email to the three email addresses specified
//(the last is optional)
function sendConfirmation($email, $name, $to, $creditType, $requestor, $additional) {
	
	global $enableSecondaryEmail;
	
	//Build up mail headers
	$headers = "From: DynaMed Support<dynamedsupport@epnet.com>\n"
		."Reply-To: DynaMed Support<dynamedsupport@epnet.com>\n"
		."Return-Path: DynaMed Support<dynamedsupport@epnet.com>\n"
		."Message-ID: <".time()."-dynamedsupport@epnet.com>\n"
		."X-Mailer: PHP v".phpversion()."\n"
		."Content-Type: text/html; charset=utf-8\n";
	
	//CC to the user and add another CC address if one was specified
	//(but don't CC the same address twice)
	if( stripos($additional,$requestor)===false ){
	//if(isset($additional) && ($requestor != $additional)) {
		$headers .= "Cc: {$requestor}, {$additional}\n";
	} else {
		$headers .= "Cc: {$additional}\n";
	}
	mail($to, "DynaMed CME/CE - {$name} - {$creditType}", $email, $headers, "-f dynamedsupport@epnet.com");
}
?>