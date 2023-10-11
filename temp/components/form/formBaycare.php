<div id="header">
<a class="popUp" href="helpBaycare.php">About CME</a></div>
<h1><span>CME Form: <?=$_REQUEST["title"]?></span></h1>

<?
  if( $_REQUEST["userType"]==NULL ){
  
	require('components/form/formBaycare_userType.php');
	
  } else {
?>

	<form method="post" id="mainForm" action="submit.php">

		<?
		/* Pass along required fields */
		require('components/form/form_hiddenFields.php');
		
		require('components/form/form_title.php');
		
		//form sections
		require('components/form/form_whatYouNeedToFind.php');
		require('components/form/form_whatYouFound.php');
		require('components/form/form_whatYouLearned.php');
		require('components/form/form_feedback.php');
		?>
		
		<h2>Identifying Information</h2>
<fieldset id="indentifyingInfo">
	<p><label class="required" for="firstName">Your First Name:</label>
	<input type="text" id="firstName" name="firstName"/></p>
	<p>
	<label class="required" for="lastName">Your Last Name:</label>
	<input type="text" id="lastName" name="lastName"/></p>
</fieldset>

<fieldset id="userEmail">
	<p><label class="required" for="yourEmail">Your E-mail:</label>
	<input type="text" id="yourEmail" name="yourEmail"/></p>
</fieldset>

<fieldset id="userPhoneNumber">
	<p><label class="required" for="yourPhoneNumber">Your Phone Number:</label>
	(<input class="phoneField" type="text" id="yourPhone_areaCode" name="yourPhone_areaCode" maxlength="3" style="width: 30px;"/>)
	<input class="phoneField" type="text" id="yourPhone_group1" name="yourPhone_group1" maxlength="3" style="width: 30px;"/> 
	<input class="phoneField" type="text" id="yourPhone_group2" name="yourPhone_group2" maxlength="4" style="width: 40px;"/>
	</p>
</fieldset>

		<h3>An email will automatically be sent to your CME Coordinator.</h3>
<fieldset id="emailCC" class="checkText">
	<p>
	<label class="check" for="enableCC">
		<span class="emailCheck"><input type="checkbox" id="enableCC" name="enableCC"/></span>
		<span class="emailLabel">E-mail additional copy to:</span>
	</label>
	<input type="text" id="CC" name="CC"/>
	</p>
</fieldset>


		<h2>Type of CME Credit Needed</h2>
<fieldset id="creditType">
	<div class="fieldSetLabel required">Select one of the following:</div>
	<div class="checks">
	<?=getElement("//credit[@id='creditAMA']", $creditTypes)?>
	</div>
</fieldset>
		
		<?
		$jsValidateFunction = "validateBaycare";
		require('components/form/form_submit.php');
		?>
		
	</form>

<?}?>