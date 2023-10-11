<? // Help content template ?>

<div id="help_content_holder">
<div id="help_content">
	<h1><?= $title ?></h1>
	<?= $content ?>
	
<?php $referer = $_SERVER['HTTP_REFERER'];
   if (!$referer == '') {
      echo '<p><a href="' . $referer . '" title="Return to the previous page">&laquo; Back</a></p>';
   } else {
      echo '<p><a href="javascript:history.go(-1)" title="Return to the previous page">&laquo; Back</a></p>';
   }
?>
</div>
</div>