function loadHTML( url, id )
{
	var xhr = new XMLHttpRequest();
	
	xhr.onreadystatechange = function()
	{ 
		if( xhr.readyState == 4 )
		{
			document.getElementById( id ).innerHTML = xhr.responseText;
		} 
	}; 
	var r = Math.floor( Math.random()*1000 )
	url = url + '?' + r;
	
	xhr.open( "GET", url , true );
	xhr.send( null ); 
}

function loadHTML_str( str, id )
{
	document.getElementById( id ).innerHTML = str;
}

function toggle_display( id )
{
	obj = document.getElementById( id );
	if ( obj ) {
		obj.style.display = ( obj.style.display == "none" ) ? "block" : "none";
	}
}


function colorizeTable( tableName )
{
	var table = document.getElementById( tableName );
	var elements = table.getElementsByTagName("tr");
	
	for (i=1; i <= elements.length ; i++)
	{	
		if (i % 2 == 1)
		elements[i].style.backgroundColor = "#e0e5f9";
	}
}

function hideMenu()
{
	document.getElementById( "navarea" ).style.display = "none";
	document.getElementById( "navseparator" ).style.display = "none";
	document.getElementById( "contentarea" ).style.width = "940px";
	
	document.getElementById( "showhide_btn" ).innerHTML = '<a href="javascript: showMenu()" style="font-size: 10px" >&gt;&gt;</a>';
}

function __()
{
	
}

function showMenu()
{
	document.getElementById( "navarea" ).style.display = "block";
	document.getElementById( "navseparator" ).style.display = "block";
	document.getElementById( "contentarea").style.width = "730px";
	
	document.getElementById( "showhide_btn" ).innerHTML = '<a href="javascript: hideMenu()" style="font-size: 10px" >&lt;&lt;</a>';
}

function changePage( selectBox )
 {
   url = selectBox.options[ selectBox.selectedIndex ].value
		
   if (url != "")
   {
      document.location.href = url;
   }
 }

function popupImage( image, width )
{	
	document.getElementById( "fadeBox" ).style.display = "block";
	document.getElementById( "imageBox" ).style.display = "block";
	document.getElementById( "imageBox" ).innerHTML = '<div style="position: relative; padding-top: 25px; width: '+(width+10)+'px; margin-left: auto; margin-right: auto;"><a href="javascript: __()"><img src="img/close_btn.png" style="border: 0px; position: absolute; right: -10px; top: 5px;" alt=""></a><div style="padding: 3px; background-color: #888888; border: 1px solid #000000;"><img style="border: 1px solid #000000" src="' + image + '" alt=""></div></div>';

	__showImageBknd( 0 );
		
}

function popupImageOut()
{	
	__hideImageBknd( 50 );
}
	
function __showImageBknd( opacity )
{
	if( (opacity*1) < 72 )
	{
		document.getElementById( "fadeBox" ).style.opacity = (opacity / 100) * 1.5;
		document.getElementById( "fadeBox" ).style.filter = "alpha(opacity=" + opacity*1.5 + ")";
		
		document.getElementById( "imageBox" ).style.opacity = ( opacity / 100 ) * 2;
		document.getElementById( "imageBox" ).style.filter = "alpha(opacity=" + opacity*2 + ")";
		setTimeout( "__showImageBknd( " + (opacity+10) + ")", 10 );
	}
		
}

function __hideImageBknd( opacity )
{
	if( (opacity*1) > 0 )
	{
		document.getElementById( "fadeBox" ).style.opacity = (opacity / 100) * 1.5;
		document.getElementById( "fadeBox" ).style.filter = "alpha(opacity=" + opacity*1.5 + ")";
		
		document.getElementById( "imageBox" ).style.opacity = (opacity / 100) * 2;
		document.getElementById( "imageBox" ).style.filter = "alpha(opacity=" + opacity*2 + ")";
		setTimeout( "__hideImageBknd( " + (opacity-10) + ")", 10 );
	} else
	{
		document.getElementById( "fadeBox" ).style.display = "none";
		document.getElementById( "imageBox" ).style.display = "none";
	}
}

function changeSS( img, desc )
{
	document.getElementById( "screenshot" ).innerHTML = '<img src="img/content/' + img + '" alt=""><div class="screenshot_desc">' + desc + '</div>';
}

function txtSelectAll( id )
{
    document.getElementById( id ).focus( );
    document.getElementById( id ).select( );
}
