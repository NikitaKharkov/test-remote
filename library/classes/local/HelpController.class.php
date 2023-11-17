<?
/**
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 */
class HelpController extends Controller
{
	
	/**
	 * finds HelpTopic IDs
	 * 
	 * @param string order_by
	 * @return array
	 */
	public function findHelpTopics($order_by='list_order_asc', $help_version_id=NULL, $language_id=NULL)
	{
		$order_by = parse_order_by($order_by);
		
		$sql = "SELECT help_topic_id FROM help_topics WHERE 1 = 1 ";
		
		$sql .= ($help_version_id) ? " AND help_version_id = '{$help_version_id}' " : "";
		$sql .= ($language_id) ? " AND language_id = '{$language_id}' " : "";
		
		$sql .= ($order_by) ? " ORDER BY " . $order_by . " " : "";
		
		return $this->performSql($sql);
	}
	
	/**
	 * finds HelpPage IDs
	 * 
	 * @param string order_by
	 * @return array
	 */
	public function findHelpPages($order_by='list_order_asc', $help_version_id=NULL, $feature_id=NULL, $language_id=NULL, $status=NULL, $help_topic_id=NULL)
	{
		$order_by = parse_order_by($order_by);
		
		$sql = "SELECT hp.help_page_id 
				FROM help_pages AS hp LEFT JOIN
					 help_topics AS ht ON hp.help_topic_id = ht.help_topic_id LEFT JOIN 
					 help_versions AS hv ON hv.help_version_id = ht.help_version_id WHERE 1 = 1 ";
		
		$sql .= ($help_version_id) ? " AND hv.help_version_id = '{$help_version_id}' " : "";
		$sql .= ($help_topic_id)   ? " AND ht.help_topic_id = '{$help_topic_id}' " : "";
		$sql .= ($language_id)     ? " AND ht.language_id = '{$language_id}' " : "";
		$sql .= ($feature_id)      ? " AND hp.feature_id = '{$feature_id}' " : '';
		$sql .= ($status) ? " AND hp.status = '{$status}' " : '';

		
		$sql .= ($order_by) ? " ORDER BY " . $order_by . " " : "";
	
		return $this->performSql($sql);
	}
	
	
	/**
	 * finds HelpTopic IDs
	 * 
 	 * @param string  order_by
	 * @param integer interface_id  Limit results to a single interface_id
	 * @param string  ebsco_code    Limit results to a single ebsco_code
	 * @param integer limit         Number of results returned (NULL won't limit results, it will return all)
	 * @param string  ignore_ebsco_code don't return the particular version
	 * @return array
	 */
	public function findHelpVersions($order_by=NULL, $interface_id=NULL, $ebsco_code=NULL, $limit=NULL, $ignore_ebsco_code=NULL)
	{
		if (empty($order_by)) {
			$order_by = 'name_asc';
		}
		$order_by = parse_order_by($order_by);
		
		$sql = "SELECT help_version_id 
		            FROM help_versions 
		            WHERE 1 = 1";
		
		$sql .= ($interface_id) ? " AND help_interface_id = '{$interface_id}' " : '';
		
		$sql .= ($ebsco_code) ? " AND ebsco_code = '{$ebsco_code}' " : '';
		
		$sql .= ($ignore_ebsco_code) ? " AND ebsco_code != '{$ignore_ebsco_code}' " : '';
				
		$sql .= ($order_by) ? " ORDER BY help_interface_id ASC, " . $order_by . " " : " ";
		
		$sql .= ($limit) ? " LIMIT {$limit} " : " ";

		return $this->performSql($sql);
	}
		
	/**
	 * finds HelpInterface IDs
	 * 
	 * @param string order_by
	 * @return array
	 */
	public function findHelpInterfaces($order_by=NULL, $ebsco_code=NULL, $status=NULL)
	{
		$order_by = parse_order_by($order_by);

 		$limit_for_user_id = NULL;
		if (Session::getLoggedInUserId()) {
			$user = new User(Session::getLoggedInUserId());
			if ($user->getAuthorizationLevel() != 'system_admin' && $user->getPermissionAllHelpInterfaces() != TRUE) {
				$limit_for_user_id = $user->getPrimaryKey();
			}
		}
			
		$sql = "SELECT help_interface_id FROM help_interfaces WHERE 1 = 1 ";
		
		$sql .= ($status) ? " AND status = '{$status}' " : '';
		$sql .= ($ebsco_code) ? " AND ebsco_code = '{$ebsco_code}'" : '';																												
		$sql .= ($limit_for_user_id) ? " AND help_interface_id IN (SELECT help_interface_id FROM users_help_interfaces WHERE user_id = '{$limit_for_user_id}') " : "";
		
		$sql .= ($order_by) ? " ORDER BY " . $order_by . " " : " ";
		
		return $this->performSql($sql);
	}
	
	/**
	 * finds HelpInterface from ebsco_code
	 * 
	 * @param string ebsco_code
	 * @return object HelpInterface
	 */
	public function findHelpInterfaceFromCode($code=NULL) 
	{
		if ($code) {
			$ids = $this->findHelpInterfaces(NULL, $code, 'live');			
			$interface = new HelpInterface($ids[0]);
			setcookie('cookie_interface_id', $interface->getPrimaryKey());
			return $interface;
		} else if (isset($_COOKIE['cookie_interface_id'])) {
			return new HelpInterface($_COOKIE['cookie_interface_id']);
		}
		throw new Exception();
	}
	
	
	/**
	 * finds Language from ebsco_code
	 * 
	 * @param string language_id
	 * @return object Language
	 */
	public function findLanguageFromCode($code=NULL) 
	{
		if ($code) {
			$language_controller = new LanguageController();
			$language_ids = $language_controller->findLanguages(NULL, $code);
			$language = new Language($language_ids[0]);
			setcookie('cookie_language_id', $language->getPrimaryKey());
			return $language;
		} else if (isset($_COOKIE['cookie_language_id'])) {
			return new Language($_COOKIE['cookie_language_id']);
		}
		throw new Exception();
	}

	
	/**
	 * finds HelpVersion from ebsco_code
	 * 
	 * @param string ebsco_code
	 * @return object HelpVersion
	 */
	public function findHelpVersionFromCode($help_interface_id, $ebsco_code = NULL)
	{
		if (empty($ebsco_code)) {
			$ebsco_code = 'live';
		}
		$ids = $this->findHelpVersions('name_asc', $help_interface_id, $ebsco_code);
		return new HelpVersion($ids[0]);
	}
	
	
	/** 
	 * parses REQUEST for ebsco toc ids
	 *
	 * @return array 
	 */
	public function parseDisabledTocIds()
	{
		$disabled_toc_ids = array();
		try {
			$toc_codes = array();
			$toc_controller = new TocController();
			$tocs = $toc_controller->listTocs('name_asc');
			foreach($tocs as $toc_id => $toc) {
				$toc_codes[$toc->getEbscoCode()] = $toc_id;
			}
			foreach($_REQUEST as $key => $value) {
				if (isset($toc_codes[$key]) && $value == '0') {
					$disabled_toc_ids[] = $toc_codes[$key];
				}
			}
		} catch (Exception $e) {}
		
		// setcookie('cookie_disabled_tocs', join(':', $disabled_toc_ids));

		return $disabled_toc_ids;
	}
	

	
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
	
	/**
	 * finds Feature Ids
	 * 
	 * @param string order_by
	 * @return array
	 */
	public function findFeatures($order_by=NULL)
	{
		$order_by = parse_order_by($order_by);
		
		$sql = "SELECT feature_id FROM features";
		
		$sql .= ($order_by) ? " ORDER BY " . $order_by . " " : " ";
		
		return $this->performSql($sql);
	}
	
	
	/**
	 * finds Feature Ids
	 * 
	 * @param string order_by
	 * @return array
	 */
	public function findDistinctFeatures()
	{
		$sql = "SELECT DISTINCT(name), ebsco_code FROM features ORDER BY name ASC";

		$output = array();
		
		$result = $this->Database->query($sql);
		if ($this->Database->numRows($result)) {
			while ($row = $this->Database->getRow($result)) {
				$output[] = array(
					'name' => $row['name'],
					'ebsco_code' => $row['ebsco_code']
				);
			}
		}
		
		return $output;
	}
		
	
	/**
	 * Prints a select of HelpInterface/HelpVersion/HelpLanguage
	 * 
	 * @param void
	 * @return void
	 */
	public function printInterfaceVersionLanguageSelect($hl_id=NULL, $name="help_language_id")
	{
		$help_interfaces = $this->listHelpInterfaces('name_asc');
		
		echo "<select name=\"{$name}\">";
		print_option($hl_id, '', 'None');

		foreach($help_interfaces as $help_interface_id => $help_interface) {
			try {
				$help_versions = $help_interface->createHelpVersions();
				foreach($help_versions as $help_version_id => $help_version) {
					try {
						$help_languages = $help_version->createHelpLanguages();
						foreach($help_languages as $help_language_id => $help_language) {
							try {
								$language = $help_language->createLanguage();
								$selected = ($hl_id == $help_language_id) ? ' selected="selected" ' : '';
								echo "<option value=\"{$help_language_id}\"{$selected}>" . $help_interface->getName() . " - " . $help_version->getName() . " - " . $language->getName() . "</option>";
							} catch (Exception $e) {}
						}
					} catch (Exception $e) {}
				}
			} catch (Exception $e) {}
			
		}
		
		echo "</select>";
			
	}
	
	/**
	 * Prints a select of HelpInterface/HelpVersion
	 * 
	 * @param void
	 * @return void
	 */
	public function printInterfaceVersionSelect($hv_id=NULL, $name="help_version_id", $onchange=NULL)
	{
		$help_interfaces = $this->listHelpInterfaces('name_asc');
		
		$onchange = ($onchange) ? " onchange=\"{$onchange}\" " : ""; 
		
		echo "<select name=\"{$name}\"{$onchange} id=\"{$name}\">";

		foreach($help_interfaces as $help_interface_id => $help_interface) {
			try {
				$help_versions = $help_interface->createHelpVersions();
				foreach($help_versions as $help_version_id => $help_version) {
					$selected = ($hv_id == $help_version_id) ? ' selected="selected" ' : '';
					echo "<option value=\"{$help_version_id}\"{$selected}>" . $help_interface->getName() . " - " . $help_version->getName() . "</option>";
				}
			} catch (Exception $e) {}
		}
		
		echo "</select>";
			
	}
	
	
	/**
	 * Prints a select of HelpInterface/HelpVersion
	 * 
	 * @param void
	 * @return void
	 */
	public function printHelpTopicsSelect($help_version_id, $language_id, $ht_id=NULL)
	{
		$name = 'help_topic_id';
			
		try {
			$help_topic_ids = $this->findHelpTopics('list_order_asc', $help_version_id, $language_id);
			$help_topics = $this->createHelpTopics($help_topic_ids);
		
			echo "<select id=\"{$name}\" name=\"{$name}\">";

			foreach($help_topics as $help_topic_id => $help_topic) {
				$selected = ($ht_id == $help_topic_id) ? ' selected="selected" ' : '';
				echo "<option value=\"{$help_topic_id}\"{$selected}>" . $help_topic->getName() . "</option>";
			}
		
			echo "</select>";
		} catch (Exception $e) {
			echo '<span class="no_topics_error">There are no topics for this Interface Version and Language.</span>&nbsp;';
			echo '<a href="/admin/help_topics.php?help_version_id=' . $help_version_id . '&amp;language_id=' . $language_id . '&amp;page_function=add">Add One Now</a>';
		}
			
	}
	
	
}

?>