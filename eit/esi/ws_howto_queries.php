<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_api.css" rel="stylesheet" type="text/css">
<link href="styles/style_howto.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'web_service';
$page = 'ws_howto';
$subpage = 'queries';
include( 'includes/navbar.php' );


?><a name="top"></a>
<h2>Search EBSCOhost</h2>
<p>
	This section contains examples of certain scenarios when using the EBSCOhost Web Service to retrieve content in EBSCOhost databases.
	This page will help you by offering applicable sample scenarios that you can use to configure your own applications. 
</p>

<ul>
	<li><a href="#tags">Using Search Tags</a></li>
	<li><a href="#fulltext">Using the Full-Text Limiter</a></li>
	<li><a href="#date">Using the Date Limiter</a></li>
	<li><a href="#multiple">Multiple Search Tags</a></li>
	<li><a href="#pubtype">Using Publication Types</a></li>
	
	
</ul>


<div class="hr"></div>
<a name="tags"></a>
<a class="top" href="#top">Back to Top</a>
<h3>Scenario 1</h3>
<h4>Using Search Tags</h4>
<div class="scenario">

	Search for "Global Warming", restricting the Authors name to "John"

	<div class="title">
		Query
	</div>
	<p class="indent">
		<code>(global+warming)+AND+(AU+John)</code>
	</p>
	
	<div class="title">
		Explanation
	</div>
	<p class="indent">
		The initial query is <code>global warming</code>.  When adding on search tags and limiters,
		the <code>AND</code> boolean term must be appended.  The "AU" stands for author, and is available
		in most database.  To see a full list of search tags available to a database, use the Info method
		of the web service.  Multiple authors can be included using boolean search terms:
		
		<div class="codeIndent">
			<code>AU+John+Smith+AND+Sally+Brown</code>
		</div>
	</p>

</div>

<div class="hr" width=20px></div>
<a name="fulltext"></a>
<a class="top" href="#top">Back to Top</a>
<h3>Scenario 2</h3>
<h4>Using the Full-Text Limiter</h4>
<div class="scenario">

	Search for "Smartphones", restricting to full-text only.

	<div class="title">
		Query
	</div>
	<p class="indent">
		<code>(smartphones)+AND+(FT+yes)</code>
	</p>
	
	<div class="title">
		Explanation
	</div>
	<div class="indent">
		The "FT" full-text limiter can be appended to any query, and will cause it to only return results with
		full-text available.  To limit to exclusively PDF or HTML full-text, using the "FM" format limiter:		
		
		<div class="codeIndent">
			<code>FM+P</code>
		</div>
		
		"P" refers to PDF full-text, and "T" refers to HTML full-text.
	</div>

</div>

<div class="hr" width=20px></div>
<a name="date"></a>
<a class="top" href="#top">Back to Top</a>
<h3>Scenario 3</h3>
<h4>Using The Date Limiter</h4>
<div class="scenario">

	Search for "Artifical Intelligence", with results from January of 2007 to present.

	<div class="title">
		Query
	</div>
	<p class="indent">
		<code>(artifical+intelligence)+AND+(DT+200701-)</code>
	</p>
	
	<div class="title">
		Explanation
	</div>
	<div class="indent">
		The "DT" search limiter specifies which dates to return results from.  To search in between two dates,
		the format of this limiter is as follows:
		
		<div class="codeIndent">
			<code>DT+[Year][Month][Day]-[Year][Month][Day]</code>
		</div>
		
		To search to the present date, simply omit the second date, for example:

		<div class="codeIndent">
			<code>DT+[Year][Month][Day]-</code>
		</div>
		
		To search only an individual year or month, format the query such as:

		<div class="codeIndent">
			<code>DT+[Year][Month][Day]</code>
		</div>
		
		Note that <code>[Month]</code> and <code>[Day]</code> in all of these cases are optional terms.  
		Year must be a four-digit number (e.g. 2007) and month and day must be a two-digit number (e.g. 05).
	
	</div>

</div>

<div class="hr" width=20px></div>
<a name="multiple"></a>
<a class="top" href="#top">Back to Top</a>
<h3>Scenario 4</h3>
<h4>Using Multiple Tags and Limiters</h4>
<div class="scenario">

	Search for "Smartphones" using multiple tags and limiters.

	<div class="title">
		Query
	</div>
	<p class="indent">
		<code>(smartphones)+AND+(FM+P+AND+T)+AND+(AU+John+Smith+OR+Sally+Brown)+(DT+20080207-20080214)</code>
	</p>
	
	<div class="title">
		Explanation
	</div>
	<div class="indent">
		To use multiple limiters and search tags, simply append them onto the query using
		boolean search terms.  This query will search for "Smartphones", with Full-text PDF and
		HTML, written by author John Smith or Sally Brown, from 02/07/2008 to 02/14/2008.  It is
		recommended for good formatting to keep all search tags and limiters in parenthesis.
	</div>	
</div>

<div class="hr" width=20px></div>
<a name="pubtype"></a>
<a class="top" href="#top">Back to Top</a>
<h3>Scenario 5</h3>
<h4>Using Publication Types</h4>
<div class="scenario">

	Search for "Global Warmming", and include only books.

	<div class="title">
		Query
	</div>
	<p class="indent">
		<code>(global+warming)+AND+(PT+book)</code>
	</p>
	
	<div class="title">
		Explanation
	</div>
	<div class="indent">
		The publication type PT limiter will limit your results to books only.  To limit your results
		to exclusively articles, use the <code>ZT article</code> limiter.
	</div>	
</div>

<div class="hr" width=20px></div>

<p>
	To learn more about how EBSCO Publishing can serve all of a corporation's electronic 
	information needs <b><a href="http://www.ebscohost.com/thisTopic.php?marketID=6&amp;topicID=683" target="_blank">click here</a></b>.
</p>
<?php 

include( 'includes/footer.php' );

?>
