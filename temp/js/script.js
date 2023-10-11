//Run this code when the page loads
window.onload = function() {
	//Only worry about form scripts if there's a form on this page
	if(document.getElementsByTagName("form")[0]) {
		//Attach some checkboxes to other fields, so when the checkbox 
		//changes state, that element toggles its enabled state also
		setUpToggle("allSections", "sections", false)
		setUpToggle("enableCC", "CC", true)			
	
		//Since some browsers don't allow hover on non-link elements, 
		//simulate it by adding and removing a "hover" CSS class to 
		//checkbox labels. Safari doesn't support clicking labels at 
		//all, so don't add onclick events for Safari
		if(navigator.userAgent.indexOf("Safari")==-1) {
			labels = document.getElementsByTagName("label")
			for(i=0;i<labels.length;i++)
				if(labels[i].className == "check") {
					//Allow for hover styling for labels in all browsers
					labels[i].onmouseover = function() { addClassName(this,"checkHover") }
					labels[i].onmouseout = function() { removeClassName(this,"checkHover") }
					
					//IE will move content by a pixel the first time a hover
					//occurs, so force it to do this on page load, that way
					//the user doesn't see it.
					addClassName(labels[i],"checkHover")
					removeClassName(labels[i],"checkHover")
				}
		}
	}
	
	//Set up links with class="popUp" as centered pop ups without toolbars
	links = document.getElementsByTagName('a')
	for(i=0;i<links.length;i++)
		if(links[i].className && links[i].className.indexOf('popUp')>-1)
			links[i].href = "javascript:void popup('"+links[i].href+"','650','500')";
}
