<?
/**
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 */
class Feature extends LoggedRecord {
	
	/**
	 * Returns the edit page string
	 *
	 * @param void
	 * @return string
	 */
	public function getEditPage() {
		return "/admin/help_interfaces.php?help_interface_id={$this->getPrimaryKey()}&amp;page_function=edit";
	}
	
	/**
	 * Resets a primary key and makes an object not existing
	 *
	 * @param void
	 * @return void
	 */
	public function resetPrimaryKey() {
		$this->existing = FALSE;
		$this->primary_key_value = NULL;
	}
}
?>