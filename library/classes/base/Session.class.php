<?php
/**
 * Session - Extends SessionCore, implements loginUserHelper for current site
 * 
 * Copyright 2002 - 2007, iMarc <info@imarc.net>
 * 
 * @usage   See http://wiki.imarc.net/wikka/SessionClass
 * 
 * @author  William Bond [wb] <will@imarc.net>
 * @author  Dave Tufts [dt] <dave@imarc.net>
 */
class Session extends SessionCore
{


	/**
	 * Sets internal class configuration values, all are optional
	 * 
	 * @since 7.0.0
	 * 
	 * @param  void
	 * @return void
	 */
	protected function configureClass()
	{
		
		/* General setup */
		
		$this->session_name = 'PHPSESS'; // (string)  name of session
		//$this->domain = '.epnet.com'; // (string)  if set, needs at least 2 dots (.imarc.net covers any subdomain for "imarc.net")
		
		
		/* Login info */
		
		$this->login_page = '/login/';  // (string)  URL of login page
		$this->no_access_page = '/login/?no_access=true';  // (string)  URL of 'access denied' page
		$this->authorization_levels = array('system_admin' => 80, 'admin' => 50);  // (array)   key = auth name, val = auth int level
		
		
		/* Auto Login - keep users logged in for specified time                                    */
		/* requires iMarc Database object passed to constructor and database table to track logins */
		
		//$this->auto_login = false;  // (boolean)
		//$this->auto_login_lasts = 604800;  // (integer) number of seconds the cookie last
		
		
		/* Privileged IPs - helpful for allowing a search engine to index restricted content */
		
		//$this->privileged_ip = '70.86.111.4';  // (string)  automatically login users from this IP
		//$this->privileged_user_agent = 'siftbox';  // (string)  restrict privileged_ip auto logins to this browser
		//$this->privileged_authorization = 'user';  // (string)  users automatically logged in by privileged_ip will be this authorization level
	}
	

	/**
	 * Encrypts password for database. When data goes IN to the database, 
	 * password value should pass through this method.
	 * 
	 * @since   6.0.0
	 * 
	 * @param   string   Plaintext password
	 * @return  boolean  Encrypted password
	 */
	public function encryptPassword($password='')
	{
		return $password;
	}  
	
	
	/**
	 * Returns if the login information is valid
	 * 
	 * @since   5.0.0
	 * 
	 * @param   string $login               User's login
	 * @param   string $encrypted_password  Encrypted password (already passed through encryptPassword())
	 * @return  boolean  If the login information is valid
	 */
	public function loginUserHelper($login=NULL, $encrypted_password=NULL)
	{
		$user_controller = new UserController();
		$user_id = $user_controller->findUserIdByLoginPassword($login, $encrypted_password);
		
		if ($user_id) {
			$user = new User($user_id);
			$this->saveSessionVariable('session_user_id', $user_id);
			$this->saveSessionVariable('session_authorization', $user->getAuthorizationLevel());
			return TRUE;
		} else {
			return FALSE;
		}
	} 
	
	 /**
	 * password value should pass through this method.
	 * @param void
	 * @return void
	 */
	static public function getLoggedInUserId()
	{
		if (isset($_SESSION['session_user_id'])) {
			return $_SESSION['session_user_id'];
		} else {
			return NULL;    
		}
	}  
}
?>
