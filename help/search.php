<div id="help_content_holder">
    <div id="help_content">
        <?php
$s = $_REQUEST['s'] ?? '';


$mysql_connection = $objects->Database->getConnection();

// leave old approach just in case
//connect to database
//mysqli_connect("supportdb102.epnet.com","supportUser","kn0wl3dge2g@1n$"); //(host, username, password)
//$mysql_connection = mysqli_connect('db',"admin","admin"); //(host, username, password)

//specify database
//mysqli_select_db($mysql_connection, "support_epnet") or die("Unable to select database");

 // SQL injection protection for the _GET
 foreach ($_GET as $key => $value) {
    $_GET[$key] = mysqli_real_escape_string($mysql_connection, $value);
  } 
 
 // Get the search variable

 	$var = $_GET['q'] ?? '';
	$trimmed = trim($var); //trim whitespace from the stored variable

 // rows to return
	$limit=25;
	
 // check for an empty string and display a message.
 if ($trimmed == "")
 	{
  		echo "<p>Please enter a search...</p>";
  		exit;
  	}

 // check for a search parameter
 if (!isset($var))
 	{
  		echo "<p>We dont seem to have a search parameter!</p>";
  		exit;
  	}

$words = $_GET['words'];
if ($words == 2) {
     // Build SQL Query
     $query = "select DISTINCT help_page_id, title from support_epnet.help_pages where content like '%$trimmed%' "
     ."and help_page_id in ( "
     ."SELECT help_page_id "
     ."FROM support_epnet.help_pages p "
     ."INNER JOIN support_epnet.help_topics t "
     ."ON p.help_topic_id=t.help_topic_id "
     ."INNER JOIN support_epnet.help_versions v "
     ."ON t.help_version_id=v.help_version_id "
     ."WHERE p.status='live' and language_id='1' and v.help_interface_id=".$help_interface->getPrimaryKey().") ORDER BY title";
} else {
    $trimmed = explode(" ", $var);
    $where = '';
    foreach ($trimmed as $word) {
        $where .= $where === ''
            ? "content LIKE '%$word%'"
            : ($words == 1 ? ' AND ' : ' OR ')."content LIKE '%$word%'"
        ;
    }

    $query = "select DISTINCT help_page_id, title from support_epnet.help_pages WHERE ($where) ";

    $query.= " and help_page_id in ("
    ."SELECT help_page_id "
    ."FROM support_epnet.help_pages p "
    ."INNER JOIN support_epnet.help_topics t "
    ."ON p.help_topic_id=t.help_topic_id "
    ."INNER JOIN support_epnet.help_versions v "
    ."ON t.help_version_id=v.help_version_id "
    ."WHERE p.status='live' and language_id='1' and v.help_interface_id=".$help_interface->getPrimaryKey().") ORDER BY title ASC";
    //."WHERE p.status='live' and v.status='live' and v.help_interface_id=".$help_interface->getPrimaryKey().")";
    }
    //echo $query;

    $numresults=mysqli_query($mysql_connection, $query);
    $numrows=mysqli_num_rows($numresults);

    if ($numrows == 0) {
        //echo "<h3>Results</h3>";
        echo "<p class='results'>Sorry, your search <b>" . $var . "</b> returned zero results</p>";
    } else {
 // next determine if s has been passed to script, if not use 0
 if (empty($s)) {
 	$s=0;
  }
  
 // get results
 	$query .= " limit $s,$limit";
 	$result = mysqli_query($mysql_connection, $query) or die("Couldn't execute query");

 // display what the person searched for
 	echo "<div><p class='results'>Your search results for <b>" . $var . "</b></p></div>";

 // begin to show results set
 	//echo "Results<br />";
 	//$count = 1 + $s ;

 // now you can display the results returned
 	while ($row= mysqli_fetch_array($result))
 	{
 		$title = $row["title"];
 		$help_page_id = $row["help_page_id"];
 		echo "<a href='/help/index.php?help_id=$help_page_id'>".$title."</a><br /><br />";
 		//$count++ ;
  	}

 	$currPage = (($s/$limit) + 1);

 //break before paging
 	echo "<br />";

 // next we need to do the links to other results
 	if ($s>=1) { // bypass PREV link if s is 0
 	$prevs=($s-$limit);
 	print "&nbsp;<a href=\"{$_SERVER['SCRIPT_NAME']}?s=$prevs&q=$var\">&lt;&lt; 
 	Prev 25</a>&nbsp&nbsp;";
 	}

 // calculate number of pages needing links
 	$pages=intval($numrows/$limit);

 // $pages now contains int of pages needed unless there is a remainder from division

 	if ($numrows%$limit) { // has remainder so add one page
 	$pages++;
  	}

 // check to see if last page
 	if (!((($s+$limit)/$limit)==$pages) && $pages!=1) {

 // not last page so give NEXT link
 	$news=$s+$limit;

 	echo "&nbsp;<a href=\"{$_SERVER['SCRIPT_NAME']}?s=$news&q=$var\">Next 25 &gt;&gt;</a>";
  	}

	$a = $s + ($limit) ;
  	if ($a > $numrows) { $a = $numrows ; }
  $b = $s + 1 ;
  echo "<p>Showing results $b to $a of $numrows</p>Visit the <a href='http://support.ebsco.com' target='_blank'>EBSCO Support Site</a> for more information. ";
}
?>
    </div>
</div>
