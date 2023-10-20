<?php
/**
* 
* Help navigation templte - called internally by robo_help class
* 
* This page requires the array returned by robo_help::get_navigation() 
* passed as $naviagation
* 
*/

// didn't find the var $navigation
if ( !isset($title) || !isset($pages) || !is_array($navigation ?? null) ) {
	echo "Unable to display";
	return false;
}

$title = ($navigation[$help_topic_id]['help_topic']) ? $navigation[$help_topic_id]['help_topic'] : '';
$pages = ($navigation[$help_topic_id]['pages'])      ? $navigation[$help_topic_id]['pages'] : array();

?>


<div id="help_content_holder">
<div id="help_content">
	
	<h1><?= $title ?></h1>
	<strong><em>Please select one of the options listed below:</em></strong>
	<ul>
		<?php foreach ($pages as $key=>$help) { ?>
		<li><a href="<?= $_SERVER['PHP_SELF'] ?>?help_id=<?= $help['help_id'] ?>"><?= $help['title'] ?></a></li>
	<? } ?>
	</ul>

</div>
</div>