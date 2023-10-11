<?
/**
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 */
class HelpLanguage extends Record 
{
	/**
	 * Copies all data from another help language and adds it to this one
	 * 
	 * @param  integer $help_language_id
	 * @return void
	 */
	public function populateFromHelpLanguage($help_language_id) 
	{
		if (!$this->existing) {
			throw new Exception('Help Language must be saved before populating.');
		}

		$help_language = new HelpLanguage($help_language_id);
		try {
			$help_topics   = $help_language->createHelpTopics();
			foreach($help_topics as $help_topic_id => $help_topic)  {
				$help_topic->resetPrimaryKey();
				$help_topic->setHelpLanguageId($this->getPrimaryKey());
				$help_topic->store();
				$help_topic->populateFromHelpTopic($help_topic_id);
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
}
?>