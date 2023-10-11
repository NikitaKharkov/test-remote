
<div id="header"><a class="popUp" href="helpTufts.php">About CME/CE</a></div>
<h1><span>CME/CE Form Completed</span></h1>
<div id="inner">

<?
require('components/submit/insertInDatabase.php');
?>

<?require('components/submit/createEmailMessage.php');?>

<?
if( $data["CC"]!='' ) 
	$data["CC"] .= ", ";
$data["CC"] .= "med-oce@tufts.edu";

require('components/submit/sendEmail.php');
?>


<?require('components/submit/logEntry.php');?>


	<p>Your CME/CE request has been successfully submitted.
		You will receive shortly an e-mail at the address you entered 
		from <a href="mailto:dynamedsupport@epnet.com">dynamedsupport@epnet.com</a>
		with instructions for claiming your credit. For further assistance, please
		contact <a href="mailto:support@thci.org">
		support@thci.org</a>. Thank you.</p>

	<p>If you would like to view or print your CME/CE request, please
	<a href="javascript:void popup('printWindow.html','750','450')">Click Here</a>.</p>
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
