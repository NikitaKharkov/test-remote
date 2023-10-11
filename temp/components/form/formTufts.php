<div id="header">
<a class="popUp" href="helpTufts.php">About CME/CE</a></div>
<h1><span>CME/CE Form: <?=$_REQUEST["title"]?></span></h1>

<?
/* 2009-03-12 msanchez:
 * A profession (a user type) is required to display applicable credits.
 * Display profession selection first and resubmit form to itself with chosen value
  */
  
  if( $_REQUEST["userType"]==NULL ){
  
	require('components/form/formTufts_userType.php');
	
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

		<?//customized fragment?>
		<h2>Identifying Information</h2>
		<fieldset id="indentifyingInfo">
			<p><label class="required" for="firstName">Your First Name:</label>
			<input type="text" id="firstName" name="firstName"/></p>
			<p>
			<label class="required" for="lastName">Your Last Name:</label>
			<input type="text" id="lastName" name="lastName"/></p>
		</fieldset>
		<fieldset id="mailingAddress">
			<p>
			<label class="required" for="address">Your Street Address:</label>
			<input type="text" id="address" name="address"/></p>
			<p>
			<label class="required" for="city">Your City:</label>
			<input type="text" id="city" name="city"/></p>
			<p>
			<label class="required" for="state">Your State:</label>
			<input type="text" id="state" name="state"/></p>
			<p>
			<label class="required" for="zip">Your Postal Code:</label>
			<input type="text" id="zip" name="zip"/>
			</p>
		</fieldset>
		<fieldset id="userEmail">
			<p><label class="required" for="yourEmail">Your E-mail:</label>
			<input type="text" id="yourEmail" name="yourEmail"/></p>
			<p class="fieldComment">(your e-mail will be used as a unique identifier)</p>
		</fieldset>
				<h3>An email will automatically be sent to your accredited CME/CE provider.</h3>
		<fieldset id="emailCC" class="checkText">
			<p>
			<label class="check" for="enableCC">
				<span class="emailCheck"><input type="checkbox" id="enableCC" name="enableCC"/></span>
				<span class="emailLabel">E-mail additional copy to:</span>
			</label>
			<input type="text" id="CC" name="CC"/>
			</p>
		</fieldset>
		

		<h2>Type of CME/CE Credit Needed</h2>
		<fieldset id="understandCheck" class="checkText">
		<p><label class="checks" for="understand" style="width:500px;">
		<span style="float:left;"><input type="checkbox" id="understand" name="understand"/></span>
		I have read and understand the requirements of <a class="popUp" href="helpTufts.php">CME/CE Accreditation</a>.
		</label></p>
		</fieldset>
		<?
			/*
			2009-03-12, msanchez: 
			Before, we sent TUFTS the credit string rather than a numeric code. 
			I am introducing a numeric code below in the value attribute to replace the string.
			String value is now pulled from the title attribute.
			
			Credits presented to users depend on the user type selected at the beginning
			This is the decision matrix is:

								A	A		c
							A	A	A		e
							M	F	N		r
							A	P	P		t
							
							1	2	3	4	5 	these are credit values (4 was removed)
						____________________________
			phys		1 	|	X	X				|
			nursepract	5	|			X	X		|
			nurse		4	|					X	|
			physasst	6	|					X	|
			pharm		2	|					X	|
			other		3	|					X	|
						____________________________
			these are userType values

			ADD ANY CHANGES TO THE CREDITS TO THE VALIDATION js
			*/
			
			$creditPreText = "
						<fieldset id=\"creditType\">
						<div class=\"fieldSetLabel required\">Select one of the following:</div>
						<div class=\"checks\">
			";
			$creditPostText = "</div>
					</fieldset>
			";
			
			switch( $_REQUEST["userType"] ){
				case "1":
					echo $creditPreText;
					echo getElement("//credit[@id='creditAMA']", $creditTypes);
					echo getElement("//credit[@id='creditAAFP']", $creditTypes);
					echo $creditPostText;
					break;
				case "5":
					echo $creditPreText;
					echo getElement("//credit[@id='creditAANP']", $creditTypes);
					echo $creditPostText;
					break;
				case "2":
				case "3":
				case "4":
				case "6":
					echo $creditPreText;
					echo getElement("//credit[@id='certificate']", $creditTypes);
					echo $creditPostText;
					break;
			}
		?>

		
		<?
		$jsValidateFunction = "validateTufts";
		require('components/form/form_submit.php');
		?>
		
	</form>

<?}?>