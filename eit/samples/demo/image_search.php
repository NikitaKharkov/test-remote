<html>
	<head>
		<title>EBSCO Image Collection</title>
	</head>
	<body>	
<style>
body {
	font-size: 11px;
	font-family: Tahoma, Arial, sans-serif;
}
#searchbox {
	margin: 0 auto;
	width: 600px;
	padding: 12px;
	text-align: center;
}
#searchbox input[type="text"] {
	width: 400px;
	margin-bottom: 6px;
}
#results_list {
	margin: 12px auto;
	padding: 12px;
	clear: both;

}
.result {
	float:left;
	height: 75px;
	text-align: center;
	padding: 6px;
	margin: 6px;
	max-width:100px;
}
.result.shadow {
	background-color:white;
	border:1px solid silver;
	height: 100px;
	
	box-shadow:2px 2px 3px #666;
	-webkit-box-shadow:2px 2px 3px #666;	
}
.result img {
	max-width:75px;
	max-height:75px;
	background-color:white;
	border:1px solid silver;
	
	box-shadow:2px 2px 3px #666;
	-webkit-box-shadow:2px 2px 3px #666;
}
.result img.noshadow {
	max-width:35px;
	max-height:35px;
	background-color:white;
	border:none;
	padding-bottom:6px;
	box-shadow:none;
	-webkit-box-shadow:none;
}

.doctype {
	padding-top: 6px;
	color: #666666;
	font-size: smaller;
}
#prev_next {
	width: 400px;
	margin: 0 auto;
	text-align: center;
	background: #DDDDDD;
	padding: 6px;
}
.noresults {
	color: red;
	font-weight: bold;
	font-style: italic;
	text-align: center;
}
#header {
	text-align: center;
	font-size: larger;
}
#radio-box {
	text-align: left;
	margin: 6px auto;
	width: 290px;
	font-size: small;
	float: left;
	margin-left: 80px;
}
#limiters {
	margin: 6px auto;
	text-align: left;
	font-size: small;
}
.hiddenDiv {
	display:none;
}

</style>
<script type="text/javascript">
	function toggleLimiters (dbcode) {
		if (dbcode == 'imh') {
			document.getElementById('limiters').className = '';
		} else {
			document.getElementById('limiters').className = 'hiddenDiv';
		}
	}
</script>
<div id="header">Image Search</div>

<?php
	if (isset($_REQUEST['submit'])) {
		$submitted = true;
	} else {
		$submitted = false;
	}
	
	$dbchoice['imh'] = 'Image Collection <a href="http://search.ebscohost.com/login.aspx?authtype=uid&user=ns054863&password=password&profile=image" target="_blank"><img src="external_link_icon.gif" /></a>';
	$dbchoice['igh'] = 'Medical Image Collection <a href="http://search.ebscohost.com/login.aspx?authtype=uid&user=ns054863&password=password&profile=medimage" target="_blank"><img src="external_link_icon.gif" /></a>';
	$dbchoice['ivh'] = 'Literary Image Collection <a href="http://search.ebscohost.com/login.aspx?authtype=uid&user=ns054863&password=password&profile=lrc"  target="_blank"><img src="external_link_icon.gif" /></a>';	
	$dbchoice['scvih'] = 'Science Video Collection <a href="http://search.ebscohost.com/login.aspx?authtype=uid&user=ns054863&password=password&profile=imagesci" target="_blank"><img src="external_link_icon.gif" /></a>';
	$dbchoice['hvh'] = 'Medical Video and Animations <a href="http://search.ebscohost.com/login.aspx?authtype=uid&user=ns054863&password=password&profile=medimage" target="_blank"><img src="external_link_icon.gif" /></a>';
	$dbchoice['vih'] = 'Video Encyclopedia of the 20th Century <a href="http://search.ebscohost.com/login.aspx?authtype=uid&user=ns054863&password=password&profile=imagewh" target="_blank"><img src="external_link_icon.gif" /></a>';
	
	$limiterchoice['MA X'] = 'Maps';
	$limiterchoice['NS X'] = 'Natural science photos';
	$limiterchoice['PC X'] = 'Photos of places';
	$limiterchoice['HI X'] = 'Historical photos';
	$limiterchoice['FL X'] = 'Flags';
	$limiterchoice['PO X'] = 'Photos of people';
	
?>
<div id="searchbox">
<form action="image_search.php" method="post">
	<input type="hidden" name="prof" value="ns054863.main.eitws" />
	<input type="hidden" name="pwd" value="ebs5078" />
	<input type="hidden" name="numrec" value="50" />
	<input type="hidden" name="startrec" value="1" />
	<input type="text" name="query" value="<?php echo $_REQUEST['query']; ?>" />
	<input type="submit" name="submit" value="Search" />
	<input type="hidden" name="userid" value="ns054863" />
	<input type="hidden" name="pass" value="password" /><br />
	<div id="radio-box">
	<?php
	$choice = 0;
	foreach ($dbchoice as $dbcode => $dblabel) {
		$choice += 1;
		echo '<input type="radio" name="db" value="'.$dbcode.'" ';
		if (isset($_REQUEST['db'])) {
			if (($_REQUEST['db']) == $dbcode) {
				echo 'checked';
				$checkedDB = $dbcode;
			}
		} else if ($choice == 1) {
			echo 'checked';
			$checkedDB = 'imh';
		}
		echo ' onclick="toggleLimiters(\'' . $dbcode . '\');"> '.$dblabel.'<br />';
	}
	?>
	</div>
	<div id="limiters"<?php if ($checkedDB != 'imh') { echo ' class="hiddenDiv"'; } ?>>
	This collection has additional options: <br/>
	<select multiple="multiple" name="limiters[]" size="<?php
	  echo sizeof($limiterchoice);
	?>">
	<?php
	$choice = 0;
	foreach ($limiterchoice as $limitercode => $limiterlabel) {
		$choice += 1;
		echo '<option value="'.$limitercode.'"';
		if (isset($_REQUEST["limiters"])) {
			foreach ($_REQUEST["limiters"] as $selectedlimiter) {
				if ($selectedlimiter == $limitercode) {
					echo ' selected="selected"';
				}
			}
		}
		echo '>'.$limiterlabel.'</option>';
	}
	?>
	</select>
	</div>
</form>
</div>
<div id="results_list">
<?php
	require('httpful-0.2.0.phar');

	if (isset($_REQUEST['submit'])) {
		//print_r($_REQUEST);

		$numrec = urlencode($_REQUEST["numrec"]);
		$query = urlencode($_REQUEST["query"]);
		$pwd = urlencode($_REQUEST["pwd"]);
		$prof = urlencode($_REQUEST["prof"]);
		$db = urlencode($_REQUEST["db"]);
		$user = urlencode($_REQUEST["userid"]);
		$password = urlencode($_REQUEST["pass"]);
		$startrec = urlencode($_REQUEST["startrec"]);

		if ((isset($_REQUEST["limiters"])) && ($db == 'imh')) {
			$count = 0;
			$limiterString = " AND (((";
			foreach ($_REQUEST["limiters"] as $selectedlimiter) {
				$count += 1;
				if ($count > 1) {
					$limiterString .= " OR ";
				}
				$limiterString .= $selectedlimiter;
			}
			$limiterString .= ")))";
			$query .= $limiterString;
		}
		
		$query = urlencode($query);
		$authString = "&authtype=uid&user=" . $user . "&password=" . $password;
		$url = "https://eit.ebscohost.com/Services/SearchService.asmx/Search?prof=".$prof."&pwd=".$pwd."&query=".$query."&db=".$db."&numrec=".$numrec."&startrec=".$startrec;
		$response = \Httpful\Request::get($url)
	    ->send();
		$response = str_replace("<ehisInfo>Y","<ehisInfo>",$response);
		$xml = simplexml_load_string(str_replace("<ehisInfo>\nY","<ehisInfo>",$response));
	    	$totrecords = $xml->Hits;
		if ($totrecords > 0) {
?>

<div id="prev_next">
	Results <?php
	    echo $_REQUEST['startrec'] . ' - ';
	    if ($totrecords > ($_REQUEST['startrec'] + 50)) {
		echo $_REQUEST['startrec'] + 49;
	    } else {
		echo $totrecords;
	    }
	    echo " of " . $totrecords . " hits";
	if ($_REQUEST['startrec'] > 1) {
?>
<form action="image_search.php" method="post" style="float:left;">
	<input type="hidden" name="prof" value="ns054863.main.eitws" />
	<input type="hidden" name="pwd" value="ebs5078" />
	<input type="hidden" name="numrec" value="50" />
	<input type="hidden" name="startrec" value="<?php
	
	$prev = $_REQUEST['startrec'] - 50;
	if ($prev < 1) {
		$prev = 1;
	}
	echo $prev;
	
	?>" />
	<input type="hidden" name="query" value="<?php echo $_REQUEST['query']; ?>" />
	<input type="hidden" name="userid" value="ns054863" />
	<input type="hidden" name="pass" value="password" />
	<input type="hidden" name="db" value="<?php echo $_REQUEST['db']; ?>" />
	<?php
	foreach ($_REQUEST["limiters"] as $limitercode) {
		echo '<input type="hidden" name="limiters[]" value="'.$limitercode.'" />';
	}
	?>
	<input type="submit" name="submit" value="Prev" />
</form>
<?php
	}
	if (($_REQUEST['startrec'] + 50) < $totrecords) {
?>
<form action="image_search.php" method="post" style="float:right;">
	<input type="hidden" name="prof" value="ns054863.main.eitws" />
	<input type="hidden" name="pwd" value="ebs5078" />
	<input type="hidden" name="numrec" value="50" />
	<input type="hidden" name="startrec" value="<?php
	
	$next = $_REQUEST['startrec'] + 50;
	echo $next;
	
	?>" />
	<input type="hidden" name="query" value="<?php echo $_REQUEST['query']; ?>" />
		<?php
	foreach ($_REQUEST["limiters"] as $limitercode) {
		echo '<input type="hidden" name="limiters[]" value="'.$limitercode.'" />';
	}
	?>
	<input type="hidden" name="userid" value="ns054863" />
	<input type="hidden" name="pass" value="password" />
	<input type="hidden" name="db" value="<?php echo $_REQUEST['db']; ?>" />
	<input type="submit" name="submit" value="Next" />
</form>
<?php
	}
?>
</div>
<div style="clear:both;">
<?php
		
			foreach ($xml->SearchResults->records->rec as $record) {
				$arttitle = $record->header->controlInfo->artinfo->tig->atl;
				$imgsrc = $record->header->controlInfo->img['src'];
				
				echo '<div class="result';
				if (strlen($imgsrc) == 0) {
					echo ' shadow';
				}
				echo '"> <a title="'.$arttitle.'" 
							target="_blank" href="'.$record->plink.$authString.'"'.'>';
				if (strlen($imgsrc) > 0) {
					echo '<img src="'.$record->header->controlInfo->img['src'].'" /></a>';
				} else {
					echo '<img src="play.png" class="noshadow"><br />';
					echo '<span style="font-size:small;">'.substr($arttitle,0,30) . "..</span>";
				}
				$doctype = $record->header->controlInfo->artinfo->doctype;
				if (strlen($doctype) > 0) {
					echo '<br /><span class="doctype">('.$doctype.')</span>';
				}
				echo '</div>';
			}

		} else {
			echo '<span class="noresults">No results found.</span>';
		}
	}	
?>	

</div>

</div>
<div style="display: none;">
	<?php
	echo $url;
	?>
</div>
	</body>
</html>
