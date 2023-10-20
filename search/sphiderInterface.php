<?  
//Include Sphider utilities
$include_dir = "./include";
require_once("sphider/settings/database.php");
require_once("sphider/languages/en-language.php");
require_once("sphider/include/commonfuncs.php");
require_once("sphider/include/searchfuncs.php");
require_once("sphider/include/categoryfuncs.php");
require_once("sphider/settings/conf.php");

//Implement functions that Sphider leaves undefined
//(for now just do nothing)
function getmicrotime(){}
function saveToLog() {}

function doSearch($query, $start, $category, $type, $numResults, $domain) {
	$search_results = get_search_results(strtolower($query), $start, $category, $type, $numResults, $domain);
	extract($search_results);
	//die(print_r($search_results));
	return $search_results;
}

function getDidYouMean($search_results) {	
	if ($search_results['did_you_mean'] && $search_results['did_you_mean'] != $search_results['ent_query']) {
		$mean = quote_replace(addmarks($search_results['did_you_mean']));
		$meanB = $search_results['did_you_mean_b'];
		?>(did you mean 
		<a style="text-decoration:underline" href="<?='index.php?query='.$mean.'&search=1'?>">
		<?=$meanB?></a>?)<?
	}
}	

function getIgnoredWords($search_results) {
	if ($search_results['ignore_words']) {
		?><div id="common_report">
		The following words are very common and were not included in your search: <b><?
		while($thisword=each($search_results['ignore_words']))
			echo " ".$thisword[1];	
		?></b></div><?
	}
}

function getResultsReport($search_results) {
	if ($search_results['total_results'] != 0 && $search_results['from'] <= $search_results['to']) {
		$firstResult = $search_results['from'];
		$numResults = $search_results['num_of_results'];
		$lastResult = $firstResult + $numResults - 1;
		$totalResults = $search_results['total_results'];
		$theQuery = $search_results['ent_query'];
		
		?><div id ="resultReport">
		Displaying <b><?=$firstResult?> - <?=$lastResult?></b>
		of <b><?=$totalResults?></b> for <b><?=$theQuery?></b>
		</div><?
	}
}

function getResults($search_results) {
	?><ul id="results"><?
	foreach ($search_results['qry_results'] as $_key => $_row) {
		$last_domain = $domain_name;
		extract($_row);
		$weight = "[".$_row['weight']."%]"; 
		$title = str_replace("EBSCO:", "", $_row['title']);
		$ext = substr($url, strlen($url)-3); 
		?>
		<li><a href="<?=$url?>" class="title <?=$ext?>">
		<?=$title?></a><br/>
		<div class="description"><?=$fulltxt?></div>
		<div class="url">
		<?=$url2?> - <?=$page_size?>
		</div>
		</li><?
	} 
	?></ul><?
}
?>
