
function validate() {
	//Add any validation errors to a list of errors
	errors = validateSections()
		+ validateLearned()
		+ validateName()
		+ validateEmails()
		+ validateCredit();

	processForm(errors);
}

function validateUser() {
	//Add any validation errors to a list of errors
	errors = validateUserType();

	processForm(errors);
}

function validateSections(){
	//Make sure either the the "All Sections" checkbox, or least one
	//individual section box is checked
	sectionsValid = (!$("sections")) || $("allSections").checked
	if(!sectionsValid)
		sectionsValid = verifyOneChecked("sections");
	
	//return  error string
	if(!sectionsValid)
		return "<li>Select at least one <b>section that you reviewed</b></li>";
	
	return "";
}
function validateLearned(){
	if(!verifyOneChecked("learned"))
		return "<li>Select at least one <b>checkbox indicating what you learned</b></li>";
		
	return "";
}
function validateName(){
	errors = "";
	if($("firstName").value == "")
		errors += "<li>Enter your <b>first name</b></li>";
	if($("lastName").value == "")
		errors += "<li>Enter your <b>last name</b></li>";
		
	return errors;
}
function validateEmails(){
	errors = "";
	if($("yourEmail").value == "")
		errors += "<li>Enter <b>your email address</b></li>";
	else if(!isValidEmail($("yourEmail").value))
		errors += "<li>Make sure your <b>email address</b> is valid</li>";
	if($("enableCC").checked && !isValidEmail($("CC").value) )
		errors += "<li>Make sure the <b>email address you're sending a copy to</b> is valid</li>";
		
	return errors;
}
function validatePhoneNumber(){
	errors = "";
	if(
		$("yourPhone_areaCode").value.length != 3 ||
		$("yourPhone_group1").value.length != 3 ||
		$("yourPhone_group2").value.length != 4
		)
		return "<li>Enter a valid <b>phone number</b></li>";

	if( 
		isNaN($("yourPhone_areaCode").value) ||
		isNaN($("yourPhone_group1").value) ||
		isNaN($("yourPhone_group2").value)
		)
		return "<li>Enter a valid <b>phone number</b></li>";
		
	return "";
}
function validateAddress(){
	errors = "";
	if($("address").value == "")
		errors += "<li>Enter your <b>street address</b></li>";
	if($("city").value == "")
		errors += "<li>Enter your <b>city</b></li>";
	if($("state").value == "")
		errors += "<li>Enter your <b>state</b></li>";
	if($("zip").value == "")
		errors += "<li>Enter your <b>postal code</b></li>";
		
	return errors;
}
function validateDisclaimer(){
	if(!($("understand").checked))
		return "<li>Indicate you have <b>read and understand the requirements of CME/CE Accreditation</b></li>";
		
	return "";
}
function validateCredit(){
	if(!verifyOneChecked("creditType"))
		return "<li>Indicate the type of <b>credit required</b></li>";
		
	return "";
}
function validateUserType() {
	if(!verifyOneChecked("userType"))
		return "<li>Indicate your profession</li>";
		
	return "";
}

function processForm( errors ) {
	if(errors == "") //The form is valid, so submit it
		$('mainForm').submit();
	else { //There are errors, display them.
		$("errorMessageInner").innerHTML = "<p>Before submitting, please:</p>" + "<ul>"+errors+"</ul>"
		$("submitButtonLabel").scrollIntoView(true)
	}
}
