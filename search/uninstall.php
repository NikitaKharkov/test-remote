<?php
include "sphider/settings/database.php";

$show_res = mysqli_query($mysql_connection, "show tables");
while($row = mysqli_fetch_array($show_res)) {
	if((strstr($row[0],"keyword") || strstr($row[0],"link")) && !strstr($row[0],"view"))
		mysqli_query($mysql_connection, "drop table ".$row[0]) or die(mysqli_error($mysql_connection));
}
?>
