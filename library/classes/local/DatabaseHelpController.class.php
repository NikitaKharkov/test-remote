<?
/**
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 */
class DatabaseHelpController extends Controller
{
	/**
	 * finds DatabaseHelpPage IDs
	 * 
	 * @param string order_by
	 * @param string language_id
	 * @param string ebsco_database_id
	 * @param string status
	 * @return array
	 */
	public function findDatabaseHelpPages($order_by=NULL, $language_id=NULL, $ebsco_database_id=NULL, $status=NULL)
	{
		$order_by = $order_by ? $order_by : 'name_asc';
		$order_by = parse_order_by($order_by);

		$sql = "SELECT database_help_page_id FROM database_help_pages";
		
		$sql .= " WHERE 1 = 1 ";
		$sql .= ($language_id)       ? " AND language_id = '{$language_id}' " : '';
		$sql .= ($ebsco_database_id) ? " AND ebsco_database_id = '{$ebsco_database_id}' " : '';		
		$sql .= ($status)            ? " AND kbp.status = '{$status}' " : '';
	
		$sql .= ($order_by) ? " ORDER BY {$order_by} " : "";
		
		return $this->performSql($sql);
	}
	
	/**
	 * finds DatabaseHelpPages for help
	 * 
	 * @param string order_by
	 * @param string language_id
	 * @param string ebsco_database_id
	 * @param string status
	 * @return array
	 */
	public function findLiveDatabaseHelpPages($ebsco_database_ids=NULL, $language_id=NULL)
	{
		$dhps = array();
		try {
			$sql = "SELECT database_help_page_id FROM database_help_pages WHERE 1=1 AND language_id = '{$language_id}' ";
			$sql .= " AND ebsco_database_id IN ('" . join("','", $ebsco_database_ids). "') ";
			$sql .= " AND status = 'live' ";
			$sql .= " ORDER BY name ASC ";
			$dhp_ids = $this->performSql($sql);
			$dhps    = $this->createDatabaseHelpPages($dhp_ids);
		} catch (Exception $e) { 
		}
		
		return $dhps;
	}
	
}
?>