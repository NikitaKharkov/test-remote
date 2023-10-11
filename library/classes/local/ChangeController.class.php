<?
/**
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 */
class ChangeController extends Controller
{
	//private $changes_per_page = 200;
	
	/**
	 * finds Change ids
	 * 
	 * @param string order_by
	 * @return array
	 */
	public function findChanges($order_by=NULL, $tables_affected, $user_ids, $actions, $start_date, $end_date)
	{
		$order_by = parse_order_by($order_by);
		
		$sql = "SELECT c.change_id FROM 
					changes AS c LEFT JOIN
					users AS u ON c.user_id = u.user_id WHERE 1 = 1 ";
		
		$sql .= " AND c.table_affected IN ('" . join("','", $tables_affected). "') ";
		$sql .= " AND c.user_id IN ('" . join("','", $user_ids) . "') ";
		$sql .= " AND c.action IN ('"  . join("','", $actions) . "') ";
		$sql .= " AND c.change_date BETWEEN '${start_date}' AND '${end_date}' ";
		
		$sql .= ($order_by) ? " ORDER BY " . $order_by . " " : " ";
		
		return $this->performSql($sql);
	} 
	
	
	public function findCountReportColumnData($tables_affected, $user_ids, $actions, $order_by='tables_affected') {
		//$columns = $this->findCountReportColumnNames($tables_affected, $user_ids, $actions);
		
		$array_names = array('table_affected', 'action', 'user_id');
	
		if ($order_by == 'user_ids') {
			$temp = $tables_affected;
			$tables_affected = $user_ids;
			$user_ids = $temp;
			$array_names = array('user_id', 'action', 'table_affected');
		}
		
		if ($order_by == 'actions') {
			$temp = $tables_affected;
			$tables_affected = $actions;
			$actions = $temp;
												
			$array_names = array('action', 'table_affected', 'user_id');
		}
		
		
		
		
		$total = 1;
		if (!empty($tables_affected)) {
			$total = $total * count($tables_affected);
		}
		if (!empty($user_ids)) {
			$total = $total * count($user_ids);
		}
		if (!empty($actions)) {
			$total = $total * count($actions);
		}		
		
		$columns = array();
		for($i=0; $i < $total; $i++) {
			$columns[] = array();
		}
		
		if (!empty($tables_affected)) {
			$total_tables_affected = count($tables_affected);
			$name = $array_names[0];
			$key = 1;
			for($i=1; $i <= $total; $i++) {
				$columns[$i-1][$name] = $tables_affected[$key-1];
				if ($i % ($total/$total_tables_affected) == 0) {
					$key++;
				}
				
			}			
		}
		
		if (!empty($actions)) {
			$total_actions = count($actions);
			$name = $array_names[1];
			if (empty($columns)) {
				$key = 1;
				for($i=1; $i <= $total; $i++) {
					$columns[$i-1][$name] = $actions[$key-1];
					if ($i % ($total/$total_actions) == 0) {
						$key++;
					}
				}			
			} else {
				$key = 1;
				for($i=1; $i <= $total; $i++) {
					$columns[$i-1][$name] = $actions[$key-1];
					$key++;
					if ($i % ($total_actions) == 0) {
						$key = 1;
					}
				}
			}
		}
		
		
		if (!empty($user_ids)) {
			$total_user_ids = count($user_ids);
			$name = $array_names[2];
			if (empty($columns)) {
				$key = 1;
				for($i=1; $i <= $total; $i++) {
					$columns[$i-1][$name] = $user_ids[$key-1];
					if ($i % ($total/$total_user_ids) == 0) {
						$key++;
					}
				}			
			} else if (isset($total_actions)) {
				$key = 1;
				for($i=1; $i <= $total; $i++) {
					$columns[$i-1][$name] = $user_ids[$key-1];
					if ($i % ($total_actions) == 0) {
						$key++;
					}
					if ($key > $total_user_ids) {
						$key = 1;
					}
				}				
			} else {
				$key = 1;
				for($i=1; $i <= $total; $i++) {
					$columns[$i-1][$name] = $user_ids[$key-1];
					$key++;
					if ($i % ($total_user_ids) == 0) {
						$key = 1;
					}
				}
			}
		}
		
		return $columns;
	}
	
	
	/**
	 * finds Change ids
	 * 
	 * @param string order_by
	 * @return array
	 */
	public function findCountReport($tables_affected, $user_ids, $actions, $start_date, $end_date, $order_by)
	{
		$count_report_columns = $this->findCountReportColumnData($tables_affected, $user_ids, $actions, $order_by);
		
		if (empty($count_report_columns)) {
			$count_report_columns = array(array());
		}
		
		$counts = array();
		foreach($count_report_columns as $columns) {
			$sql = "SELECT count(c.change_id) from changes AS c WHERE 1 = 1 ";
			foreach($columns as $name => $val) {
				$sql .= " AND c.${name} = '${val}' ";
			}
			$sql .= " AND c.change_date BETWEEN '${start_date}' AND '${end_date}'";

			$result = $this->Database->query($sql);
			$row    = $this->Database->getRow($result);

			array_push($counts, $row['count(c.change_id)']);
		}
		
		$count_report_columns_total = count($count_report_columns);
		for($i = 0; $i < $count_report_columns_total; $i++) {
			$count_report_columns[$i]['count'] = $counts[$i];
		}
		
		return $count_report_columns;
	} 
	
	
	/**
	 * lists Change objects
	 * 
	 * @param integer current page
	 * @return void
	 */
	public function listChanges($order_by=NULL, $page=NULL)
	{
		$ids = $this->findChanges($order_by, $page);
		
		$page = (!$page) ? ceil(count($ids) / $this->changes_per_page) : $page;
		
		return $this->createObjects('changes', $ids);
	}
	
	/**
	 * lists Change objects
	 * 
	 * @param integer current page
	 * @return void
	 */
	public function getChangeCount()
	{
		$results = $this->Database->smartSelect('count(change_id)', 'changes');
		$count   = $results[0]['count(change_id)'];
		
		return $count;
	}
	
	/**
	 * returns an assoc_array of item type names => table affected
	 *
	 * @param void
	 * @return array
	 */
	public function getChangeItemTypes()
	{
		return array(
			'EBSCO Databases' => 'ebsco_databases',
			'Database Help Pages' => 'database_help_pages',
			'Help Interfaces' => 'help_interfaces',
			'Help Pages' => 'help_pages',
			'Help Topics' => 'help_topics',
			'Help Features' => 'features',
			'Help TOCs' => 'tocs',
			'Knowledge Base Interfaces' => 'kb_interfaces',
			'Knowledge Base Pages' => 'kb_pages',
			'Knowledge Base Topics' => 'kb_topics',
			'Languages' => 'languages',
			'News Items' => 'news_items',
			'Users' => 'users'
		);
	}
	
	/**
	 * returns an assoc_array of action name => action
	 *
	 * @param void
	 * @return array
	 */
	public function getChangeActions()
	{
		return array(
			'Added'   => 'insert',
			'Edited'  => 'update',
			'Deleted' => 'delete'
		);
	}
	
	
	
}