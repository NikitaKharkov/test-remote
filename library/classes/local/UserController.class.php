<?
/**
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 */
class UserController extends Controller
{
	/**
	 * finds NewsItem objects
	 * 
	 * @param string order_by
	 * @return array
	 */
	public function findUsers($order_by=NULL)
	{
		$order_by = parse_order_by($order_by);
		
		$sql = "SELECT user_id FROM users";
		
		$sql .= ($order_by) ? " ORDER BY " . $order_by . " " : " ";
		
		return $this->performSql($sql);
	}
	
	/**
	 * finds NewsItem objects
	 * 
	 * @param string order_by
	 * @return array
	 */
	public function findUserIdByLoginPassword($login=NULL, $password=NULL)
	{
		$sql = "SELECT user_id FROM users WHERE login = '{$login}' AND password = '{$password}'";
		
		try {
			$results = $this->performSql($sql);
			$user_id = array_shift($results);
		} catch (Exception $e) {
			$user_id = NULL;			
		}
		
		return $user_id;
	}

}
?>