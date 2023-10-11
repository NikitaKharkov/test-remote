<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>EBSCOhost Integration Toolkit Support Center</title>

<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/carousel2.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="js/site.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/carousel.js"></script>

</head>
<body >

<div id="builderHolder">
	<h2 style="margin-top: 0px;">Carousel Builder</h2>
	
	<div class="bookArea">
		<div class="bookAreaTitle">
			1. Books
		</div>
		
		<ul id="bookList">
			<!--<li>Book  <div class="edit"></div> <div class="delete"></div></li>-->
			<li class="emptyList">No Books Added</li>
		</ul>
		
		<div class="addButton" id="addBook">
			Add a Book
		</div>
		
	</div>
	
	<div class="configArea">
		<div class="configAreaTitle">
			2. Configuration
		</div>
		<div class="configBoxName">
			Books Displayed
		</div>
		<div class="configBoxValue">
			<select class="configBoxForm" name="booksDisplayed">
				<optgroup label="No Books"></optgroup>
			</select>
		</div>
		
		<div class="clear"></div>
	
		<div class="configBoxName">
			Books Shifted
		</div>
		<div class="configBoxValue">
			<select class="configBoxForm" name="booksShifted">
				<optgroup label="No Books"></optgroup>
			</select>
		</div>
		
		<div class="clear"></div>
		
		
		<div class="configBoxName">
			Shift Time (Seconds)
		</div>
		<div class="configBoxValue">
			<select name="shiftSpeed" class="configBoxForm">
				<option value=200>0.2</option>
				<option value=400>0.4</option>
				<option value=600>0.6</option>
				<option value=800>0.8</option>
				<option value=1000>1</option>
			</select>
		</div>
		
		<div class="clear"></div>
		
		
		<div class="configBoxName">
			Auto Shift
		</div>
		<div class="configBoxValue">
			<select name="autoShift" class="configBoxForm">
				<option value=true>On</option>
				<option value=false>Off</option>
			</select>
		</div>
		
		<div class="clear"></div>
		
		
		<div class="configBoxName">
			Auto Shift Timer
		</div>
		<div class="configBoxValue">
			<select name="shiftTime" class="configBoxForm">
				<option value=5>5 Sec.</option>
				<option value=10>10 Sec.</option>
				<option value=15>15 Sec.</option>
			</select>
		</div>
		
		<div class="clear"></div>
		
		
		<div class="configBoxName">
			Profile Name
		</div>
		<div class="configBoxValue">
			<input name="profile" type="text" class="configBoxForm" />
		</div>
		
		<div class="clear"></div>
	</div>
	
	<div class="clear"></div>
	
	<div class="submitBox">
	
		<div class="submitTitle">
			3. Make Your Carousel!
		</div>
		
		<p>
			Click "Create Code" button below to get the carousel code now.  There will also be a preview
			of your carousel, to make sure all of the books were typed in and display correctly.
		</p>
		
		<div class="checkButton" id="createCarousel">
			Create Code
		</div>
	
	</div>
	
	
	<div class="add_popup" id="addBookPopup" style="display: none">
		<div class="addBox">
		
			<h4 style="margin-top: 0px;">Add a Book</h4>
			
			<div class="rule"></div>
		
			<div class="addBoxName">
				Book Title
			</div>
			<div class="addBoxValue">
				<input type="text" name="addTitle" class="addBoxForm" />
			</div>
			
			<div class="addBoxName">
				ISBN
			</div>
			<div class="addBoxValue">
				<input type="text" name="addISBN" class="addBoxForm" />
			</div>
			
			<div class="addBoxName">
				AN
			</div>
			<div class="addBoxValue">
				<input type="text" name="addAN" class="addBoxForm" />
			</div>
			
			<div class="addBoxName">
				Database
			</div>
			<div class="addBoxValue">
				<input type="text" name="addDB" class="addBoxForm" />
			</div>
			
			<div class="clear"> </div>
			
			<div class="closeButton" id ="addBookCancel">
				Cancel
			</div>
			
			<div class="checkButton" id="addBookList">
				Add Book
			</div>
			
		</div>
	</div>
	
	<div class="add_popup" id="editBookPopup" style="display: none">
		<div class="addBox">
		
			<h4 style="margin-top: 0px;">Edit a Book</h4>
			
			<div class="rule"></div>
		
			<div class="addBoxName">
				Book Title
			</div>
			<div class="addBoxValue">
				<input type="text" name="editTitle" class="addBoxForm" />
			</div>
			
			<div class="addBoxName">
				ISBN
			</div>
			<div class="addBoxValue">
				<input type="text" name="editISBN" class="addBoxForm" />
			</div>
			
			<div class="addBoxName">
				AN
			</div>
			<div class="addBoxValue">
				<input type="text" name="editAN" class="addBoxForm" />
			</div>
			
			<div class="addBoxName">
				Database
			</div>
			<div class="addBoxValue">
				<input type="text" name="editDB" class="addBoxForm" />
			</div>
			
			<div class="clear"> </div>
			
			<div class="closeButton" id ="editBookCancel">
				Cancel
			</div>
			
			<div class="checkButton" id="editBookList">
				Done
			</div>
			
		</div>
	</div>
</div>

<div id="codeHolder">
	
	<div class="codeBox">
	
		<div class="codeTitle">
			Your Carousel
		</div>
		
		<p>
			Copy and paste the code from the box below to display your Carousel.
		</p>
		<pre id="codeArea">
Code Here
		</pre>
	
	</div>
	
	<div id="previewCode" style="display: none;">
	
	</div>
	
	<div class="previewBox">
		<style type="text/css">#carouselContainer{position: relative; margin-left: auto; margin-right: auto; margin-bottom: 20px;}#carouselContainer .mainWindow{height: 250px; width: 180px; position: relative; overflow: hidden; } #carouselContainer .img_holder { height: 130px; } #carouselContainer .prev{position: absolute; width: 35px; height: 35px; left: -35px;top: 70px;background-image: url("http://lh2cc.net/bbates/prev-horizontal.png"); background-position: -60px 0px;}#carouselContainer .next{position: absolute;right: -35px;width: 35px; height: 35px;top: 70px;background-image: url("http://lh2cc.net/bbates/next-horizontal.png"); background-position: -62px 0px;}#carouselContainer .noclick{position: absolute;left: 0px;top: 0px;right: 0px;bottom: 0px;}#carouselContainer .slideHolder{position: absolute; top: 20px; left: 0px; right: -5000px;}#carouselContainer .book{ padding-top: 7px; background-position: -2px 0px; background-image: url("http://lh2cc.net/bbates/carousel_shadow.png"); background-repeat: no-repeat;width: 90px; height: 168px; margin-left: 20px; margin-right: 20px;float: left; text-align: center;} #carouselContainer .bookTitle { font-size: 11px; width: 80px; text-align: left; margin-left: 5px; }</style><div id="carouselContainer"><div class="mainWindow"><div id="slideHolder"class="slideHolder"></div></div><div id="prev"class="prev"></div><div id="next"class="next"></div></div>
	</div>
	
	<div class="codeBox" style="height: 20px; margin-top: 10px; padding-top: 5px; padding-right: 5px; width: 583px;">
		<div class="editButton" id="goBack">
			Go Back and Edit
		</div>
	</div>
</div>

</body>
</html>