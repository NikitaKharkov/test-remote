
<div id="header"><a class="popUp" href="helpBaycare.php">About CME</a></div>
<h1><span>CME Form Completed</span></h1>
<div id="inner">

<?require('components/submit/insertInDatabase.php');?>

<?require('components/submit/createEmailMessageBaycare.php');?>

<?
//change generic email address to specific for user type
switch( $data["userType"] ){
	case 7: //SJH
		$data["email"] = 'Janet.Chance@baycare.org';
		break;
	case 8: //SAH
		$data["email"] = 'marylou.johnson@baycare.org';
		break;
	case 9: //MPM
		$data["email"] = 'Lee.Blomberg@baycare.org';
		break;
}

require('components/submit/sendEmail.php');
?>


<?require('components/submit/logEntry.php')?>


	<p>Your CME request has been successfully submitted. Please 
	contact your CME administrator for more information at: 
	<strong><?=$data["email"]?></strong></p>

	<p>If you would like to view or print your CME request, please <a href="javascript:void popup('printWindow.html','750','450');">Click Here</a>.</p>
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
