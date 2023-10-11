<?
/* --------------------------------------------------------------------- */
/* @author  Dave Tufts [dt] <dave@imarc.net>
/* --------------------------------------------------------------------- */
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 

$template->setStyle('site');
$template->setColumn("left", "contact.php");
$template->setHtmlTitle('Support Materials');

$template->printHeader();
	
# ----------------------------------- #
#	BODY
# ----------------------------------- #
?>

<h1>Request Printed Materials</h1>
<br />

<?
// PAGE FUNCTION
$page_function = (isset($_REQUEST['page_function'])) ? $_REQUEST['page_function'] : '';	
$valid_page_functions = array("show_form", "send", "confirm");
if(!in_array($page_function, $valid_page_functions)){
	$page_function = $valid_page_functions[0];
}

$error	   = "";
$message   = "";
?>



<?
/**
*
* confirm
* 
*/
if ($page_function == "confirm") {
?>
<div class="message">Your request has been sent successfully.</div>
<?
}



/**
*
* send
* 
*/
if ($page_function == "send") {
		
	//  Validate the form submission.
	$validator = new Validator();
	$validator->validateFields("DynPosQTY||SRCPosQTY||NxtRdsPosQTY||CCCPosQTY||CCLPosQTY||K8PosQTY||EHBMPosQTY||NRBPosQTY||NovBkmrkQTY||BSCBkmrkQTY||NovPosQTY||NovPlusPosQTY||NovButQTY||ASBkmrkQTY||NRButQTY||EhostPosQTY||EhostMagQTY||EhostSticQTY||EhostStic2QTY, name, institution_name, phone, street_address, email, city, state, zip, country");
	
	if (!$validator->getError()){
		$validator->validateEmail($_REQUEST['email']);
	}
	
	if ($validator->getError()){
		$error = str_replace("DynPosQTY <strong>or</strong> SRCPosQTY <strong>or</strong>  NxtRdsPosQTY <strong>or</strong> CCCPosQTY <strong>or</strong> CCLPosQTY <strong>or</strong> K8PosQTY <strong>or</strong> EHBMPosQTY <strong>or</strong> NRBPosQTY <strong>or</strong> NovBkmrkQTY <strong>or</strong> BSCBkmrkQTY <strong>or</strong> ASBkmrkQTY <strong>or</strong> NovButQTY <strong>or</strong> NRButQTY <strong>or</strong> NovPosQTY <strong>or</strong> NovPlusPosQTY <strong>or</strong> EhostPosQTY <strong>or</strong> EhostMagQTY <strong>or</strong> EhostSticQTY <strong>or</strong> EhostStic2QTY", "Quantity Requested", $validator->getError());
		$page_function = "show_form";
		
	} else {
		//  Set the contact e-mail address.
		//$to = "mtylec@ebscohost.com";	//	Live e-mail account.jtozier@ebscohost.com
		$to = "jtozier@ebscohost.com";	//	Live e-mail account.
		
		//  Compile the body of the e-mail.
		$m = "";
		$m .="Support Website: (Request Printed Materials)\n";
		$m .="-----------------------------------------------------------\n";
		$m .="The following user has requested printed materials:\n";
		$m .="Name: " . stripslashes($_REQUEST['name']) . "\n";
		$m .="Institution: " . stripslashes($_REQUEST['institution_name']) . "\n";
		$m .="Address: " . stripslashes($_REQUEST['street_address']) . "\n";
		if($_REQUEST['city']){
			$m .="City: " . stripslashes($_REQUEST['city']) . "\n";
		}
		if($_REQUEST['state']){
			$m .="State: " . stripslashes($_REQUEST['state']) . "\n";
		}
		if($_REQUEST['zip']){
			$m .="ZIP: " . stripslashes($_REQUEST['zip']) . "\n";
		}
		$m .="Country: " . stripslashes($_REQUEST['country']) . "\n";
		if($_REQUEST['phone']){
			$m .="Phone: " . stripslashes($_REQUEST['phone']) . "\n";
		}
		$m .="E-Mail: " . stripslashes($_REQUEST['email']) . "\n";
		$m .="-----------------------------------------------------------\n";
		$m .="Materials Requested:\n\n";
		if($_REQUEST['DynPosQTY']){
			$m .="Dynamed Posters - " . stripslashes($_REQUEST['DynPosQTY']) . "\n";
		}
		if($_REQUEST['SRCPosQTY']){
			$m .="Student Research Center Posters - " . stripslashes($_REQUEST['SRCPosQTY']) . "\n";
		}
		if($_REQUEST['NxtRdsPosQTY']){
			$m .="NextReads Posters - " . stripslashes($_REQUEST['NxtRdsPosQTY']) . "\n";
		}
		if($_REQUEST['CCCPosQTY']){
			$m .="COIN Career Community Posters - " . stripslashes($_REQUEST['CCCPosQTY']) . "\n";
		}
		if($_REQUEST['CCLPosQTY']){
			$m .="COIN Career Library Posters - " . stripslashes($_REQUEST['CCLPosQTY']) . "\n";
		}
		if($_REQUEST['K8PosQTY']){
			$m .="K-8 Posters - " . stripslashes($_REQUEST['K8PosQTY']) . "\n";
		}
		if($_REQUEST['NovPosQTY']){
			$m .="NoveList Posters - " . stripslashes($_REQUEST['NovPosQTY']) . "\n";
		}
		if($_REQUEST['NovPlusPosQTY']){
			$m .="NoveList Plus Posters - " . stripslashes($_REQUEST['NovPlusPosQTY']) . "\n";
		}
		if($_REQUEST['NRBPosQTY']){
			$m .="NextReads Patron Bookmarks - " . stripslashes($_REQUEST['NRBPosQTY']) . "\n";
		}
		if($_REQUEST['NovBkmrkQTY']){
			$m .="NoveList Bookmark - " . stripslashes($_REQUEST['NovBkmrkQTY']) . "\n";
		}
		if($_REQUEST['EhostMagQTY']){
			$m .="EBSCOhost Magnets - " . stripslashes($_REQUEST['EhostMagQTY']) . "\n";
		}
		if($_REQUEST['EhostSticQTY']){
			$m .="EBSCOhost Stickers - " . stripslashes($_REQUEST['EhostSticQTY']) . "\n";
		}
		if($_REQUEST['EhostPosQTY']){
			$m .="EBSCOhost Posters - " . stripslashes($_REQUEST['EhostPosQTY']) . "\n";
		}
		if($_REQUEST['EHBMPosQTY']){
			$m .="EBSCOhost Bookmarks - " . stripslashes($_REQUEST['EHBMPosQTY']) . "\n";
		}
		if($_REQUEST['NovButQTY']){
			$m .="NoveList Buttons - " . stripslashes($_REQUEST['NovButQTY']) . "\n";
		}
		if($_REQUEST['BSCBkmrkQTY']){
			$m .="Business Source Complete Bookmarks - " . stripslashes($_REQUEST['BSCBkmrkQTY']) . "\n";
		}
		if($_REQUEST['ASBkmrkQTY']){
			$m .="Academic Search Bookmarks - " . stripslashes($_REQUEST['ASBkmrkQTY']) . "\n";
		}
		if($_REQUEST['NRButQTY']){
			$m .="NextReads Buttons - " . stripslashes($_REQUEST['NRButQTY']) . "\n";
		}
		if($_REQUEST['EhostStic2QTY']){
			$m .="'Available Online' Stickers - " . stripslashes($_REQUEST['EhostStic2QTY']) . "\n";
		}
								
		// Mail headers
		$date = date("m/d/Y");
		$mailsubject = "Support Website Request: $date"; 
		$mailheaders = "From: " . $_REQUEST['email'] . "\n";
		$mailheaders .= "Reply-To: " . $_REQUEST['email'] . "\n";
		$mailheaders .= "X-Mailer: PHP Mail Function on Apache\n";

		// Send the email to the administrators
		if (mail($to, $mailsubject, $m, $mailheaders)) {
			ob_end_clean();
			header("Location: " .  server_address() . $_SERVER['PHP_SELF'] . "?page_function=confirm");
			exit;
		} else {
			$error = "We're sorry, but there's been an error while sending your contact request.";
			$page_function = "show_form";
		}
	}
}


/**
*
* show_form
* 
*/
if ($page_function == "show_form") {
	// errors, messages
	if ($error)	   echo "<div class=\"error\">" . $error . "</div>";
	if ($message)  echo "<div class=\"message\">". $message . "</div>";
	
	if(!$message && !$error){
?>
Order free print materials below, or visit the <a href="/promotion/promo.php">Promote Your Online Resources</a>
page to download customizable marketing tools including posters, flyers, bookmarks, and more. Please note quantities may be limited.
<br /><br />
<?
	}
?>

<div>
<form id="additional_materials" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
<table cellpadding="0" cellspacing="0" class="form_table" border="0">
	<tr>
		<th colspan="4"><h2>Request Printed Materials</h2></th>
	</tr>
	<tr>
		<td colspan="4">
			<table cellpadding="1" cellspacing="1" class="option_table" border="0">
				<tr>
					<td><strong>Posters</strong><br />(Click on images for a larger view)</td>
					<td>&nbsp;</td>
				</tr>
				
				<tr>
					<td>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td>EBSCO<i>host</i></td>
								<td align="right"><a href="javascript:popUpThumb('/images/posters/Ehost_Poster_lg.jpg')"><img src="/images/posters/Ehost_Poster_thumb.jpg" /></a></td>
							</tr>
						</table>
					</td>
					<td>
						<input type="text" maxlength="3" name="EhostPosQTY" value="<?= stripslashes($EhostPosQTY); ?>" tabindex="2" />
					</td> 
				</tr>
				<tr>
					<td>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td>DynaMed</td>
								<td align="right"><a href="javascript:popUpThumb('/images/posters/DynaMed_Poster_lg.jpg')"><img src="/images/posters/DynaMed_Poster_thumb.jpg" /></a></td>
							</tr>
						</table>
					</td>
					<td>
						<input type="text" maxlength="3" name="DynPosQTY" value="<?= stripslashes($DynPosQTY); ?>" tabindex="2" />
					</td> 
				</tr>
				
				<tr>
					<td>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td>Student Research Center</td>
								<td align="right"><a href="javascript:popUpThumb('/images/posters/SRC_Poster_lg.jpg')"><img src="/images/posters/SRC_Poster_thumb.jpg" /></a></td>
							</tr>
						</table>
					<td>
						<input type="text" maxlength="3" name="SRCPosQTY" value="<?= stripslashes($SRCPosQTY); ?>" tabindex="3" />
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td>NextReads</td>
								<td align="right"><a href="javascript:popUpThumb('/images/posters/NextReads_Poster.gif')"><img src="/images/posters/NextReads_Poster_thumb.gif" /></a></td>
							</tr>
						</table>
					</td>
					<td>
						<input type="text" maxlength="3" name="NxtRdsPosQTY" value="<?= stripslashes($NxtRdsPosQTY); ?>" tabindex="6" />
						
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td>Coin Career Community</td>
								<td align="right"><a href="javascript:popUpThumb('/images/posters/CCC_Poster_lg.jpg')"><img src="/images/posters/CCC_Poster_thumb.jpg" /></a></td>
							</tr>
						</table>
					</td>
					<td>
						<input type="text" maxlength="3" name="CCCPosQTY" value="<?= stripslashes($CCCPosQTY); ?>" tabindex="7" />
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td>Coin Career Library</td>
								<td align="right"><a href="javascript:popUpThumb('/images/posters/CCL_Poster_lg.jpg')"><img src="/images/posters/CCL_Poster_thumb.jpg" /></a></td>
							</tr>
						</table>
					</td>
					<td>
						<input type="text" maxlength="3" name="CCLPosQTY" value="<?= stripslashes($CCLPosQTY); ?>" tabindex="8" />
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td>K-8 Resources</td>
								<td align="right"><a href="javascript:popUpThumb('/images/posters/K-8_Poster_lg.jpg')"><img src="/images/posters/K-8_Poster_thumb.jpg" /></a></td>
							</tr>
						</table>
					</td>
					<td>
						<input type="text" maxlength="3" name="K8PosQTY" value="<?= stripslashes($K8PosQTY); ?>" tabindex="9" />
					</td> 
				</tr>
				<tr>
					<td>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td>NoveList</td>
								<td align="right"><a href="javascript:popUpThumb('/images/posters/Nov_Poster_lg.jpg')"><img src="/images/posters/Nov_Poster_thumb.jpg" /></a></td>
							</tr>
						</table>
					</td>
					<td>
						<input type="text" maxlength="3" name="NovPosQTY" value="<?= stripslashes($NovPosQTY); ?>" tabindex="10" />
					</td> 
				</tr>
				<tr>
					<td>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td>NoveList Plus</td>
								<td align="right"><a href="javascript:popUpThumb('/images/posters/NovPlus_Poster_lg.jpg')"><img src="/images/posters/NovPlus_Poster_thumb.jpg" /></a></td>
							</tr>
						</table>
					</td>
					<td>
						<input type="text" maxlength="3" name="NovPlusPosQTY" value="<?= stripslashes($NovPlusPosQTY); ?>" tabindex="11" />
					</td> 
				</tr>
				<tr>
					<td><strong>Bookmarks</strong><br />(Click on images for a larger view)</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td>Academic Search Bookmark</td>
								<td align="right"><a href="javascript:popUpThumb('/images/bookmarks/ASearch_Bookmark.jpg')"><img src="/images/bookmarks/BSC_bookmark_thumb.jpg" /></a></td>
							</tr>
						</table>
					</td>
					<td>
						<input type="text" maxlength="3" name="ASBkmrkQTY" value="<?= stripslashes($ASBkmrkQTY); ?>" tabindex="13" /><br />
						Maximum Order - 50<br />
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td>Business Source Complete Bookmark</td>
								<td align="right"><a href="javascript:popUpThumb('/images/bookmarks/BSC_bookmark.jpg')"><img src="/images/bookmarks/BSC_bookmark_thumb.jpg" /></a></td>
							</tr>
						</table>
					</td>
					<td>
						<input type="text" maxlength="3" name="BSCBkmrkQTY" value="<?= stripslashes($BSCBkmrkQTY); ?>" tabindex="14" /><br />
						Maximum Order - 50<br />
					</td>
				</tr>
				<!--<tr>
					<td>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td>EBSCO<i>host</i> Bookmark</td>
								<td align="right"><a href="javascript:popUpThumb('/images/bookmarks/Ehost_Bookmark.jpg')"><img src="/images/bookmarks/Ehost_Bookmark_thumb.jpg" /></a></td>
							</tr>
						</table>
					</td>
					<td>
						<input type="text" maxlength="3" name="EHBMPosQTY" value="<?= stripslashes($EHBMPosQTY); ?>" tabindex="12" /><br />
						Maximum Order - 50<br />
					</td>
				</tr>-->
				<tr>
					<td>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td>NextReads Patron Bookmark<br /><span class="small">(To request additional bookmarks, please<br />contact NextReads@ebscohost.com.)</span></td>
								<td align="right"><a href="javascript:popUpThumb('/images/bookmarks/NR_BKMKAUG07.jpg')"><img src="/images/bookmarks/NR_BKMKAUG07_thumb.jpg" /></a></td>
							</tr>
						</table>
					</td>
					<td>
						<input type="text" maxlength="3" name="NRBPosQTY" value="<?= stripslashes($NRBPosQTY); ?>" tabindex="13" /><br />
						Maximum Order - 500<br />
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td>NoveList Bookmark</td>
								<td align="right"><a href="javascript:popUpThumb('/images/bookmarks/NoveList_bookmark.jpg')"><img src="/images/bookmarks/sm_NoveList_bookmark.jpg" /></a></td>
							</tr>
						</table>
					</td>
					<td>
						<input type="text" maxlength="3" name="NovBkmrkQTY" value="<?= stripslashes($NovBkmrkQTY); ?>" tabindex="14" /><br />
						Maximum Order - 100<br />
					</td>
				</tr>
				<tr>
					<td><strong>Buttons</strong><br />(Click on images for a larger view)</td>
					<td>&nbsp;</td>
				</tr>
				<!--<tr>
					<td>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td>NoveList Button</td>
								<td align="right"><a href="javascript:popUpThumb('/images/buttons/NoveListButton.jpg')"><img src="/images/buttons/NoveListButton_thumb.jpg" /></a></td>
							</tr>
						</table>
					</td>
					<td>
						<input type="text" maxlength="3" name="NovButQTY" value="<?= stripslashes($NovButQTY); ?>" tabindex="12" /><br />
						Maximum Order - 20<br />
					</td>
				</tr>-->
				<tr>
					<td>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td>NextReads Button</td>
								<td align="right"><a href="javascript:popUpThumb('/images/buttons/NR_Button.jpg')"><img src="/images/buttons/NR_Button_thumb.jpg" /></a></td>
							</tr>
						</table>
					</td>
					<td>
						<input type="text" maxlength="3" name="NRButQTY" value="<?= stripslashes($NRButQTY); ?>" tabindex="12" /><br />
						Maximum Order - 25<br />
					</td>
				</tr>
				<!--<tr>
					<td><strong>Flyers</strong><br />(Click on images for a larger view)</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td>NextReads Patron Flyer</td>
								<td align="right"><a href="javascript:popUpThumb('/images/flyers/NR_PatronFlyer.jpg')"><img src="/images/flyers/NR_PatronFlyer_thumb.jpg" /></a></td>
							</tr>
						</table>
					</td>
					<td>
						<input type="text" maxlength="3" name="NRFPosQTY" value="<?= stripslashes($NRFPosQTY); ?>" tabindex="15" /><br />
						Maximum Order - 250<br />
					</td>
				</tr>-->
				<tr>
					<td><strong>Magnets</strong><br />(Click on images for a larger view)</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td>EBSCO<i>host</i> Magnet</td>
								<td align="right"><a href="javascript:popUpThumb('/images/magnets/ehost_magnet.gif')"><img src="/images/magnets/ehost_magnet_thumb.gif" /></a></td>
							</tr>
						</table>
					</td>
					<td>
						<input type="text" maxlength="3" name="EhostMagQTY" value="<?= stripslashes($EhostMagQTY); ?>" tabindex="16" /><br />
						Maximum Order - 50<br />
					</td>
				</tr>
				<tr>
					<td><strong>Stickers</strong><br />(Click on images for a larger view)</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td>EBSCO<i>host</i> Sticker (3 in. diam.)</td>
								<td align="right"><a href="javascript:popUpThumb('/images/stickers/ehost_sticker_lg.gif')"><img src="/images/stickers/ehost_sticker_sm.gif" /></a></td>
							</tr>
						</table>
					</td>
					<td>
						<input type="text" maxlength="3" name="EhostSticQTY" value="<?= stripslashes($EhostSticQTY); ?>" tabindex="17" /><br />
						Maximum Order - 200<br />
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td>&ldquo;Available Online&rdquo; Stickers</td>
								<td align="right"><a href="javascript:popUpThumb('/images/magnets/ehost_magnet.gif')"><img src="/images/magnets/ehost_magnet_thumb.gif" /></a></td>
							</tr>
						</table>
					</td>
					<td>
						<input type="text" maxlength="2" name="EhostStic2QTY" value="<?= stripslashes($EhostStic2QTY); ?>" tabindex="16" /><br />
						Maximum Order - 50<br />
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td width="232">* Name:</td>
		<td><input type="text" name="name" value="<?= stripslashes($name); ?>" tabindex="18" /></td>
	</tr>
	<tr>
		<td>* Institution Name:</td>
		<td><input type="text" name="institution_name" value="<?= stripslashes($institution_name); ?>" length="4" tabindex="19" /></td>
	</tr>
	<tr>
		<td>* Phone:</td>
		<td><input type="text" name="phone" value="<?= stripslashes($phone); ?>" tabindex="20" /></td>
	</tr>
	<tr>
		<td>* Street Address: &nbsp;(no P.O. boxes please)</td>
		<td><input type="text" name="street_address" value="<?= stripslashes($street_address); ?>" tabindex="21" /></td>
	</tr>
	<tr>
		<td>* E-mail:</td>
		<td><input type="text" name="email" value="<?= stripslashes($email); ?>" maxlength="50" tabindex="22" /></td>
	</tr>
	<tr>
		<td>* City:</td>
		<td><input type="text" name="city" value="<?= stripslashes($city); ?>" maxlength="50" tabindex="23" /></td>
	</tr>
	<tr>
		<td>* State:</td>
		<td><input type="text" name="state" value="<?= stripslashes($state); ?>" maxlength="5" tabindex="24" /></td>
	</tr>
	<tr>
		<td>* ZIP:</td>
		<td><input type="text" name="zip" value="<?= stripslashes($zip); ?>" maxlength="10" tabindex="25" /></td>
	</tr>
	<tr>
		<td>* Country</td>
		<td><input type="text" name="country" value="<?= stripslashes($country); ?>" tabindex="26" /></td>
	</tr>
	<tr>
		<td align="center" colspan="2"><input type="hidden" name="page_function" value="send" /> <input type="image" src="/images/btn_submit.gif" alt="Submit" class="graphic_button" tabindex="27" /></td>
	</tr>
	<tr>
		<td colspan="2">* required field</td>
	
</table>
</form>
</div>
<?php
}



# ----------------------------------- #
#	FOOTER
# ----------------------------------- #
	$template->printFooter();
?>