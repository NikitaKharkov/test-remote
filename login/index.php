<?php
/* --------------------------------------------------------------------- */
/* @author  Jeff Turcotte [jt] <jeff@imarc.net>
/* --------------------------------------------------------------------- */
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 

$action_map = array(
	'form'                  => 'Log In',
	'login'                 => 'Log In',
	'logout'                => 'Log Out',
	'no_access'             => 'No Access',
);
$valid_page_functions = array_keys($action_map);

$page_function = page_function($valid_page_functions);
$action        = $action_map[$page_function];

$template->setStyle('site');
$template->setData('title', 'Manage KB Pages');
$template->printHeader();


/* --------------------------------------------------------------------- */
/* Variable setup
/* --------------------------------------------------------------------- */

$login           = request_value('login');
$password        = request_value('password');

$destination     = request_value('destination');
$logged_out      = request_value('logged_out', 'boolean');

$message         = NULL;      
$error           = NULL;
$exception       = NULL;


/* --------------------------------------------------------------------- */
/* Content
/* --------------------------------------------------------------------- */
?>

<div class="inner_frame_content_border1">
		<div class="inner_frame_content_border2">
		<div class="inner_frame_content_border3">
		<div class="inner_frame_content_border4">
			<div class="bodycontent">
				<div style="clear:both;"></div>
				<h3>Log In</h3>

<?php
/* ---------------------------------- */
/* ---------------------------------- */ 
if ('no_access' == $page_function) {
	?>
	
	<div class="error">
		We're sorry, but this page is restricted to EBSCO customers only. 
		If you are an EBSCO customer, please see your EBSCOhost administrator for information on accessing this page.
	</div>
	
	<?php
}
?>	


<?php
/* ---------------------------------- */
/* ---------------------------------- */ 
if ('logout' == $page_function) {
	
	$session->killUser();
	redirect_site($_SERVER['PHP_SELF'] . '?logged_out=true');
	
}
?>	


<?php
/* ---------------------------------- */
/* ---------------------------------- */ 
if ('login' == $page_function) {

 	if (!$session->loginUser($login, $password) ) {
	
		$error  = 'We&rsquo;re sorry, but we couldn&rsquo;t find a user with that login information.<br />';
		$error .= 'Try again below.'; 
		$page_function = 'form';
		
	} else {
		
		redirect_site(($destination) ? urldecode($destination) : '/admin');
	}
	
}
?>	


<?php
/* ---------------------------------- */
/* ---------------------------------- */ 
if ('form' == $page_function) {
	
	if ($session->isLoggedIn()) { redirect_site('/admin'); } 

	if ($logged_out) {
		$message = 'You were successfully logged out';	
	}
	
	?>
	
	<? print_all_messages($message, $error); ?>
	
	<div>
		<form id="login" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
		<div>
			<table cellpadding="8" cellspacing="0">
				<tr valign="top">
					<th><label for="login">Login</label></th>
					<td><input type="text" name="login" /></td>
				</tr>
				<tr valign="top">
					<th><label for="password">Password</label></th>
					<td><input type="password" name="password" /></td>
				</tr>
				<tr valign="top">
					<td>&nbsp;</td>
					<td><input type="submit" value="Log In" name="send" class="normal_width" /></td>
				</tr>
			</table>
			<input type="hidden" name="page_function" value="login" />
			<input type="hidden" name="destination" value="<?= form_value($destination) ?>" />
		</div>
		</form>
	</div>
	<br /><br /><br /><br />


<?
}
?>

</div>
</div>
</div>
</div>
</div>

<?php
/* --------------------------------------------------------------------- */
/* Printing Footer
/* --------------------------------------------------------------------- */
$template->printFooter();
?>