
<div id="header"><a class="popUp" href="help.php">About CME/CE</a></div>
<h1><span>CME/CE Form Completed</span></h1>
<div id="inner">

<?php
/**
 * @var array $selectedLearningsStrings - see temp/submit.php and components/submit/prepareData.php;
 * Put senseless string just to prevent errors from IDE;
 */
$selectedLearningsStrings = $selectedLearningsStrings;
    require('insertInDatabase.php');
    require('createEmailMessage.php');
    require('sendEmail.php');
    require('logEntry.php');
?>


	<p>Your CME/CE request has been successfully submitted. 
	<?if( $data["email"]!='' ){?>
	Please contact your CME/CE administrator for more information at: 
	<strong><?=$data["email"]?></strong>
	<?}?>
	</p>

	<p>If you would like to view or print your CME/CE request, please
	<a href="javascript:void popup('printWindow.html','750','450');">Click Here</a>.</p>
	<div class="buttons">
		<a href="javascript:window.close();">
		<img src="images/buttonClose.gif" alt="Close"/>
		</a>
	</div>
	<div id="emailHTML" style="display:none;"><!--
		<?=$emailMessage?>
	-->
	</div>
</div>
