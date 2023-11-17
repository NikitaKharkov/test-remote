<?
// ----------------------------------------------------
// @author jeff turcotte [jt] <jeff@imarc.net>
// ----------------------------------------------------
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 

$help_version_id = request_value('help_version_id');
$language_id     = request_value('language_id');

$help_controller->printHelpTopicsSelect($help_version_id, $language_id, null);
?>