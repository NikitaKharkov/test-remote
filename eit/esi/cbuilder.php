<?php 

$head = '
<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/carousel.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="js/site.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/carousel_0.1.6.js"></script>
';
include( 'includes/header.php' );

$menu = 'widgets';
$page = 'widgets_branding';
include( 'includes/navbar.php' );


?>
<div style="width: 200px; float: left; height: 65px;">
	<h2 style="margin: 0px; padding-top: 15px;">Carousel Builder</h2>
</div>
<div style="float: left; width: 0px; border-left: 1px solid #a6b3cb; height: 65px;">
</div>
<div style="width: 300px; float: left; height: 65px;">
	<p style="padding-left: 10px;">Choose custom books, and customize the settings to create a carousel to fit your site.  Start with Step 1, by pressing the "Add a Book" button.</p>
</div>

<div style="clear: both"></div>

	<div class="hr" style="margin-top: 0px;"></div>
	
<h3><font color="#144679">STEP 1</font> &nbsp;Enter Books</h3>
<p>
	Using the "Add a Book" button, add as many books as you would prefer <br/>
	to your book carousel.  You must know the ISBN, AN, Title, and database which<br/>
	the book resides in.
	
</p>
<div id="builderHolder">
	<div class="bookArea">
		
		
		<ul id="bookList">
			<!--<li>Book  <div class="edit"></div> <div class="delete"></div></li>-->
			<li class="emptyList" id="eList">No Books Added</li>
		</ul>

		<div class="addButton" id="addBook">
			Add a Book
		</div>
		
		
		<div class="bookAreaInactive" id="bookAreaInactive" style="display: none">
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

	<div class="hr" style="margin-top: 10px"></div>
	
	<div style="float: left; width: 340px; height: 350px; position: relative; padding-left: 15px; padding-right: 10px;">
		<h3><font color="#144679">STEP 2</font> &nbsp;Configure</h3>
		<p>
			Once you've added all the books you need, configure the carousel
			just the way you like it.  Modify things like number of books
			displayed, speed, and auto-shift.
			
		</p>
		
		<div class="configArea">
		
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
				Open in New Window
			</div>
			<div class="configBoxValue">
				<input type="checkbox" name="newWindow" value=true />
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
		
		<div class="bookAreaInactive" id="configAreaInactive" style="display: none">
		</div>
	</div>
	
	<div style="float: left; width: 0px; border-left: 1px solid #a6b3cb; height: 350px;">
	</div>
	
	<div style="float: left; padding-left: 15px; width: 349px; height: 350px; position: relative;">
		<h3><font color="#144679">STEP 3</font> &nbsp;Generate Your Carousel</h3>
		<div class="submitBox" style="margin-top: 0px; border: 0px;">
			Now that you've configured your carousel the way you want it, you
			can get the code and start using it now.  Press "Create Code" now
			to create your code and view your carousel.
			<br/>
			<br/>
			<div class="checkButton" id="createCarousel">
				Create Code
			</div>
			
			
		</div>
		
		<div class="bookAreaInactive" id="createAreaInactive" style="display: none">
		</div>
	</div>
</div>
<div style="clear: both"></div>
<div class="hr" style="margin-top: 0px; margin-bottom: 0px;"></div>

<div style="padding-top: 15px; position: relative;">
	<h3 style="margin-top: 0px;"><font color="#144679">STEP 3</font> &nbsp;Preview &amp; Get Your Code</h3>

	<div id="codeHolder">
		
		<div class="codeBox">
			<p>
				Copy and paste the code from the box below to display your Carousel.
			</p>
			
			<div style="position: relative;">
				<div id="selectAll" class="editButton">
					Select All
				</div>
				
				<textarea id="codeArea" style="width: 726px; height: 100px">Carousel Code Here</textarea>
				
			</div>
		</div>
		
		<div id="previewCode" style="display: none;">
		
		</div>
		
		<div id="previewBox" class="previewBox">
<style type="text/css">#carouselContainer{position: relative; margin-left: auto; margin-right: auto; margin-bottom: 20px;}#carouselContainer .mainWindow{height: 250px; width: 180px; position: relative; overflow: hidden; } #carouselContainer .img_holder { height: 130px; } #carouselContainer .prev{position: absolute; width: 20px; height: 26px; left: -20px;top: 70px;background-image: url("images/carousel/arrows.png"); cursor: pointer; background-position: 0px 0px;}#carouselContainer .next{position: absolute;right: -20px;width: 20px; height: 26px;top: 70px;background-image: url("images/carousel/arrows.png"); cursor: pointer; background-position: 20px 0px;}#carouselContainer .noclick{position: absolute;left: 0px;top: 0px;right: 0px;bottom: 0px;}#carouselContainer .slideHolder{position: absolute; top: 20px; left: 0px; right: -5000px;}#carouselContainer .book{ padding-top: 7px; background-position: -2px 0px; background-image: url("images/carousel/carousel_shadow.png"); background-repeat: no-repeat;width: 90px; height: 168px; margin-left: 20px; margin-right: 20px;float: left; text-align: center;} #carouselContainer .bookTitle { line-height: 13px; font-size: 11px; width: 80px; text-align: left; margin-left: 5px; }</style><div id="carouselContainer"><div class="mainWindow"><div id="slideHolder"class="slideHolder"></div></div><div id="prev"class="prev"></div><div id="next"class="next"></div></div>	</div>
		
	</div>
	<div style="clear: both"></div>
	
	<div class="bookAreaInactive" id="previewAreaInactive" style="display: none">
	</div>
</div>

<div class="clear"></div>
	
<?php 

include( 'includes/footer.php' );

?>