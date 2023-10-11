<?
/**
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 */
class User extends LoggedRecord {

	/**
	 * whether or not this user can edit news
	 *
	 * @return boolean
	 */
	public function canEditNews() {
		$news = ($this->getAuthorizationLevel() == 'system_admin' || $this->getPermissionNews()) ? TRUE : FALSE;
		return $news;
	}	
	
	/**
	 * whether or not this user can edit help
	 *
	 * @return boolean
	 */
	public function canEditHelp($interface_id=NULL) {
		if ($this->getAuthorizationLevel() == 'system_admin' || $this->getPermissionAllHelpInterfaces()) {
			return TRUE;
		}
		try {
			$help_interface_ids = $this->findHelpInterfaceIds();
			if (($interface_id && in_array($interface_id, $help_interface_ids)) || (!$interface_id && count($help_interface_ids))) {
				return TRUE;
			}
		} catch (Exception $e) {}
		return FALSE;
	}
	
	/**
	 * whether or not this user can edit the knowledge base
	 *
	 * @return boolean
	 */
	public function canEditKnowledgeBase() {
		if ($this->getAuthorizationLevel() == 'system_admin' || $this->getPermissionAllKbInterfaces()) {
			return TRUE;
		}
		return FALSE;
	}
	
	/**
	 * whether or not this user can edit database help
	 *
	 * @return boolean
	 */
	public function canEditDatabaseHelp($database_id=NULL) {
		if ($this->getAuthorizationLevel() == 'system_admin' || $this->getPermissionAllDatabaseHelp()) {
			return TRUE;
		}
		try {
			$database_ids = $this->findEbscoDatabaseIds();
			if (($database_id && in_array($database_id, $database_ids)) || (!$database_id && count($database_ids))) {
				return TRUE;
			} 
		} catch (Exception $e) {}
		return FALSE;
	}
	
	
	/**
	 * whether or not this user can edit ebsco databases
	 *
	 * @return boolean
	 */
	public function canEditEbscoDatabases($database_id=NULL) {
		if ($this->getAuthorizationLevel() == 'system_admin' || $this->getPermissionAllEbscoDatabases()) {
			return TRUE;
		}
		return FALSE;
	}
	
	/**
	 * Returns the edit page string
	 *
	 * @param void
	 * @return string
	 */
	public function getEditPage() {
		return "/admin/users.php?user_id={$this->getPrimaryKey()}&amp;page_function=edit";
	}
	
	
}
?>