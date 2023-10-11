function ebscoHostSearchGo(ebscohosturl) {
	document.location=ebscohosturl + document.getElementById("ebscohostsearch").value;
}


function handleKeyPress(e,form){
	var key=e.keyCode || e.which;
	if (key==13) {
		ebscoHostSearchGo();
	}
}