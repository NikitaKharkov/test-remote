<?php
/**
* 
* Default interface home page
* 
* This page requires a single database row from the interface table passed 
* as an array, $page
* 
*/

if ( !isset($page) || !is_array($page) ) {
	echo "Unable to display interface home page";
	return false;
}

$title   = (isset($page['interface']))       ? $page['interface'] : '';
$content = (isset($page['default_content'])) ? $page['default_content'] : '';
if (strip_tags($content) == $content) {
	$content = nl2br($content);
}

?>



<div id="help_content_holder">
<div id="help_content">
	
	<h1><?= $title ?></h1>
	<?= $content ?>

</div>
</div>