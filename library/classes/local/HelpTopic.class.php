<?
/**
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 */
class HelpTopic extends LoggedRecord 
{
	/**
	 * Configures the class
	 * 
	 * @param  void
	 * @return void
	 */
	protected function configure() 
	{
	    $this->field_options['list_order']['ordering'] = TRUE;
		$this->field_options['help_page_ids']['sql_order_by'] = 'c.list_order ASC';
	}	
	
	/**
	 * Copies all data from another help topic and adds it to this one
	 * 
	 * @param  integer $help_topic_id
	 * @return void
	 */
	public function populateFromHelpTopic($help_topic_id) 
	{
		if (!$this->existing) {
			throw new Exception('Help Topic must be saved before populating.');
		}

		$help_topic = new HelpTopic($help_topic_id);
		try {
			$help_pages = $help_topic->createHelpPages();
			foreach($help_pages as $help_page_id => $help_page)  {
				$help_page->resetPrimaryKey();
				$help_page->setListOrder(-1);
				$help_page->setHelpTopicId($this->getPrimaryKey());
				$help_page->store();
			}
		} catch (Exception $e) {}
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
	
	/**
	 * Returns the edit page string
	 *
	 * @param void
	 * @return string
	 */
	public function getEditPage() {
		return "/admin/help_topics.php?help_topic_id={$this->getPrimaryKey()}&amp;page_function=edit";
	}
}
?>