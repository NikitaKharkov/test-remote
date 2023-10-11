<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'web_service';
$page = 'ws_howto';
$subpage = 'hl';
include( 'includes/navbar.php' );


?><a name="top"></a>
<h2>Health Library Query Syntax: Search Tips</h2>
<p>
	This section contains examples of search queries that can serve as a guide as you configure your own Health Library search applications 
</p>

<div class="hr"></div>
<a class="top" href="#top">Back to Top</a>
<h3>Boolean Operators</h3>
<table><tr><td width=20>&nbsp;</td><td>
	<P>
	<p><b>And</b> - combines search terms so that each search result contains all of the terms. 
	<p>For example, <b>stroke and hypertension</b> finds articles that contain <i>both terms</i>. </p>
	<P>
	<p><b>Or</b> - combines search terms so that each search result contains at least one of the terms. 
	<p>For example, <b>stroke or hypertension</b> finds results that contain <i>either term</i>.
	<P>
	<p><b>Not</b> - excludes terms so that each search result does not contain any of the terms that follow it. 
	<p>For example, <b>stroke not hypertension</b> finds results that contain
	the term <i>stroke</i> but not the term </i>hypertension</i>. 

</td></tr></table>

<div class="hr" width=20px></div>
<a class="top" href="#top">Back to Top</a>
<h3>Wildcard (?) and Truncation (*) Symbols</h3>
<table><tr><td width=20>&nbsp;</td><td>
	<p>Use the wildcard and truncation symbols to create searches where there are unknown characters, multiple spellings or various endings. Neither the wildcard nor the truncation symbol can be used as the first character in a search term. </p>
	<p>
	<u>Wildcards</u>
	<p>The <b>wildcard</b> is represented by a question mark ? or a pound sign #. </p> 
	<P>
	<p>To use the ? wildcard, enter your search terms and replace each unknown character with a ?. EBSCO finds all citations of that word with the ? replaced by a letter. </p> 
	<P>
	<p>For example, type <b>midwi?e</b> to find all citations containing <b>midwife & midwive</b>. </p> 
	<P>
	<p>Note: When searching for a title that ends in a question mark, the symbol should be removed from the search in order to ensure results will be returned.</p> 
	<P>
	<p>To use the # wildcard, enter your search terms, adding the # in places where an alternate spelling may contain an extra character. EBSCO finds all citations of the word that appear with or without the extra character.</p> 
	<P>
	<p>For example, type <b>p#ediatric</b> to find all citations containing <b>pediatric</b> or <b>paediatric</b></p>
	<p>
	<u>Truncation</u>
	<p>Truncation is represented by an asterisk (*). To use truncation, enter the root of a search term and replace the ending with an *. EBSCO finds all forms of that word. </p>
	<P>
	<p>For example, type <b>cardio*</b> to find the words <b>cardiology</b> or <b>cardiovascular</b>, <b>cardiopulmonary</b>. </p>
	<P>
	<p>Note: The Truncation symbol (*) may also be used between words to match any word. </p>
	<P>
	<p>For example, <b>chronic</b> * <b>pain</b> will return results that contain the exact phrase, <b>chronic knee pain</b>, <b>chronic acute pain</b>, <b>chronic low back pain</b>. </p>
	</td></tr></table>

<div class="hr"></div>
<a class="top" href="#top">Back to Top</a>
<h3>Proximity </h3>
<table><tr><td width=20>&nbsp;</td><td>
	<p>You can use a proximity search to search for two or more words that occur within a specified number of words (or fewer) of each other in the databases. Proximity searching is used with a keyword or Boolean search.
	<P>
	<p>The proximity operators are composed of a letter (<b>N</b> or <b>W</b>) and a <b>number</b> (to specify the number of words). The proximity operator is placed between the words that are to be searched, as follows:
	<P>
	<p><b>Near Operator (N) - N5</b> finds the words if they are within five words of one another regardless of the order in which they appear.
	<P>
	<p>For example, type <b>pain N5 head</b> to find results that would match <b>pain in the head</b> as well as <b>head with pain</b>, or, <b>breast N5 cancer</b> to find results that would match <b>cancer of the breast</b>
	<P>
	<p><b>Within Operator (W)</b> - In the following example, <b>W8</b> finds the words if they are within eight words of one another and <i>in the order in which you entered them</i>. 
	<P>
	<p>For example, type <b>hearing W8 aids</b> to find results that would match <i>hearing aids</i> but would <b>not</b> match <i>aids for hearing</i>. 

</td></tr></table>

<div class="hr"></div>
<a class="top" href="#top">Back to Top</a>
<h3>Grouping Terms Together Using Parentheses </h3>
<table><tr><td width=20>&nbsp;</td><td>
	<p><i>Parentheses</i> also may be used to control a search query. Without parentheses, a search is executed from left to right. Words that you enclose in parentheses are searched first. 
	<P>
	<p>Why is this important? Parentheses allow you to control and define the way the search will be executed. The left phrase in parentheses is searched first; then, based upon those results, the second phrase in parentheses is searched. </p>
	<p>
	<b>Generalized Search</b>: <b>arm or leg</b> and <b>broken or injured</b>
	<p>In this first example, the search will retrieve everything on <b>arms, <i>as well as</i> legs broken <i>as well as</i> everything on injured</b>. </p>
	<P>
	<b>Focused Search</b>: <b>(arm or leg)</b> and <b>(broken or injured)</b>
	<p>In this second example, we have used the parentheses to control our query to only find articles about <b>arm or leg</b> that reference <b>broken or injured</b>.</p>
	<p>	
</td></tr></table>

<div class="hr"></div>
<a class="top" href="#top">Back to Top</a>
<h3>Using Quotation Marks</h3>
<table><tr><td width=20>&nbsp;</td><td>
	<p>Typically, when a phrase is enclosed by double <b>quotations marks</b>, the exact phrase is searched. This is not true of phrases containing stop words. A stop word will never be searched for in an EBSCO database, even if it is enclosed in double quotation marks. A search query with stop words only (i.e. no other terms) yields no results.  </p>
</td></tr></table>
<a class="top" href="#top">Back to Top</a>


<p>
	To learn more about how EBSCO Publishing can serve all of a corporation's electronic 
	information needs <b><a href="http://www.ebscohost.com/thisTopic.php?marketID=6&amp;topicID=683" target="_blank">click here</a></b>.
</p>
<?php 

include( 'includes/footer.php' );

?>
