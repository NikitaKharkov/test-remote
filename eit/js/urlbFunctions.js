var URLB = new urlBuilder();
var JuneOne = new Date("June 1, 2017 00:00:00");
var Today = new Date();

/*###################################################*/
/*################# DOCUMENT READY ##################*/
 $("document").ready( function(){
	 
		
	loadDataOne();
	/*### 2016_10_27 Making CustID manditory
	setCustIdCheckBox();*/
	
	jQuery("#select_Interface").change( function(){
		populateMultiSelectItems( jQuery("#select_Interface option:selected").val() );
	});
	
	/*### 2016_10_27 Making CustID manditory
	jQuery("#CheckBox_CustID").click(function(){
		if(jQuery("#CheckBox_CustID").is(':checked'))
		{ 
			jQuery("#customerIdInputDiv").css("opacity","1");
		}
		else
		{
			jQuery("#customerIdInputDiv").css("opacity",".3");
		}
	});
	*/
	
	
	/*### 2016_10_27 Making CustID manditory
	jQuery("#AuthenticationMethodsDiv input[type='radio']").click(function(){
	
		if( jQuery("#radio_cpid").is(':checked') || jQuery("#radio_custid").is(':checked') )
		{ 
			jQuery("#customerIdInputDiv").css("opacity","1");
			
			jQuery("#CheckBox_CustID").attr('checked', 'checked');
			FlashCustomerIdInputDiv();
		}
		else
		{
			$("#customerInfoDiv").css("border-width","0px"); 
		}

	});*/
	
	jQuery("#radioDeselect").click(function(){
		$(':radio').attr('checked', false);					   
	});
	
	
	jQuery("#Button_GenerateURLs").click(function(){
		
		jQuery("#outputDiv").html("");
		
		var alerts = vetInput();
		if(alerts.length == 0)
		{
			generateURLs();
		}
		else
		{
			jQuery("#outputDiv").append('<div class="errorMessage">' + alerts + '</div>');
		}
		
	});
	
	
	jQuery(".helpButton").click(function(event){
										 
		var xPos = event.pageX;// - offset.left;
		var yPos = event.pageY;// - offset.top;
		var helpText = jQuery(this).find("input[type='hidden']").val();
	
		if( jQuery(".floatingHelpDiv").length == 0 )
		{
			jQuery("body").append('<div class="floatingHelpDiv" style="left:'+xPos+'px;top:'+yPos+'px;"><div>'+helpText+'</div></div>');
			
		}
		else
		{
			jQuery(".floatingHelpDiv").remove();
			jQuery("body").append('<div class="floatingHelpDiv" style="left:'+xPos+'px;top:'+yPos+'px;"><div>'+helpText+'</div></div>');
		}
		
		$(".floatingHelpDiv").draggable();
		
		jQuery(".helpCloser").click(function(){
			jQuery(".floatingHelpDiv").remove();
		});
	});
	
	
	
	$('#chkfilter').on('keyup', function() {
    	var query = this.value;
		query = query.toUpperCase();

    	$('#multiSelectItems div').each( function() {
			if( $(this).find('label').text().toUpperCase().indexOf(query) > -1 )
			{
				$(this).show();
			}
			else
			{
				$(this).hide();
			}
    	});
	}); //Thank you Ariana
	
});
 /*################# END DOCUMENT READY ##################*/
/*########################################################*/


function vetInput()
{
	var alerts = "";
	
	/*
	if( $("#input_CustomerID").val().length < 1)
	{
		alerts += "A Customer ID is required.<br/>";
	}*/
	
	if(getAuthenticationParams() == null)
	{
		alerts += "At least one authentication method must be selected.<br/>"
	}
	
	return alerts;
}

function urlBuilder()
{
	var globalData;
	var exceptionList;
	var interface_DoNotUseList;
}

function loadDataOne()
{
	jQuery.get('txtData/InterfaceExceptions.txt', function(data, status){
			   URLB.exceptionList =  data;
			   loadDataTwo();
	});
}

function loadDataTwo()
{
	jQuery.getJSON('js/dbMeta.js',function(data){
			   URLB.globalData = data;
			   loadDataThree();
	});
}

function loadDataThree()
{
	jQuery.get('txtData/Interfaces_DoNotUse.txt', function(data, status){
			URLB.interface_DoNotUseList = data;
			populateInterfaceChoices();
			populateMultiSelectItems("ehost");
	});
}

/*### 2016_10_27 Making CustID manditory
function setCustIdCheckBox()
{
	if( $('#CheckBox_CustID').is(':checked') )
	{ 
		jQuery("#customerIdInputDiv").css("opacity","1");
	}
	else
	{
		jQuery("#customerIdInputDiv").css("opacity",".3");
	}
}*/

//end of initializeInterfaceSelections


function populateInterfaceChoices()
{	
	var currentInterfaceID;
	var currentInterfaceDisplayName;
	var localData = URLB.globalData; /*this allows us to call the URLB instance once instead of five different times.*/
	for(j = 0; j < localData.interfaces.length; j++)
	{
		currentInterfaceID = localData.interfaces[j].id;
		currentInterfaceDisplayName = localData.interfaces[j].displayName;
		
		if(localData.interfaces[j].id == "ehost" )
		{
			jQuery("#select_Interface").append('<option selected="selected" value="' + currentInterfaceID + '">' + currentInterfaceDisplayName + '</option>');
		}
		else
		{
			if(!isOnDoNotUuseList(currentInterfaceID))
			{
				jQuery("#select_Interface").append('<option value="' + currentInterfaceID + '">' + currentInterfaceDisplayName + '</option>');
			}
		}
	}
}


function populateMultiSelectItems( interfaceID )
{
	if(interfaceID == "ehost")
	{
		jQuery("#multiSelectItems").show();
		jQuery("#dbfilter").show();
		jQuery("#multiSelectItems").html("");
		jQuery("#chooseDatabaseAccess").show();
		
		var currentInterface;
		var localData = URLB.globalData; /*a local copy of the global data allows us to make that search once instead of 4 different times.*/
		
		for(i = 0; i <  localData.interfaces.length; i++)
		{
			if(localData.interfaces[i].id == interfaceID)
			{
				currentInterface = localData.interfaces[i];
			}
		}
		
		var allDatabases = currentInterface.databases;
		
		for(f = 0; f < allDatabases.length; f++)
		{
			
			var _displayName = GeoLocDisplayName(allDatabases[f].displayName, allDatabases[f].id);
			
			jQuery("#multiSelectItems").append('<div><input type="checkbox" name="txtDatabases" id="' 
			+ allDatabases[f].id 
			+ '" value="' 
			+ allDatabases[f].id 
			+ '"/><label>' 
			+ _displayName 
			+ '</label><span> (' 
			+ allDatabases[f].id 
			+ ')</span></div>');
		}
	}
	else
	{
		jQuery("#chooseDatabaseAccess").hide();
		jQuery("#multiSelectItems").hide();
		jQuery("#dbfilter").hide();
	}
}

function GeoLocDisplayName(OriginalDisplayName, ID)
{
	
	var dispName = OriginalDisplayName;
	
	if(OriginalDisplayName.toUpperCase().indexOf("EBOOK") > -1)
	{
		var GeoLoc = ID.substring((ID.length)-2,ID.length);

		switch(GeoLoc)
		{
			case "na": OriginalDisplayName += " - North America - "; break;
			case "uk": OriginalDisplayName += " - United Kingdom - "; break;
			case "uk": OriginalDisplayName += " - Canada - "; break;
			case "ww": OriginalDisplayName += " - Worldwide - "; break;
			case "ca": OriginalDisplayName += " - Canada - "; break;
			default: break;
		}
	}
	
	return OriginalDisplayName;
}

function generateURLs()
{
	jQuery("#outputDiv").html("");
	var baseURL = "https://search.ebscohost.com/login.aspx";
	var wholeURL;
	var authenticationParams = getAuthenticationParams();
	var proxPrefix = jQuery("#input_ProxyPrefix").val();
	
	var chosenInterface = $("#select_Interface option:selected").val();
	//console.log("chosenInterface: " + chosenInterface);
	
	var chosenInterfaceDisplayName = $("#select_Interface option:selected").text();
	
	var isOnExceptionsList = isOnExcetionsList(chosenInterface);
	var profileID  = chosenInterface;
	
	var multiSelectDatabases;
	
	if(chosenInterface === "ehost")
	{
		multiSelectDatabases = jQuery("#multiSelectItems input[type='checkbox']:checked");
	}
	else
	{
		multiSelectDatabases = new Array();
	}
	
	//console.log("multiSelectDatabases.length: " + multiSelectDatabases.length);
	

	
	var currentDbDisplayName = chosenInterfaceDisplayName;
	/*### IF ONE OR MORE DBs ARE CHOSEN, CREATE ONE URL FOR EACH DB CHOSEN IN MULTI CHECK BOX LIST ###*/
	if(multiSelectDatabases.length > 0)
	{
		for(i = 0; i < multiSelectDatabases.length; i++)
		{
			proxPrefix = jQuery("#input_ProxyPrefix").val();
			
			if(proxPrefix.indexOf("{targetURL}") > -1)
			{
				proxPrefix = proxPrefix.replace("{targetURL}","");
				wholeURL = proxPrefix + baseURL + "?";
			}
			else if(proxPrefix.indexOf("{targetURLRemainder}") > -1)
			{
				proxPrefix = proxPrefix.replace("{targetURLRemainder}","");
				wholeURL = proxPrefix + "login.aspx?";
			}
			else
			{
				wholeURL = baseURL + "?";
			}
			
	
			if(isOnExceptionsList)
			{
				wholeURL += "site=" + profileID + "&return=y";
			}
			else
			{
				wholeURL += "profile=" + profileID;
			}
			
			if( $("#input_groupID").val().length > 0 )
			{
				wholeURL += "&groupid=" + $("#input_groupID").val();
			}
			
			
			var currentDB = multiSelectDatabases[i].getAttribute("value");
			currentDbDisplayName = multiSelectDatabases[i].parentNode.getElementsByTagName("label")[0].firstChild.nodeValue;
			wholeURL += "&defaultdb=" + currentDB + authenticationParams;
			
			/*### 2016_10_27 Making CustID manditory
			if(jQuery("#CheckBox_CustID").is(":checked"))
			{ 
				wholeURL += "&custid=" + $("#input_CustomerID").val();
			}*/
			
			if( $("#input_CustomerID").val().length > 0)
			{
				wholeURL += "&custid=" + $("#input_CustomerID").val();
			}
			
			
			jQuery("#outputDiv").append('<div><b>'+currentDbDisplayName+':</b><br/><a href="' + wholeURL + '" target="_new">' + wholeURL + '</a></div>');
		}
	}
	else  //NO DBs ARE CHOSEN
	{
		if(proxPrefix.indexOf("{targetURL}") > -1)
		{
			proxPrefix = proxPrefix.replace("{targetURL}","");
			wholeURL = proxPrefix + baseURL + "?";
		}
		else if(proxPrefix.indexOf("{targetURLRemainder}") > -1)
		{
			proxPrefix = proxPrefix.replace("{targetURLRemainder}","");
			wholeURL = proxPrefix + "login.aspx?";
		}
		else
		{
			wholeURL = baseURL + "?";
		}
	
		if(isOnExceptionsList)
		{
			wholeURL += "site=" + profileID + "&return=y";
		}
		else
		{
			wholeURL += "profile=" + profileID;
		}
		
		/*### 2016_10_27 Making CustID manditory
		if(jQuery("#CheckBox_CustID").is(":checked"))
		{ 
			wholeURL += "&custid="+ $("#input_CustomerID").val();
		}*/
		
		
		if( $("#input_CustomerID").val().length > 0)
		{
			wholeURL += "&custid=" + $("#input_CustomerID").val();
		}
		
		
		if( $("#input_groupID").val().length > 0 )
		{
			wholeURL += "&groupid=" + $("#input_groupID").val();
		}
		
		wholeURL += authenticationParams;
		
		
		jQuery("#outputDiv").append('<div><b>'+currentDbDisplayName+':</b><br/><a href="' + wholeURL + '" target="_new">' + wholeURL + '</a></div>');
	}
	/*### END OF CREATE ONE URL FOR EACH DB CHOSEN IN MULTI CHECK BOX LIST ###*/
}



function getAuthenticationParams()
{
	var allAuthenticationMethodCheckBoxes = jQuery("#authCheckBoxesDiv input[type='checkbox']:checked");
	var finalAuthenticationParams = "&authtype=";
	var additionalAuthenticationMethod = "";
	
	if( $('#AuthenticationMethodsColumnTwo input[type="radio"]:checked').length + allAuthenticationMethodCheckBoxes.length < 1 )
	{
		return null;
	}
	else
	{
		if( $('#AuthenticationMethodsColumnTwo input[type="radio"]:checked').length > 0 )
		{
			additionalAuthenticationMethod = $('#AuthenticationMethodsColumnTwo input[type="radio"]:checked').val();
		}
		
		for(i = 0; i < allAuthenticationMethodCheckBoxes.length; i++)
		{
			finalAuthenticationParams += allAuthenticationMethodCheckBoxes[i].getAttribute("value");
			if(allAuthenticationMethodCheckBoxes.length > 0 && i < allAuthenticationMethodCheckBoxes.length-1)
			{
				finalAuthenticationParams += ",";
			}
		}
		
		if(additionalAuthenticationMethod != "")
		{	
			//if we have already added one or more authentication methods above, then place a comma.
			if(allAuthenticationMethodCheckBoxes.length > 0)
			{
				finalAuthenticationParams += ",";
			}
			
			if(additionalAuthenticationMethod === 'social')
			{
				additionalAuthenticationMethod += "&provider=" + $("#SocMediaType option:selected").val();
			}
			
			finalAuthenticationParams += additionalAuthenticationMethod;
		}
		return finalAuthenticationParams;
	}
}


function isOnExcetionsList(interfaceName)
{
	var X = false;
	var lowerCaseExceptions = URLB.exceptionList.toLowerCase();
	var arrayOfExceptions = lowerCaseExceptions.split(/\s+/);
	if(jQuery.inArray(interfaceName.toLowerCase(),arrayOfExceptions,0) > -1)
	{
		X = true;
	}
	return X;
}


function isOnDoNotUuseList(interfaceName)
{
	var X = false;
	var lowerCaseInterfaces =  URLB.interface_DoNotUseList.toLowerCase();
	var arrayOfDoNotUseInterfaces = lowerCaseInterfaces.split(/\s+/);
	
	if(Today > JuneOne)
	{
		arrayOfDoNotUseInterfaces.push("apic");
	}
	
	if(jQuery.inArray(interfaceName.toLowerCase(),arrayOfDoNotUseInterfaces,0) > -1)
	{
		X = true;
	}
	return X;
}


function FlashCustomerIdInputDiv()
{
	var T = 0
	if( $("#customerInfoDiv").css("border-left-width") == "0px" )
	{
		for(i = 0; i < 3; i++)
		{
			setTimeout(flashCustIdDiv, T);
			T += 300;
		}
	}
	else
	{
		for(i = 0; i < 4; i++)
		{
			setTimeout(flashCustIdDiv, T);
			T += 300;
		}
	}
}


function flashCustIdDiv()
{
	if( $("#customerInfoDiv").css("border-left-width") == "0px" )
	{
		$("#customerInfoDiv").css("border-width","1px");
	}
	else
	{
		$("#customerInfoDiv").css("border-width","0px");
	}	
}
