<?php
/**
 * SessionCore - Session management and login/authentication functions, extended by Session
 * 
 * Copyright 2002 - 2007, iMarc <info@imarc.net>
 * 
 * @version  7.0.0
 * 
 * @author  Dave Tufts [dt] <dave@imarc.net>
 * @author  William Bond [wb] <will@imarc.net>
 * @author  Fred LeBlanc [fl] <fred@imarc.net>
 * @author  Patrick McPhail [pm] <patrick@imarc.net>
 * 
 * @requires  PHP 5 or higher
 * 
 * @changes  7.0.0  Removed Objects from constructor parameters, removed internal db abstraction in favor of Database class, moved configuration to extending class, no longer uses 'Session.conf.php' [dt, 2007-05-30]
 * @changes  6.2.0  Added Objects object parameter to the constructor [wb, 2007-04-06]
 * @changes  6.1.1  Fixed commenting style errors, boolean consistency and code stardards compliance, added pgsql and mysql specific db create statements for auto login table [wb, 2007-02-01]
 * @changes  6.1.0  added getError() method. [pm, 2006-12-21]
 * @changes  6.0.1  Replaced outdated postgres functions with new ones [wb, 2006-09-29]
 * @changes  6.0.0  Changed auto login db schema [wb, 2006-09-21] and added functionality store passwords securely [dt, 2006-09-22]
 * @changes  5.6.1  Fixed bug where a user would be auto logged in if they have an autologin cookie even if auto_login was turned off [wb, 2006-06-12]
 * @changes  5.6.0  Added public method getDomain() to allow access to the private variable $domain [wb, 2006-06-07]
 * @changes  5.5.0  Added public methods killAutoLoginCookie(), isLoggedIn(); removed class vars session_logged_in, session_authorization in favor of $_SESSION super globals [dt, 2006-04-19]
 * @changes  5.4.1  Changed Postgres db_type value from 'postgres' to 'pgsql' so it's compatable with Database::, [dt, 2006-04-19]
 * @changes  5.4.0  Updated auto login code to work with both mysql and postgres seamlessly, sized up login and password fields [wb, 2006-04-13]
 * @changes  5.3.1  getUserId() no longer triggers a notice if $_SESSION['session_user_id'] has not been set [wb, 2006-03-21]
 * @changes  5.3.0  parameter 1 of the constructor can now be either a database connection or iMarc Database class [dt, 2006-03-14]
 * @changes  5.2.0  added hasAccess() method [dt, 2006-03-13]
 * @changes  5.1.2  fixed forwardUser() to properly maintain the destination querystring [wb, 2006-03-08]
 * @changes  5.1.1  added isset() checking to suppres error notices [dt, 2006-03-03
 * @changes  5.1.0  removed stripSession(), refacorded SQL abstraction, fixed auto_login bugs, made startSession() private [dt, 2006-02-25]
 * @changes  5.0.0  updated to PHP5, fixed up code to comply more fully with new code standards [wb, 2006-01-30]
 * @changes  4.0.0  updated code to comply with new code standards [fl, 2006-01-17]
 * @changes  3.5.0  added method get_version()
 * @changes  3.4.0  added methods get_user_id() and get_user_auth_level() to allow access to user information from outside class
 * @changes  3.3.0  added method get_auth_levels() to allow access to auth levels from outside class 
 * @changes  3.2.0  added destination url parameter to the no_access page redirect
 * @changes  3.1.0  added ability to defined privileged IP address, subnets, or user agents to allow for search engine indexing
 * @changes  3.0.0  finished testing all v2.1 updates; fixed bug with auto_login_cookie
 * @changes  2.3.0  added checks to work with E_ALL error reporting
 * @changes  2.1.0  removed features used for php 3 compatibility, created conf file loading and site specific login loading
 * @changes  2.0.0  updated comments for phpdoc
 */
abstract class SessionCore
{
	/**
	 * Version number: major.minor.bug-fix
	 * 
	 * @var string
	 */
	private $version = '7.0.0';
	
	
	/**
	 * 
	 * Configuration variables, set in extending class
	 * 
	 */
	protected $session_name             = '';
	protected $login_page               = '';
	protected $no_access_page           = '';
	protected $auto_login               = false;
	protected $auto_login_lasts         = 0;
	protected $domain                   = '';
	protected $authorization_levels     = array();
	protected $privileged_ip            = '';
	protected $privileged_user_agent    = '';
	protected $privileged_authorization = '';
	
	
	/**
	 * Optional iMarc Database object
	 * 
	 * @var object
	 */
	protected $database;


	/**	
	 * Current session id
	 * 
	 * @var string
	 */
	private $session_id;	
	
	/**
	 * Persistant cookie name for auto_login 
	 * 
	 * @var string
	 */
	private $auto_login_cookie;
		
	/**
	 * Class/Function error messages
	 * 
	 * @var string
	 */
	private $error;
		
	/**
	 * If a call is being made from another method
	 * 
	 * @var boolean
	 */
	protected $auto_login_call = FALSE;

	
	/**
	 * Creates of continues a user session
	 * 
	 * @since 1.0.0
	 * 
	 * @param  mixed $database  iMarc Database class (object) or an open database connection (resource)
	 * @return void
	 */
	public function __construct($database=NULL)
	{
		$this->configureClass();
		if (!$this->session_name) { $this->session_name = "PHPSESSID"; }
		session_set_cookie_params(0, "/", $this->domain);
		
		// database checking
		if (!empty($database)) {
			if (gettype($database) == "object" && ($database instanceof Database)) {
				$this->database = $database;
			} else {
				die("A database oject was passed, but it doesn't seem to be the iMarc Database class");
			}
		} else {
			$this->auto_login = false; // auto login only works if iMarc Database object is passed to constructor
		}
		
		$this->auto_login_cookie = "AUTO_".$this->session_name;
		
		
		// Start a new session or continue an old one
		$this->startSession();
	}

	/**
	 * Sets internal class values, must be declared in extending class
	 * 
	 * @since 7.0.0
	 * 
	 * @param  void
	 * @return void
	 */
	abstract protected function configureClass();
	
	/**
	 * Returns the version of the class
	 * 
	 * @since 4.0.0
	 * 
	 * @param  void
	 * @return string  current class version
	 */
	public function getVersion()
	{
		return $this->version;	
	}
		
	
	/**
	 * Returns the class variable that defines authorization levels
	 * 
	 * @since 5.0.0
	 * 
	 * @param  void
	 * @return array  List of valid authorization levels
	 */
	public function getAuthorizationLevels()
	{
		return $this->authorization_levels;
	}
	
	
	/**
	 * Returns the authorization level of the current user
	 * 
	 * @since 5.0.0
	 * 
	 * @param  void
	 * @return string  Authorization level of current user
	 */
	public function getUserAuthorizationLevel()
	{
		return (array_key_exists('session_authorization', $_SESSION) && !empty($_SESSION['session_authorization'])) ? $_SESSION['session_authorization'] : NULL;
	}
	
	
	/**
	 * Returns true if param 1 has at least as high a permission level as param 2
	 * 
	 * @since 5.2.0
	 * 
	 * @param  string $check_level     authorization level key to check ('user', 'admin', etc...)
	 * @param  string $required_level  authorization level key
	 * @return bool
	 */
	public function hasAccess($check_level, $required_level)
	{
		$level_array     = $this->getAuthorizationLevels();
		$check_points    = (!empty($level_array[$check_level])) ? $level_array[$check_level] : 0;
		$required_points = (!empty($level_array[$required_level])) ? $level_array[$required_level] : 100;
		return ($check_points >= $required_points) ? TRUE : FALSE;
	}
	
	
	/**
	 * Returns the id of the current user
	 * 
	 * @since 4.0.0
	 * 
	 * @param  void
	 * @return string  ID of Current user
	 */
	public function getUserId()
	{
		if (isset($_SESSION['session_user_id'])) {
			return $_SESSION['session_user_id'];
		} else {
			return NULL;    
		}
	}
	
	
	/**
	 * Returns the current session id
	 * 
	 * @since 5.0.0
	 * 
	 * @param  void
	 * @return string  Current session id
	 */
	public function getSessionId()
	{
		return $this->session_id;
	}
	
	
	/**
	 * Returns the name of the session
	 * 
	 * @since  5.0.0
	 * 
	 * @param  void
	 * @return string  Session name
	 */
	public function getSessionName()
	{
		return $this->session_name;
	}
	
	
	/**
	 * Returns the domain
	 * 
	 * @since 5.6.0
	 * 
	 * @param  void
	 * @return string  Domain
	 */
	public function getDomain()
	{
		return $this->domain;
	}
	
	
	/**
	 * Returns the error string
	 * 
	 * @since 6.1.0
	 * 
	 * @param  void
	 * @return string  Error
	 */
	public function getError()
	{
		return $this->error;
	}
	
	
	/**
	 * Starts a new session or continues an old session and logs the user in (if applicable)
	 * 
	 * @since 5.0.0
	 * 
	 * @param  void
	 * @return void
	 */
	private function startSession()
	{
		// Set the session name, start it and grab the id so we can use it later
		session_name($this->session_name);
		session_start();
		$this->session_id = session_id();
				
		// not logged in, try to log user in
		if (!$this->isLoggedIn() && !empty($this->auto_login)) {
			$this->autoLogin();
		}
	}

	
	/**
	 * Saves a session variable
	 * 
	 * @since   4.0.0
	 * 
	 * @param  string $name   The name of the variable
	 * @param  string $value  The value of the variable
	 * @return void
	 */
	public function saveSessionVariable($name=NULL, $value=NULL)
	{
		if (!empty($name)) {
			$_SESSION[$name] = $value;
		}
	}
	
	
	/**
	 * Returns true if user is logged in
	 * 
	 * @since   5.5.0
	 * 
	 * @param  void
	 * @return bool
	 */
	public function isLoggedIn()
	{
		return (!empty($_SESSION['session_logged_in'])) ? TRUE : FALSE;
	}
	
	
	/**
	 * Deletes a session variable
	 * 
	 * @since 4.0.0
	 * 
	 * @param  string $name  The name of the session variable to kill
	 * @return void
	 */
	public function killSessionVariable($name=NULL)
	{
		if (!empty($name)) {
			unset($_SESSION[$name]);
		}
	}

	
	/**
	 * Checks if a user is logged in with enough permissions
	 * 
	 * If not logged in, go to $this->login_page
	 * If logged in with too little permissions, go to $this->no_access_page
	 * 
	 * @since 4.0.0
	 * 
	 * @param  string $authorization_level_required  The authorization level required to view the page
	 * @return boolean  if the user met the authorization requirements
	 */
	public function loginRequired($authorization_level_required='')
	{
		$this->checkPrivileged();        
		if (!$this->isLoggedIn()) {
			if ($this->login_page) {
				$this->forwardUser($this->login_page);
			} else {
				print('The page that you reqested is for logged in users only');
				exit;
			}
		} else {
			if (!$authorization_level_required || !$this->authorization_levels) {
				return TRUE;
			} else {
				settype($this->authorization_levels, 'array');
				
				$user_level = 0; // Default user level
				reset($this->authorization_levels);
				while (list($key, $val) = each($this->authorization_levels)) {
					if ($this->getUserAuthorizationLevel() == $key) {
						$user_level = $val;
						break;
					}
				}
				
				$page_level = 100; // Default page level (more secure that default user)
				reset ($this->authorization_levels);
				while (list($key, $val) = each($this->authorization_levels)) {
					if ($authorization_level_required == $key) {
						$page_level = $val;
						break;
					}
				}
				
				// User has less authorization than the page requires - no access
				if ($user_level < $page_level) {
					if ($this->no_access_page) {
						$this->forwardUser($this->no_access_page);
					} else {
						echo 'You do not have enough access privelages to view this page.';
						exit;
					}
				} else {
					return TRUE;
				}
			}
		}
	}
	
	
	/**
	 * Forwards user to $page, appends session info, exits
	 * 
	 * @since 5.1.0
	 * 
	 * @param  string $page  relative url
	 * @return void
	 */
	private function forwardUser($page)
	{
		$url  = (!empty($_SERVER['HTTPS'])) ? 'https://' : 'http://';
		$url .= $_SERVER['HTTP_HOST'] . $page;
		$url .= (strpos($url, '?') !== FALSE) ? '&' : '?';
		$url .= $this->session_name . '=' . $this->session_id;
		$url .= '&destination=';
		$destination = urlencode($_SERVER['PHP_SELF']);
		if($_SERVER['QUERY_STRING']) { 
			$destination .= urlencode('?' . $_SERVER['QUERY_STRING']);
		}
		$url .= $destination;
		header('Location: ' . $url);
		exit;
	}
	
	
	/**
	 * Checks to see if the current user is a privileged user, and if so auto log them in
	 * 
	 * @since   5.0.0
	 * 
	 * @param  void
	 * @return void
	 */
	private function checkPrivileged()
	{
		// Check to see if any privileged access has been granted
		$privileged = FALSE;

		// Check the IP address of the user if we have defined a privileged IP address
		if(!empty($this->privileged_ip)) {

			// IP address is a CIDR range
			if(strpos($this->privileged_ip, "/")) {

				// This function checks to see if an IP is in a CIDR range
				$ip_arr       = explode("/",$this->privileged_ip);
				$network_long = ip2long($ip_arr[0]);
				$mask_long    = pow(2,32)-pow(2,(32-$ip_arr[1]));
				$ip_long      = ip2long($_SERVER['REMOTE_ADDR']);
				$privileged   = (($ip_long & $mask_long) == $network_long);
			
			// IP address is a list
			} elseif (strpos($this->privileged_ip, ",") !== FALSE) {
				$ip_list = explode(",", $this->privileged_ip);
				foreach($ip_list as $ip) {
					$privileged = $privileged || ($ip == $_SERVER['REMOTE_ADDR']);
				}
			
			// Plain IP address
			} else {
				$privileged = ($this->privileged_ip == $_SERVER['REMOTE_ADDR']);
			}
		}

		// Check the user agent of the user if we have defined a privileged user agent
		if(!empty($this->privileged_user_agent)) {
			if(stripos($_SERVER['HTTP_USER_AGENT'], $this->privileged_user_agent) !== FALSE) {
				$privileged = TRUE;
			}
		}	
		
		// If the user met one of the privileged levels, set them to logged in
		if($privileged) {
			$this->saveSessionVariable("session_authorization", $this->privileged_authorization);
			$this->saveSessionVariable("session_logged_in", "1");
		}
	}
	
	
	/**
	 * Passes login/password args to site_specific_login()
	 * 
	 * @since 4.0.0
	 * 
	 * @param  string $login     User's login
	 * @param  string $password  Unencrypted, plaintext password
	 * @return boolean  True, if user's login information was valid
	 */
	public function loginUser($login='', $password='')
	{
		// passwords from auto_login are already encrypted
		$password = ($this->auto_login_call) ? $password : $this->encryptPassword($password);
		
		if ($this->loginUserHelper($login, $password)) {
			$this->saveSessionVariable('session_logged_in', 1);
			return $this->recordAutoLogin($login, $password);
		} else {
			return FALSE;
		}
	}
	
	
	/**
	 * Saves auto_login cookie and db record (requires iMarc Database object in constructor)
	 * 
	 * @since 5.1.0
	 * 
	 * @param  string $login               User's login
	 * @param  string $encrypted_password  Encrypted password (passed through encryptPassword())
	 * @return boolean
	 */
	private function recordAutoLogin($login, $encrypted_password)
	{
		if ($this->auto_login && $this->auto_login_cookie && $this->session_name && $this->session_id) {										
			$expires = (int) (time() + $this->auto_login_lasts);					
			setcookie($this->auto_login_cookie, $this->session_id, (int) (time() + $this->auto_login_lasts), '/', $this->domain);
			
			// Insert Into Session Table
			$sql = "INSERT INTO session_auto_logins (login, password, last_session, last_login) 
					VALUES ('" . $login . "', '" . $encrypted_password . "', '" . $this->getSessionId() . "', CURRENT_TIMESTAMP)";
			if ($this->database->query($sql)) {
				return TRUE;
			} else {
				$error  = "<p><strong>Setup Error</strong> - Auto login is enabled, but the database table doesn't exist.</p>\n";
				$error .= "<p>Either set <em>\$auto_login</em> to false in the extending class configuration, or create the following table:</p>\n";
				$error .= "<pre>\n";
					if ($this->database->getDatabaseType() == 'pgsql') {
						$error .= "CREATE TABLE session_auto_logins (\n";
						$error .= "  session_auto_login_id  serial PRIMARY KEY,\n";
						$error .= "  login                  varchar(32),\n";
						$error .= "  password               text,\n";
						$error .= "  last_session           varchar(36),\n";
						$error .= "  last_login             timestamp NOT NULL\n";
						$error .= ");\n";
					} elseif ($this->getDatabaseType == 'mysql') {
						$error .= "CREATE TABLE session_auto_logins (\n";
						$error .= "  session_auto_login_id  integer AUTO_INCREMENT PRIMARY KEY,\n";
						$error .= "  login                  varchar(32),\n";
						$error .= "  password               text,\n";
						$error .= "  last_session           varchar(36),\n";
						$error .= "  last_login             datetime NOT NULL\n";
						$error .= ");\n";
					} else {
						$error .= "CREATE TABLE schema not available for the database type you selected \n";
					}
				$error .= "</pre>";	
				die($error);
			}
		} else { 
			// auto login not enabled - no problem...
			return TRUE;
		}
	}
	
	
	/**
	 * Stub to validate if user's login info is valid (to be expanded by extending class)
	 * 
	 * @since 5.0.0
	 * 
	 * @param  string $login                User's login
	 * @param  string $encrypted_password   Encrypted password (already passed through encryptPassword())
	 * @return boolean  If the login information is valid
	 */
	protected function loginUserHelper($login=NULL, $encrypted_password=NULL)
	{
		return FALSE;
	}
	
	
	/**
	 * Stub to make secure version of password
	 * 
	 * @since 6.0.0
	 * 
	 * @param  string $password  Plaintext password
	 * @return boolean  Encrypted password
	 */
	protected function encryptPassword($password='')
	{
		return $password;
	}
	
	
	/**
	 * Kills all session variables info associated with the user
	 * 
	 * @since 4.0.0
	 * 
	 * @param  void
	 * @return void
	 */
	public function killUser()
	{
		session_unset();
		session_destroy();
		setcookie($this->session_name, '', (time() - 31536000), '/', $this->domain);
		$this->killAutoLoginCookie();
	}
	
	
	/**
	 * Kills auto login cookie
	 * 
	 * @since 5.5.0
	 * 
	 * @param  void
	 * @return void
	 */
	public function killAutoLoginCookie()
	{
		setcookie($this->auto_login_cookie, '', (time() - 31536000), '/', $this->domain);
	}

	
	/**
	 * Automatically get the user's login/password from database (requires iMarc Database object in constructor)
	 * 
	 * @since 4.0.0
	 * 
	 * @param  void
	 * @return bool
	 * 
	 */
	private function autoLogin()
	{
		$cookie_value = (!empty($_COOKIE[$this->auto_login_cookie])) ? $_COOKIE[$this->auto_login_cookie] : FALSE;
		if ($this->auto_login && $cookie_value) {
			$sql = "SELECT login, password FROM session_auto_logins WHERE last_session = '" . $cookie_value . "'";
			if ($result = $this->database->query($sql)) {
				$row      = $this->database->getRow($result);
				$login    = $row['login'];
				$password = $row['password'];
				
				$this->auto_login_call = TRUE;
				$success = $this->loginUser($login, $password);
				$this->auto_login_call = FALSE;
				
				if ($success) { 
					return TRUE;
				} else {
					return FALSE;
				}
			}
		}
	}
}
?>
