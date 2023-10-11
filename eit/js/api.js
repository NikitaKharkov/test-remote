function showSect( section )
{
	$("#" + section).slideDown( 500 );
	$("#" + section + "Txt").html( '<a href="javascript: hideSect(\'' + section + '\')">Hide</a> | <a href="#top">Back to Top</a>' );
}

function hideSect( section )
{
	$("#" + section).slideUp( 500 );
	$("#" + section + "Txt").html( '<a href="javascript: showSect(\'' + section + '\')">Show</a> | <a href="#top">Back to Top</a>' );
}