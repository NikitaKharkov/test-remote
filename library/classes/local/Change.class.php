<?
/**
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 */
class Change extends Record {

	/**
	 * Configures the class
	 * 
	 * @param  void
	 * @return void
	 */
	protected function configure() 
	{
		$this->field_options['change_date']['date_created'] = TRUE;
	}
	
	/**
	 * Sets and serializes the object
	 * 
	 * @param  void
	 * @return void
	 */
	public function setSerializedObject($object=NULL) {
		$this->assignValue('serialized_object', serialize($object));
	}
	
	/**
	 * Gets and unserialized the object
	 * 
	 * @param  void
	 * @return object
	 */
	public function getSerializedObject() {
		return unserialize($this->retrieveValue('serialized_object'));
	}

   /**
	 * Stores the current data into the database, throw exception on error
	 * 
	 * @since 1.0.0
	 * 
	 * @param  boolean $use_transaction  If a transaction should be created (only set to false if you are manually starting a transaction)
	 * @return void
	 */
	public function store($use_transaction=TRUE) 
	{
		$this->setIpAddress($_SERVER['REMOTE_ADDR']);
		$this->setUserId(Session::getLoggedInUserId());
		parent::store($use_transaction);
	}
}