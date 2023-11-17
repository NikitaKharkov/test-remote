<?
error_reporting(E_ALL);
$settings_dir = "sphider/settings";
include "$settings_dir/database.php";

$error = 0;

mysqli_query($mysql_connection, "drop table `".$mysql_table_prefix."filteredKeywords`");
if (mysqli_errno($mysql_connection) > 0) { print "Error: " . mysqli_error($mysql_connection) . "<br>\n"; }

mysqli_query($mysql_connection, "create table `".$mysql_table_prefix."filteredKeywords`
	select k.keyword_id, k.keyword, sum(v.weight) as weight
	from keywords k, links l, (
		select * from link_keyword0 union all
		select * from link_keyword1 union all
		select * from link_keyword2 union all
		select * from link_keyword3 union all
		select * from link_keyword4 union all
		select * from link_keyword5 union all
		select * from link_keyword6 union all
		select * from link_keyword7 union all
		select * from link_keyword8 union all
		select * from link_keyword9 union all
		select * from link_keyworda union all
		select * from link_keywordb union all
		select * from link_keywordc union all
		select * from link_keywordd union all
		select * from link_keyworde union all
		select * from link_keywordf
	) v
	where k.keyword_id = v.keyword_id
	and v.link_id = l.link_id
	and url not like '%lang%'
	group by k.keyword_id, k.keyword
	having sum(v.weight) > 500
	order by sum(v.weight) desc
");
if (mysqli_errno($mysql_connection) > 0) { print "Error: " . mysqli_error($mysql_connection) . "<br>\n"; }
?>
