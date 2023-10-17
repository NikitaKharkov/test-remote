<?php
	$database="sphider_db";
	$mysql_user = "mysql";
	$mysql_password = "0utofs1t3d3v"; 
	$mysql_host = "localhost";
	$mysql_table_prefix = "";

	$success = mysqli_connect ('p:'.$mysql_host, $mysql_user, $mysql_password);
	if (!$success)
		die ("<b>Cannot connect to database, check if username, password and host are correct.</b>");
	$success = mysqli_select_db ($database);
	if (!$success) {
		print "<b>Cannot choose database, check if database name is correct.";
		die();
	}
?>

