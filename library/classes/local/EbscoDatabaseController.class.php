<?
/**
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 */
class EbscoDatabaseController extends Controller
{
	/**
	 * finds EbscoDatabase objects
	 * 
	 * @param string order_by
	 * @param mixed status
	 * @return array
	 */
	public function findEbscoDatabases($order_by=NULL, $status=NULL, $ebsco_codes=NULL)
	{
		$order_by = parse_order_by($order_by);
		
		$status = ($status && !is_array($status)) ? array($status) : $status;
		
		$sql = "SELECT ebsco_database_id FROM ebsco_databases WHERE 1 = 1 ";
		
		$sql .= (is_array($ebsco_codes)) ? " AND ebsco_code IN ('" . join("','", $ebsco_codes) . "') " : '';
		$sql .= ($status)   ? " AND status IN ('" . join("','", $status) . "') " : '';
		$sql .= ($order_by) ? " ORDER BY " . $order_by . " " : " ";
		
		return $this->performSql($sql);
	}
	
	
	/** 
	 * parses REQUEST for ebsco database ids. 
	 *
	 * @return array 
	 */
	public function parseRequestedEbscoDatabaseIds()
	{
		$ed_ids = array();
		
		if (isset($_REQUEST['dbs'])) {
			$ecs = explode(',', $_REQUEST['dbs']);
		} else if (isset($_COOKIE['cookie_ebsco_database_codes'])) {
			$ecs = explode(',', $_COOKIE['cookie_ebsco_database_codes']);
		} else {
			$ecs = array();
		}
		
		try {
			$ed_ids = $this->findEbscoDatabases('name_asc', 'active', $ecs);
			setcookie('cookie_ebsco_database_codes', join(',', $ecs));
		} catch (Exception $e) {}

		return $ed_ids;
	}

	
}
?>