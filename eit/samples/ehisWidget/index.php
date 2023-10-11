<?php

/************************************************
*  EBSCO
*  Alvet Miranda (amiranda@ebscohost.com)
*  Description : EHIS to EIT Widget
*  
*  Date        : 2013-Feb-08
*  Notes       : Builds a URL for the ehisWidget
*	
************************************************/

?>
<?php header('Access-Control-Allow-Origin: *'); ?>
<?php

if(isset($_REQUEST["submit"])){
	
		$numrec = urlencode($_REQUEST["numrec"]);
		$query = urlencode($_REQUEST["query"]);
		$pwd = urlencode($_REQUEST["pwd"]);
		$prof = urlencode($_REQUEST["prof"]);
		$db = urlencode($_REQUEST["db"]);
		$title = urlencode($_REQUEST["title"]);
		$format = urlencode($_REQUEST["format"]);
		$protect = isset($_REQUEST["protect"])? urlencode($_REQUEST["protect"]) : "no";
		
		$generatedURL = "widget.php";
		$generatedURL =  $generatedURL."?prof=".(($protect=="yes")? base64_encode($prof):$prof);
		$generatedURL =  $generatedURL."&pwd=".(($protect=="yes")? base64_encode($pwd):$pwd);
		$generatedURL =  $generatedURL."&query=".$query;
		$generatedURL =  $generatedURL."&db=".$db;
		$generatedURL =  $generatedURL."&numrec=".$numrec;
		$generatedURL =  $generatedURL."&title=".$title;
		$generatedURL =  $generatedURL."&format=".$format;
		$generatedURL =  $generatedURL."&protect=".$protect;
		
		$textGeneratedURL = "http://support.ebscohost.com/eit/samples/ehisWidget/widget.php";
		$textGeneratedURL =  $textGeneratedURL."?prof=".(($protect=="yes")? base64_encode($prof):$prof);
		$textGeneratedURL =  $textGeneratedURL."&pwd=".(($protect=="yes")? base64_encode($pwd):$pwd);
		$textGeneratedURL =  $textGeneratedURL."&query=ep.SearchTerm";
		$textGeneratedURL =  $textGeneratedURL."&db=".$db;
		$textGeneratedURL =  $textGeneratedURL."&numrec=".$numrec;
		$textGeneratedURL =  $textGeneratedURL."&title=".$title;
		$textGeneratedURL =  $textGeneratedURL."&format=".$format;
		$textGeneratedURL =  $textGeneratedURL."&protect=".$protect;
}else{
		$numrec = "";
		$query =  "";
		$pwd =  "";
		$prof =  "";
		$db =  "";
		$title =  "";
		$format =  "";
		$protect =  "";
		$generatedURL = "";
		$textGeneratedURL = "";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EHIS Widget Builder</title>
<script>
function checkData(){

	var message = "";
	if(document.getElementById("numrec").value==""){
		message +="No. of Records\n";}
		
	if(document.getElementById("query").value==""){
		message +="Search Term\n";}
		
	if(document.getElementById("pwd").value==""){
		message +="Password\n";}
		
	if(document.getElementById("prof").value==""){
		message +="Profile ID\n";}
		
	if(document.getElementById("db").value==""){
		message +="Database ID\n";}
		
	if(document.getElementById("title").value==""){
		message +="Title\n";}
		
	if(message==""){
		return true;
	}else{
		message = "Please enter values into the following fields:\n"+message;
		alert(message);
		return false;
	}
}

/*"widget.php?
prof=ns019847.main.eit
&pwd=ebs6056
&query=books
&db=fc7599ae
&numrec=10
&title=BIOSIS%20Previews%20Results" 
width="300" height="500"
*/
</script>
<style>
* {
  margin: 0;
  padding: 0;
}
body{
	font-family:Arial, Helvetica, sans-serif;
	font-size:small;
}

#container{
	width:650px;
	height:600px;
	margin:0 auto;
	background-color:#ffffff;
	padding-left: 15px;
	padding-right: 15px;
}

#resultsBlock, #requestBlock{
	width:320px;
	height: 470px;
}
#resultsBlock{
	float:right;
}
#requestBlock{
	float:left;
}


h1{
	text-align:center;
}
h4{
	font-size:medium;
}

#header{
	background-color:#ffffff;
}
input{
	width:99%;
}
.optionInput{
	width:30px;
}

</style>
</head>

<body>
    <form method="post" action="#" onsubmit="return checkData();">
      <div id="container">
        	<p>&nbsp;</p>
        	<h1>EHIS Widget Builder</h1>
        	<p>&nbsp;</p>
            <div id="requestBlock">
            	<h4>
                	Step 1: Complete  below form
                </h4>
            	<p>&nbsp;</p>
            	<table width="100%" border="0" cellspacing="7" cellpadding="7">
            	  <tr>
            	    <td><div align="right">Profile ID: </div></td>
            	    <td><input type="text" name="prof" id="prof" value="<?php echo urldecode($prof) ?>" /></td>
          	    </tr>
            	  <tr>
            	    <td><div align="right">Password:</div></td>
            	    <td><input type="text" name="pwd" id="pwd"  value="<?php echo urldecode($pwd) ?>"  /></td>
          	    </tr>
            	  <tr>
            	    <td><div align="right">Search Term:</div></td>
            	    <td><input type="text" name="query" id="query"  value="<?php echo urldecode($query) ?>"  /></td>
          	    </tr>
            	  <tr>
            	    <td><div align="right">Database ID:</div></td>
            	    <td><input type="text" name="db" id="db"  value="<?php echo urldecode($db) ?>"  /></td>
          	    </tr>
            	  <tr>
            	    <td><div align="right">No. of Records:</div></td>
            	    <td><input type="text" name="numrec" id="numrec"  value="<?php echo urldecode($numrec) ?>" /></td>
          	    </tr>
            	  <tr>
            	    <td><div align="right">Title:</div></td>
            	    <td><input type="text" name="title" id="title"  value="<?php echo urldecode($title) ?>" /></td>
          	    </tr>
            	  <tr>
            	    <td><div align="right">Result Format:</div></td>
            	    <td align="left">
                        <input class="optionInput" <?php echo ($format=="html" or $format=="" )? 'Checked="Checked"':'' ?> type="radio" value="html" name="format" id="format" />HTML
                        <input class="optionInput" <?php echo ($format=="xml")? 'Checked="Checked"':'' ?> type="radio" value="xml" name="format" id="format" />XML
                    </td>
          	    </tr>
            	  <tr>
            	    <td colspan="2" align="left">Protect Profile ID and Password?
                    <input style="width:30px;" <?php echo ($protect=="yes" or $protect=="")? 'Checked="Checked"':'' ?> type="checkbox" value="yes" name="protect" id="protect" /></td>
           	      </tr>
              </table>
            	<p>&nbsp;</p>
            	<h4>
                	Step 2: Click  button to generate URL
                      <br />
                      <br />
            	</h4>
                
               <p> <input value="Generate URL" type="submit" name="submit" id="submit" /> <br />
<br />
</p>
                <textarea title="Click, Right Click and select Copy to copy this URL" style="width:99%; height:100px;" id="generatedURL" onclick="this.select();"><?php echo $textGeneratedURL ?></textarea>
                
		    </div>
            <div id="resultsBlock">
            	<h4>Step 3: Verify  Results</h4>
            	<p>&nbsp;</p>
	            <iframe id="widget" style="width:310px;height:420px;" src="<?php echo $generatedURL ?>"></iframe>
            </div>
            <div style="clear:both;"></div>
                 <h4>&nbsp;
               	</h4>
                 <h4>Step 4: Copy URL and Paste into Widget placeholder in EBSCO Discovery Service</h4>
        </div>
    </form>
</body>
</html>