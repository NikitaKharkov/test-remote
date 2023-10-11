/* Carousel Builder Script */


var currentBook;
var mdeleteBook;
var addBook;
var debug;
var bookList = new Array();

function renderBookList()
{
	scroll = $("#bookList").scrollTop();

	$('#bookList').append( $("<li></li>").attr( "id", "tItem" ).attr( "style", "height: 5000px; width: 1px;" ) );
	
	$('#eList').remove();
	
	if( mdeleteBook == true )
	{
		for( i = 0; i <= bookList.length; i++ )
		{
			$('#book' + i).remove();
		}
	} else if( addBook == true )
	{
		for( i in bookList )
		{
			if( i != currentBook ) {
				$('#book' + i).remove();
			}
		}
	} else
	{
		for( i in bookList )
		{
			$('#book' + i).remove();
		}
	}
	
	addBook = false;
	mdeleteBook = false;
	currentBook = null;
	
	if( bookList.length == 0 )
	{
		$('#bookList').
			append($("<li></li>").
			attr("id", "eList").
			attr("class", "emptyList").
			text( "No Books Added" ));
			
		$("[name=booksDisplayed]").empty();
		
		$("[name=booksDisplayed]").
				append( $("<optgroup></optgroup").
				attr("Label", "No Books"));
				
		
		$("[name=booksShifted]").empty();
		
		$("[name=booksShifted]").
				append( $("<optgroup></optgroup").
				attr("Label", "No Books"));
				
		$("#configAreaInactive").fadeIn( 200 );
		$("#createAreaInactive").fadeIn( 200 );
		$("#previewAreaInactive").fadeIn( 200 );
	} else
	{
		j = 1;
		$("#configAreaInactive").fadeOut( 200 );
		$("#createAreaInactive").fadeOut( 200 );
		$("#previewAreaInactive").fadeOut( 200 );
		
		$("[name=booksDisplayed]").empty();
		$("[name=booksShifted]").empty();
		
		for ( i in bookList )
		{
		
			$('#bookList').
				append($('<li></li>').
				attr("id", "book" + i).
				html( '<div class="bookTitle">' + bookList[i].title + '</div><div onclick="javascript: deleteBook(' + i + ')" class="delete"></div> <div class="edit" onclick="javascript: editBook(' + i + ')"></div><div class="down" onclick="javascript: moveDown(' + i + ')"></div><div class="up" onclick="javascript: moveUp(' + i + ')"></div><div style="clear: both"></div>' ));
				
			$("[name=booksDisplayed]").
				append( $("<option></option").
				attr("value", j).
				text( j ));
			
			$("[name=booksShifted]").
				append( $("<option></option").
				attr("value", j).
				text( j ));
			
			j++;
		}
	}
	
	$( "#tItem" ).remove();
	$("#bookList").scrollTop( scroll );
}

function editBook( bookNum )
{
	$("[name=editTitle]").val( bookList[ bookNum ].title );
	$("[name=editISBN]").val( bookList[ bookNum ].isbn );
	$("[name=editAN]").val( bookList[ bookNum ].an );
	$("[name=editDB]").val( bookList[ bookNum ].db );
	
	currentBook = bookNum;
	
	$("#bookAreaInactive").fadeIn( 200 );
	$("#editBookPopup").fadeIn( 200 );
}

function deleteBook( bookNum )
{
	bookList.splice( bookNum, 1 );
	
	currentBook = bookNum;
	mdeleteBook = true;
	
	$("#book" + bookNum).fadeOut( 200, function() {
		renderBookList();
	});
}

function moveUp( bookNum )
{
	if( bookNum < (bookList.length - 1) )
	{
		tempBook = bookList[ bookNum ];
		
		bookList.splice( bookNum, 1 );
		
		bookList.splice( bookNum + 1, 0, tempBook );
		
		scroll = $("#bookList").scrollTop();
		
		
		book1 = $("#book" + bookNum).position().top + scroll;
		book2 = $("#book" + (bookNum + 1)).outerHeight();

		if( (bookNum + 2) <= (bookList.length - 1) )
		{
			book3 = $("#book" + (bookNum + 2)).position().top;
			
			$("#book" + (bookNum + 2)).css({
				'margin-top': ((book3 - book1) + scroll)
			});
		}
		
		$("#book" + bookNum).css({
			'top': book1,
			'right': '0px',
			'left': '0px',
			'position': 'absolute'
		});
		
		$("#book" + (bookNum + 1)).css({
			'top': (book1 + $("#book" + bookNum).outerHeight()),
			'right': '0px',
			'left': '0px',
			'position': 'absolute'
		});		
		
		$("#book" + bookNum).animate({
			    top: book1 + book2
		});
		
		$("#book" + (bookNum + 1)).animate({
			    top: book1
		}, function() {
			renderBookList();
		});
	}
}


function moveDown( bookNum )
{
	if( bookNum > 0 )
	{
		tempBook = bookList[ bookNum ];
		
		bookList.splice( bookNum, 1 );
		
		bookList.splice( bookNum - 1, 0, tempBook );
		
		scroll = $("#bookList").scrollTop();
		
		book1 = $("#book" + (bookNum - 1)).position().top + scroll;
		book2 = $("#book" + bookNum).outerHeight();
		
		if( (bookNum + 1) <= (bookList.length - 1) )
		{
			book3 = $("#book" + (bookNum + 1)).position().top;
			
			$("#book" + (bookNum + 1)).css({
				'margin-top': ((book3 - book1) + scroll)
			});
		}
		
		$("#book" + bookNum).css({
			'top': (book1 + $("#book" + (bookNum - 1)).outerHeight()),
			'right': '0px',
			'left': '0px',
			'position': 'absolute'
		});
		
		$("#book" + (bookNum - 1)).css({
			'top': book1,
			'right': '0px',
			'left': '0px',
			'position': 'absolute'
		});		
		
		$("#book" + bookNum).animate({
			    top: book1
		});
		
		$("#book" + (bookNum - 1)).animate({
			    top: book1 + book2
		}, function() {
			renderBookList();
		});
	}
}


function renderCarousel( )
{
	var codeStr = '';
	if( bookList.length > 0 )
	{
	
	if( $("[name=newWindow]").is(':checked') )
	{
		newWindow = true;
	} else {
		newWindow = false;
	}
	
codeStr += '<script type="text/javascript" language="Javascript">\n';
codeStr += 'var carousel = {\n';
codeStr += '	"profile": "' + $("[name=profile]").val() + '",\n';
codeStr += '	"newWindow": ' + newWindow + ',\n';
codeStr += '	"booksDisplayed": ' + $("[name=booksDisplayed]").val() + ',		// Number of books displayed.\n';
codeStr += '	"shiftRate": ' + $("[name=booksShifted]").val() + ',			// Number of books shifted every iteration.\n';
codeStr += '	"shiftSpeed": ' + $("[name=shiftSpeed]").val() + ',		// How fast the books shift (ms).\n';
codeStr += '	"autoShift": ' + $("[name=autoShift]").val() + ',		// Auto shift will shift the books after a certain period.\n';
codeStr += '	"shiftTime": ' + $("[name=shiftTime]").val() + '			// Time, in seconds, to auto shift the books.\n';
codeStr += '};\n';
codeStr += 'var bookList = {\n';
codeStr += '	"books" : [\n';
for( i in bookList )
{
	codeStr += '	{\n';
	codeStr += '		"ISBN":\'' + bookList[i].isbn + '\',\n';
	codeStr += '		"AN":\'' + bookList[i].an + '\',\n';
	codeStr += '		"database":\'' + bookList[i].db + '\',\n';
	codeStr += '		"title":"' + bookList[i].title + '"\n';
	codeStr += '	}\n';
	if( i < bookList.length - 1 )
		codeStr += ',\n';
}
codeStr += ']};\n';
codeStr += '</script>\n';
codeStr += '<div style="margin: auto; text-align: center; width: 300px;font-weight: bold;">Recommended Books</div>\n';
codeStr += '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"type="text/javascript"></script>\n';
codeStr += '<script src="http://support.ebscohost.com/eit/scripts/carousel-v0.1.1.js"  type="text/javascript"></script>';
	}
	
	$("#codeArea").text( codeStr );
	doCarousel();
}

$("document").ready( function() {

	$("#previewBox").hide();

	$("#configAreaInactive").show();
	$("#createAreaInactive").show();
	$("#previewAreaInactive").show();
	
	$("#addBook").click( function() {
		$("[name=addTitle]").val( '' );
		$("[name=addISBN]").val( '' );
		$("[name=addAN]").val( '' );
		$("[name=addDB]").val( '' );
	
		$("#addBookPopup").fadeIn( 200 );
		$("#bookAreaInactive").fadeIn( 200 );
	});
	
	$("#addBookCancel").click( function() {
		$("#addBookPopup").fadeOut( 200 );
		$("#bookAreaInactive").fadeOut( 200 );
	});
	
	$("#addBookList").click( function() {
		
		title = $.trim( $("[name=addTitle]").val() );
		isbn = $.trim( $("[name=addISBN]").val() );
		an = $.trim( $("[name=addAN]").val() );
		db = $.trim( $("[name=addDB]").val() );
		flag = false;
		
		if( title == 'debug' )
		{
			debug = true;
			populate();
			$("#addBookPopup").fadeOut( 200 );
			$("#bookAreaInactive").fadeOut( 200 );
		} else if (  title != '' && isbn != '' && an != '' && db != '' ) {
			currentBook = ( bookList.push( { 'title': title, 'isbn': isbn, 'an': an, 'db': db } ) - 1);
			renderBookList();
			$("#addBookPopup").fadeOut( 200 );
			$("#bookAreaInactive").fadeOut( 200 );
			
			addBook = true;
		} else {
			alert( "Please fill in all of the fields." );
		}
	});
	
	
	$("#editBookCancel").click( function() {
		$("#editBookPopup").fadeOut( 200 );
		$("#bookAreaInactive").fadeOut( 200 );
	});
	
	$("#editBookList").click( function() {
		
		title = $.trim( $("[name=editTitle]").val() );
		isbn = $.trim( $("[name=editISBN]").val() );
		an = $.trim( $("[name=editAN]").val() );
		db = $.trim( $("[name=editDB]").val() );
		flag = false;
		
		if (  title != '' && isbn != '' && an != '' && db != '' ) {
			bookList[ currentBook ].title = title;
			bookList[ currentBook ].isbn = isbn;
			bookList[ currentBook ].an = an;
			bookList[ currentBook ].db = db;
			renderBookList();
			$("#editBookPopup").fadeOut( 200 );
			$("#bookAreaInactive").fadeOut( 200 );
		} else {
			alert( "Please fill in all of the fields." );
		}
	});
	
	$("#createCarousel").click( function() {
		if( bookList.length > 0 )
		{
			window.clearTimeout( shiftTimeout );
			renderCarousel();
			$("#previewBox").slideDown( 300 );
		} else
		{
			alert( "There are no books on your list." );
		}
		
	});
	
	$("#goBack").click( function() {
		
		$("#codeHolder").fadeOut( 400, function() {
			$("#builderHolder").fadeIn( 400 );
		});
	});
	
	$("#selectAll").click( function() {
		$("#codeArea").select();
	});
});

function populate()
{
	if( debug == true )
	{
		bookList.push( 
			{	
				"isbn":'9780195338218',
				"an":'gua3677229',
				"db":'cat00264a',
				"title":"Technology : a world history"
			},
			{
				"isbn":'9780226610894',
				"an":'gua3679703',
				"db":'cat00264a',
				"title": "Modern nature"
			},
			{
				"isbn":'9781848162259',
				"an":'gua3643909',
				"db":'cat00264a',
				"title":"Chemistry : the impure science"
			},
			{
				"isbn":'9781889538389',
				"an":'gua3662187',
				"db":'cat00264a',
				"title": "Community gardening"
			},
			{
				"isbn":'0192854194',
				"an":'gua3079884',
				"db":'cat00264a',
				"title": "ancient Egypt : a very short introduction"
			},
			{
				"isbn":'0736055002',
				"an":'gua3081198',
				"db":'cat00264a',
				"title": "Basketball : steps to success"
			},
			{
				"isbn":'0415287634',
				"an":'gua3088297',
				"db":'cat00264a',
				"title": "Poetry : the basics"
			},
			{
				"isbn":'1552979008',
				"an":'gua3390568',
				"db":'cat00264a',
				"title": "Insects : their natural history and diversity"
			},
			{
				"isbn":'0471381519',
				"an":'gua2854010',
				"db":'cat00264a',
				"title": "How things work : the physics of everyday life"
			},
			{
				"isbn":'9780520252950',
				"an":'gua3530463',
				"db":'cat00264a',
				"title": "Cooking : the quintessential art"
			}
		);
		renderBookList();
	}
}

/*

	Carousel Builder Copy

*/

var position = 0;
var shiftTimeout;
var animated = false;
var bookCount;
var carousel = [{}];

var width = 130;

function shiftNext()
{
	if(!animated) {
		window.clearTimeout( shiftTimeout );
		animated = true;
		position += carousel.shiftRate;
		
		$("#slideHolder").animate(
			{
				left : '-=' + (width*carousel.shiftRate)
			},
			carousel.shiftSpeed,
			function() {
				if(position >= bookCount) {
				
					position = position % bookCount;
		
					$("#slideHolder").css({
						'left' : ((bookCount*width) + (position*width)) * -1
					});
				}
				animated=false;
				if( carousel.autoShift )
					shiftTimeout = window.setTimeout( "shiftNext()", (carousel.shiftTime * 1000) );
			}
		);
	}
}

function shiftPrev()
{
	if(!animated) {
		window.clearTimeout( shiftTimeout );
		animated = true;
		position -= carousel.shiftRate;
		
		$("#slideHolder").animate(
			{
				left : '+=' + (width*carousel.shiftRate)
			},
			carousel.shiftSpeed,
			function() { 
				if(position < 0) {
					position += bookCount;
					
					$("#slideHolder").css({
						'left' : ((bookCount*width) + (position*width)) * -1
					});
				}
				animated = false;
				if( carousel.autoShift )
					shiftTimeout = window.setTimeout( "shiftNext()", (carousel.shiftTime * 1000) );
			}
		);
	}
}

function doCarousel() { 

	bookCount = bookList.length;
	
	carousel.profile = $("[name=profile]").val();
	carousel.booksDisplayed = ($("[name=booksDisplayed]").val() * 1);
	carousel.shiftRate = ($("[name=booksShifted]").val() * 1);
	carousel.shiftSpeed = ($("[name=shiftSpeed]").val() * 1);
	
	if( $("[name=autoShift]").val() == "true" )
	{
		carousel.autoShift = true;
	} else {
		carousel.autoShift = false;
	}
	
	if( $("[name=newWindow]").is(':checked') )
	{
		carousel.newWindow = true;
	} else {
		carousel.newWindow = false;
	}
	
	carousel.shiftTime = ($("[name=shiftTime]").val() * 1);

	
	if(carousel.booksDisplayed > bookCount)
		carousel.booksDisplayed = bookCount;
		
	if(carousel.shiftRate > carousel.booksDisplayed)
		carousel.shiftRate = carousel.booksDisplayed;
		
		
	if(bookList.length>0) {
	
		if( carousel.autoShift )
		{
			shiftTimeout = window.setTimeout( "shiftNext()", (carousel.shiftTime * 1000) );
		}
		
		$(".mainWindow").css({ 
			'width' : (carousel.booksDisplayed*width)
		});
		
		$("#carouselContainer").css({
			'width' : (carousel.booksDisplayed*width)
		});
		
		$("#slideHolder").css({
			'right' : 3*(bookCount*width),
			'width' : 3*(bookCount*width)
		});
		
		$(".next").css({
			'left' : (carousel.booksDisplayed*width)
		});
		
		$("#slideHolder").html( function() {
			returnString = "";
		
			if( carousel.newWindow )
			{
				popup = "_blank";
			} else {
				popup = "_self";
			}
		
			for(var i=0;i<3;i++) {
				for(var j=0;j<bookCount;j++) {
					returnString += '<div class="book">';
					returnString += '<a target="' + popup + '" href="http://search.ebscohost.com/login.aspx?direct=true&db='+bookList[j].db+'&AN='+bookList[j].an+'&site=eds-live&profile='+carousel.profile+'&scope=site">';
					returnString += '<div class="img_holder"><img style="border: 0px; width: 80px; height: 120px;" src="http://contentcafe2.btol.com/ContentCafe/jacket.aspx?UserID=ebsco-test&Password=ebsco-test&Return=T&Type=S&Value=';
					returnString += bookList[j].isbn;
					returnString += '" alt="" /></div><div class="bookTitle">';
					returnString += bookList[j].title;
					returnString+='</div></a></div>';
				}
			}
			
			return returnString;
		});
		
		$("#slideHolder").css({
			'left' : (bookCount*width) * -1
		});
			
		$("#next").click( function() {
			shiftNext();
		});
		
		$("#prev").click( function() {
			shiftPrev();
		});
		
	}
}
