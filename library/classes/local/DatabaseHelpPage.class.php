<?
/** 
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 */
class DatabaseHelpPage extends LoggedRecord {
	
	/**
	 * Returns the edit page string
	 *
	 * @param void
	 * @return string
	 */
	public function getEditPage() {
		return "/admin/database_help.php?database_help_page_id={$this->getPrimaryKey()}&amp;page_function=edit";
	}
}
?>