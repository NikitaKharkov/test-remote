<?
/**
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 */
class FeatureController extends Controller
{
	/**
	 * finds Feature Ids
	 * 
	 * @param string order_by
	 * @return array
	 */
	public function findFeatures($order_by=NULL, $ebsco_code=NULL, $help_interface_id=NULL)
	{
		$order_by = parse_order_by($order_by);
		
		$sql = "SELECT feature_id FROM features WHERE 1 = 1";
		
		$sql .= ($help_interface_id) ? " AND help_interface_id = '{$help_interface_id}' " : '';
		$sql .= ($ebsco_code) ? " AND ebsco_code = '{$ebsco_code}' " : '';
		$sql .= ($order_by) ? " ORDER BY " . $order_by . " " : " ";
		
		return $this->performSql($sql);
	}
}
?>