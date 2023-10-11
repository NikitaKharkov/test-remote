function validateTufts() {
	//Add any validation errors to a list of errors
	errors = 
		validateSections()
		+ validateLearned()
		+ validateName()
		+ validateAddress()
		+ validateEmails()
		+ validateDisclaimer()
		+ validateCredit();
	
	processForm(errors);
}