<?php require('_drawrating.php'); ?>
<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ratings</title>
<script type="text/javascript" src="js/behavior.js"></script>
<script type="text/javascript" src="js/rating.js"></script>
<link rel="stylesheet" type="text/css" href="css/rating.css" media="all" />
</head>
<body>
<?
if ( $_POST['submit'] ) {

   $error = '';
   
   if ( $_POST['comment'] == '' ) {
     $error = 'Error: Please enter your comments';
}
   elseif(in_array($_POST['q'],$_SESSION['comment']))
   { header ("Location: /knowledge_base/thanku.php"); }

   elseif ( !$_POST['q'] && ( !$_POST['rating'] ) )
   { header ("Location: /knowledge_base/thanku.php"); }
	
   elseif (!array_intersect($_SESSION['kbids'],$_SESSION['ratings']))
   { header ("Location: /knowledge_base/thanku.php"); }

	elseif ( !$error ) {

   if ( !isset( $_SESSION['comment'] ) ) {
   $_REQUEST['q'] = array();
}
$cids = $_REQUEST['q'];
$_SESSION['comment'][$cids] = $cids;

mysqli_connect("localhost", "root", "") or die(mysqli_error());
mysqli_select_db("faq_ratings") or die(mysqli_error());

$mysql = array();
$mysql['id'] = mysqli_real_escape_string( $_POST['q'] );
$mysql['rating'] =  mysqli_real_escape_string( $_POST['rating'] );
$mysql['comment'] = mysqli_real_escape_string( $_POST['comment'] );
$sql = "INSERT INTO comments ( id,rating,comment,date ) VALUES ( '{$mysql['id']}','{$mysql['rating']}','{$mysql['comment']}', NOW() )"; 
mysqli_query($rating_conn, $sql);

//echo "Thank you for your feedback!";
header('Location: /knowledge_base/thanku.php', true, 302);

}
}
?>
<? if ( $error ) { ?>
   <?=$error;?>
<? } ?>	
<form method="post" action="<? echo $PHP_SELF;?>">
<input type="hidden" id="id" name="q" value="<?= $q ?>" />
<input type="hidden" id="rating" name="rating" value="<?= $rating ?>" />
	<textarea id="comment" maxlength="1000" name="comment" cols="30" rows="5"wrap="hard"></textarea>
<br><input type="submit" name="submit" id="submit" value="Submit Comment" /></form><br /><br />
</body>
</html>
