<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title>DynaMed CME/CE Form</title>
		<meta http-equiv="Content-Type" content="charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="css/styles.css" />
		<?//Optionally include a CSS fix for Safari
		if(strstr($_SERVER['HTTP_USER_AGENT'],"Safari")) {?>
		<link rel="stylesheet" type="text/css" href="css/safariStyles.css" />
		<?}?>
		<script type="text/javascript" src="js/utils.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<script type="text/javascript" src="js/validate.js"></script>
		<?//add style specific to customer?>
		<?//add validation for customer-specific form?>
		<?if( $customer<>$defaultCustomer ){?>
		<link rel="stylesheet" type="text/css" href="css/styles<?=$customer?>.css" />
		<script type="text/javascript" src="js/validate<?=$customer?>.js"></script>
		<?}?>
	</head>

	<body>
		<div id="main">
