<?php 
$html5 = true;

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_urlb.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';


$newJQuery = true;
include( 'includes/header_urlb.php' );

$menu = 'url_builder';
$page = 'urlb';
include( 'includes/navbar.php' );
?>

		<h2>Direct URL Builder</h2>
		<!-- ahazen 7.10.2019 -->
		<p>Choose the search parameters to build your URL(s).</p>
        <p>Please see <a target="_blank" href="https://connect.ebsco.com/s/article/Using-the-EBSCO-Direct-URL-Builder-Tool">Using the EBSCO Direct URL Builder Tool</a> for more information about the URL builder.</p>

		<form id="urlbForm" name="form1" onsubmit="return false;">
			<div id="urlbContainer">
            	<div class="stepContainer">
                	<!--### STEP ONE ###-->
                    <h3>
                        <b>STEP 1&#160;&#160;</b> Set Search Parameters<span class="helpButton"><input type="hidden" value="<div class='helpCloser'>X</div><h4>Step 1 Set Search Parameters</h1><p>Choose the interface that you would like links for and the corresponding databases. If you would only like a profile level link that will bring you to all of the databases, please do not choose any databases.</p>"/><img src="img/urlb/help.gif"/></span>
                    </h3>
                    
                    <div class="selectContainer">
                        <label>Interface:</label>
                        <select id="select_Interface"></select>
                    </div>

                    <div class="radioContainer" id="chooseDatabaseAccess">
                        <label>Choose Database(s):</label><span class="note">&#160;&#160;&#160;Note: To create one URL that includes all databases in the chosen interface, <br/>
                        just leave all unchecked.
                    If no databases are listed for your chosen interface, it indicates that it does not have database-level searching. The URL will be built accordingly.</span></div>
                    
					<div id="dbfilter" class="col-2">
                    	<input id="chkfilter" value="" size="50" placeholder="Start typing to filter database list" type="text">
                        </div>
                    <div class="multiListContainer" id="multiSelectItems"></div>
                </div>
            	
				
                <div class="stepContainer">
                	<!--### STEP TWO ###-->
                    <h3>
                        <b>STEP 2&#160;&#160;</b> Select Authentication Parameters <span class="helpButton"><input type="hidden" value="<div class='helpCloser'>X</div><h4>Step 2 Select Authentication Parameters</h1><p>Choose your preferred authentication methods into EBSCO. For additional details on our authentication methods, see this <a target='_new' href='https://help.ebsco.com/interfaces/EBSCOadmin/Admin_User_Guide/authentication_methods_available_for_accessing_EBSCO_interfaces'>FAQ</a>, or call Technical Support at 1-800-758-5995</p>"/><img src="img/urlb/help.gif"/></span>
                    </h3>
					
					
					<div id="customerInfoDiv">
                        <div id="customerIdInputDiv">
                        	<label><!--<span class="referenceNote">*</span>--></label><label>Customer ID: </label><input type="text" id="input_CustomerID"/><label> (Should not be used if generated URLs are for multiple institutions)</label>
                        </div>
						<div id="groupIdInputDiv">
                        	<label><span class="referenceNote">**</span></label><label>Group ID: </label><input type="text" id="input_groupID"/><label> (Use with Guest Access)</label>
							<br/>
                        </div>
						<br/><span class="note">If you do not know your Customer ID or Group ID, please contact Technical Support at <a href="mailto:support@ebsco.com?subject=URL Builder">support@ebsco.com</a> or call 1-800-758-5995.</span>
                    </div>
					
					
                    <label>Proxy: </label>
                  <input type="text" id="input_ProxyPrefix"/>
                    
					<div>
						<p>If you are accessing through a proxy:</p>
						<p>1). Cut and paste one of the two example URLs below into the  text box (include the curly brackets).</p>
						<p>2). Replace the green portions with your actual proxy server domain and path values.</p>
					</div>
					
                  <p><b>http://<span class="userInputPart">proxy.institution.edu/login.aspx?</span>url={targetURL}</b></p>
                  <p><b>http://search.ebscohost.com.<span class="userInputPart">proxy.institution.edu</span>/{targetURLRemainder}</b></p>
                    
      <div id="inputColorKeys">
                    </div>
                    
                    <div id="AuthenticationMethodsDiv">
                    <label class="boxLabel">Authentication Methods</label>
                        <div id="AuthenticationMethodsColumnOne">
                            <h4>Select any of the following:</h4>
                            <div id="authCheckBoxesDiv">
                                <input type="checkbox" id="CheckBox_Cookie" value="cookie" /><label>Cookie</label><br/>
                                <input type="checkbox" id="CheckBox_IP" value="ip" /><label>IP Address</label><br/>
                                <input type="checkbox" id="CheckBox_RefURL" value="url" /><label>Referring URL</label><br/>
                            </div>
                        </div>
                        <div id="AuthenticationMethodsColumnTwo">
                            <h4>Select one of the following:</h4>
                            <div id="authRadoButtonsDivOne">
                                <input name="authenticationRadioButton" type="radio" value="uid" /><label>User ID/Password</label><br/>
                                <input name="authenticationRadioButton" type="radio" value="cpid" id="radio_cpid" /><label>Patterned ID<br/>
                                <input name="authenticationRadioButton" type="radio" value="shib" /><label>Shibboleth</label><br/>
                                
                            </div>
                            <div id="authRadoButtonsDivTwo">
                                <input name="authenticationRadioButton" type="radio" value="custuid" id="radio_custid" /><label>Patron ID</label><br/>
                                <input name="authenticationRadioButton" type="radio" value="guest" /><label>Guest Access <span class="referenceNote">**</span></label><br/>
                                <input name="authenticationRadioButton" type="radio" value="athens" /><label>Athens</label>
                            </div>
							
							<div id="authRadoButtonsDivThree">
								<input name="authenticationRadioButton" type="radio" value="social" /><label>Google</label>
								
								<!--SocMediaType -- Commented out until other social media type login authentication methods are available. Works with the SocMediaType function within the urlbFunctions.js file.
									<select id="SocMediaType">
										<option value="google">Google</option>
									</select>
								-->
								
							</div>
                          
                          <p class="authNote"><span class="note"><a id="radioDeselect">Click here to deselect radio selection.</a></span></p>
                        </div>
                        
                    </div><!--## end of authentication div ##-->
                    <p class="authNote">* Required field.</p>
                    <p class="authNote">** Guest Authentication applies to EDS only and must be configured in EBSCOadmin.</p>
                    
                    
                </div>
                
                <div class="stepContainer">
                	<!--### STEP THREE ###-->
                    <h3>
                        <b>STEP 3&#160;&#160;</b> Generate the URL(s)
                        
                    </h3>
                    <div id="invokeDiv">
                        <input type="button" value="Generate URLs" id="Button_GenerateURLs"/>
                        <div id="outputDiv"></div>
                        <p>Click on the link(s) to open the search in a new window or tab.</p>
                    </div>
                </div>
                
               

			</div>
			<!--### end of urlbContainer ###-->
		</form>

	
<?php 
include( 'includes/footer_urlb.php' );
?>

