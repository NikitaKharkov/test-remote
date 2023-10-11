function validateBaycare() {
	//Add any validation errors to a list of errors
	errors = 
		validateSections()
		+ validateLearned()
		+ validateName()
		+ validateEmails()
		+ validatePhoneNumber()
		+ validateCredit();
	
	processForm(errors);
}