<?
/**
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 */
class HelpInterface extends LoggedRecord 
{
	/**
	 * Copies all data from another interface and adds it to this one
	 * 
	 * @param  integer $interface_id
	 * @return void
	 */
	public function populateFromHelpInterface($help_interface_id) 
	{
		if (!$this->existing) {
			throw new Exception('Help Interface must be saved before populating.');
		}

		$this->Database->setDebug(TRUE);

		$help_interface = new HelpInterface($help_interface_id);
		try {
			$help_versions  = $help_interface->createHelpVersions();
			foreach($help_versions as $help_version_id => $help_version)  {
				$help_version->resetPrimaryKey();
				$help_version->setHelpInterfaceId($this->getPrimaryKey());
				$help_version->store();
				$help_version->populateFromHelpVersion($help_version_id);
			}
		} catch (Exception $e) {}
		try {
			$features  = $help_interface->createFeatures();
			foreach($features as $feature_id => $feature)  {
				$feature->resetPrimaryKey();
				$feature->setHelpInterfaceId($this->getPrimaryKey());
				$feature->store();
			}
		} catch (Exception $e) {}
	}
	
	/**
	 * Resets a primary key and makes an object not existing
	 *
	 * @param void
	 * @return void
	 */
	public function resetPrimaryKey() {
		$this->existing = FALSE;
		$this->primary_key_value = NULL;
	}
	
	/**
	 * Returns the edit page string
	 *
	 * @param void
	 * @return string
	 */
	public function getEditPage() {
		return "/admin/help_interfaces.php?help_interface_id={$this->getPrimaryKey()}&amp;page_function=edit";
	}
	
}
?>