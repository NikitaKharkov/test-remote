<?
// ----------------------------------------------------
// @author jeff turcotte [jt] <jeff@imarc.net>
// ----------------------------------------------------
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 

$help_version_id = request_value('help_version_id');

try {
	$help_version = new HelpVersion($help_version_id);
	$help_interface = $help_version->createHelpInterface();
	$help_interface_id = $help_interface->getPrimaryKey();
	$features = $help_interface->createFeatures();
	?>
	<select id="feature_id" name="feature_id">
		<?
		print_option($feature_id, ' ', 'None');
		foreach($features as $id => $feature) {
			print_option($feature_id, $id, $feature->getName() . ' - ' . $feature->getEbscoCode());
		}
		?>
	</select>
	<?
} catch (NoResultsException $e) {
	?>
	There are no features for this interface. <a href="/admin/help_interfaces.php?help_interface_id=<?= $help_interface_id ?>&amp;page_function=edit">Add features.</a>
	<?
}
?>