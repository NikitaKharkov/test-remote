/******************************************************************************************************************************************
 This file is used by the Search Box Builder page to create the actual search box code outputted, as well as dynamically changing the test-
 drive version.
******************************************************************************************************************************************/
function _isEmpty(e){
	return (e===null||typeof e==="undefined"||e===undefined);
}
var selectedInterface="Oversized";
var bError;
var adddbcode = 0;
var adddbgroup = 0;

function findObj(n, d) {
	var p,i,x; 
	if(!d) 
		d=document; 
		
	if((p=n.indexOf("?"))>0&&parent.frames.length) 
		{
			d=parent.frames[n.substring(p+1)].document; 
			n=n.substring(0,p);
		}
		if(!(x=d[n])&&d.all) 
			x=d.all[n]; 
		for (i=0;!x&&i<d.forms.length;i++) 
			x=d.forms[i][n];
		for(i=0;!x&&d.layers&&i<d.layers.length;i++) 
			x=findObj(n,d.layers[i].document);
		if(!x && d.getElementById) 
			x=d.getElementById(n); 
		return x;
}


function preloadImages() {
	var d=document; if(d.images){ if(!d.p) d.p=new Array();
	var i,j=d.p.length,a=preloadImages.arguments; for(i=0; i<a.length; i++)
	if (a[i].indexOf("#")!=0){ d.p[j]=new Image; d.p[j++].src=a[i];}}
}

function swapImage() {
	var i,j=0,x,a=swapImage.arguments; document.sr=new Array; for(i=0;i<(a.length-2);i+=3)
	if ((x=findObj(a[i]))!=null){document.sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function swapImgRestore() {
	var i,x,a=document.sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function displayBlock() {
	if(document.getElementById){var args=displayBlock.arguments;
	for(var i=0;i<args.length;i=i+2){var obj=findObj(args[i]);
	if(obj){(args[i+1])?obj.style.display='none':obj.style.display='block';}}}
}

function displayInline() {
	if(document.getElementById){
		var args=displayInline.arguments;
		for(var i=0;i<args.length;i=i+2) {
			var obj=findObj(args[i]);
			if(obj) {
				(args[i+1])?obj.style.display='none':obj.style.display='inline';
			}
		}
	}
}

function isUrl(s) {
	var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
	return regexp.test(s);
}

function trim(st) {
	return st.replace(/^\s+|\s+$/g,"");
}

function restrictCharacters(myfield, e) {
	if (!e) var e = window.event
	if (e.keyCode) code = e.keyCode;
	else if (e.which) code = e.which;
	var character = String.fromCharCode(code);
	
	if (!e.ctrlKey && code!=9 && code!=8 && code!=36 && code!=37 && code!=38 && (code!=39 || (code==39 && character=="'")) && code!=40) {
		if (character.match(/[1234567890]/g)) {
			return true;
		} else {
			return false;
		}
		
	}
}

function getSelectedRadioValue(buttonGroup) {
	var i = getSelectedRadio(buttonGroup);
	if (i == -1) {
		return "";
	} else {
		if (buttonGroup[i]) {
			return buttonGroup[i].value;
		} else {
			return buttonGroup.value;
		}
	}
}

function getSelectedRadio(buttonGroup) {
	if (buttonGroup[0]) {
		for (var i=0; i<buttonGroup.length; i++) {
			if (buttonGroup[i].checked) {
				return i
			}
		}
	} 
	else {
		if (buttonGroup.checked) { 
			return 0; 
		}
	}
	return -1;
}

function getMultiple(ob)
{ 
	var arSelected = new Array();
	var i = 0; 
	try {			
		for (i = 0; i < ob.length; i++) {
			if (ob[i].checked) {
				arSelected.push(ob[i].value);
			}	
		}
	}
	catch(err){}

	return arSelected;
}

function getAndValidateDatabases(ob, interface){
	var databases = getMultiple(ob);

	if(databases == "") {
		bError+="Please select one or more databases.\n";
		return "-1";
	}

	var dbInputAry = databases;
	var dbList = "";

	for(var i=0;i<dbInputAry.length; i++) {
		var db = trim(dbInputAry[i]);
		if((dbList != "") || (interface != 'eds-live')) 
			dbList += "&db=";
		dbList += db;
	}

	return dbList;
}

function getAndValidateDatabase(ob){
	if(ob.checked) {
		var database = ob.value;
		return "&db=" + database;
	} 
	else {
		bError+="Please select a database.\n";
		return "-1";
	}
}

function getAndValidateSubjects(ob){
	var databases = getMultiple(ob);

	if(databases == "") {
		bError+="Please select one or more database groups.\n";
		return "-1";
	}

	var dbInputAry = databases;
	var dbList = "";

	for(var i=0;i<dbInputAry.length; i++) {
		var db = trim(dbInputAry[i]);
		if(dbList != "") 
			dbList += "&dbgroup=";
		dbList += db;
	}

	return dbList;
}

function getAndValidateSubject(ob){	
	if(ob.checked) {
		var database = ob.value;
		return database;
	} 
	else {
		bError+="Please select a database group.\n";
		return "-1";
	}
}

function getSelectedDatabases(ob,src){
 var databases = getMultiple(ob)
 if(databases == "") {
	 bError="Please select one or more databases.\n";
	 return -1;
 }
 var dbInputAry = databases;
 var dbList = "";
 for(var i=0;i<dbInputAry.length; i++) {
 	 var db = dbInputAry[i];
	 dbList += "&" + src + "=" + db;
 }
 return dbList;
}


function setSelectedIndex(s, v) {
	for ( var i = 0; i < s.options.length; i++ ) {
		if ( s.options[i].value == v ) {
			s.options[i].selected = true;
			return;
		}
	}
}

function ebscoHostSearchParse(ebscohostsearchtext,ebscohostsearchmode) {
 var sT=ebscohostsearchtext.match(/(\(|\)|[^"^\s^)]+)\s*|"([^"]+)"\s*/gi); var sQ=''; var bP=0; var fP=0; var nP=0;
 for(var i = 0;i<sT.length;i++) { sT[i]=sT[i].replace(/\s+$/,""); switch (sT[i].toUpperCase()) {
 case 'TX': case 'AU': case 'TI': case 'SU': case 'SO': case 'IS': if (sQ.length>nP) if (bP==0) sQ+=ebscohostsearchmode; if (fP==1) sQ+=sT[i]+'\+AND\+'; else if (fP==2) sQ+=sT[i]+'\+'; else sQ+=sT[i]+'\+(\+'; if (fP!=2) fP=1; bP=1; break;
 case 'AA': case 'AB': case 'AC': case 'AD': case 'AE': case 'AF': case 'AG': case 'AI': case 'AK': case 'AL': case 'AM': case 'AN': case 'AO': case 'AP': case 'AR': case 'AS': case 'AT': case 'AV': case 'AW': case 'AZ': case 'BA': case 'BC': case 'BD': case 'BK': case 'BM': case 'BN': case 'BP': case 'BR': case 'BS': case 'BT': case 'CA': case 'CB': case 'CC': case 'CD': case 'CE': case 'CF': case 'CH': case 'CI': case 'CL': case 'CM': case 'CN': case 'CO': case 'CP': case 'CR': case 'CS': case 'CT': case 'CU': case 'CX': case 'CY': case 'DB': case 'DC': case 'DD': case 'DE': case 'DF': case 'DG': case 'DI': case 'DM': case 'DN': case 'DO': case 'DP': case 'DR': case 'DS': case 'DT': case 'DU': case 'DX': case 'EB': case 'EC': case 'ED': case 'EF': case 'EG': case 'EL': case 'EM': case 'EN': case 'ER': case 'ES': case 'ET': case 'EV': case 'FA': case 'FC': case 'FD': case 'FF': case 'FG': case 'FI': case 'FK': case 'FL': case 'FM': case 'FQ': case 'FR': case 'FS': case 'FT': case 'GB': case 'GC': case 'GD': case 'GE': case 'GI': case 'GL': case 'GN': case 'GR': case 'GS': case 'GT': case 'GV': case 'HC': case 'HJ': case 'HS': case 'HT': case 'HY': case 'IA': case 'IB': case 'IC': case 'ID': case 'II': case 'IM': case 'IN': case 'IP': case 'IR': case 'IV': case 'JI': case 'JN': case 'JS': case 'JT': case 'KK': case 'KT': case 'KW': case 'KY': case 'LA': case 'LB': case 'LC': case 'LE': case 'LG': case 'LH': case 'LI': case 'LL': case 'LN': case 'LS': case 'LT': case 'LV': case 'LW': case 'LY': case 'MA': case 'MB': case 'MC': case 'MD': case 'ME': case 'MF': case 'MH': case 'MI': case 'MJ': case 'MM': case 'MN': case 'MO': case 'MP': case 'MQ': case 'MR': case 'MS': case 'MT': case 'MV': case 'MW': case 'NA': case 'NB': case 'NC': case 'ND': case 'NE': case 'NF': case 'NI': case 'NM': case 'NN': case 'NO': case 'NP': case 'NR': case 'NS': case 'NT': case 'NU': case 'OA': case 'OC': case 'OD': case 'OG': case 'OL': case 'OP': case 'OS': case 'OT': case 'PA': case 'PB': case 'PC': case 'PD': case 'PE': case 'PG': case 'PH': case 'PI': case 'PL': case 'PM': case 'PN': case 'PO': case 'PP': case 'PR': case 'PS': case 'PT': case 'PU': case 'PY': case 'PZ': case 'QT': case 'RA': case 'RC': case 'RD': case 'RE': case 'RF': case 'RJ': case 'RL': case 'RN': case 'RO': case 'RP': case 'RR': case 'RS': case 'RT': case 'RV': case 'RW': case 'SA': case 'SB': case 'SC': case 'SD': case 'SE': case 'SG': case 'SH': case 'SI': case 'SJ': case 'SK': case 'SL': case 'SM': case 'SN': case 'SP': case 'SQ': case 'SS': case 'ST': case 'SX': case 'SY': case 'TA': case 'TC': case 'TD': case 'TH': case 'TK': case 'TL': case 'TM': case 'TN': case 'TP': case 'TR': case 'TS': case 'TT': case 'TU': case 'TY': case 'UC': case 'UD': case 'UI': case 'UP': case 'UR': case 'UT': case 'VC': case 'VI': case 'VS': case 'VT': case 'XN': case 'XY': case 'YR': case 'ZL': case 'AA1': case 'AG1': case 'AG2': case 'AG3': case 'AG4': case 'CC4': case 'CE3': case 'CE5': case 'CI2': case 'DE3': case 'DT1': case 'EB1': case 'EC1': case 'EC2': case 'EC3': case 'FC3': case 'FC5': case 'FM3': case 'GN1': case 'GN3': case 'GR2': case 'JN1': case 'LA1': case 'LA10': case 'LA14': case 'LA20': case 'LA5': case 'LA6': case 'LV4': case 'LX': case 'LX1': case 'LX10': case 'LX11': case 'LX12': case 'LX5': case 'LX6': case 'LX9': case 'MH1': case 'MX1': case 'PB1': case 'PF1': case 'PG1': case 'PG4': case 'PT1': case 'PT10': case 'PT100': case 'PT102': case 'PT103': case 'PT11': case 'PT12': case 'PT15': case 'PT16': case 'PT2': case 'PT35': case 'PT61': case 'PT68': case 'PT69': case 'PT70': case 'PT71': case 'PT78': case 'PT79': case 'PT80': case 'PT81': case 'PT82': case 'PT83': case 'PT88': case 'PZ1': case 'PZ26': case 'PZ7': case 'PZ8': case 'PZ9': case 'QL1': case 'SB1': case 'SB8': case 'SC2': case 'SC3': case 'SE5': case 'SL1': case 'SU1': case 'SX1': case 'TL2': case 'TS1': case 'TW': case 'TY2': if (sQ.length>nP) if (bP==0) sQ+=ebscohostsearchmode; if (fP==1) sQ+=sT[i]+ebscohostsearchmode; else if (fP==2) sQ+=sT[i]+'\+'; else sQ+=sT[i]+'\+'; if (fP!=1) fP=2; bP=1; break;
 case '(': if (sQ.length>nP && bP==0) { if (fP!=2) sQ+=ebscohostsearchmode; else sQ+='\+'; } if (fP!=1) sQ+='(\+'; bP=1; nP+=1; break; 
 case ')': sQ+='\+)'; if(fP==1) sQ+='\+)'; bP=1; fP=0; nP-=1; break;
 case 'AND': case 'OR': case 'NOT': if (sQ.length>nP && fP==1 && nP<1) sQ+='\+)'; sQ+='\+'+sT[i].toUpperCase()+'\+'; bP=1; fP=0; break;
 case '&': case '+': break;
 default: if (sT[i].toLowerCase().search(/^w([01]?\d\d?|2[0-4]\d|25[0-5])$/)!=-1||sT[i].toLowerCase().search(/^n([01]?\d\d?|2[0-4]\d|25[0-5])$/)!=-1) { sQ+='\+'+sT[i]+'\+'; bP=1; break; } else { if (sQ.length>nP && bP==0) { if (fP!=2) sQ+=ebscohostsearchmode; else sQ+='\+'; } sT[i]=sT[i].replace(/\+/g,"%2b"); sQ+=sT[i]; bP=0; } } }
 if (fP==1) sQ+='\+)'; sQ=sQ.replace(/\"/g,"%22"); sQ=sQ.replace(/ /g,"+"); sQ=sQ.replace(/,/g,"%2c"); sQ=sQ.replace(/&/g,"%26"); return sQ;
}

function updateLayout(newTitle, newLogo, newHeight, newWidth) {
	findObj('txtTitle').value = newTitle;
	findObj('txtLogo').value = newLogo;
	findObj('txtHeight').value = newHeight;
	findObj('txtWidth').value = newWidth;
}

function getQuerystring(key, default_)
{
	if (default_==null) 
		default_="";
	key = key.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
	var regex = new RegExp("[\\?&]"+key+"=([^&#]*)");
	var qs = regex.exec(window.location.href);
	
	if(qs == null) 
		return default_;
	else 
		return qs[1];
} 

/* Changes visible divs on the SBB index page depending on the interface selected */
function loadInterface(inputSelect)
{	
	/* Hides limiters and ehis by default */	
	displayBlock('searchehisdatabases',1);
	displayBlock('eds-liv_limiters',1);
	displayBlock('ehost-liv_limiters',1);	

	var radSearchBoolean = findObj('radSearchBoolean');
	if (radSearchBoolean) {
            radSearchBoolean.checked = true;
  	}
	var chkAvailInLibCollection = findObj('chkAvailInLibCollection');
	if (chkAvailInLibCollection) {
            chkAvailInLibCollection.checked = false;
  	}

	//show non ehost radio buttons
	displayBlock('step1main',0);
	
	/* When interface is selected... */
	switch (inputSelect) {
	case 'brc-live':
		setSelectedIndex(findObj('txtInterface'),'brc-live');
		displayBlock(inputSelect,0);
		displayBlock("preview_brc-live",0);
		selectStyle('m_brc-live');
		break;
	case 'bbs-live':
		setSelectedIndex(findObj('txtInterface'),'bbs-live');
		displayBlock(inputSelect,0);
		displayBlock("preview_bbs-live",0);
		selectStyle('m_bbs-live');
		break;
	case 'bsi-live':
	case 'bsi-live_bth':
		setSelectedIndex(findObj('txtInterface'),'bsi-live')
		findObj('txtDb_bsi-live')[0].checked = true;
		displayBlock('bsi-live',0);
		displayBlock("preview_bsi-live_bth",0);
		selectStyle('m_bsi-live_bth');
		break;
	case 'bsi-live_bch':
		setSelectedIndex(findObj('txtInterface'),'bsi-live')
		findObj('txtDb_bsi-live')[1].checked = true;
		displayBlock('bsi-live',0);
		displayBlock("preview_bsi-live_bch",0);
		selectStyle('m_bsi-live_bch');
		break;
	case 'bsi-live_buh':
		setSelectedIndex(findObj('txtInterface'),'bsi-live')
		findObj('txtDb_bsi-live')[2].checked = true;
		displayBlock('bsi-live',0);
		displayBlock("preview_bsi-live_buh",0);
		selectStyle('m_bsi-live_buh');
		break;
	case 'bsi-live_bah':
		setSelectedIndex(findObj('txtInterface'),'bsi-live')
		findObj('txtDb_bsi-live')[3].checked = true;
		displayBlock('bsi-live',0);
		displayBlock("preview_bsi-live_buh",0);
		selectStyle('m_bsi-live_buh');
		break;
	case 'chc-live':
		setSelectedIndex(findObj('txtInterface'),'chc-live');
		displayBlock(inputSelect,0);
		displayBlock("preview_chc-live",0);
		selectStyle('m_chc-live');
		break;	
	case 'eds-live':
		setSelectedIndex(findObj('txtInterface'),'eds-live');
		displayBlock(inputSelect,0);
	        
		/* setting default search mode */
		var myRad = findObj('radSearchAll');
	        if (myRad) {
		    myRad.checked = true;
	        }

		/* setting Available in Lib Collection limiter on by default */
		var chkLibCollection = findObj('chkAvailInLibCollection');
		if (chkLibCollection) {
		    chkLibCollection.checked = true;
		}

		displayBlock('eds-liv_limiters',0);
		displayBlock('preview_eds-live',0);
		selectStyle('m_eds-live');
		break;
	case 'ell-live':
		setSelectedIndex(findObj('txtInterface'),'ell-live');
		displayBlock(inputSelect,0);
		displayBlock("preview_ell-live",0);
		selectStyle('m_ell-live');
		break;
	case 'hrc-live':
		setSelectedIndex(findObj('txtInterface'),'hrc-live');
		displayBlock(inputSelect,0);
		displayBlock("preview_hrc-live",0);
		selectStyle('m_hrc-live');
		break;
	case 'hcrc-live':
		setSelectedIndex(findObj('txtInterface'),'hcrc-live');
		displayBlock(inputSelect,0);
		displayBlock("preview_hcrc-live",0);
		selectStyle('m_hcrc-live');
		break;
	case 'hirc-live':
		setSelectedIndex(findObj('txtInterface'),'hirc-live');
		displayBlock(inputSelect,0);
		displayBlock("preview_hirc-live",0);
		selectStyle('m_hirc-live');
		break;
	case 'srck5-live':
		setSelectedIndex(findObj('txtInterface'),'srck5-live');
		displayBlock(inputSelect,0);
		displayBlock("preview_srck5-live",0);
		selectStyle('m_srck5-live');
		break;
	case 'lirc-live':
		setSelectedIndex(findObj('txtInterface'),'lirc-live');
		displayBlock(inputSelect,0);
		displayBlock("preview_lirc-live",0);
		selectStyle('m_lirc-live');
		break;
	case 'lrc-live':
		setSelectedIndex(findObj('txtInterface'),'lrc-live');
		displayBlock(inputSelect,0);
		displayBlock("preview_lrc-live",0);
		selectStyle('m_lrc-live');
		break;
	case 'novelist-live':
		setSelectedIndex(findObj('txtInterface'),'novelist-live');
		findObj('txtDb_novelist-live')[0].checked = true;
		displayBlock('novelist-live',0);
		displayBlock("preview_novelist-live",0);
		selectStyle('m_novelist-live');
		break;
	case 'novp-live':
		setSelectedIndex(findObj('txtInterface'),'novelist-live');
		findObj('txtDb_novelist-live')[1].checked = true;
		displayBlock('novelist-live',0);
		displayBlock("preview_novp-live",0);
		selectStyle('m_novp-live');
		break;
	case 'novelistk8-live':
		setSelectedIndex(findObj('txtInterface'),'novelist-live');
		findObj('txtDb_novelist-live')[2].checked = true;
		displayBlock('novelist-live',0);
		displayBlock("preview_novelistk8-live",0);
		selectStyle('m_novelistk8-live');
		break;
	case 'novpk8-live':
		setSelectedIndex(findObj('txtInterface'),'novelist-live');
		findObj('txtDb_novelist-live')[3].checked = true;
		displayBlock('novelist-live',0);
		displayBlock("preview_novpk8-live",0);
		selectStyle('m_novpk8-live');
		break;
	case 'nrc-live':
		setSelectedIndex(findObj('txtInterface'),'nrc-live');
		displayBlock(inputSelect,0);
		displayBlock("preview_nrc-live",0);
		selectStyle('m_nrc-live');
		break;
	case 'perc-live':
		setSelectedIndex(findObj('txtInterface'),'perc-live');
		displayBlock(inputSelect,0);
		displayBlock("preview_perc-live",0);
		selectStyle('m_perc-live');
		break;
	case 'pov-live':
		setSelectedIndex(findObj('txtInterface'),'pov-live');
		displayBlock(inputSelect,0);
		displayBlock("preview_pov-live",0);
		selectStyle('m_pov-live');
		break;
	case 'rrc-live':
		setSelectedIndex(findObj('txtInterface'),'rrc-live');
		displayBlock(inputSelect,0);
		displayBlock("preview_rrc-live",0);
		selectStyle('m_rrc-live');
		break;
	case 'scirc-live':
		setSelectedIndex(findObj('txtInterface'),'scirc-live');
		displayBlock(inputSelect,0);
		displayBlock("preview_scirc-live",0);
		selectStyle('m_scirc-live');
		break;
	case 'sas-live':
		setSelectedIndex(findObj('txtInterface'),'sas-live');
		displayBlock(inputSelect,0);
		displayBlock("preview_sas-live",0);
		selectStyle('m_sas-live');
		break;
	case 'sbrc-live':
		setSelectedIndex(findObj('txtInterface'),'sbrc-live');
		displayBlock(inputSelect,0);
		displayBlock("preview_sbrc-live",0);
		selectStyle('m_sbrc-live');
		break;
	case 'serrc-live':
		setSelectedIndex(findObj('txtInterface'),'serrc-live');
		displayBlock(inputSelect,0);
		displayBlock("preview_serrc-live",0);
		selectStyle('m_serrc-live');
		break;
	case 'slrc-live':
		setSelectedIndex(findObj('txtInterface'),'slrc-live');
		displayBlock(inputSelect,0);
		displayBlock("preview_slrc-live",0);
		selectStyle('m_slrc-live');
		break;
	case 'src-live':
		setSelectedIndex(findObj('txtInterface'),'src-live');
		displayBlock(inputSelect,0);
		displayBlock("preview_src-live",0);
		selectStyle('m_src-live');
		break;
	case 'swi-live':
		setSelectedIndex(findObj('txtInterface'),'swi-live');
		displayBlock(inputSelect,0);
		displayBlock("preview_swi-live",0);
		selectStyle('m_swi-live');
		break;
	/* Default is for Ehost Interface (for dropdown on SBB) */
	default:
		setSelectedIndex(findObj('txtInterface'),'ehost-live');
		displayBlock('step1search',0);
		displayBlock('step1main',1);
		displayBlock('searchdatabases',0);
		displayBlock('searchehisdatabases',0);
		displayBlock('searchsubjects',1)
		displayBlock('profileCredentials',1);
		displayBlock('ehost-live',0);
		displayBlock("ehost-liv_limiters",0);
		displayBlock("preview_ehost-live",0);
		selectStyle('Oversized');
	}
	updateChooseDatabases();
	SetFTSearch();
}

function load() {
	loadInterface(getQuerystring('site'));
	displayBlock('primaryContent',0);
}

/* This is used to populate the preview in Step 5, as well as the logo within the code generated. */
function selectStyle(inputSelect) {

	switch (inputSelect) {
	case 's_brc-live':
		updateLayout('Research databases', 'http://support.ebsco.com/images/logos/BioRef100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_brc-live':
		updateLayout('Research databases', 'http://support.ebsco.com/images/logos/BioRef150.gif', '75', '392')
		updatePreview()
 		break;	
	case 'l_brc-live':
		updateLayout('Research databases', 'http://support.ebsco.com/images/logos/BioRef200.gif', '100', '440')
		updatePreview();
		break;
	case 's_bbs-live':
		updateLayout('Research databases', 'http://support.ebsco.com/images/logos/bbs_100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_bbs-live':
		updateLayout('Research databases', 'http://support.ebsco.com/images/logos/bbs_150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_bbs-live':
		updateLayout('Research databases', 'http://support.ebsco.com/images/logos/bbs_200.gif', '100', '440')
		updatePreview();
		break;
	case 's_bsi-live_buh':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/bspremier100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_bsi-live_buh':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/bspremier150.gif', '75', '392')
		updatePreview()
		break;
	case 'l_bsi-live_buh':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/bspremier200.gif', '100', '440')
		updatePreview();
		break;
	case 's_bsi-live_bch':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/bscorporate100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_bsi-live_bch':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/bscorporate150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_bsi-live_bch':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/bscorporate200.gif', '100', '440')
		updatePreview();
		break;
	case 's_bsi-live_bth':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/bscomplete100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_bsi-live_bth':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/bscomplete150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_bsi-live_bth':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/bscomplete200.gif', '100', '440')
		updatePreview();
		break;
	case 's_chc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/consumerhealth100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_chc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/consumerhealth150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_chc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/consumerhealth200.gif', '100', '440')
		updatePreview();
		break;
	case 's_eds-live':
		updateLayout('Discovery Service', 'http://supportforms.epnet.com/eit/images/eds100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_eds-live':
		updateLayout('Discovery Service', 'http://supportforms.epnet.com/eit/images/eds150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_eds-live':
		updateLayout('Discovery Service', 'http://supportforms.epnet.com/eit/images/eds200.gif', '100', '440')
		updatePreview();
		break;
	case 's_ell-live':
		updateLayout('Research databases', 'http://support.ebsco.com/images/logos/ell100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_ell-live':
		updateLayout('Research databases', 'http://support.ebsco.com/images/logos/ell150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_ell-live':
		updateLayout('Research databases', 'http://support.ebsco.com/images/logos/ell200.gif', '100', '440')
		updatePreview();
		break;
	case 's_hrc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/hrc100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_hrc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/hrc150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_hrc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/hrc200.gif', '100', '440')
		updatePreview();
		break;
	case 's_hcrc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/hcrc100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_hcrc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/hcrc150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_hcrc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/hcrc200.gif', '100', '440')
		updatePreview();
		break;
	case 's_hirc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/hirc100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_hirc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/hirc150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_hirc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/hirc200.gif', '100', '440')
		updatePreview();
		break;
	case 's_srck5-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/kidssearch100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_srck5-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/kidssearch150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_srck5-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/kidssearch200.gif', '100', '440')
		updatePreview();
		break;
	case 's_lirc-live':
		updateLayout('Research databases', 'http://support.ebsco.com/images/logos/legalreference_webbutton_100X50.gif', '50', '340')
		updatePreview();
		break;
	case 'm_lirc-live':
		updateLayout('Research databases', 'http://support.ebsco.com/images/logos/legalreference_webbutton_150X75.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_lirc-live':
		updateLayout('Research databases', 'http://support.ebsco.com/images/logos/legalreference_webbutton_200X100.gif', '100', '440')
		updatePreview();
		break;
	case 's_lrc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/litreference100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_lrc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/litreference150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_lrc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/litreference200.gif', '100', '440')
		updatePreview();
		break;
	case 's_novelist-live':
		updateLayout('Find Your Next Book To Read:', 'http://www.ebscohost.com/customerSuccess/downloads/supports/novelist100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_novelist-live':
		updateLayout('Find Your Next Book To Read:', 'http://www.ebscohost.com/customerSuccess/downloads/supports/novelist150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_novelist-live':
		updateLayout('Find Your Next Book To Read:', 'http://www.ebscohost.com/customerSuccess/downloads/supports/novelist200.gif', '100', '440')
		updatePreview();
		break;
	case 's_novp-live':
		updateLayout('Find Your Next Book To Read:', 'http://www.ebscohost.com/customerSuccess/downloads/supports/novplus100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_novp-live':
		updateLayout('Find Your Next Book To Read:', 'http://www.ebscohost.com/customerSuccess/downloads/supports/novplus150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_novp-live':
		updateLayout('Find Your Next Book To Read:', 'http://www.ebscohost.com/customerSuccess/downloads/supports/novplus200.gif', '100', '440')
		updatePreview();
		break;
	case 's_novelistk8-live':
		updateLayout('Find Your Next Book To Read:', 'http://support.ebscohost.com/images/logos/novk8_100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_novelistk8-live':
		updateLayout('Find Your Next Book To Read:', 'http://support.ebscohost.com/images/logos/novk8_150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_novelistk8-live':
		updateLayout('Find Your Next Book To Read:', 'http://support.ebscohost.com/images/logos/novk8_200.gif', '100', '440')
		updatePreview();
		break;
	case 's_novpk8-live':
		updateLayout('Find Your Next Book To Read:', 'http://www.ebscohost.com/customerSuccess/downloads/supports/novk8plus100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_novpk8-live':
		updateLayout('Find Your Next Book To Read:', 'http://www.ebscohost.com/customerSuccess/downloads/supports/novk8plus150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_novpk8-live':
		updateLayout('Find Your Next Book To Read:', 'http://www.ebscohost.com/customerSuccess/downloads/supports/novk8plus200.gif', '100', '440')
		updatePreview();
		break;
	case 's_nrc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/nrc100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_nrc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/nrc150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_nrc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/nrc200.gif', '100', '440')
		updatePreview();
		break;
	case 's_perc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/perc100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_perc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/perc150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_perc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/perc200.gif', '100', '440')
		updatePreview();
		break;
	case 's_pov-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/pov100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_pov-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/pov150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_pov-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/pov200.gif', '100', '440')
		updatePreview();
		break;
	case 's_rrc-live':
		updateLayout('Research databases', 'http://support.ebscohost.com/images/logos/rrc100_webbutton.gif', '50', '340')
		updatePreview();
		break;
	case 'm_rrc-live':
		updateLayout('Research databases', 'http://support.ebscohost.com/images/logos/rrc150_webbutton.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_rrc-live':
		updateLayout('Research databases', 'http://support.ebscohost.com/images/logos/rrc200_webbutton.gif', '100', '440')
		updatePreview();
		break;
	case 's_scirc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/scireference100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_scirc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/scireference150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_scirc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/scireference200.gif', '100', '440')
		updatePreview();
		break;
	case 's_sas-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/searchasaurus100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_sas-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/searchasaurus150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_sas-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/searchasaurus200.gif', '100', '440')
		updatePreview();
		break;
	case 's_sbrc-live':
		updateLayout('Research databases', 'http://support.ebsco.com/images/logos/smallbusiness_webbutton_100X50.gif', '50', '340')
		updatePreview();
		break;
	case 'm_sbrc-live':
		updateLayout('Research databases', 'http://support.ebsco.com/images/logos/smallbusiness_webbutton_75X150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_sbrc-live':
		updateLayout('Research databases', 'http://support.ebsco.com/images/logos/smallbusiness_webbutton_100X200.gif', '100', '440')
		updatePreview();
		break;
	case 's_serrc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/serrc100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_serrc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/serrc150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_serrc-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/serrc200.gif', '100', '440')
		updatePreview();
		break;
	case 's_slrc-live':
		updateLayout('Research databases', 'http://support.ebsco.com/images/logos/referencialatina_webbutton_50X100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_slrc-live':
		updateLayout('Research databases', 'http://support.ebsco.com/images/logos/referencialatina_webbutton_75X150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_slrc-live':
		updateLayout('Research databases', 'http://support.ebsco.com/images/logos/referencialatina_webbutton_100X200.gif', '100', '440')
		updatePreview();
		break;		
	case 's_src-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/studentresearch100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_src-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/studentresearch150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_src-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/studentresearch200.gif', '100', '440')
		updatePreview();
		break;
	case 's_swi-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/ehost100.gif', '50', '340')
		updatePreview();
		break;
	case 'm_swi-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/ehost150.gif', '75', '392')
		updatePreview()
 		break;
	case 'l_swi-live':
		updateLayout('Research databases', 'http://www.ebscohost.com/customerSuccess/downloads/supports/ehost200.gif', '100', '440')
		updatePreview();
		break;
	case 'Oversized':
		updateLayout('Research databases', 'http://supportforms.epnet.com/eit/images/ebscohost.gif', '66', '375')
		updatePreview();
		break;
	case 'Large':
		updateLayout('Research databases', 'http://supportforms.epnet.com/eit/images/researchdatabases.gif', '66', '300')
		updatePreview();
		break;
	case 'Custom':
		updateLayout('Research databases', '', '50', '225')
		updatePreview();
		break;
	}
}

/* This function changes the style elements on the index page of SBB with the settings chosen above */
function updatePreview() {
	findObj('ebscohostsearchtitle').firstChild.data = findObj('txtTitle').value;
	findObj('ebscohostsearchbox').style.backgroundImage = "url('" + findObj('txtLogo').value + "')";
	findObj('ebscohostsearchbox').style.height = findObj('txtHeight').value + 'px';
	findObj('ebscohostsearchbox').style.width = findObj('txtWidth').value + 'px';
	var dbList = findObj('dbList');
	if (!_isEmpty(dbList))
		dbList.style.width = findObj('txtWidth').value + 'px';

	
	findObj('ebscohostsearchtitle').style.marginTop = (findObj('txtHeight').value-75)/2 + 'px';

	var paddingOffset = findObj('txtWidth').value - 225;

	if (paddingOffset < 0)
		paddingOffset = 0;

	findObj('ebscohostsearchfields').style.paddingLeft = paddingOffset + 'px';

	if (findObj('txtLogo').value == 'http://supportforms.epnet.com/eit/images/ebscohost.gif') {

		findObj('Oversized').className = 'selectStyle';
		findObj('Large').className = 'defaultStyle';
		findObj('Custom').className = 'defaultStyle';	

	} else if (findObj('txtLogo').value == 'http://supportforms.epnet.com/eit/images/researchdatabases.gif') {

		findObj('Oversized').className = 'defaultStyle';
		findObj('Large').className = 'selectStyle';
		findObj('Custom').className = 'defaultStyle';
	
	} else {
		findObj('Oversized').className = 'defaultStyle';
		findObj('Large').className = 'defaultStyle';
		findObj('Custom').className = 'selectStyle';	
	}
}

/* This function should be merged with the one above.  This creates the code outputted to into Step 6 of the Search Box Builder. */
function createSearchBox() {
	bError="";
	var databases;
	var iface;
	var selectedInterface;
	var searchsrc = "db";
	var protocol = "http";
	
	var aIsUseProfileInfo = getSelectedRadioValue(findObj('raddbprofilemain')) && getSelectedRadioValue(findObj('raddbprofilemain')) === 'dbprofile';
	var aIsEhostUseProfileInfo = getSelectedRadioValue(findObj('radSearch')) && getSelectedRadioValue(findObj('radSearch')) === 'dbprofile';

	/* Options set depending on iface */
	selectedInterface=findObj('txtInterface').value;
	switch (selectedInterface) {
	case 'brc-live':
		iface = 'brc-live';
		databases = getAndValidateDatabase(findObj('txtDb_brc-live'));
		break;
	case 'bbs-live':
		iface = 'bbs-live';
		databases = getAndValidateDatabase(findObj('txtDb_bbs-live'));
		break;
	case 'bsi-live_bth':
		iface = 'bsi-live';
		databases = getAndValidateDatabases(findObj('txtDb_bsi-live'), iface);
		var addDatabases = getAndValidateDatabases(findObj('txtDb_bsi-live-a'), iface);
		if (addDatabases == -1)	bError="";
		else databases = databases + "&db=" + addDatabases;
		break;
	case 'chc-live':
		iface = 'chc-live';
		databases = getAndValidateDatabase(findObj('txtDb_chc-live'));
		break;
	case 'eds-live':
		iface = 'eds-live';
		databases = '';
		break;
	case 'ehost-live':
		iface = 'ehost-live';
		searchsrc = getSelectedRadioValue(findObj('radSearch'));
		if (searchsrc == "db") databases = getAndValidateDatabases(findObj('txtDatabases'), iface);
		else if (adddbgroup==0 && !aIsEhostUseProfileInfo) bError+="Please add one or more database groups.\n";
		else if (adddbgroup==1) databases = getAndValidateSubject(findObj('txtSubjects'));
		else if (adddbgroup>1) databases = getAndValidateSubjects(findObj('txtSubjects'));
		break;
	case 'ell-live':
		iface = 'ell-live';
		databases = getAndValidateDatabase(findObj('txtDb_ell-live'));
		break;
	case 'hrc-live':
		iface = 'hrc-live';
		databases = getAndValidateDatabase(findObj('txtDb_hrc-live'));
		break;
	case 'hcrc-live':
		iface = 'hcrc-live';
		databases = getAndValidateDatabase(findObj('txtDb_hcrc-live'));
		break;
	case 'hirc-live':
		iface = 'hirc-live';
		databases = getAndValidateDatabase(findObj('txtDb_hirc-live'));
		break;
	case 'srck5-live':
		iface = 'srck5-live';
		databases = getAndValidateDatabases(findObj('txtDb_srck5-live'), iface);
		break;
	case 'lirc-live':
		iface = 'lirc-live';
		databases = getAndValidateDatabase(findObj('txtDb_lirc-live'));
		break;
	case 'lrc-live':
		iface = 'lrc-live';
		databases = getAndValidateDatabases(findObj('txtDb_lrc-live'), iface);
		break;
	case 'novelist-live':
		switch (getSelectedRadioValue(findObj('txtDb_novelist-live'))) {
		case 'noh':
			iface = 'novelist-live';
			databases = '&db=noh';
			break;
		case 'neh':
			iface = 'novp-live';
			databases = '&db=neh';
			break;
		case 'nnh':
			iface = 'novelistk8-live';
			databases = '&db=nnh';
			break;
		case 'njh':
			iface = 'novpk8-live';
			databases = '&db=njh';
			break;
		}
		break;
	case 'nrc-live':
		iface = 'nrc-live';
		databases = getAndValidateDatabases(findObj('txtDb_nrc-live'), iface);
		break;
	case 'perc-live':
		iface = 'perc-live';
		databases = getAndValidateDatabases(findObj('txtDb_perc-live'), iface);
		break;
	case 'pov-live':
		iface = 'pov-live';
		databases = getAndValidateDatabase(findObj('txtDb_pov-live'));
		break;
	case 'rrc-live':
		iface = 'rrc-live';
		databases = getAndValidateDatabases(findObj('txtDb_rrc-live'), iface);
		break;
	case 'scirc-live':
		iface = 'scirc-live';
		databases = getAndValidateDatabase(findObj('txtDb_scirc-live'));
		break;
	case 'sas-live':
		iface = 'sas-live';
		databases = getAndValidateDatabases(findObj('txtDb_sas-live'), iface);
		break;
	case 'sbrc-live':
		iface = 'sbrc-live';
		databases = getAndValidateDatabase(findObj('txtDb_sbrc-live'));
		break;
	case 'serrc-live':
		iface = 'serrc-live';
		databases = getAndValidateDatabase(findObj('txtDb_serrc-live'));
		break;
	case 'slrc-live':
		iface = 'slrc-live';
		databases = getAndValidateDatabase(findObj('txtDb_slrc-live'));
		break;
	case 'src-live':
		iface = 'src-live';
		databases = getAndValidateDatabases(findObj('txtDb_src-live'), iface);
		break;
	case 'swi-live':
		iface = 'swi-live';
		databases = getAndValidateDatabase(findObj('txtDb_swi-live'));
		break;
	}

	/* Add &db= to plinks into all ifaces except EDS, OR when the searchbox lets the user select multiple DBs (when previewChooseDatabases is not hidden) */
	if ((findObj('previewChooseDatabases').style.display=='block') || iface == 'eds-live') {
		databases = "";
	}
	else {
		// databases string contains the &db= querystring snippet we will add to the URL, so no need to change it here
		searchsrc = "url";
	}

	iface = "&site=" + iface;

	var searchmode = getSelectedRadioValue(findObj('radSearchMode'));
	var aSearchModeQstring = '&mode=';
	switch(searchmode) {
	case '+':
		aSearchModeQstring += 'bool';
		break;
	case '+AND+':
		aSearchModeQstring += 'and';
		break;
	case '+OR+':
		aSearchModeQstring += 'or';
		break;
	}

	/* Add limiters to plink code */
	var limiterCount = 0;
		
	var FullText = "";
	if($("#useFTLimiter").val()=="1") {
		FullText = "&cli" + limiterCount + "=FT&clv" + limiterCount + "=Y";
		limiterCount += 1;
	}
	var ReferencesAvailable = "";
	if(findObj('chkReferencesAvailable').checked) {
		ReferencesAvailable = "&cli" + limiterCount + "=FR&clv" + limiterCount + "=Y";
		limiterCount += 1;
	}
	var PeerReviewd = "";
	if((findObj('chkPeerReviewed').checked) || (findObj('chkPeerReviewed1').checked)) {
		PeerReviewd = "&cli" + limiterCount + "=RV&clv" + limiterCount + "=Y";
		limiterCount += 1;
	}
	var AvailLibColl = "";
	if(findObj('chkAvailInLibCollection').checked) {
		AvailLibColl = "&cli" + limiterCount + "=FT1&clv" + limiterCount + "=Y";
		limiterCount += 1;
	}
	
	var proxy = "";
	if(isUrl(findObj('txtProxyPrefix').value))
		proxy = findObj('txtProxyPrefix').value;
	else if (findObj('txtProxyPrefix').value.length!=0)
		bError += "Please enter a valid proxy URL.\n";

	/* Add Authentication Information */
	var authType = "";

	if(findObj('chkCookie').checked)
		authType += "cookie";

	if(findObj('chkIp').checked) {
		if (authType != "")
			authType += ",";
		authType += "ip";
	}
	
	if(findObj('chkGuest').checked) {
		if(!aIsUseProfileInfo && !aIsEhostUseProfileInfo) {
			bError += "Please enter credentials under Profiles if using Guest Access.\n";
		}
		if (authType != "")
			authType += ",";
		authType += "guest";
	}
	
	var profileId="";
	//var profileId=jQuery.trim($("#profileId").val());
	//profileId=profileId.length===0?"":"&profile="+profileId;	

	/* Add CustID's for any authentication methods that require one */
	if(getSelectedRadioValue(findObj('radAuthMethod'))) {
		if (authType != "")
			authType += ","
		authType += getSelectedRadioValue(findObj('radAuthMethod'));

		if (getSelectedRadioValue(findObj('radAuthMethod')) == "custuid" || getSelectedRadioValue(findObj('radAuthMethod')) == "cpid") {

			var authCustID = trim(findObj('txtCustID').value);
			if (authCustID=="") {
					if (getSelectedRadioValue(findObj('radAuthMethod')) == "custuid")
						bError += "Patron ID requires your Cust ID to authenticate.\n";
					else if (getSelectedRadioValue(findObj('radAuthMethod')) == "cpid")
						bError += "Patterned ID requires your Cust ID to authenticate.\n";
			} else {
				authType += "&custid=" + authCustID;
			}
		}
	}
	if (authType != "") authType = "&authtype=" + authType;

	var logo = "";
	if(isUrl(findObj('txtLogo').value))
		logo = "background-Image:url(\'" + findObj("txtLogo").value + "\');background-repeat:no-repeat;";
	else if (findObj('txtLogo').value!=0)
		bError += "Please enter a valid logo URL.\n";

	if(findObj('chkSSL').checked)
		protocol="https";
		
	// If profiles selected (for Ehost or other interfaces), use that information instead of what is in databases
	var aProfCustId,aProfGroupId,aProfId = '';	
	if((aIsUseProfileInfo || aIsEhostUseProfileInfo) && findObj('profileCredentials') && findObj('profileCredentials').style.display !== 'none') {
		if(findObj('customerId').value && findObj('groupId').value && findObj('profileId').value) {
			aProfCustId = findObj('customerId').value;
			aProfGroupId = findObj('groupId').value;
			aProfId = findObj('profileId').value;
			databases = "&custid=" + aProfCustId + "&groupid=" + aProfGroupId + "&profid=" + aProfId;
		}
		else {
			bError += "Please enter IDs for all fields in Profiles.\n";
		}
	}

	/* Actually constructing the URL for the code output box */
	if (bError == "") {		
		var searchType = (selectedInterface.indexOf("eds")===0)?0:1;
		var url = proxy + protocol + "://search.ebscohost.com/login.aspx?direct=true" + iface + "&scope=site&type="+searchType+databases+aSearchModeQstring+FullText+ReferencesAvailable+PeerReviewd+AvailLibColl+authType+profileId;
		
		if(findObj('chkSSL').checked)
			url+= "&ssl=Y";
		
		var paddingOffset = findObj('txtWidth').value - 225;
		if (paddingOffset < 0)
			paddingOffset = 0;

		var resultWindow;
		if (findObj('chkResults').checked)
			resultWindow = 1;
		else
			resultWindow = 0;

		var Keywords = trim(findObj('txtKeywords').value);

		var searchBoxCode = '<!'+'-- EBSCOhost Custom Search Box Begins --'+'>\n' +		
			'<script src=\"http://supportforms.epnet.com/eit/scripts/ebscohostsearch.js" type=\"text\/javascript\"></script>\n';				

		if (findObj('previewChooseDatabases').style.display=='block')
		{
			searchBoxCode += '<style type=\"text/css\">\n' +
				'.choose-db-list{ list-style-type:none;padding:0;margin:10px 0 0 0;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:9pt;width:'+ findObj('txtWidth').value +'px; }\n' +
				'.choose-db-check{ width:20px;float:left;padding-left:5px;padding-top:5px; }\n' +
				'.choose-db-detail{ margin-left:30px;border-left:solid 1px #E7E7E7;padding:5px 11px 7px 11px;line-height:1.4em; }\n' +
				'.summary { background-color:#1D5DA7;color:#FFFFFF;border:solid 1px #1D5DA7; }\n' +
				'.one { background-color: #FFFFFF;border:solid 1px #E7E7E7;border-top:solid 1px #FFFFFF; }\n' +
				'.two { background-color: #F5F5F5;border:solid 1px #E7E7E7;border-top:solid 1px #FFFFFF; }\n' +
				'.selected { background-color: #E0EFF7;border:solid 1px #E7E7E7;border-top:solid 1px #FFFFFF; }\n' +
				'</style>\n';
		}
		var fullTextMarkup = "";
		if ($("#useFTLimiter").val()!="1" && $("#chkShowFT").is(":checked"))
		{	
			fullTextMarkup = '\t\t\t<div id="includeFT">\n'
						   + '\t\t\t\t<input type="checkbox" id="chkFullText" name="chkFullText" style="margin-left:0px;"/>'
						   + '<label for="chkFullText">Full Text</label>\n'
						   + '\t\t\t</div>\n';
		}
		

		searchBoxCode += '<form action="" onsubmit="return ebscoHostSearchGo(this);" method="post">\n' +
			'<input id="ebscohostwindow" name="ebscohostwindow" type="hidden" value="' + resultWindow + '" />\n' +
			'<input id="ebscohosturl" name="ebscohosturl" type="hidden" value="' + url + '" />\n' +
			'<input id="ebscohostsearchsrc" name="ebscohostsearchsrc" type="hidden" value="' + searchsrc + '" />\n' +
			'<input id="ebscohostsearchmode" name="ebscohostsearchmode" type="hidden" value="' + searchmode + '" />\n' +
			'<input id="ebscohostkeywords" name="ebscohostkeywords" type="hidden" value="' + Keywords + '" />\n' +
			'<div style="' + logo + 'height:' + findObj('txtHeight').value + 'px;width:' + findObj('txtWidth').value + 'px;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:9pt;font-weight:bold;color:#353535;">\n' +
			'\t<div style="padding-top:5px;padding-left:' + paddingOffset + 'px;">\n' +
			'\t\t<span style="font-weight:bold;">' + findObj('txtTitle').value + '</span>\n' +
			'\t\t<div>\n' +
			'\t\t\t<input id="ebscohostsearchtext" name="ebscohostsearchtext" type="text" size="23" style="font-size:9pt;padding-left:5px;margin-left:0px;" />\n' +			
			'\t\t\t<input type="submit" value="Search" style="font-size:9pt;padding-left:5px;" />\n' +
			fullTextMarkup +
			'\t\t</div>\n' +
			'\t</div>\n' +
			'</div>\n';

		if (findObj('previewChooseDatabases').style.display=='block')
		{
			var linkurl = proxy + protocol + "://search.ebscohost.com/login.aspx?direct=true" + iface + "&scope=site" + ReferencesAvailable + PeerReviewd + AvailLibColl + authType + profileId;
			var linkResultWindow = ""; if (resultWindow == 1) linkResultWindow = ' target=\"_blank\"';
			var selectedCheckAll = ""; if (findObj('cball').checked) selectedCheckAll = " checked";

			searchBoxCode += '<div style=\"position:absolute;width:auto;\">\n' +
				'<ul class=\"choose-db-list\">\n' +
				'<li class=\"summary\">\n' +
				'	<span class=\"choose-db-check\" title=\"Select / deselect all\">\n' +
				'		<input type=\"checkbox\" onclick=\"SelectAllCheckBoxes(this);\" name=\"cball\" id=\"cball\"' + selectedCheckAll + '>\n' +
				'	</span>\n' +
				'	<div class=\"choose-db-detail\">\n' +
				'		 <span style=\"font-weight:bold;color:#FFFFFF;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:9pt;\"> Select / deselect all</a></span>\n' +
				'	</div>\n' +
				'</li>';

			if (getSelectedRadioValue(findObj('radSearch')) == "dbgroup") {
				var dbInputAry = getMultiple(findObj('txtSubjects'));
				for(var i=0;i<dbInputAry.length; i++) {
					var iCount = (i % 2) ? 'two' : 'one';
					if((getMultiple(findObj('cbs')).indexOf(dbInputAry[i]))>-1) {
						searchBoxCode += '<li id=\"tr' + (i+1) + '\" class=\"selected\">\n' +
							'	<span class=\"choose-db-check\" title=\"' + trim(findObj('dbgroup'+dbInputAry[i]).parentNode.childNodes[1].nodeValue) + '\">\n' +
							'		<input type=\"checkbox\" id=\"cb' + (i+1) + '\" name=\"cbs\" value=\"' + dbInputAry[i] + '\" onclick=\"highlight(\'tr' + (i+1) + '\',\'' + iCount +'\',this.id);\" checked>\n' +
							'	</span>\n' +
							'	<div class=\"choose-db-detail\">\n' +
							'		<a href=\"' + linkurl + '&' + getSelectedRadioValue(findObj('radSearch')) + '=' + dbInputAry[i] + '\"' + linkResultWindow + '>' + trim(findObj('dbgroup'+dbInputAry[i]).parentNode.childNodes[1].nodeValue) + '</a>\n' +
							'	</div>\n' +
							'</li>';
					} else {
						searchBoxCode += '<li id=\"tr' + (i+1) + '\" class=\"' + iCount + '\">\n' +
							'	<span class=\"choose-db-check\" title=\"' + trim(findObj('dbgroup'+dbInputAry[i]).parentNode.childNodes[1].nodeValue) + '\">\n' +
							'		<input type=\"checkbox\" id=\"cb' + (i+1) + '\" name=\"cbs\" value=\"' + dbInputAry[i] + '\" onclick=\"highlight(\'tr' + (i+1) + '\',\'' + iCount +'\',this.id);\">\n' +
							'	</span>\n' +
							'	<div class=\"choose-db-detail\">\n' +
							'		<a href=\"' + linkurl + '&' + getSelectedRadioValue(findObj('radSearch')) + '=' + dbInputAry[i] + '\"' + linkResultWindow + '>' + trim(findObj('dbgroup'+dbInputAry[i]).parentNode.childNodes[1].nodeValue) + '</a>\n' +
							'	</div>\n' +
							'</li>';
					}				
				}
			} else  {
				var dbInputAry = getMultiple(findObj('txtDatabases'));

				for(var i=0;i<dbInputAry.length; i++) {
					var iCount = (i % 2) ? 'two' : 'one';
					if((getMultiple(findObj('cbs')).indexOf(dbInputAry[i]))>-1) {
						searchBoxCode += '<li id=\"tr' + (i+1) + '\" class=\"selected\">\n' +
							'	<span class=\"choose-db-check\" title=\"' + trim(findObj(dbInputAry[i]).parentNode.childNodes[1].nodeValue) + '\">\n' +
							'		<input type=\"checkbox\" id=\"cb' + (i+1) + '\" name=\"cbs\" value=\"' + dbInputAry[i] + '\" onclick=\"highlight(\'tr' + (i+1) + '\',\'' + iCount +'\',this.id);\" checked>\n' +
							'	</span>\n' +
							'	<div class=\"choose-db-detail\">\n' +
							'		<a href=\"' + linkurl + '&' + getSelectedRadioValue(findObj('radSearch')) + '=' + dbInputAry[i] + '\"' + linkResultWindow + '>' + trim(findObj(dbInputAry[i]).parentNode.childNodes[1].nodeValue) + '</a>\n' +
							'	</div>\n' +
							'</li>';
					} else {
						searchBoxCode += '<li id=\"tr' + (i+1) + '\" class=\"' + iCount + '\">\n' +
							'	<span class=\"choose-db-check\" title=\"' + trim(findObj(dbInputAry[i]).parentNode.childNodes[1].nodeValue) + '\">\n' +
							'		<input type=\"checkbox\" id=\"cb' + (i+1) + '\" name=\"cbs\" value=\"' + dbInputAry[i] + '\" onclick=\"highlight(\'tr' + (i+1) + '\',\'' + iCount +'\',this.id);\">\n' +
							'	</span>\n' +
							'	<div class=\"choose-db-detail\">\n' +
							'		<a href=\"' + linkurl + '&' + getSelectedRadioValue(findObj('radSearch')) + '=' + dbInputAry[i] + '\"' + linkResultWindow + '>' + trim(findObj(dbInputAry[i]).parentNode.childNodes[1].nodeValue) + '</a>\n' +
							'	</div>\n' +
							'</li>';
					}
				}
			}

			searchBoxCode += '\n</ul>\n' +
				'</div>\n';
		}

		searchBoxCode += '</form>\n' +
			'<!'+'-- EBSCOhost Custom Search Box Ends --'+'>';

		findObj('memoCode').value = searchBoxCode;
	} else {
		findObj('memoCode').value = bError;
	}
}

function selectInterface(inputSelect) {
	displayBlock("bbs-live",1);
	displayBlock("brc-live",1);
	displayBlock("bsi-live",1);
	displayBlock("chc-live",1);
	displayBlock("eds-live",1);
	displayBlock("ehost-live",1);
	displayBlock("ell-live",1);
	displayBlock("hrc-live",1);
	displayBlock("hcrc-live",1);
	displayBlock("hirc-live",1);
	displayBlock("srck5-live",1);
	displayBlock("lirc-live",1);
	displayBlock("lrc-live",1);
	displayBlock("novelist-live",1);
	displayBlock("nrc-live",1);
	displayBlock("perc-live",1);	
	displayBlock("pov-live",1);
	displayBlock("rrc-live",1);
	displayBlock("scirc-live",1);
	displayBlock("sas-live",1);
	displayBlock("sbrc-live",1);
	displayBlock("serrc-live",1);
	displayBlock("slrc-live",1);
	displayBlock("src-live",1);
	displayBlock("swi-live",1);

	displayBlock("step1search",1);
	displayBlock("step1main",1);
	displayBlock("searchdatabases",1);
	displayBlock("searchsubjects",1)
	displayBlock('profileCredentials',1);
	displayBlock("ehost-liv_limiters",1);

	displayBlock("preview_brc-live",1);
	displayBlock("preview_bbs-live",1);
	displayBlock("preview_bsi-live_buh",1);
	displayBlock("preview_bsi-live_bch",1);
	displayBlock("preview_bsi-live_bth",1);
	displayBlock("preview_chc-live",1);
	displayBlock("preview_eds-live",1);
	displayBlock("preview_ehost-live",1);
	displayBlock("preview_ell-live",1);
	displayBlock("preview_hrc-live",1);
	displayBlock("preview_hcrc-live",1);
	displayBlock("preview_hirc-live",1);
	displayBlock("preview_srck5-live",1);
	displayBlock("preview_lirc-live",1);
	displayBlock("preview_lrc-live",1);
	displayBlock("preview_novelist-live",1);
	displayBlock("preview_novp-live",1);
	displayBlock("preview_novelistk8-live",1);
	displayBlock("preview_novpk8-live",1);
	displayBlock("preview_nrc-live",1);
	displayBlock("preview_perc-live",1);
	displayBlock("preview_pov-live",1);
	displayBlock("preview_rrc-live",1);
	displayBlock("preview_scirc-live",1);
	displayBlock("preview_sas-live",1);
	displayBlock("preview_sbrc-live",1);
	displayBlock("preview_serrc-live",1);
	displayBlock("preview_slrc-live",1);
	displayBlock("preview_src-live",1);
	displayBlock("preview_swi-live",1);

	loadInterface(inputSelect);
}

function addDatabase() {
	var displayname = findObj('dbdisplayname').value + " ";
	var code = findObj('dbcode').value;
	var interface = findObj('txtInterface').value;

	if (displayname==" ") {
		alert("Please enter a database display name.");
		return;
	}

	if (code=="") {
		alert("Please enter a database code.");
		return;
	}

	var node = findObj(code);

	if (node != null) {
		node.parentNode.childNodes[1].nodeValue = displayname;
	} 
	else {
		var element = document.createElement('li');
		
		if (adddbcode == 0) {
			element.style.borderTop = "1px solid #CCCCCC";
			element.style.paddingTop = "4px";
		}

		var elementChild = document.createElement('label');
		elementChild.setAttribute('for', code);

		var elementChildChild;
		elementChildChild = document.createElement('input');
		elementChildChild.setAttribute('type', 'checkbox');
		elementChildChild.setAttribute('id', code);
		elementChildChild.setAttribute('value', code);
		
		if(interface == 'ehost-live')
			elementChildChild.setAttribute('name', 'txtDatabases');
		else
			elementChildChild.setAttribute('name', 'txtDb_eds-live');
		elementChildChild.setAttribute('onclick', 'updateChooseDatabases();');

		var eAnchor = document.createElement('span');
		eAnchor.style.color='#999999';

		eAnchor.appendChild(document.createTextNode('('+code+')'));

		elementChild.appendChild(elementChildChild);
		elementChild.appendChild(document.createTextNode(displayname));
		elementChild.appendChild(eAnchor);

		element.appendChild(elementChild);
		if(interface == 'ehost-live')
			findObj('ehost-live-databases').appendChild(element);
		else
			findObj('eds-live-dbs').appendChild(element);
	}

	findObj('dbdisplayname').value ="";
	findObj('dbcode').value ="";
	findObj(code).setAttribute('checked', 'checked');
	findObj(code).focus();
	adddbcode += 1;
	updateChooseDatabases();
}

function addSubject() {
	var displayname = "";
	displayname = findObj('subjectdisplayname').value + " ";	
	var code = findObj('subjectcode').value;

	if (displayname=="") {
		alert("Please enter a database group display name.");
		return;
	}

	if (code=="") {
		alert("Please enter a database group code.");
		return;
	}
	var node = findObj('dbgroup'+code);

	if (node != null) {
		node.parentNode.childNodes[1].nodeValue = displayname;
	} 
	else {
		var element = $("<li></li>");
		var elementChild = $("<label></label>").attr("for",'dbgroup'+code);
		var s = "<input type='checkbox' checked='checked' name='txtSubjects' id='dbgroup"+code+"' value='"+code+"' />";
		var input = $(s);
		
		input.bind("click", function(){updateChooseDatabases();});

		var eAnchor = $("<span></span>").attr("style","color:#999999").html("("+code+")");		
		$("#ehost-live-subjects").append(element.append(elementChild.append(input).append(displayname).append(eAnchor)));
	}

	findObj('subjectdisplayname').value ="";
	findObj('subjectcode').value = "";
	
	//findObj('dbgroup'+code).focus();
	adddbgroup++;
	updateChooseDatabases();
}

function getChildNode(cell)
{
	if (cell != null) {
		for (var i = 0, l = cell.childNodes.length; i < l; i++) {
			var child = cell.childNodes[i];
			if (child.nodeType === 1) {
				return child;
			}
		}
	}
}

function updateChooseDatabases()
{		
	if(findObj('txtInterface').value == 'ehost-live') {
		displayBlock('displayChooseDatabases',0);
		var id, iddesc, iObj;

		var cell = findObj('previewChooseDatabases');
		cell = getChildNode(cell);
		cell = getChildNode(cell);
	
		if ( cell.hasChildNodes() )
		{
	    while ( cell.childNodes.length >= 1 )
	    {
	        cell.removeChild( cell.firstChild );       
	    } 
		}

		if (getSelectedRadioValue(findObj('radSearch')) == "db") {
			id = 'txtDatabases';
			iddesc = '';
		} 
		else {
			id = 'txtSubjects';
			iddesc = 'dbgroup';
			if (adddbgroup == 0) 
				return;
		}

		var dbInputAry = getMultiple(findObj(id));

		iObj = dbInputAry.length;
		if (findObj('chkChooseDatabases').checked && iObj > 1) {
			displayInline('requireChooseDatabases',1);
			displayBlock('previewChooseDatabases',0);
		}
		else {
			if (iObj > 1) 
				displayInline('requireChooseDatabases',1);
			else 
				displayInline('requireChooseDatabases',0);
	
			displayBlock('previewChooseDatabases',1);
			return;
		}

		var protocol = "http";

		var proxy = "";
		if(isUrl(findObj('txtProxyPrefix').value))
			proxy = findObj('txtProxyPrefix').value;
		else if (findObj('txtProxyPrefix').value.length!=0)
			bError += "Please enter a valid proxy URL.\n";

		var authType = "";

		if(findObj('chkCookie').checked)
			authType += "cookie";

		if(findObj('chkIp').checked) {
			if (authType != "")
				authType += ",";
		
			authType += "ip";
		}
		
		if(findObj('chkGuest').checked) {
			if (authType != "")
				authType += ",";
		
			authType += "guest";
		}

		if(getSelectedRadioValue(findObj('radAuthMethod'))) {
			if (authType != "")
				authType += ",";
			authType += getSelectedRadioValue(findObj('radAuthMethod'));

			if (getSelectedRadioValue(findObj('radAuthMethod')) == "custuid" || getSelectedRadioValue(findObj('radAuthMethod')) == "cpid") {
				var authCustID = trim(findObj('txtCustID').value);
				if (authCustID=="") {
					if (getSelectedRadioValue(findObj('radAuthMethod')) == "custuid")
						bError += "Patron ID requires your Cust ID to authenticate.\n";
					else if (getSelectedRadioValue(findObj('radAuthMethod')) == "cpid")
						bError += "Patterned ID requires your Cust ID to authenticate.\n";
				} 
				else {
					authType += "&custid=" + authCustID;
				}
			}
		}
		
		if (authType != "") 
			authType = "&authtype=" + authType;
			
		var profileId="";
		//var profileId=jQuery.trim($("#profileId").val());
		//profileId=profileId.length===0?"":"&profile="+profileId;
			
		var linkurl = proxy + protocol + "://search.ebscohost.com/login.aspx?direct=true&scope=site&site=ehost-live" + authType + profileId;

		ChooseDatabaseHeader();

		for(var i=0;i<iObj; i++) {
			var iCount = (i % 2) ? 'two' : 'one';
			var elementChildChild2;
			
			elementChildChild2 = document.createElement('li');
			elementChildChild2.setAttribute('name', 'tr' + (i+1));
			elementChildChild2.setAttribute('id', 'tr' + (i+1));
			elementChildChild2.setAttribute('class', iCount);

			var elementChildChild31;

			elementChildChild31 = document.createElement('div');
			elementChildChild31.setAttribute('class', 'choose-db-check');
			elementChildChild31.setAttribute('title', trim(findObj(iddesc+dbInputAry[i]).parentNode.childNodes[1].nodeValue));

			var elementChildChild311;

			elementChildChild311 = document.createElement('input');
			elementChildChild311.setAttribute('type', 'checkbox');
			elementChildChild311.setAttribute('id', 'cb'+ (i+1));
			elementChildChild311.setAttribute('value', dbInputAry[i]);
			elementChildChild311.setAttribute('name', 'cbs');
			elementChildChild311.setAttribute('onclick', 'highlight(\"tr' + (i+1) + '\",\"' + iCount + '\",this.id);');

			var elementChildChild32;

			elementChildChild32 = document.createElement('div');
			elementChildChild32.setAttribute('class', 'choose-db-detail');

    	
			var elementChildChild321;

			elementChildChild321 = document.createElement('a');
			elementChildChild321.setAttribute('href', linkurl + '&' + getSelectedRadioValue(findObj('radSearch')) + '=' + dbInputAry[i]);
			if (findObj('chkResults').checked) 
				elementChildChild321.setAttribute('target', '_blank');
    	
			elementChildChild321.appendChild(document.createTextNode(trim(findObj(iddesc+dbInputAry[i]).parentNode.childNodes[1].nodeValue)));
			elementChildChild31.appendChild(elementChildChild311);
			elementChildChild32.appendChild(elementChildChild321);
			elementChildChild2.appendChild(elementChildChild31);
			elementChildChild2.appendChild(elementChildChild32);
	  	
			cell.appendChild(elementChildChild2);
		} 
	} 
	else {
		displayBlock('displayChooseDatabases',1);
		displayBlock('previewChooseDatabases',1);
	}
}

function ChooseDatabaseHeader() {
   
	var elementChildChild2;

	elementChildChild2 = document.createElement('li');
	elementChildChild2.setAttribute('class', 'summary');

	var elementChildChild31;

	elementChildChild31 = document.createElement('div');
	elementChildChild31.setAttribute('class', 'choose-db-check');
	elementChildChild31.setAttribute('title', 'Select / deselect all');

	var elementChildChild311;
	elementChildChild311 = document.createElement('input');
	elementChildChild311.setAttribute('type', 'checkbox');
	elementChildChild311.setAttribute('name', 'cball');
	elementChildChild311.setAttribute('id', 'cball');
    $(elementChildChild311).bind("click", function(){SelectAllCheckBoxes(this);});

	var elementChildChild32;
	elementChildChild32 = document.createElement('div');
	elementChildChild32.setAttribute('class', 'choose-db-detail');
	elementChildChild32.setAttribute('style', 'font-weight:bold;');

	var elementChildChild321;
	elementChildChild321 = document.createElement('span');
	elementChildChild321.appendChild(document.createTextNode('Select / deselect all'));
	
	elementChildChild31.appendChild(elementChildChild311);
	elementChildChild32.appendChild(elementChildChild321);
	elementChildChild2.appendChild(elementChildChild31);
	elementChildChild2.appendChild(elementChildChild32);

	var cell = findObj('previewChooseDatabases');
	cell = getChildNode(cell);
	cell = getChildNode(cell);

	cell.appendChild(elementChildChild2);
}

function resetForm(form)
{
	form.reset();
	displayBlock('CustIDField',1);

	if (adddbcode > 0) {	
		for(i = 0; i < form.txtDatabases.length; i++) {
			form.txtDatabases[i].checked = false;
		} 
	}
	
	if (adddbgroup > 0) {
		for(i = 0; i < form.txtSubjects.length; i++) {
			form.txtSubjects[i].checked = false;
		} 
	}
	
	selectInterface(getQuerystring('site'));
	return false;
}

function highlight(id, currentClass, checkboxId)
{
 var checkbox_element = findObj(checkboxId);
 var row_element = findObj(id);
 row_element.className = checkbox_element.checked ? 'selected' : currentClass;
 if(checkbox_element.checked==false) 
 	findObj('cball').checked=false;
}

function SelectAllCheckBoxes(e) {
    $("input[name='cbs']").each(function(){this.checked=e.checked;});
}

if (!Array.prototype.indexOf) {
  Array.prototype.indexOf = function(elt /*, from*/) {
    var len = this.length >>> 0;

    var from = Number(arguments[1]) || 0;
    from = (from < 0)
         ? Math.ceil(from)
         : Math.floor(from);
    if (from < 0)
      from += len;

    for (; from < len; from++) {
      if (from in this && this[from] === elt)
        return from;
    }
    return -1;
  };
}
function SetFTSearch(){	
	var isChecked = arguments.length==0?$("#chkShowFT").attr("checked"):arguments[0].checked;	
	if (isChecked) {
		$("#includeFT").show();
	}
	else {
		$("#chkFullText").removeAttr("checked");
		$("#includeFT").hide();		
	}		
}
function SetFTOptions(e) {
	if (e.checked) {
		$("#useFTLimiter").val(1);
		$("#displayFullText").hide();
		$("#chkShowFT").removeAttr("checked");
	}
	else {
		$("#useFTLimiter").val(0);
		$("#displayFullText").show();
	}
	
	SetFTSearch();
}

function showCurrentDbs() {
	//For non-ehost dbs, clicking the Database radio button reveals current interface's db selection, hides the profiles section
	var aCurrentInterface = findObj("txtInterface").value;
	//only interface in dropdown with different id than the db section is bsi-live
	if(aCurrentInterface === 'bsi-live_bth') {
		aCurrentInterface = 'bsi-live';
	}
	displayBlock(aCurrentInterface,0);
	displayBlock('profileCredentials',1);
	updateChooseDatabases();
}

function hideCurrentDbs() {
	//For non-ehost dbs, clicking the Profiles radio button shows the profile inputs and hides the current db selection
	var aCurrentInterface = findObj("txtInterface").value;
	//only interface in dropdown with different id than the db section is bsi-live
	if(aCurrentInterface === 'bsi-live_bth') {
		aCurrentInterface = 'bsi-live';
	}
	displayBlock('profileCredentials',0);
	displayBlock(aCurrentInterface,1);
	updateChooseDatabases();
}