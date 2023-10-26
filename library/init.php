<?php
// support.epnet.com init file
 
ob_start();
error_reporting(E_ALL | E_STRICT);
date_default_timezone_set('America/New_York');

define('DATE_FORMAT', 'M j, Y');
define('DATETIME_FORMAT', 'M j, Y g:ia');

define('_PERSONAL_SEARCH_DICTIONARY', '/srv/www/support.epnet.com/knowledge_base/search_custom.pws'); // use the personal dictionary
define('_DEFAULT_HELP_LOGO', '/images/logo_support.gif');

require_once($_SERVER['DOCUMENT_ROOT'] . '/env.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/library/functions/base.functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/library/functions/local.functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/library/functions/debug.functions.php');

$objects = Objects::getInstance();
$objects->configureClass('Database', DATABASE_HOST, DATABASE_NAME, DATABASE_USER, DATABASE_PASS, 'mysql');
$objects->configureClass('Session', $objects->Database);
$objects->configureClass('Inflector');
$objects->configureClass('Validator');
$objects->configureClass('Cache', $_SERVER['DOCUMENT_ROOT'] . '/uploads/cache/cache_class_permanent_storage.txt', FALSE);
$objects->configureClass('FileUpload');

$objects->Inflector->addCustomRule('toc', 'tocs');
$objects->Inflector->addCustomRule('database', 'databases');

$inflector = $objects->Inflector;

$language_controller       = new LanguageController();
$news_item_controller      = new NewsItemController();
$ebsco_database_controller = new EbscoDatabaseController();
$help_controller           = new HelpController();
$kb_controller             = new KbController();
$database_help_controller  = new DatabaseHelpController();
$user_controller           = new UserController();
$change_controller         = new ChangeController();
$feature_controller        = new FeatureController();

$session = $objects->Session;

$template = new Template($_SERVER['DOCUMENT_ROOT'] . '/library/templates');
$template->setStyle('admin');

$logged_in_user = NULL;
if ($session->getLoggedInUserId()) {
	$logged_in_user = new User($session->getLoggedInUserId());
}
//$objects->Database->setDebug(TRUE);
?>
