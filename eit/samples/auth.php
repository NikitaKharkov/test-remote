<?php


if( !isset( $_GET["login"] ) )
{
	if( !isset( $_GET['fwd'] ))
		$fwd = "portal/";
	else
		$fwd = $_GET['fwd'];
		
	if( isset( $_GET['error'] ) ) 
		$error_str = 'Your profile and password were incorrect.<br />';
	else
		$error_str = '';
	
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">




<html>
	<head><title>
	EBSCOhost - world’s foremost premium research 
			database service
</title>
<meta name="GENERATOR" content="Microsoft Visual Studio .NET 7.1">
<meta name="CODE_LANGUAGE" content="C#">
<meta name="vs_defaultClientScript" content="JavaScript">
<meta name="vs_targetSchema" content="http://schemas.microsoft.com/intellisense/ie6">
<meta name="description" content="EBSCOhost (ebscohost.com) serves thousands of libraries and other institutions with premium content in every subject area. Free LISTA: LibraryResearch.com">
<meta name="ROBOTS" content="ALL">
<link href="Site.css" type="text/css" rel="STYLESHEET" />
		<script type="text/javascript" language="javascript">
        
		    function formSubmit() {
		        document.forms[0].FormSubmit.value = 'true';
		        return true;
		    }

		</script>
	</head>
<body style="margin:15px 0px 0px 0px">
<form action="auth.php?login" method="POST">
<input type="hidden" name="fwd" value="<?php echo $fwd; ?>" />
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUJMjEzNzg1OTE1ZGQ=" />
<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEWBAKq+tqpAQKtysb4DwKlqJDrAgL669Q/" />
<input type="hidden" name="FormSubmit" />


<a name="TopOfPage"></a>
<table id="loginUI_tblMain" align="center" width="61%">
	<tr>
		<td>
            <table id="loginUI_tbl_loginFrame" align="left" cellspacing="0" cellpadding="0" width="100%" style="height:362px; border-color:#568c5b; border-width:1px; border-style:solid">
			<tr>
				<td id="loginUI_col_GreenBar" colspan="2">
                        
                        <table id="loginUI_tbl_Header" align="left" cellpadding="6" cellspacing="0" style="height:30px;" width="100%">
					<tr id="loginUI_rw_GreenBar">
						<td id="loginUI_col_GreenBar1" align="left" class="GreenBar" style="height: 30px;">
                                    <span id="loginUI_lb_Login">Login</span>
                                </td>
						<td id="loginUI_col_SupportSiteURL" align="right" class="GreenBarBold" style="height: 30px">
		                            <a id="loginUI_lnk_SupportSiteURL" href="http://support.epnet.com/index.php" style="color:White;">EBSCO Support Site</a>
		                        </td>
					</tr>
				</table>
				
		            </td>
			</tr>
			<tr id="loginUI_rwMain">
				<td valign="top" style="height:300px"> 
                        <!--left shaded table-->
                        <table id="loginUI_tbl_left" cellspacing="0" cellpadding="4" align="center" border="0" style="width:100%;border-collapse:collapse;">
					<tr id="loginUI_rw_tbl_left_1" style="height:40px">
						<td id="loginUI_lb_UserMessage_Left" class="bodybold-shaded" style="width:33%;"></td><td class="bodyLarger" align="left"><span id="loginUI_lb_UserMessage"></span></td>
					</tr><tr id="loginUI_rw_tbl_left_3">
                  

                  <?php if( $error_str != '' ) { ?>
		<span style="color: #FF0000; font-weight: bold;"><?php echo $error_str; ?></span>
		<?php } ?>
                        
						<td id="loginUI_lb_UserID_Left" class="bodybold-shaded" style="height:20px;"><span id="loginUI_tbl_lblUserID">Profile</span></td><td style="height:20px;"><table id="loginUI_tbl_txtUserID" cellspacing="0" cellpadding="0" align="left" border="0" style="border-style:None;width:70%;border-collapse:collapse;">
							<tr>
								<td valign="bottom" style="border-style:None;"><input name="prof" maxlength="20" id="prof" class="blue_border_txt" /></td>
							</tr>
						</table></td>
					</tr><tr id="loginUI_rw_tbl_left_5">
						<td id="loginUI_lb_Pwd_Left" class="bodybold-shaded" style="height:20px;"><span id="loginUI_tbl_lblPwd">Password</span></td><td style="height:20px;"><table id="loginUI_tbl_txtPwd" cellspacing="0" cellpadding="0" align="left" border="0" style="border-style:None;width:70%;border-collapse:collapse;">
							<tr>
								<td valign="top" style="border-style:None;"><input name="pwd" type="password" maxlength="20" id="pwd" class="blue_border_txt" /></td>
							</tr>
						</table></td>
					</tr><tr id="loginUI_rw_tbl_left_6">
						<td id="loginUI_btnLogin_Left" class="bodybold-shaded"></td><td align="left" valign="top"><input type="submit" name="loginUI:btnLogin" value="Login" id="loginUI_btnLogin" class="LoginButton" /></td>
					</tr><tr id="loginUI_Space">
						<td id="loginUI_space_Left" class="bodybold-shaded" style="height:105px;"></td><td></td>
					</tr><tr id="loginUI_Links">
						<td id="loginUI_links_Left" class="bodybold-shaded" style="height:20px;"></td><td style="height:20px;">
                                    <div>
                                        <ul class="list_item">
                                            <!--<a id="loginUI_lnk_ShibLogin" class="FooterLeftMostWithLeftPadding" href="http://search.ebscohost.com//login.aspx?authtype=shib&amp;direct=true&amp;db=a9h&amp;AN=63155198&amp;site=ehost-live" target="_self" style="text-decoration:none;">Shibboleth Login</a><a id="loginUI_lnk_AthensLogin" class="footer" href="http://search.ebscohost.com//login.aspx?authtype=athens&amp;amp;lp=athens.asp&amp;direct=true&amp;db=a9h&amp;AN=63155198&amp;site=ehost-live" target="_blank" style="text-decoration:none;">Athens Login</a>-->
                                        </ul>
                                    </div>
                                </td>
					</tr><tr id="loginUI_BrowserInfo">
						<td id="loginUI_lb_BrowserInfo_Left" class="bodybold-shaded"></td><td valign="bottom" style="height:28px;">
                                    <table width="96%" cellspacing="1" cellpadding="3" style="border-color:#d4d0c8; border-top-style:solid; border-top-width:1px" >
                                        <tr>
                                            <td valign="bottom" style="height: 30px">
                                                

<!--<div class="body" style="margin-bottom:3px">	
	<span id="loginUI_AuthBrwsInfo_lb_Brsw1"></span>&nbsp<span id="loginUI_AuthBrwsInfo_lb_Brsw2"></span>
</div>-->
<div class="body">
    <a id="loginUI_AuthBrwsInfo_lnk_SupportedBrowsers" href="http://support.epnet.com/knowledge_base/detail.php?id=25" target="_blank">Supported Browsers</a>
</div>
<div class="body">   
	<span id="loginUI_AuthBrwsInfo_lb_Brsw3">Recommended minimum screen resolution:</span>&nbsp<span id="loginUI_AuthBrwsInfo_lb_Brsw4">1024x768</span>
</div>


                                            </td>
                                        </tr>
                                    </table>
                                </td>
					</tr>
				</table>
                    </td>
				<td id="loginUI_col2" style="width:40%; height:300px; border-color:#d4d0c8; border-left-style:solid; border-left-width:1px"><!--right table-->
                        <table id="loginUI_tbl_right" align="center" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td valign="middle" align="center" style="height:270px">
                                    <img id="loginUI_InterfaceLogos" src="../images/InterfaceLogos.jpg" border="0" />
                                </td>
					</tr>
					<tr>
						<td valign="bottom" align="center" class="BodyBlack" style="height:30px">
                                    <span id="loginUI_lb_LearnMoreAbout">Learn more about</span>
                                </td>
					</tr>
					<tr>
						<td valign="top" align="center" class="bodybold" style="height:40px">
                                    <a id="loginUI_lnk_PrdSvc" href="http://www.ebscohost.com" style="text-decoration:underline;">EBSCO Publishing's Product & Services</a>
                                </td>
					</tr>
				</table>
				
                    </td>
			</tr>
		</table>
		
        </td>
	</tr>
	<tr>
		<td>
            <table id="loginUI_tblFooter" align="center" style="width:100%">
			<tr>
				<td>
                        <div class="Infolink">
                            <span id="loginUI_lblInfo"><b><font color="red">Important User Information:</font color></b> You must have an EIT-enabled profile to access this demo. Contact your Account Manager for details on getting an EIT enabled profile.</span>
                        </div>
                    </td>
			</tr>
		</table>
		
        </td>
	</tr>
	<tr>
		<td>
            <div>


<div style="width:100%; text-align:center; margin-top:10px">    
    <div id="loginUI_AuthFooter_divLinks"><ul style="margin: 0px 0px 10px 0px">
    <a id="loginUI_AuthFooter_lSupport" class="FooterLeftMost" href="http://support.epnet.com/index.php" target="_blank" style="text-decoration:none;">EBSCO Support Site</a>  
	<a id="loginUI_AuthFooter_lPolicy" class="footer" href="http://support.ebscohost.com/ehost/privacy.html" target="_blank" style="text-decoration:none;">Privacy Policy</a>
	<a id="loginUI_AuthFooter_lTerms" class="footer" href="http://support.ebscohost.com/ehost/terms.html" target="_blank" style="text-decoration:none;">Terms of Use</a>
	<a id="loginUI_AuthFooter_lCopyright" class="footer" href="http://support.ebscohost.com/ehost/terms.html#copyright" target="_blank" style="text-decoration:none;">Copyright</a>         		
	</ul></div>	
	<div id="loginUI_AuthFooter_divConnection" class="FooterLeftMost">
		<a id="loginUI_AuthFooter_lECConnection" href="http://connection.epnet.com" target="_blank">EBSCOhost Connection</a>			
	</div>
	<div id="loginUI_AuthFooter_divCompany" class="CopyrightFooter">
		<span id="loginUI_AuthFooter_lblCompany">&#169; 2011 EBSCO Industries, Inc.  All rights reserved</span>        
	</div>
	<div id="loginUI_AuthFooter_divFooter" class="GreenBarFooter">
         <img id="loginUI_AuthFooter_IconRecycle" class="GreenBarFooter" src="../images/iconRecycle.gif" border="0" />      
	     <a id="loginUI_AuthFooter_lGreenInitiatives" class="GreenBarFooter" href="http://www.ebscohost.com/thisTopic.php?marketID=30&amp;topicID=872" target="_blank" style="font-weight:bold;">EBSCO Publishing Green Initiatives</a>
	     
    </div>	
</div>
	
   
		


</div>
        </td>
	</tr>
</table>
		    		
		<input name="authtype" type="hidden" id="authtype" value="uid" /><input name="ref" type="hidden" id="ref" /></form>		
	</body>		
</html>

<?php 
} else
{
	include( "simple_search/service.php" );
    $fwd = $_POST["fwd"];
    
	if( !isset( $_POST["prof"]) || !isset( $_POST["pwd"]) )
		die( header( "Location: auth.php") );
		
		// Setup profile parameters
    $params = array(
	"prof" => $_POST["prof"],
	"pwd"  => $_POST["pwd"]
    );
    
	// Request Database Information
	$xmlDoc = new DataService;
	$xmlDoc->connect( "http://eit.ebscohost.com/Services/SearchService.asmx/" );
	$xmlDoc->send( "Info", $params );
	$xml = $xmlDoc->recieve();
    
	
	// Create a DOMDocument to parse the XML file
	$xmlObj = new DOMDocument();
	$xmlObj->loadXML( $xml );
	
	if( $xmlObj->getElementsByTagName( "Fault" )->item(0) )
	{
		die( header( "Location: auth.php?error&fwd=" . $fwd ));
	}
	else
	{
		setcookie( "profile", $_POST["prof"], 0, '/' );
		setcookie( "password", $_POST["pwd"], 0, '/' );
		
		header( "Location: " . $fwd );
	}
}
?>