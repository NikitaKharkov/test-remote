This site makes use of a PHP app called Sphider to index and search the site:
http://cs.ioc.ee/~ando/sphider/

--------------------------------------------------------------------------------

The files in this folder are interfaces and scripts which interact with Sphider,
and the actual tool is conatined in the "sphider" subdirectory. Listed below are
the custom utilities / interfaces we've created:

uninstall.php - Drops all sphider tables from the DB
sphiderInterface.php - Interface which exposes Sphider functionality to our UI 
code as simple functions
keywordWeights.php - Creates a table which contains only keywords whose
aggregate weight is above a certain threshhold
index.php - The support site page which makes use of Sphider functionality
filter.php - Removes all URLs mathching specified patterns from the search index

sphiderJobFull.sh - Shell script which calls the above utilities to fully 
reindex the site from scratch
sphiderJob.sh - Shell script which calls some of the above utilities to update
the existing site index

--------------------------------------------------------------------------------

If you need to replace Sphider with a new copy, make sure to make the following 
changes, which are customizations we've made to Sphider:

1. Replace the following line in commonfuncs.php:
	$lines = @file($include_dir.'/common.txt');
With this line:
	$lines = @file(realpath('./sphider/include/common.txt'));
This is necessary since our PHP settings require absolute paths be passed to the
file function.

2. Replace the following line in searchfuncs.php:
	$result = mysqli_query($mysql_connection, "select keyword from ".$mysql_table_prefix."keywords where soundex(keyword) = soundex('$word')");
With this line:
	$result = mysqli_query($mysql_connection, "select keyword from ".$mysql_table_prefix."filteredKeywords");

Replace these lines in the same file:
	$distance = levenshtein($row[0], $word);
	if ($distance < $max_distance && $distance <4) {
With these lines:
	$distance = levenshtein($row[0], $word) + 
		levenshtein(metaphone($row[0]), metaphone($word));
	if ($distance < $max_distance && $distance / strlen($word) < 0.5) {

This makes use of the "filteredKeywords" table we've created, and finds more
accurate suggestions for the "did you mean" feature.

3. Replace the following line in spiderfuncs.php:
	$command = $catdoc_path." $filename";
With this line:
	$command = $catdoc_path." $filename" . " | sed 's/^[ ^t]*//' | grep -v '^-*$'";
This causes blank lines and dashes to be removed from indexed Word files so that
results will look cleaner.

--------------------------------------------------------------------------------
