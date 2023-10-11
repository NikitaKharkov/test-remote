<?	include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 
$page_function = page_function(array( "show_form", "search" ), request_value('page_function'));
$page_function = "search";

$template->setHtmlTitle('Search Knowledge Base');
$template->setStyle('site');
$template->setColumn("left", "knowledge.php");


$keyword           = request_value('keyword');
$document_type     = urldecode(request_value('document_type'));
$language_id       = request_value('language_id');
$kb_topic_id       = request_value('topic');
$kb_interface_ids   = request_value('interface_id','array');
$ebsco_database_id = request_value('ebsco_database_id');
$page              = request_value('page', 'integer', 1);
$kb_status_filter  = array('public', 'private');
$error   = NULL;
$message = NULL;
?>

<a href="/novelist/"><div class="logo"></div></a>
  <div class="menu_area">
	<a href="/novelist/" class="preview">Welcome</a>
	<a href="/novelist/getting_started.php" class="getting_started">Getting Started</a>
	<a href="/novelist/training.php" class="training">Training</a>
	<a href="/novelist/novelist_faqs.php" class="faqs">FAQs</a>
	<a href="/novelist/promotion.php" class="promotion">Promotion</a>
	<a href="/novelist/contact.php" class="contact">Contact</a>
</div>