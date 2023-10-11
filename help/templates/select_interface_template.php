<?php

// $error = '';

try {
	$language_code  = request_value('lang');
	$interface_code = request_value('int');
			
	$languages       = $language_controller->listLanguages('name_asc');
	$help_interfaces = $help_controller->listHelpInterfaces('name_asc', NULL, 'live');
	?>

	<div id="help_content_holder">
		<div id="help_content">
			<?
			if ($language_code) {
				try {
					$chosen_languages = $language_controller->findLanguages('name_asc', $language_code);
					$chosen_language_id = $chosen_languages[0];
					$chosen_language = new Language($chosen_language_id);
				} catch (Exception $e) {}
			}			
			?>
	
			<h2>Language: <?= (isset($chosen_language)) ? $chosen_language->getName() : '<em>None Selected</em>' ?></h2>
			<em>Change Language</em><br />
	
			<?
			foreach($languages as $language_id => $language) {
				?>
				<a href="<?= $_SERVER['PHP_SELF'] ?>?lang=<?= $language->getEbscoCode() ?>&amp;int=<?= $interface_code ?>"><?= $language->getName() ?></a>
				<?
			}
			?>
			<br /><br />
		
			<h2>Select Interface</h2>
			<ul>
				<?
				foreach($help_interfaces as $help_interface_id => $help_interface) {
					?>
					<li><a href="/help/?int=<?= $help_interface->getEbscoCode() ?>&amp;lang=<?= $language_code ?>"><?= $help_interface->getName() ?></a></li>
					<?
				} 
				?>
			</ul>
		</div>
	</div>
	
	<?
} catch (Exception $e) {
	
}
?>

