<?
/**
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 */
class NewsItemController extends Controller
{
	/**
	 * finds NewsItem objects
	 * 
	 * @param string order_by
	 * @param mixed status
	 * @return array
	 */
	public function findNewsItems($order_by=NULL, $display_page=NULL, $status=NULL, $limit=NULL)
	{
		$order_by = parse_order_by($order_by);
		
		$sql = "SELECT news_item_id FROM news_items WHERE 1 = 1 ";
		
		$status = ($status && !is_array($status)) ? array($status) : $status;
		
		$sql .= ($status)   ? " AND status IN ('" . join("','", $status) . "') " : '';
		$sql .= ($display_page) ? " AND display_page = '{$display_page}' " : '';
		$sql .= ($order_by) ? " ORDER BY " . $order_by . " " : '';
		$sql .= ($limit) ? " LIMIT {$limit} " : '';
				
		return $this->performSql($sql);
	}
}
?>