<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_widgets.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'widgets';
$page = 'widgets_record';
include( 'includes/navbar.php' );


?>
<a name="top"></a>
<h2>Detailed Record Widgets</h2>

<p>
	Detailed Record widgets are modules which are displayed on the Detailed Record page of the EBSCOhost
	and EBSCO Discovery Service user interfaces.  These	widgets are commonly used to provide additional 
	or related information for the record the user is viewing.
</p>

<p>
	<a href="http://support.epnet.com/knowledge_base/detail.php?id=4713" target="blank">Click here for step-by-step instructions on how to add widgets to EBSCOhost or EBSCO Discovery Service</a>
</p>

<div class="hr"></div>
<a class="top" href="#top">Back to Top</a>
<a name="gbooks"></a><h3>Google Books</h3>

<a href="javascript: popupImage( 'img/widgets/googlebooks.png', 800 )">
	<img class="widget_image" src="img/widgets/googlebooks_thumb.png" alt="">
</a>

<p class="widget_desc">
	<b>Name: </b>Google Books<br>
	<b>Submitter: </b>EBSCO Publishing<br>
	<b>Type: </b>Custom HTML<br>
	<b>Obtained From: </b><a href="http://code.google.com/apis/books/">Google</a><br>
</p>

<p class="widget_comments">
	<b>Comments</b>: This widget provides a Google Book preview if the search result contains a valid ISBN
	or OCLC number. Your custom html code should be placed in the 
	"Custom HTML" box of the Viewing Results Add/Modify Feature screen. Below is an example of the html 
	code: 
</p>

<pre>
&lt;script type="text/javascript" src="https://www.google.com/jsapi"&gt;&lt;/script&gt;
&lt;script language="Javascript" type="text/javascript"&gt;

google.load( "books", "0" );	

var viewer;
var epISBN = "ep.ISBN";
var epOCLC = "ep.OCLC";

function bookError()
{
	document.getElementById( "ehostBookPreview" ).innerHTML = 'The google book preview for this book could not be found.';
}	
	
function initializeBookPreview() {	
	if( epISBN != "" )
	{
		viewer = new google.books.DefaultViewer( document.getElementById( "ehostBookPreview" ) );
		viewer.load( 'ISBN:' + epISBN, bookError );
	} else if( epOCLC != "" )
	{
		viewer = new google.books.DefaultViewer( document.getElementById( "ehostBookPreview" ) );
		viewer.load( 'OCLC:' + epOCLC, bookError );
	} else
	{
		document.getElementById( "ehostBookPreview" ).innerHTML = 'Search for a book with an ISBN or an OCLC number to see the Google Books preview!';
	}
}

google.setOnLoadCallback( initializeBookPreview );
	
&lt;/script&gt;
&lt;div style="width: 450px;margin-left: auto; margin-right: auto;"
&lt;div id="ehostBookPreview" style="width: 450px; height: 450px; "&gt;&lt;/div&gt;
&lt;/div&gt;
</pre>



<div class="hr"></div>
<a class="top" href="#top">Back to Top</a>
<a name="gbooks"></a><h3>Goodreads Reviews</h3>

<a href="javascript: popupImage( 'img/widgets/goodreads.png', 800 )">
	<img class="widget_image" src="img/widgets/goodreads_thumb.png" alt="">
</a>

<p class="widget_desc">
	<b>Name: </b>Goodreads Reviews<br>
	<b>Submitter: </b>EBSCO Publishing<br>
	<b>Type: </b>Custom HTML<br>
	<b>Obtained From: </b> <a href="http://www.goodreads.com/">Goodreads</a><br>
</p>

<p class="widget_comments">
	<b>Comments</b>: This widget will give the user the top 2 reviews available for a book from the popular website
	Goodreads.  You must obtain a Goodreads API key from <a href="http://www.goodreads.com/api">the Goodreads API
	website</a>, and put it into the javascript below.  Your custom html code should be placed in the "Custom HTML" 
	box of the Branding screen in EBSCOadmin. Below is an example of the HTML code: 
</p>

<pre>
&lt;script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js" type="text/javascript"&gt;&lt;/script&gt; &lt;script language="Javascript" type="text/javascript"&gt;
//&lt;![CDATA[

var Goodreads_API_Key = '';

function epReviewCallback( result )
{
	var col;
	var returnResult;
	
	jQuery("document").ready( function() {
		for( var i = 1; i &lt;= 7; i++ )
		{
			col = "#col" + i;
			if( i &gt; result.reviews.length )
				break;	
				
			if( result.reviews[ i - 1 ].body != null )
			{
				jQuery( col ).addClass( "review" );
					
				result.reviews[ i - 1].body.replace( '&lt;a', '&lt;a target="_blank"' );
					
				jQuery( col ).html( function() {
					returnResult = result.reviews[ i - 1 ].body;
                                        returnResult += '&lt;br /&gt;&lt;br /&gt;Rating:  ';
					returnResult += '&lt;br /&gt;';
					
					for( j = 0; j &lt; (result.reviews[ i - 1].rating * 1); j++ )
					{
						returnResult += '&lt;div class="star"&gt;&lt;/div&gt;';
					}
					
					
					for( j = 5; j &gt; (result.reviews[ i - 1].rating * 1); j-- )
					{
						returnResult += '&lt;div class="star_dull"&gt;&lt;/div&gt;';
					}
					
					returnResult += '(' + result.reviews[ i - 1 ].rating + ')';
					
                    returnResult += '&lt;br /&gt;&lt;br /&gt;';
					returnResult += 'From &lt;a target="_blank" href="' + result.reviews[ i - 1 ].user.url + '"&gt;';
					returnResult += result.reviews[ i - 1 ].user.name + '&lt;/a&gt;';
					return returnResult;
				});
				
				jQuery(col + " a").attr( "target", "_blank" );
			}
		}
		
		jQuery( "#bookLink" ).html( function() {
			return '&lt;a href="' + result.url + '#other_reviews" target="_blank"&gt;Read All Reviews&lt;/a&gt;&lt;br /&gt;&lt;br /&gt;&lt;a target="_blank" href="' + result.url + '"&gt;Click here&lt;/a&gt; to write your own review.&lt;/a&gt;';
		});
	});
}

document.write( '&lt;script type="text/javascript" src="http://www.goodreads.com/book/isbn?format=json&isbn=ep.ISBN&key=' + Goodreads_API_Key + '&callback=epReviewCallback"&gt;&lt;/scr' + 'ipt&gt;' );
//]]&gt;
&lt;/script&gt;
&lt;style&gt;

#reviews
{
	width: 500px;
	margin-left: auto;
	margin-right: auto;
}

#reviews td
{
	width: 160px;
	padding: 5px;

	vertical-align: top;
	
	color: #888888;
	font-style: italic;
	
	border: 1px solid #AAAAAA
}

#reviews .star
{
	width: 22px;
	height: 22px;
	background-image: url( 'http://support.ebscohost.com/eit/images/goodreads/stars.png' );
	background-position: 0px 0px;
	background-repeat: none;
	
	float: left;
}

#reviews .star_dull
{
	width: 22px;
	height: 22px;
	background-image: url( 'http://support.ebscohost.com/eit/images/goodreads/stars.png' );
	background-position: 22px 0px;
	background-repeat: none;
	
	float: left;
}

#reviews .review
{
	color: #000000;
	font-style: normal;
}

&lt;/style&gt;
&lt;div id="reviews"&gt;
&lt;table&gt;
	&lt;tr&gt;
		&lt;td&gt;
			&lt;div id="col1"&gt;
				No Review Found
			&lt;/div&gt;
			&lt;br /&gt;
		&lt;/td&gt;
		
		&lt;td&gt;
			&lt;div id="col2"&gt;
				No Review Found
			&lt;/div&gt;
		&lt;/td&gt;

	
		&lt;td&gt;
			&lt;div id="col3"&gt;
				No Review Found
			&lt;/div&gt;
		&lt;/td&gt;
&lt;/table&gt;

&lt;div id="bookLink"&gt;
&lt;/div&gt;

&lt;/div&gt;
</pre>
<?php 

include( 'includes/image_popup.php' );
include( 'includes/footer.php' );

?>