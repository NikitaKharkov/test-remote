<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_widgets.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'widgets';
$page = 'widgets_list';
include( 'includes/navbar.php' ); 


?>
<a name="top"></a>
<h2>Result List Widgets</h2>

<p>
	Result List widgets are modules which can be displayed on the search result list of the EBSCOhost
	and EBSCO Discovery Service user interfaces. These widgets are commonly used to compliment
	the content returned by a user's search such as: related Flickr images or WorldCat entries.
</p>

<p>
	<a href="http://support.epnet.com/knowledge_base/detail.php?id=4713" target="blank">Click here for step-by-step instructions on how to add widgets to EBSCOhost or EBSCO Discovery Service</a>
</p>

<!------------------------------------->
<!------- Begin MeeboMe Widget -------->
<!------------------------------------->
<div class="hr"></div>
<a class="top" href="#top">Back to Top</a>
<a name="meebome"></a><h3>MeeboMe</h3>

<a href="javascript: popupImage( 'img/widgets/meeboscreen.jpg', 800 )">
	<img class="widget_image" src="img/widgets/meeboscreen_thumb.jpg" alt="">
</a>

<p class="widget_desc">
	<b>Name: </b> MeeboMe<br>
	<b>Submitter: </b> EBSCO Publishing<br>
	<b>Type: </b>Custom HTML<br>
	<b>Obtained From: </b> <a href="http://www.meebome.com/">MeeboMe</a><br>
</p>

<p class="widget_comments">
	<b>Comments</b>: It is necessary to visit www.meebome.com  , setup an account, and generate your 
	own custom html code to create this widget. Your custom html code should be placed in the 
	"Custom HTML" box of the Viewing Results Add/Modify Feature screen. Below is an example of the html 
	code: 
</p>

<pre>
&lt;!-- Beginning of meebo me widget code. Want to talk with visitors on your page? Go to http://www.meebome.com/ and get your widget! --&gt; 
&lt;object width="165" height="250" &gt;
	&lt;param name="movie" value="http://widget.meebo.com/mm.swf?KgmDNVUUtN"/&gt;
	&lt;embed src="http://widget.meebo.com/mm.swf?KgmDNVUUtN" type="application/x-shockwave-flash" width="170" height="270"&gt;
	&lt;/embed&gt;
&lt;/object&gt;
</pre>

<!------------------------------------->
<!------- Begin Flickr Widget --------->
<!------------------------------------->
<div class="hr"></div>
<a class="top" href="#top">Back to Top</a>
<a name="flickr"></a><h3>Flickr</h3>

<a href="javascript: popupImage( 'img/widgets/flickrscreen.jpg', 800 )">
	<img class="widget_image" src="img/widgets/flickrscreen_thumb.jpg" alt="">
</a>

<p class="widget_desc">
	<b>Name: </b> Flickr Widget<br>
	<b>Submitter: </b> EBSCO Publishing<br>
	<b>Type: </b>Custom HTML<br>
	<b>Obtained From: </b> <a href="http://www.flikr.com/">Flickr</a><br>
</p>

<p class="widget_comments">
	<b>Comments</b>: To enable this widget, the following URL was placed in the "Custom HTML" box of the 
	Viewing Results Add/Modify Feature screen:
</p>

<pre>
&lt;script type="text/javascript"&gt;
var searchterm = 'ep.SearchTerm';
function jsonFlickrFeed(feed){
z='';
document.write('&lt;br/&gt;');
if(feed.items.length&gt;0){
for (x=0; x&lt;4; x++) {
tmp=feed.items[x].media.m;
tmp=tmp.replace(/_m\.jpg/g,'_s.jpg');
z+='&lt;a href="'+feed.items[x].link+'" target="_new"&gt;&lt;img src="'+feed.items[x].media.m+'" alt="some img" width="75px" height="75px" style="margin: 1px;"&gt;&lt;/a&gt;';
}

} else {
z+='&lt;br/&gt;No &lt;a href="http://www.flickr.com"&gt;Flickr&lt;/a&gt; images were found for &lt;i&gt;'+searchterm+'&lt;/i&gt;.';
}
document.getElementById('flickrpics').style.display='block';
document.getElementById('flickrpics').innerHTML=z;
z='&lt;a style="font-family: Verdana, Arial, Sans-Serif; font-size: .7em" href="http://www.flickr.com/search/?q='+searchterm+'" target="_blank"&gt;Find More @ Flickr&lt;/a&gt;';
document.getElementById('flickrlink').style.display='block';
document.getElementById('flickrlink').innerHTML=z;
}
function searchFlickr() {
var headID = document.getElementsByTagName("head")[0];
var newScript = document.createElement('script');
newScript.type = 'text/javascript';
newScript.src = 'http://api.flickr.com/services/feeds/photos_public.gne?tags='+searchterm+'&format=json';
headID.appendChild(newScript);
return false;
}
searchFlickr();
&lt;/script&gt;
&lt;div style='border: 0; width: 164px; display: none;' id='flickrpics'&gt;&lt;/div&gt;
&lt;div style="margin-top:9px" id='flickrlink'&gt;&lt;/div&gt;
</pre>

<!------------------------------------->
<!------- Begin LibGuide Widget ------->
<!------------------------------------->
<div class="hr"></div>
<a class="top" href="#top">Back to Top</a>
<a name="libguide"></a><h3>LibGuide</h3>

<a href="javascript: popupImage( 'img/widgets/libguidesscreen.jpg', 800 )">
	<img class="widget_image" src="img/widgets/libguidesscreen_thumb.jpg" alt="">
</a>

<p class="widget_desc">
	<b>Name: </b> LibGuide Widget<br>
	<b>Submitter: </b> EBSCO Publishing<br>
	<b>Type: </b>Custom HTML<br>
	<b>Obtained From: </b> <a href="http://demo.libguides.com/createwidget.php">LibGuide</a><br>
</p>

<p class="widget_comments">
	<b>Comments</b>: To enable this widget, the following HTML was placed in the "Custom HTML" box of the 
	Viewing Results Add/Modify Feature screen:
</p>

<pre>
&lt;object type="application/x-shockwave-flash" data="http://widgets.libguides.com/lgwsr.swf?wid=3037" width="170" height="270" &gt;
	&lt;param name="movie" value="http://widgets.libguides.com/lgwsr.swf?wid=3037" /&gt;
	&lt;param name="wmode" value="transparent" /&gt;
&lt;/object&gt;
</pre>

<!------------------------------------->
<!------- Begin WorldCat Widget ------->
<!------------------------------------->
<div class="hr"></div>
<a class="top" href="#top">Back to Top</a>
<a name="worldcat"></a><h3>WorldCat</h3>

<a href="javascript: popupImage( 'img/widgets/worldcat.jpg', 964 )">
	<img class="widget_image" src="img/widgets/worldcat_thumb.jpg" alt="">
</a>

<p class="widget_desc">
	<b>Name: </b>WorldCar Widget<br>
	<b>Submitter: </b> EBSCO Publishing<br>
	<b>Type: </b>Custom HTML<br>
	<b>Obtained From: </b> <a href="http://worldcat.org/devnet/wiki/BasicAPIDetails">WorldCat</a>, <a href="http://feed2js.org/index.php?s=build">Feed2Js</a><br>
</p>

<p class="widget_comments">
	<b>Comments</b>: The below code sample contains a "wskey". To use the code, you will need to request your 
	own wskey from WorldCat (link above) and place it between the single quotes below where it says 
	"PUT YOUR wskey HERE".
</p>

<p class="widget_comments">
	To enable this widget, the following HTML was placed in the "Custom HTML" box of the Viewing Results 
	Add/Modify Feature screen: 
</p>

<pre>
&lt;style type="text/css" media="all"&gt;
.rss_box {
  width: 185px;
  font-size: 8pt;
}
.rss_title, rss_title a {
}
.rss-items {
  list-style:none;
  margin:0;
  padding:0;
}
.rss-item {
  font-size: small;
  margin-bottom: 1em;;
}
.rss_item a:link, .rss_item a:visited, .rss_item a:active {
  font-family: verdana, arial, sans-serif;
  font-size: 1.0em;
}
.rss_item a:hover {
}
.rss_date {
}
&lt;/style&gt;

&lt;script type="text/javascript"&gt;
var wsKey = 'PUT YOUR wskey HERE';

var EP_SearchTerm = 'ep.SearchTerm';
EP_SearchTerm = EP_SearchTerm.replace( / /g, '%2B' );

var EP_WorldCat = 'http://feed2js.org//feed2js.php?src=http%3A%2F%2Fwww.worldcat.'
  + 'org%2Fwebservices%2Fcatalog%2Fsearch%2Fopensearch%3Fq%3D'
  + EP_SearchTerm + '%26format%3Drss%26cformat%3Dmla%26wskey%3D'
  + wsKey + '&amp;num=10&amp;targ=y&amp;html=a';

document.write( '&lt;script type="text/javascript" language="Javascript" src="'
  + EP_WorldCat + '"&gt;&lt;' + '/script&gt;' );

&lt;/script&gt;
</pre>

<?php 

include( 'includes/image_popup.php' );
include( 'includes/footer.php' );

?>