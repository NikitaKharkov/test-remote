<?
/** 
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 */
class EbscoDatabase extends LoggedRecord {
	
	/**
	 * Returns the edit page string
	 *
	 * @param void
	 * @return string
	 */
	public function getEditPage() {
		return "/admin/ebsco_databases.php?ebsco_database_id={$this->getPrimaryKey()}&amp;page_function=edit";
	}
}
?>