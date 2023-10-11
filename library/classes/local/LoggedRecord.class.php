<?
/**
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 */
class LoggedRecord extends Record {

 	/**
	 * Stores the current data into the database, throw exception on error
	 * 
	 * @param  boolean $use_transaction  If a transaction should be created (only set to false if you are manually starting a transaction)
	 * @return void
	 */
	public function store($use_transaction=TRUE) 
	{
		$action = 'insert';
		if ($this->existing) {
			$action = 'update';
		}
		
		parent::store($use_transaction);
		
		$this->load();
		
		$change = new Change();
		$change->setAction($action);
		$change->setTableAffected($this->retrieveDatabaseTable());
		$change->setObjectId($this->getPrimaryKey());
		$change->store();
	}
	
	/**
	 * Deletes the current data from the database and removes uploaded files, throws exception on error
	 * 
	 * @param  boolean $use_transaction  If a transaction should be created (only set to false if you are manually starting a transaction)
	 * @param  boolean $delete_files     If all files should be deleted
	 * @return void 
	 */
	public function delete($use_transaction=TRUE, $delete_files=TRUE) 
	{
		$change = new Change();
		$change->setAction('delete');
		$change->setSerializedObject($this);
		$change->setTableAffected($this->retrieveDatabaseTable());
		$change->setObjectId($this->getPrimaryKey());
		
		parent::delete($use_transaction, $delete_files);
		
		$change->store();
	}
	
	
	/**
	 * Returns the usually protected $this->values
	 * 
	 * @param void
	 * @return array
	 */
	public function getFieldInfo()
	{
		return $this->field_info;
	}
}