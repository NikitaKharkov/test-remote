		<fieldset id="hiddenFields" style="display:none">
		<?foreach(array_keys($_GET) as $key) {?>
		<input type="hidden" name="<?=$key?>" value="<?=htmlspecialchars($_GET[$key])?>"/>
		<?}?>
		</fieldset>
