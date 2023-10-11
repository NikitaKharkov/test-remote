<?
header("Content-type: text/plain");
$tables = Array("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f");

$excludes = Array("/support_news/index.php",
		"/support_news/release_info.php",
		"/knowledge_base/index.php?page_function=show_list",
		"/knowledge_base/index.php?page_function=select_service",
		"/knowledge_base/search.php");

echo "use sphider_db\n";
foreach($excludes as $exclude) {
	echo "\n--Remove links matching '{$exclude}'\n";
	foreach($tables as $table) {
		echo "DELETE FROM link_keyword{$table} ";
		echo "where link_id in (SELECT link_id FROM links where url like '%{$exclude}%');\n";
	}
	//echo "DELETE FROM links where url like '%{$exclude}%';\n";
}

?>
