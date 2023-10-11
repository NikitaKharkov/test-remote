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


function hideMenu()
{
	$( "#navarea" ).hide( 400 );

	$('#contentarea').animate({
		width: '940'
	  }, 500
	);
	
	$( "#showhide_btn" ).html( function() {
		return '<a href="javascript: showMenu()" style="font-size: 10px" >&gt;&gt;</a>';
	});
}

function showMenu()
{
	$( "#navarea" ).show( 500 );

	$('#contentarea').animate({
		width: '730'
	  }, 400
	);
	
	$( "#showhide_btn" ).html( function() {
		return '<a href="javascript: hideMenu()" style="font-size: 10px" >&lt;&lt;</a>';
	});
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
	$( "#imageBox" ).html( function() {
		//return '<div style="position: relative; padding-top: 25px; width: '+(width+10)+'px; margin-left: auto; margin-right: auto;"><a href="javascript: __()"><img src="img/close_btn.png" style="border: 0px; position: absolute; right: -10px; top: 5px;" alt=""></a><div style="padding: 3px; background-color: #888888; border: 1px solid #000000;"><img style="border: 1px solid #000000" src="' + image + '" alt=""></div></div>';
		return '<a href="javascript: "><img src="img/close_btn.png" style="border: 0px; position: absolute; right: -10px; top: 5px;" alt=""></a><img style="border: 1px solid #000000;" src="' + image + '" alt="Click to close." />';
	});

	$( "#imageBox" ).css({
		'position'			: 'relative',
		'padding-top'		: '25px',
		'width'				: width + 'px',
		'margin-left'		: 'auto',
		'margin-right'		: 'auto'
	});
	
	width = $( "#imageBox" ).width();
	
	$( "#fadeBox" ).fadeIn( 500 );
	
	$( "#fadeBox" ).click( function() {
		$( "#fadeBox"  ).fadeOut( 500 );
	});
	
	$( "#imageBox" ).click( function() {
		$( "#fadeBox"  ).fadeOut( 500 );
	});
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
