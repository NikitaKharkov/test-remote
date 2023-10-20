<?
/**
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 */
class HelpVersion extends Record 
{
	/**
	 * Configures the class
	 * 
	 * @param  void
	 * @return void
	 */
	protected function configure() 
	{
		$this->field_options['logo']['file_upload'] = array('directory' => $_SERVER['DOCUMENT_ROOT'] . '/uploads/help_versions/');
		$this->field_options['help_topic_ids']['sql_order_by'] = 'c.list_order ASC';
	}
	
	/**
	 * Copies all data from another version and adds it to this one
	 * 
	 * @param  integer $interface_id
	 * @return void
	 */
	public function populateFromHelpVersion($help_version_id) 
	{
		if (!$this->existing) {
			throw new Exception('Help Version must be saved before populating.');
		}

		$help_version = new HelpVersion($help_version_id);
		try {
			$help_topics = $help_version->createHelpTopics();
			foreach($help_topics as $help_topic_id => $help_topic)  {
				$help_topic->resetPrimaryKey();
				$help_topic->setListOrder(-1);
				$help_topic->setHelpVersionId($this->getPrimaryKey());
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
	
		/**
	 * Displays the current file html including the temporary file hidden field and the delete file checkbox
	 * 
	 * @since  3.0.0
	 * 
	 * @param  string $field      The field to print the current file html for
	 * @param  boolean $as_child  If the html is for a child table
	 * @return void
	 */
	public function printCurrentFileUploadHtml($field, $as_child=FALSE)
	{
		// Error out if the field is not a file upload
		if (!isset($this->field_options[$field]['file_upload'])) {
			throw new FatalException('The field ' . $field . ' does not have the file_upload field option set');    
		}
		
		$this->checkFileUploadFieldOption($field);
		$directory = $this->field_options[$field]['file_upload']['directory'];
		
		$code = '$temp_file = $this->get' . $this->camelCase($field, TRUE) . '();';
		eval($code);
        /** @var $temp_file - eval() function code */
		$file = $temp_file;
		if (!isset($this->old_file_name[$field]) && $this->existing) {
			$temp_file = '';
		}
		$temporary_field_name = ($as_child) ? $this->database_table . '_temporary_' . $field . '[]' : 'temporary_' . $field;
		echo '<input type="hidden" name="' . $temporary_field_name . '" value="' . $temp_file . '" />';
		
		$code = '$file_with_dir = $this->get' . $this->camelCase($field, TRUE) . '(TRUE);';
		eval($code);
		
		static $number = 1;

        /** @var $file_with_dir - eval() function result */
		if (trim($file_with_dir) && !is_dir($_SERVER['DOCUMENT_ROOT'] . $file_with_dir) && file_exists($_SERVER['DOCUMENT_ROOT'] . $file_with_dir)) {
			echo '<span class="current_file">';
			echo 'Current: <a href="' . $file_with_dir . '">' . $file . '</a>';
			echo '</span> ';
			echo '<span class="delete_checkbox">';
			$delete_field_name = ($as_child) ? $this->database_table . '_delete_' . $field . '[]' : 'delete_' . $field;
			echo '<input type="checkbox" class="checkbox" name="' . $delete_field_name . '" id="delete_' . $field . '_' . $number . '" value="' . form_value($file) . '"';
			echo (!empty($this->delete_flagged[$field])) ? ' checked="checked"' : '';
			echo ' /> ';
			echo '<label for="delete_' . $field . '_' . $number . '">Delete</label>';
			echo '</span>';
			$number++;
		}    
	}
	
	
}
?>