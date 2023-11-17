<?
/**
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 */
class KbInterface extends LoggedRecord {
	
	/**
	 * create distinct topics
	 * 
	 * @param void
	 * @return array
	 */
	public function createDistinctTopics()
	{
		$kb_interface_id = $this->getPrimaryKey();
		
		$sql = "SELECT DISTINCT(t.kb_topic_id) FROM 
					kb_topics AS t LEFT JOIN
					kb_pages_kb_topics AS pt ON t.kb_topic_id = pt.kb_topic_id LEFT JOIN
					kb_pages AS p ON pt.kb_page_id = p.kb_page_id LEFT JOIN
					kb_pages_kb_interfaces AS pi ON p.kb_page_id = pi.kb_page_id LEFT JOIN
					kb_interfaces AS i ON pi.kb_interface_id = i.kb_interface_id
				WHERE i.kb_interface_id = '{$kb_interface_id}' AND p.status = 'public' ORDER BY t.name ASC";
		
		$ids = array();
		$result = $this->Database->query($sql);
		if ($this->Database->numRows($result)) {
			while($row = $this->Database->getRow($result)) {
				array_push($ids, $row['kb_topic_id']);
			}
		}
		
		$objects = array();
		foreach($ids as $id) {
			$objects[$id] = new KbTopic($id);
		}
		
		return $objects;
	}
	
}
?>