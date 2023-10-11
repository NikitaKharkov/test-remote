<?
/**
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 */
class KbTopic extends LoggedRecord 
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
	}	
	
	/**
	 * finds KbTopic IDs
	 * 
	 * @param string order_by
	 * @return array
	 */
	public function countKbPagesForInterface($kb_interface_id=NULL)
	{
		$sql = "SELECT count(p.kb_page_id) FROM 
					kb_topics AS t LEFT JOIN
					kb_pages_kb_topics AS pt ON t.kb_topic_id = pt.kb_topic_id LEFT JOIN
					kb_pages AS p ON pt.kb_page_id = p.kb_page_id LEFT JOIN
					kb_pages_kb_interfaces AS pi ON p.kb_page_id = pi.kb_page_id LEFT JOIN
					kb_interfaces AS i ON pi.kb_interface_id = i.kb_interface_id
				WHERE t.kb_topic_id = '" . $this->getPrimaryKey() . "' AND i.kb_interface_id = '${$kb_interface_id}' ";
		
		$result = $this->Database->query($sql);
		if ($this->Database->numRows($result)) {
			$row = $this->Database->getRow($result);
			trace($row); die;
		}
		
	}
	
	/**
	 * Returns the edit page string
	 *
	 * @param void
	 * @return string
	 */
	public function getEditPage() {
		return "/admin/kb_topics.php?kb_topic_id={$this->getPrimaryKey()}&amp;page_function=edit";
	}
}
?>