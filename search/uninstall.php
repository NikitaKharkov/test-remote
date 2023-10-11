<?
include "sphider/settings/database.php";

$show_res = mysqli_query("show tables");
while($row = mysqli_fetch_array($show_res)) {
	if((strstr($row[0],"keyword") || strstr($row[0],"link")) && !strstr($row[0],"view"))
		mysqli_query("drop table ".$row[0]) or die(mysqli_error());
}
?>
