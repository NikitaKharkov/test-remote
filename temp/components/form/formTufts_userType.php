	<form method="get" id="mainForm" action="<?=$_SERVER['PHP_SELF']?>">
	<?foreach(Array("date","title","type","email","custid") as $v) {?>
		<input type="hidden" name="<?=$v?>" value="<?=htmlspecialchars($_GET[$v])?>"/>
	<?}

		require('components/form/form_title.php');
	?>
	
		<h2>Please select your profession</h2>
		<fieldset id="userType">
			<div class="fieldSetLabel required">Select one of the following:</div>
			<div class="checks">
			<?
			foreach( getElements("//user[@type='Tufts']", $userTypes) as $xml )
				echo $xml;
			?>
			</div>
		</fieldset>
	
		<?
		$jsValidateFunction = "validateUser";
		require('components/form/form_submit.php');
		?>
	
	</form>
