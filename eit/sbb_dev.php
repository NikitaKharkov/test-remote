<?php 

//require https
if( $_SERVER['HTTPS'] == "off"){
	$redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}

$html5 = true;

$head = '<link href="styles/style_sbb.css" rel="stylesheet" type="text/css">
<link href="styles/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://imageserver.ebscohost.com/branding/css/ebsco-bootstrap.css" />
<style>
.btn-primary {
    color: #fff;
    background-color: #337ab7;
    border-color: #2e6da4;
}
.btn-danger {
    color: #fff;
    background-color: #d9534f;
    border-color: #d43f3a;
}
.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
}
button {
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
}
button {
    -webkit-appearance: button;
    cursor: pointer;
}
button {
    text-transform: none;
}
button {
    overflow: visible;
}
button {
    margin: 0;
    font: inherit;
    color: inherit;
	height: 40px;
}
</style>
';

$newJQuery = true;
include( 'includes/header.php' );

$menu = 'search_box_builder';
$page = 'sbb';
include( 'includes/navbar.php' );

?>

		<h2>Search Box Builder</h2>
		<p>Choose your search parameters and customize your search box<br />size and style to fit your site.</p>
				<div class="leftblock">
					<p>For help with EBSCOhost Search Box Builder, please see:</p>
					<ul class="general">
						<li>
							<a target="_blank" href="https://help.ebsco.com/interfaces/EBSCO_Guides/General_Product_FAQs/Create_an_EBSCO_search_box">How do I embed an EBSCOhost search box on to my website?</a>
						</li>
						<li>
							<a target="_blank" href="https://help.ebsco.com/interfaces/EBSCO_Guides/General_Product_FAQs/use_the_EBSCO_Search_Box_Builder_tool">How do I use the EBSCO Search Box Builder tool?</a>
						</li>
						<!--<li>EBSCOhost Integrated Search (EHIS) search box samples</a></li>-->
					</ul>
				</div>
		<form id="sbbForm" name="form1" onsubmit="return false;">
			<div id="sbbMainContainer">
				<h3>
					<b>STEP 1</b> Set Search Parameters
				</h3>

				<!-- Interface Selection Dropdown -->
				<div>
					<label for="txtInterface" class="col-1">Interface:</label>
					<!-- populates from js/interfaces.js -->
					<select data-class="dropdown" name="txtInterface" id="txtInterface" onchange="document.getElementById('memoCode').value = 'Click the &quot;Create Search Box&quot; button above to generate code.';"></select>
				</div>

				<!-- Interface Language Dropdown -->
				<div data-class="languagesContainer">
					<label for="txtLanguage" class="col-1">Interface Language:</label>
					<select data-class="languages" name="txtLanguage" id="txtLanguage">
						<option data-class="languageOption"></option>
					</select>
				</div>

				<!-- Database Groups or Specify Databases option for Ehost Interface -->
				<div>
					<label class="col-1">Choose:</label>
					<ul class="horizontal" data-class="databaseAccessList">
						<li>
							<label data-class="databaseAccessLabel">
								<input data-class="databaseAccessInput" name="databaseAccessType" type="radio" />
								<span data-class="databaseAccessText"></span>
							</label>
						</li>
					</ul>
				</div>

				<!-- Start of Databases per Interface Section -->
				<div id="choose-interface" class="input-auto-width">
					<!-- Profile Credential Inputs -->
					<div data-class="profile" id="profileCredentials" class="col-2">
						<ul>
							<li>
								<input data-class="profileCustomerId" type="text" id="customerId" onkeypress="showCustID()" />
								<div class="commenttext">Customer ID</div>
							</li>
							<li>
								<input data-class="profileGroupId" type="text" id="groupId" />
								<div class="commenttext">Group ID</div>
							</li>
							<li>
								<input data-class="profileProfileId" type="text" id="profileId" />
								<div class="commenttext">Profile ID</div>
							</li>
						</ul>
					</div>
					<!-- Databases listed -->
					
					<div data-class="databases" id="searchdatabases">
					<div id ="dbfilter" class="col-2"><input id="chkfilter" type="text" value="" size="50" placeholder="Start typing to filter database list" /></div>
						<ul data-class="databasesSingleSelect" class="multiselect">
							<li>
								<label data-class="databaseLabel">
									<input data-class="databaseSingleInput" type="radio" name='databasesSingleSelect' />
									<span data-class="databaseDisplayName"></span><span class="db-short-name" data-class="databaseName"></span>
								</label>
							</li>
						</ul>
						<ul data-class="databasesMultiSelect" class="multiselect">
							<li>
								<label data-class="databaseLabel">
									<input data-class="databaseInput" type="checkbox" name='txtDatabases' />
									<span data-class="databaseDisplayName"></span><span class="db-short-name" data-class="databaseName"></span>
								</label>
							</li>
						</ul>
						<ul data-class="ehisDatabases" class="multiselect">
							<li>
								<label data-class="databaseLabel">
									<input data-class="databaseInput" type="checkbox" name='txtDatabases' />
									<span data-class="databaseDisplayName"></span><span class="db-short-name" data-class="databaseName"></span>
								</label>
							</li>
						</ul>
					</div>
					<div data-class='addEhisDatabaseContainer' id="searchehisdatabases">
						<p class="add-help-text center-to-db-list">Subscribe to EHIS? Add your third-party database.</p>

						<div class="add-container center-to-db-list">
							<input data-class="addEhisDatabaseDisplayName" type="text" id="ehisDbDisplayName" class="db-display-name" name="dbdisplayname" />
							<label for="ehisDbDisplayName" class="commenttext">Display Name</label>

							<input data-class="addEhisDatabaseCode" type="text" maxlength="20" id="ehisDbCode" class="db-code" name="dbcode" />
							<label for="ehisDbCode" class="commenttext">
								Code  <a href="#" onclick="return false;" class="tt">
									<img src="img/sbb/iconHoverSm.gif" width="10" height="13" />
									<span class="tooltip">
										<img src="img/sbb/DbCodeHover.gif" border="0" width="754" height="513" />
									</span>
								</a>
							</label>
							<input data-class="addEhisDatabase" class="db-add" type="button" value="Add" />
						</div>
					</div>

					<!-- Database Subject Area -->

					<div data-class="databaseGroups" id="searchsubjects">
						<p class="add-help-text center-to-db-list">Add database groups you created in EBSCOadmin.</p>

						<div class="add-container center-to-db-list">
							<input data-class="addDatabaseGroupDisplayName" type="text" id="subjectdisplayname" class="db-display-name" />
							<label class="commenttext">Display Name</label>
							<input data-class="addDatabaseGroupCode" type="text" maxlength="20" id="subjectcode" class="db-code" />
							<label id="dbGroupCodeLabel" class="commenttext">
								Code  <a href="#" onclick="return false;" class="tt">
									<img src="img/sbb/iconHoverSm.gif" width="10" height="13" />
								</a>
							</label>
							<input data-class="addDatabaseGroup" id="dbGroupAdd" class="db-add" type="button" value="Add" />
						</div>
							
						<ul data-class="databaseGroupList" class="multiselect">
							<li>
								<label data-class="databaseLabel">
									<input data-class="databaseInput" type="checkbox" name='txtDatabases' />
									<span data-class="databaseDisplayName"></span>
									<span data-class="databaseName"></span>
								</label>
							</li>
						</ul>
					</div>

				</div>

				<!-- Search Mode Option NO LONGER WORKS 
				<div data-class="searchModeContainer" id="search-mode-option">
					<label for="radSearchMode" class="col-1">Search:</label>
						<ul data-class="searchModes" class="horizontal">
							<li>
								<input data-class="searchModeInput" type="radio" name="radSearchMode" id="radSearchBoolean" />
								<label data-class="searchModeLabel" for="radSearchBoolean"></label>
							</li>
						</ul>
				</div>-->
				
				<!-- EHOST Limiters -->
				<div data-class="limitersContainer">
					<label class="col-1">Limit results:</label>
					<ul class="labeltext" data-class="limiters">
						<li>
							<input type="checkbox" data-class="limiterInput"/>
							<label data-class="limiterLabel"></label>
						</li>
					</ul>
				</div>

				<!-- Publication Type ( EHOST & EDS ) -->
				<div data-class="pubLimitersContainer">
					<label class="col-1">Publication Type:</label>
					<ul data-class="pubLimiters">
						<li>
							<input type="checkbox" data-class="limiterInput" />
							<label data-class="limiterLabel"></label>
						</li>
					</ul>
				</div>

				<div data-class="disciplinesContainer" class="scroll-box-container">
					<div class="disciplines-section-title">
						<span>Choose Discipline(s) to Show and/or Search</span>
					</div>
					<table id="disciplinesContainer" cellspacing="0" cellpadding="0">
						<colgroup>
							<col class="first" />
							<col class="second" />
							<col class="third" />
						</colgroup>
						<thead>
							<tr>
								<th>
									Show
								</th>
								<th>
									Discipline
								</th>
								<th>
									Default to Selected
								</th>
							</tr>
						</thead>
						<tbody data-class="disciplinesBody">
							<tr>
								<td>
									<input data-class="disciplineIsEnable" type="checkbox" />
								</td>
								<td>
									<span data-class="disciplineName"></span>
								</td>
								<td>
									<input data-class="disciplineIsDefaultSelectedOn" type="radio" />
									<label data-class="disciplineIsDefaultSelectedOnLabel">On</label>
									<input data-class="disciplineIsDefaultSelectedOff" type="radio" />
									<label data-class="disciplineIsDefaultSelectedOffLabel">Off</label>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
					
				<!-- Keyword Box -->
				<div>
					<label for="txtKeywords" class="col-1">Keywords:</label>
					<input data-class="keywords" name="txtKeywords" type="text" id="txtKeywords" value="" size="38" />
					<div class="commenttext col-2">Keywords will be combined with user search box input.</div>
				</div>
				<!-- Authentication Parameters -->
				<div>
					<h3>
						<b>STEP 2</b> Select Authentication Parameters
					</h3>
					<div>
						<label for="txtProxyPrefix" class="col-1">Proxy prefix:</label>
						<input data-class="proxyPrefix" name="txtProxyPrefix" type="text" id="txtProxyPrefix" value="" size="38"  onkeyup="this.value = this.value.replace(/\{targetURL\}/i,'')" />
						<div id="proxyPrifixHelpTextContainer" class="commenttext col-2">
							i.e. https://proxy.institution.edu/login?url={targetURL}<br/>
							OR https://0-{targetURLDomain}.proxy.institution.edu{targetURLRemainder} <br/>
						</div>
						<div>
							<div id="methods">
								<fieldset class="col-2">
									<legend>Methods</legend>

									<ul data-class="authMethodsMulti">
										<li>
											<label data-class="authMethodsMultiLabel">
												<input onclick="showCustID();" data-class="authMethodsMultiInput" type="checkbox"  />
												<span data-class="authMethodsMultiText"></span>
											</label>
										</li>
									</ul>

									<ul data-class="authMethodsSingle">
										<li>
											<label data-class="authMethodsSingleLabel">
												<input onclick="showCustID();" data-class="authMethodsSingleInput" name="authMethodsSingle" type="radio" />
												<span data-class="authMethodsSingleText"></span>
											</label>
										</li>
									</ul>
								</fieldset>
								<label class="commenttext col-2">Guest Authentication applies to EDS only and must be configured in EBSCOadmin</label>
							</div>
							<div data-class="authCustIdContainer" class="col-2" style="display:none"><p style="color:red">One of your selected authentication methods requires your Cust ID to authenticate.</p>
								<label for="txtCustID" class="col-1">Cust ID:</label>
								<input data-class="authCustId" name="txtCustID" type="text" id="txtCustID" value="" size="38" />
								<div class="commenttext">
									<p>Please contact <a href="https://support.ebscohost.com/contact/askus.php" target="_blank">Tech Support</a> for help with your Cust ID.</p>
								</div>
							</div>
							<label for="chkSSL" class="col-2">
								<input data-class="https" type="checkbox" name="chkSSL" id="chkSSL" value="https" />
								Secure HTTPS authentication
							</label>
						</div>
					</div>
				</div>
				<!-- Search Box Design area -->
				<div>
					<h3>
						<font color="#144679">STEP 3</font> Choose a Search Box Design
					</h3>
					<!-- Create Preview Images for STEP 3 on SBB -->
					<div data-class="designs">
						<a href="#">
							<img data-class="designImage" title="Small Search Box" border="0"/>
						</a>
					</div>
				</div>
				<!-- STEP 4 Customize Layout section -->
				<div id="customizeLayout">
					<h3>
						<b>STEP 4</b> Customize the Layout
					</h3>
					<ul>
						<li>
							<label for="txtTitle" class="col-1">Title:</label>
							<input data-class="layoutTitle" name="txtTitle" type="text" id="txtTitle" value="" size="38"/>
						</li>
						<li>
							<label for="txtLogo" class="col-1">Logo:</label>
							<input data-class="layoutLogo" name="txtLogo" type="text" id="txtLogo" value="" size="38"/>
							<div class="commenttext col-2">Want to use your own logo? Paste a URL to the image.</div>
						</li>
						<li data-class="layoutHelpTextContainer">
							<label for="txtHelpText" class="col-1">Help Text:</label>
							<input data-class="layoutHelpText" name="txtHelpText" type="text" id="txtHelpText" value="" size="38"/>
						</li>
						<li class="input-auto-width">
							<label for="txtHeight" class="col-1">Height:</label>
							<input data-class="layoutHeight" name="txtHeight" type="text" id="txtHeight" maxlength="3" size="3"/>
							pixels
						</li>
						<li class="input-auto-width">
							<label for="txtWidth" class="col-1">Width:</label>
							<input data-class="layoutWidth" name="txtWidth" type="text" id="txtWidth" maxlength="3" size="3" />
							pixels
						</li>
						<li>
							<label for="chkResults" class="col-1">Results:</label>
							<input data-class="layoutOpenNewWindow" type="checkbox" name="chkResults" id="chkResults" value="1" />
							<label for="chkResults">Open search results in new browser</label>
						</li>
						<li>
							<div data-class="showChooseDatabasesContainer">
								<label for="chkChooseDatabases" class="col-1">Databases:</label>
								<input data-class="showChooseDatabases" type="checkbox" name="chkChooseDatabases" id="chkChooseDatabases" value="choose" />
								<label for="chkChooseDatabases">
									Show choose databases
									<span id="chooseDatabasesHelpText">(for 2 or more databases)</span>
								</label>
							</div>
						</li>
					</ul>
					<ul data-class="layoutShowLimiters">
						<li data-class="layoutShowLimiterContainer">
							<label data-class="layoutShowLimiterFirstLabel" class="col-1"></label>
							<input data-class="layoutShowLimiterCheckbox" type="checkbox" />
							<label data-class="layoutShowLimiterSecondLabel"></label>
						</li>
					</ul>
					<ul data-class="disciplineDisplayTypeContainer">
						<li>
							<label class="col-1">Disciplines:</label>
							<fieldset class="col-2">
								<legend>Method</legend>
								<input data-class="disciplineDisplayTypeCheckBox" type="radio" id="disciplineDisplayTypeCheckBox" name="disciplineDisplayType" />
								<label data-class="disciplineDisplayTypeCheckBoxLabel" for="disciplineDisplayTypeCheckBox">Check Box</label>
								<input data-class="disciplineDisplayTypeScrollBox" type="radio" id="disciplineDisplayTypeScrollBox" name="disciplineDisplayType" />
								<label data-class="disciplineDisplayTypeScrollBoxLabel" for="disciplineDisplayTypeScrollBox">Scroll Box</label>
							   <input data-class="disciplineDisplayTypeNone" type="radio" id="disciplineDisplayTypeNone" name="disciplineDisplayType" />
								<label data-class="disciplineDisplayTypeNoneLabel" for="disciplineDisplayTypeNone">None - Removed from Code</label>
							</fieldset>
						</li>
					</ul>
				</div>
				
				<div id="testDriveSection" class="input-auto-width">
					<h3>
						<b>STEP 5</b> Confirm Your Search Box
					</h3>
					<div>
						<p>Test-drive your search box. Try it out here.</p>

						<div id="testDrivePreview" class="well"></div>
					</div>
				</div>
				<div height="100px;">
					<div  id="buildSearchBoxButton" >
						<button class="btn btn-primary" href="#" data-class="buildSearchbox"><i class="fa fa-check" aria-hidden="true">&nbsp;</i>Create Search Box
						</button>
					</div>
					<button style="float:right;" onclick="formReset();" class="btn btn-danger right"><i class="fa fa-trash"  aria-hidden="true"></i>&nbsp;Reset everything</button>
				</div>
				<div class="leftblock">

					<div>
						<div>
							<h3>
								<font color="#144679">STEP 6</font> &nbsp;Copy Your Search Box Code
							</h3>
						</div>
					</div>
					<div>
						<div>
							<div class="labeltext">
								<p>Copy code to clipboard. Paste this code in your web page.</p>
							</div>
						</div>
					</div>
					<div>
						<div>
							<div class="labeltext">
								<textarea name="memoCode" id="memoCode" rows="6">Click the "Create Search Box" button above to generate code.</textarea>
							</div>
						</div>
					</div>

				</div>
			</div>
		</form>
		
<script id="limitersTemplate" type="text/x-jsrender">
	<style type="text/css">
	    .ebscohostCustomSearchBox {font-family:Helvetica,Verdana,Arial,sans-serif;width:{{: selectedInterface().layout.width()}}px;}
		.ebscohostCustomSearchBox #databaseblock {width:98%;}
		.ebscohostCustomSearchBox .choose-db-list{ list-style-type:none;padding:0;margin:10px 0 0 0;font-size:9pt; width:100%;}
		.ebscohostCustomSearchBox .choose-db-check{ width:20px;float:left;padding-left:5px;padding-top:5px; }
		.ebscohostCustomSearchBox .choose-db-detail{ margin-left:30px;border-left:solid 1px #E7E7E7;padding:5px 11px 7px 11px;line-height:1.4em; }
		.ebscohostCustomSearchBox .summary { background-color:#1D5DA7;color:#FFFFFF;border:solid 1px #1D5DA7; }
		.ebscohostCustomSearchBox .two, .ebscohostCustomSearchBox .one, .ebscohostCustomSearchBox .selected {border:solid 1px #E7E7E7; border-top:0;}
		.ebscohostCustomSearchBox #disciplineBlock { width:auto; }
		.ebscohostCustomSearchBox .limiter { float:left;margin:0;padding:0;width:50%; }
		
		.ebscohostCustomSearchBox #ebscohostsearchtext { width: 144px; }
		.ebscohostCustomSearchBox #ebscohostsearchtext.edspub { width: 245px; }
		.ebscohostCustomSearchBox .ebscohostCustomSearchBox .ebscohost-search-button.edspub {
			border: 1px solid #156619;
			padding: 5px 10px !important;
			border-radius: 3px;
			color: #fff;
			font-weight: bold;
			background-color: #156619;
		}	
		.ebscohostCustomSearchBox .ebscohost-title.edspub {
			color: #1c7020;
			font-weight: bold;
		}

	</style>
	<form class="ebscohostCustomSearchBox" action="" onsubmit="return ebscoHostSearchGo(this);" method="post" style="overflow:hidden;">
		<input id="ebscohostwindow" name="ebscohostwindow" type="hidden" value="{{: (selectedInterface().layout.openNewWindow()) ? '1' : '0' }}" />
		<input id="ebscohosturl" name="ebscohosturl" type="hidden" value="{{: buildUrl() }}" />
		<input id="ebscohostsearchsrc" name="ebscohostsearchsrc" type="hidden" value="{{: getSearchSource() }}" />
		<input id="ebscohostsearchmode" name="ebscohostsearchmode" type="hidden" value="+" />
		<input id="ebscohostkeywords" name="ebscohostkeywords" type="hidden" value="{{: selectedInterface().keywords() }}" />
		{{if selectedInterface().isEdsPub }}<div id="ebscoIsPubFinder"></div>{{/if}}
		<div style="background-image:url('{{: logo() }}'); background-repeat:no-repeat; height:{{: selectedInterface().layout.height() }}px; width:{{: selectedInterface().layout.width() }}px; font-size:9pt; color:#353535;">
			<div style="padding-top:5px;padding-left:{{: selectedInterface().layout.width() - selectedInterface().layout.leftPaddingMinus }}px;">
				<span class="ebscohost-title {{if selectedInterface().isEdsPub }}edspub{{/if}}" style="font-weight:bold;">{{: selectedInterface().layout.title() }}</span>

				<div>
					<input id="ebscohostsearchtext" class="{{if selectedInterface().isEdsPub }}edspub{{/if}}" name="ebscohostsearchtext" type="text" size="23" {{if selectedInterface().layout.helpText}}placeholder="{{: selectedInterface().layout.helpText()}}"{{/if}} style="font-size:9pt;padding-left:5px;margin-left:0px;" />
					<input type="submit" value="Search" class="ebscohost-search-button {{if selectedInterface().isEdsPub }}edspub{{/if}}" style="font-size:9pt;padding-left:5px;" />
					{{if selectedInterface().showSearchBy}}
					<div id="guidedFieldSelectors">
						<input class="radio" type="radio" name="searchFieldSelector" id="guidedField_0" value="" checked="checked" />
						<label class="label" for="guidedField_0"> Keyword</label>
						<input class="radio" type="radio" name="searchFieldSelector" id="guidedField_1" value="TI" />
						<label class="label" for="guidedField_1"> Title</label>
						<input class="radio" type="radio" name="searchFieldSelector" id="guidedField_2" value="AU" />
						<label class="label" for="guidedField_2"> Author</label>
					</div>
					{{/if}}
				</div>
			</div>
		</div>
{{if (selectedInterface().name !== 'dmp-live' && selectedInterface().name !== 'dme-live')}}
		<div id="limiterblock" style="margin-left:-{{: paddingOffset }}px; overflow: auto; {{if !areLimitersSelected()}}display:none;{{/if}}">
			<div id="limitertitle" style="font-weight:bold;padding-top:25px;padding-bottom:5px;">Limit Your Results</div>
			{{for selectedInterface().limiters}}
			<div class="limiter" {{if !visible() || alwaysHide }}style="display:none;"{{/if}}>
				<input type="checkbox" id="chk{{: capitaliseFirstLetter(type()) }}" name="chk{{: capitaliseFirstLetter(type()) }}" {{if state() }}checked="checked"{{/if}} />
				<label for="chk{{: capitaliseFirstLetter(type()) }}">{{if finalDisplayName }}{{: finalDisplayName }}{{else}}{{: displayName }}{{/if}}</label>
			</div>
			{{/for}}
		</div>
		{{/if}}
		{{if selectedInterface().disciplines}}		{{if selectedInterface().disciplineDisplayType() !== 'none'}}
		<div id="disciplineBlock" style="margin-left:-{{: paddingOffset }}px; overflow: auto;">
			{{if getNumberVisibleDisciplines() > 0}}<div style="font-weight:bold;padding-top:25px;padding-bottom:5px;">Disciplines</div>{{/if}}{{if selectedInterface().disciplineDisplayType() == 'checkBox' }}{{for selectedInterface().disciplines}}
			<div style="{{if !visible() }}display:none;{{/if}}">
				<input type="checkbox" id="{{: id }}" name="{{: id}}" value="{{: code }}" {{if isDefaultSelected() == 'true' }}checked="checked"{{/if}} />
				<label for="{{: id }}">{{: displayName }}</label>
			</div>{{/for}}{{else selectedInterface().disciplineDisplayType() == 'scrollBox'}}
			<select id="ehostVisibleDisciplines" multiple="multiple">
				<option {{if !visibleDisciplineSelected() }}selected="selected"{{/if}} value="">Select Disciplines (optional)</option>
				{{for selectedInterface().disciplines}}{{if visible()}}<option value="{{: code }}" {{if isDefaultSelected() == 'true' }}selected="selected"{{/if}} >{{: displayName }}</option>{{/if}}{{/for}}
			</select><select multiple="multiple" id="ehostHiddenDisciplines" style="display:none;">{{for selectedInterface().disciplines}}{{if !visible() && isDefaultSelected() == 'true'}}<option value="{{: code }}" selected="selected" >{{: displayName }}</option>{{/if}}{{/for}}</select>{{/if}}
		</div>		{{/if}}		{{/if}}

		{{if selectedInterface().chooseDatabases && selectedInterface().chooseDatabases() && getNumberDatabases() > 1 }}
		<div id="databaseblock" style="float:left;margin:0;padding:0;padding-left:4px;">
			<ul class="choose-db-list">
				<li class="summary">
					<span class="choose-db-check" title="Select / Deselect all">
						<input type="checkbox" onclick="SelectAllCheckBoxes(this);" name="cball" id="cball"/>
					</span>
					<div class="choose-db-detail">
						<span style="font-weight:bold;color:#FFFFFF;font-size:9pt;"> Select / Deselect all</span>
					</div>
				</li>
				{{for selectedInterface().databases.multiSelect selectedInterface().ehisDatabases()}}{{if state()}}
				<li id="tr{{: #index + 1 }}" class="{{: (#index % 2) ? 'two' : 'one' }}">
					<span class="choose-db-check" title="{{: displayName }}">
						<input type="checkbox" id="cb{{: #index + 1 }}" name="cbs" value="{{: name }}" {{if state() }}checked="checked"{{/if}} />
					</span>
					<div class="choose-db-detail">
						<a href="{{: buildUrl() }}">{{: displayName }}</a>
					</div>
				</li>
				{{/if}}{{/for}}
			</ul>
		</div>{{/if}}
	</form>
	<!-- EBSCOhost Custom Search Box Ends -->

</script>
	
<?php 

// insert config
//include( 'includes/sbbData.php' );

$page_footer = '<script type="text/javascript" src="js/jsrender.js"></script>
<script type="text/javascript" src="js/knockout.js"></script>
<script type="text/javascript" src="js/sbb-interfaces.js"></script>
<script type="text/javascript" src="js/sbb-dbfilter.js"></script>
<script>
	function showCustID() {
		var currentcustid = $("#customerId").val();
		console.log(currentcustid.length);
		var auths = [];
		var p_contents = $("input[data-class=\'authMethodsMultiInput\'], input[data-class=\'authMethodsSingleInput\']");
		for (var i = 0, elm; elm = p_contents[i]; i++) {
			if (elm.checked) {
				auths.push(elm.id);
			}
		}

				if ((auths.indexOf("guest") > -1 || auths.indexOf("geo") > -1 || auths.indexOf("cpid") > -1 || auths.indexOf("athens") > -1 || auths.indexOf("sso") > -1 || auths.indexOf("shib") > -1 || auths.indexOf("custuid") > -1) && currentcustid.length < 1) {
					$("div[data-class=\'authCustIdContainer\']").show();
				} else {
					$("div[data-class=\'authCustIdContainer\']").hide();
				}

	}

function formReset()
{
    var resetPrompt = confirm("Are you sure you want to reset your search box code?");
    if (resetPrompt == true) {
        window.location.reload(true);
    } else {
    }
}
</script>';

include( 'includes/footer.php' );

?>