<?
/**
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 */
class KbPage extends LoggedRecord {
	
	/**
	 * Configures the class
	 * 
	 * @param  void
	 * @return void
	 */
	protected function configure() 
	{
		$this->field_options['title']['xhtml'] = TRUE;
		$this->field_options['content']['xhtml'] = TRUE;
		$this->field_options['last_updated']['date_updated'] = TRUE;
		$this->field_options['file']['file_upload'] = array('directory' => $_SERVER['DOCUMENT_ROOT'] . '/uploads/kb/');
		
		$this->validation_rules[] = array('one_or_more' => array('content', 'file'));
	}
	
	/**
	 * Returns the edit page string
	 *
	 * @param void
	 * @return string
	 */
	public function getEditPage() {
		return "/admin/kb_pages.php?kb_page_id={$this->getPrimaryKey()}&amp;page_function=edit";
	}
	
}
?>