function popUp(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=1,statusbar=0,menubar=0,resizable=0,width=745,height=500,left=200,top=250');");
}
function popUpWilsonWeb(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=1,statusbar=0,menubar=0,resizable=0,width=714,height=487,left=200,top=250');");
}
function popUpNRC(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=1,statusbar=0,menubar=0,resizable=0,width=745,height=540,left=250,top=180');");
}
function popUpTutWide(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=1,statusbar=0,menubar=0,resizable=0,width=740,height=600,left=250,top=0');");
}
function popUpTuts(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=1,statusbar=0,menubar=0,resizable=0,width=660,height=620,left=250,top=0');");
}
function popUpTuts852(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=1,statusbar=0,menubar=0,resizable=0,width=852,height=480,left=250,top=0');");
}
function popUpTutsLg(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=1,statusbar=0,menubar=0,resizable=0,width=860,height=620,left=250,top=0');");
}
function popUpWide(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=1,statusbar=0,menubar=0,resizable=0,width=760,height=580,left=250,top=0');");
}
function popUpPodcast(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=250,height=10,left=550,top=430');");
}
function popUpEsp(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=1,statusbar=0,menubar=0,resizable=0,width=800,height=600');");
}
function popUpSizable(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=1,scrollbars=1,location=1,statusbar=1,menubar=1,resizable=1,width=800,height=600,left=150,top=100');");
}
function popUpZH(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=1,scrollbars=1,location=1,statusbar=1,menubar=1,resizable=1,width=1024,height=600,left=100,top=200');");
}
function popUpSurvey(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=650,height=650,left=500,top=400');");
}
function popUpThumb(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=533,left=500,top=300');");
}
function popUpIR(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=300,left=500,top=300');");
}

function check_page() {
	for (i=0; i<document.links.length; i++) {
		var obj = document.links[i];
		if (obj.href == "<?= server_address() . $_SERVER['PHP_SELF'] ?>" && (obj.parentNode.className == "columnnav")) {
			obj.setAttribute('class', 'highlight');
			obj.firstChild.src = "/images/bullet_columnnav_over.gif";
		}
		// Change the nav image for the current section to the over state - FLASH ALTERNATIVE ONLY
		if (obj.href.substring(0,obj.href.lastIndexOf("/")+1) == "<?= substr(server_address() . $_SERVER['PHP_SELF'], 0, strrpos(server_address() . $_SERVER['PHP_SELF'], "/")+1) ?>" && (obj.parentNode.id == "home_stage")) {
			var img = obj.firstChild.src;
			obj.firstChild.src = obj.firstChild.src.substring(0,img.length-4) + "_o.gif";
		} 
	}
	
	var links = document.getElementsByTagName('a');
	for(var i=0;i<links.length;i++) {
	var a = links[i];
	var c = a.className;
	
	if(c && c.indexOf('ExLink')>-1)
		a.href = "javascript:void window.open('"+a.href+"')";
		
	if(c && c.indexOf('DocLink')>-1 && navigator.appName.indexOf('Internet Explorer') > -1)
		a.href = "javascript:void window.open('"+a.href+"')";	

	}

	//if(typeof items_to_hide != 'undefined')
		//hide_items(items_to_hide);

	if (document.all && document.getElementById) {
	navRoot = document.getElementById("navtest");
	for (i=0; i<navRoot.childNodes.length; i++) {
  	node = navRoot.childNodes[i];
  	if (node.nodeName=="LI") {
  	node.onmouseover=function() {
  	this.className+=" over";
    	}
  	node.onmouseout=function() {
  	this.className=this.className.replace
      	(" over", "");
   	}
   	}
  	}
 	}
}

// Onmouseover and Onmouseout handlers - FLASH ALTERNATIVE ONLY
function ch_img(link) {
	var img = link.firstChild.src;
	
	// If the image being rolled isn't the "on" state for the current section
	if(link.href.substring(0,link.href.lastIndexOf("/")+1) != "<?= substr(server_address() . $_SERVER['PHP_SELF'], 0, strrpos(server_address() . $_SERVER['PHP_SELF'], "/")+1) ?>") {
		// If the _o image is being displayed right now, change it to the non _o image
		if(img.substring(img.length-6,img.length-4) == "_o") {
			link.firstChild.src = img.substring(0,img.length-6) + ".gif";
		} else {
			link.firstChild.src = img.substring(0,img.length-4) + "_o.gif";
		}
	}	
} 

function supportWin(){
	var targetWindow;
	
	targetWindow = window.open('http://supportforms.epnet.com/CustSupport/Customer/email_support.aspx', 'supportWindow', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=640,height=500');
	targetWindow.focus();
}

function hide_items(item_array) {
	for(i=0;i<item_array.length;i++) {
		item = document.getElementById(item_array[i]);
		
		childElements = 0;
		for(j=0;j<item.childNodes.length;j++)
			if(item.childNodes[j].nodeType==1)
				childElements++;
		
		if(childElements > 2)
			toggle_item(item_array[i]);
	}
}
	
function toggle_item(item_id)
{
	var item = document.getElementById(item_id);
    if(item.style.display != "none")
            item.style.display = "none";
    else
            item.style.display = "block";
}

function BothFieldsIdenticalCaseSensitive() {
var one = document.mailing_list.email.value;
var another = document.mailing_list.emailcf.value;
if(one == another) { return true; }
alert("please confirm email address");
return false;
}


function Validate() {
	
	if ((document.getElementById('1').checked) ||
	(document.getElementById('2').checked) ||
	(document.getElementById('3').checked) ||
	(document.getElementById('4').checked) || 
	(document.getElementById('5').checked) || 
	(document.getElementById('6').checked) ||
	(document.getElementById('7').checked) ||
	(document.getElementById('8').checked) ||
	(document.getElementById('9').checked) ||
	(document.getElementById('10').checked))
		
	{ return true;} else { alert('Please add Product'); return false; }
		 
  
}

function Other() {

if ((document.getElementById('10').checked)
   && (document.getElementById('other').value == '')) { alert('Please add Product'); return false; }
                                                     else { return true; }
}

function Scope() {
					if ((document.getElementById('1').checked) && (document.getElementById('scope1').value == '') ||
					(document.getElementById('2').checked) && (document.getElementById('scope2').value == '') ||
					(document.getElementById('3').checked) && (document.getElementById('scope3').value == '') ||
					(document.getElementById('4').checked) && (document.getElementById('scope4').value == '') ||
					(document.getElementById('5').checked) && (document.getElementById('scope5').value == '') ||
					(document.getElementById('6').checked) && (document.getElementById('scope6').value == '') ||
					(document.getElementById('7').checked) && (document.getElementById('scope7').value == '') ||
					(document.getElementById('8').checked) && (document.getElementById('scope8').value == '') ||
					(document.getElementById('9').checked) && (document.getElementById('scope9').value == '') ||
					(document.getElementById('10').checked) && (document.getElementById('scope10').value == ''))
					
						{ alert('Please add scope of maintenance'); return false; }
															else { return true; }
						}

