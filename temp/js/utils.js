//Helper function allows use of "$()" instead of "document.getElementById()"
function $(id) { return document.getElementById(id) }

//Create a centered popup window with the specified URL, width, and height
var popupWindow;
function popup(url, width, height) {
	x = Math.floor(screen.width/2) - (width/2)
	y = Math.floor(screen.height/2) - (height/2)
	popupWindow = window.open(url,'popupWindow','width='+width+',height='+height+',top='+y+',left='+x+',scrollbars=1')
	if (window.focus) {
		popupWindow.focus();
	}
	return false;
}

//Wire up "checkbox" to "target" so that enabling and disabling the checkbox 
//enables and disables the target element. If sameState is true, the target 
//should be enabled when the checkbox is checked. When sameState is false, the 
//target should be enabled when the checkbox is unchecked
function setUpToggle(checkbox, target, sameState) {
	if($(checkbox) && $(target)) {
		//Wire the onclick event to the target's state
		$(checkbox).onclick = function(e) { toggleField(target) }
		
		//Make sure that the target state initially matches the checkbox state
		if($(checkbox).checked != sameState)
			changeField(target,true,"disabled")
		else
			changeField(target,false,"")
	}
}

//This event handler toggles the input field with the specified id
function toggleField(id) {
	if($(id).className == "")
		changeField(id, true, "disabled", null)
	else
		changeField(id, false, null, "disabled")
}

function changeField(id, disabled, addClass, removeClass) {
	//Change this field
	changeFieldHelper($(id), disabled, addClass, removeClass)
	
	//Change all fields which are children of this field
	childFields = $(id).getElementsByTagName("input")
	for(i=0;i<childFields.length;i++)
		changeFieldHelper(childFields[i], disabled, addClass, removeClass)
}

//Change the field with the id specified disabled state and class name
function changeFieldHelper(el, disabled, addClass, removeClass) {
	//Add and remove classes
	if(addClass) { addClassName(el, addClass) }
	if(removeClass) { removeClassName(el, removeClass) }
	
	//If this element has a "disabled" property, set it
	if(el.disabled != null) { el.disabled = disabled }
	
	//If this element is a disabled input make sure its checkbox is
	//unchecked and its text is cleared if applicable
	if(el.disabled == true) {
		if(el.checked)
			el.checked = false
		if(el.type == "text")
			el.value = ""
	}
}

//Verify that at least one checkbox within id is checked
function verifyOneChecked(id) {
	if($(id)) {
		childFields = $(id).getElementsByTagName("input")
		for(i=0;i<childFields.length;i++)
			if(childFields[i].checked == true)
				return true
	}
	return false
}

//Add a class name to element "el"s list of class names
function addClassName(el, addClass) {
	list = trimAndSplit(el.className.replace(addClass,''))
	list[list.length] = addClass; 
	el.className = list.join(' ');
}

//Add a class name to element "el"s list of class names
function removeClassName(el, removeClass) {
	var list = trimAndSplit(el.className.replace(removeClass,''))
	el.className = list.join(' ');
}

//Trim whitespace from the front and back of str and split it on each space
function trimAndSplit(str) { return str.replace(/^\s*|\s*$/g,"").split(' ') }

//Build up the regex for a full email address
//(\w is any letter, number, or underscore)
emailTest = /^(\w|\.|\-)+\@((\w|\-)+\.)+(\w{2,3})$/

//Returns true if email is a valid address, false otherwise
function isValidEmail(email) { return emailTest.test(email) }
