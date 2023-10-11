<?php
/* --------------------------------------------------------------------- */
/* @author  Dave Tufts [dt] <dave@imarc.net>
/* --------------------------------------------------------------------- */
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php');


//Set up parameters in a way that sphider will accept
$vars = Array('query','search','domain','type','catid',
	      'category','results','start','adv', 'page');

//Initialize the variables dynamically
foreach($vars as $var) {
	eval('$'.$var.' = ""; ');
	if(isset($_GET[$var]))
		eval('$'.$var.' = $_GET["'.$var.'"];');
}

//If no search terms were typed in, this text might have remained in the search,
//box. Treat it the same as an empty search box.
if($query == "Search This Site") {
	$query = "";
}

include("sphiderInterface.php");

$template->setStyle('site');
$template->setColumn("left", "search.php");
$template->setHtmlTitle('Site Search');

$template->printHeader();




// If there is a query, show the results
if(isset($query) && $query != "") {
	$results_per_page = 20;

	// If no page number, set to 1
	if(!$page) { $page = 1; }
	
	// Remove slashes
	$query = stripslashes($query);
	
	// Execute the search
	$the_results = doSearch($query, $start, $category, $type, 10, $domain);
	
	echo "<h1>Search results for <i>" . htmlspecialchars($query) . "</i></h1>";
	echo "<h2 style=\"text-align:center\">";
	getDidYouMean($the_results);
	echo "</h2>";

	if($the_results['total_results'] > 0) {
		// If we have any results, display some statistics
		getResultsReport($the_results);
	
		// If we actually got some results, display them
		getResults($the_results);
	
		// page walker
		$current_page     = request_value('page', 'int', 1);
		$results_per_page = 20;
		
		$paginator = new Paginator($the_results['total_results'], $current_page, $results_per_page);
		?>
		<div class="paginator">
			<? $paginator->printTemplate('page_walker'); ?>
		</div>
		<?php
	} else {
		
		// Otherwise just show an error that we didn't find anyting
		?><span class=\"search_results_info\">
		Your search - <strong><em><?=htmlspecialchars($query)?></em></strong> - 
		did not match any documents.</span><br /><br />
		<span class=\"search_suggestions\">Suggestions:
		<ul>
		<li>Make sure all words are spelled correctly.</li>
		<li>Try different keywords.</li>
		<li>Try more general keywords.</li>
		<li>Try fewer keywords.</li>
		</ul></span><?
	}
} else {?>
	<h1>Search</h1>
	<br/><br/>
	<h2 style="text-align: center">No search terms specified.</h2>
	<p style="text-align: center">Please enter search terms in the box above.</p>
<?}

// Print the footer
$template->printFooter();
?>
