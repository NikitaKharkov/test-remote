var position = 0;
var shiftTimeout;
var animated = false;

var width = 130;

var bookCount = bookList.books.length;

if(carousel.booksDisplayed > bookCount)
	carousel.booksDisplayed = bookCount;
	
if(carousel.shiftRate > carousel.booksDisplayed)
	carousel.shiftRate = carousel.booksDisplayed;

function shiftNext()
{
	if(!animated) {
		window.clearTimeout( shiftTimeout );
		animated = true;
		position += carousel.shiftRate;
		
		jQuery("#slideHolder").animate(
			{
				left : '-=' + (width*carousel.shiftRate)
			},
			carousel.shiftSpeed,
			function() {
				if(position >= bookCount) {
					position = position % bookCount;
		
					jQuery("#slideHolder").css({
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
		
		jQuery("#slideHolder").animate(
			{
				left : '+=' + (width*carousel.shiftRate)
			},
			carousel.shiftSpeed,
			function() { 
				if(position < 0) {
					position += bookCount;
					
					jQuery("#slideHolder").css({
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

	if(bookList.books.length>0) {
	
		if( carousel.autoShift )
		{
			shiftTimeout = window.setTimeout( "shiftNext()", (carousel.shiftTime * 1000) );
		}
	
		jQuery(".mainWindow").css({ 
			'width' : (carousel.booksDisplayed*width)
		});
		
		jQuery("#carouselContainer").css({
			'width' : (carousel.booksDisplayed*width)
		});
		
		jQuery("#slideHolder").css({
			'right' : 3*(bookCount*width),
			'width' : 3*(bookCount*width)
		});
		
		jQuery(".next").css({
			'left' : (carousel.booksDisplayed*width)
		});
		
		jQuery("#slideHolder").html( function() {
			returnString = "";
			
		if( carousel.newWindow )
		{
			popup = "out";
		} else {
			popup = "_self";
		}
		
			for(var i=0;i<3;i++) {
				for(var j=0;j<bookCount;j++) {
					returnString += '<div class="book">';
					returnString += '<a target="' + popup + '" href="http://search.ebscohost.com/login.aspx?direct=true&db=qbh&AN='+bookList.books[j].AN+'&site=eds-live&authtype=cookie,uid&user=ns015198&password=password&profile='+carousel.profile+'&scope=site">';
					returnString += '<div class="img_holder"><img style="border: 0px; width: 80px; height: 120px;" src="http://imageserver.ebscohost.com/featureimages/bbs/live/';
					returnString += bookList.books[j].AN;
					returnString += '.jpg" alt="" /></div><div class="bookTitle">';
					returnString += bookList.books[j].title;
					returnString+='</div></a></div>';
				}
			}
			
			return returnString;
		});
		
		jQuery("#slideHolder").css({
			'left' : (bookCount*width) * -1
		});
			
		jQuery("#next").click( function() {
			shiftNext();
		});
		
		jQuery("#prev").click( function() {
			shiftPrev();
		});
		
	}
}

document.write('<style type="text/css">#carouselContainer{position: relative; margin-left: auto; margin-right: auto; margin-bottom: 20px;}#carouselContainer .mainWindow{height: 250px; width: 180px; position: relative; overflow: hidden; } #carouselContainer .img_holder { height: 130px; } #carouselContainer .prev{position: absolute; width: 20px; height: 26px; left: -20px;top: 70px;background-image: url("images/carousel/arrows.png"); cursor: pointer; background-position: 0px 0px;}#carouselContainer .next{position: absolute;right: -20px;width: 20px; height: 26px;top: 70px;background-image: url("images/carousel/arrows.png"); cursor: pointer; background-position: 20px 0px;}#carouselContainer .noclick{position: absolute;left: 0px;top: 0px;right: 0px;bottom: 0px;}#carouselContainer .slideHolder{position: absolute; top: 20px; left: 0px; right: -5000px;}#carouselContainer .book{ padding-top: 7px; background-position: -2px 0px; background-image: url("../images/carousel/carousel_shadow.png"); background-repeat: no-repeat;width: 90px; height: 168px; margin-left: 20px; margin-right: 20px;float: left; text-align: center;} #carouselContainer .bookTitle { line-height: 13px; font-family: Georgia; font-size: 11px; width: 100px; text-align: left; margin-left: 5px; }</style><div id="carouselContainer"><div class="mainWindow"><div id="slideHolder"class="slideHolder"></div></div><div id="prev"class="prev"></div><div id="next"class="next"></div></div>');

setTimeout( "doCarousel()", 100 );