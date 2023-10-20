<div id="header">
<a class="popUp" href="help.php">About CME/CE</a></div>
<h1><span>CME/CE Form: <?=$_REQUEST["title"]?></span></h1>


	<form method="post" id="mainForm" action="submit.php">

		<?php
		/* Pass along required fields */
		require('form_hiddenFields.php');
		require('form_title.php');
		
		//form sections
		require('form_whatYouNeedToFind.php');
		require('form_whatYouFound.php');
		require('form_whatYouLearned.php');
		require('form_feedback.php');
		require('form_identifyingInformation.php');
		require('form_typeOfCreditNeeded.php');
		
		/* Set up section to display errors */
		require('form_submit.php');
		?>

	</form>