<?
/**
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 */
class TocController extends Controller
{
	/**
	 * finds Feature Ids
	 * 
	 * @param string order_by
	 * @return array
	 */
	public function findTocs($order_by=NULL)
	{
		$order_by = parse_order_by($order_by);
		
		$sql = "SELECT toc_id FROM tocs";
		
		$sql .= ($order_by) ? " ORDER BY " . $order_by . " " : " ";
		
		return $this->performSql($sql);
	}
}
?>