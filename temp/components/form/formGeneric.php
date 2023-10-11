<div id="header">
<a class="popUp" href="help.php">About CME/CE</a></div>
<h1><span>CME/CE Form: <?=$_REQUEST["title"]?></span></h1>


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
		require('components/form/form_identifyingInformation.php');
		require('components/form/form_typeOfCreditNeeded.php');
		
		/* Set up section to display errors */
		require('components/form/form_submit.php');
		?>

	</form>