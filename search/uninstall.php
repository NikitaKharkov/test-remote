<?
include "sphider/settings/database.php";

$show_res = mysql_query("show tables");
while($row = mysql_fetch_array($show_res)) {
	if((strstr($row[0],"keyword") || strstr($row[0],"link")) && !strstr($row[0],"view"))
		mysql_query("drop table ".$row[0]) or die(mysql_error());
}
?>
