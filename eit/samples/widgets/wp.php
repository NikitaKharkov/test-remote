<?php

// first we are going to construct the wikipedia API url using q= in our URL
// it is important to urlencode the value otherwise searches like parkinson's disease are going to fail

$site_url = 'http://en.wikipedia.org/w/api.php?action=query&list=search&format=json&srsearch='. urlencode($_GET["q"]);

// second we are going to use CURL to pick up the file and make it available for processing
// we need to do this as many servers don't allow file_get_contents() in their php.ini file
// the Wikipedia API requires a descriptive user agent including contact details

$ch = curl_init();
$timeout = 5; // set to zero for no timeout
curl_setopt ($ch, CURLOPT_URL, $site_url);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
curl_setopt ($ch,CURLOPT_USERAGENT,'EDS Wikipedia Widget (cwolf@ebscohost.com)');
ob_start();
curl_exec($ch);
curl_close($ch);
$file_contents = ob_get_contents();
ob_end_clean();

// let's decode the JSON string into arrays

$json_a = json_decode($file_contents,true);

// let's create some wrapper html

echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html;charset=utf-8\"/>";
echo "<head>";
echo "<title>Wikipedia PHP</title>";
echo "<style type=\"text/css\">";
echo "p {font-size:12px;font-family:Tahoma,Geneva,Kalimati,sans-serif;}";
echo "a {font-size:13px;font-family:Tahoma,Geneva,Kalimati,sans-serif;font-weight:bold;text-decoration:underline;}";
echo ".searchmatch {font-weight:bold;font-style:italic;color:red}";
echo "</style>";
echo "</head>";

// the API gives us ten results, but we only want to use the first five, we set i to be zero and then count up

for($i=0;$i<5;$i++){
	echo '<p><a href="http://en.wikipedia.com/wiki/' .$json_a[query][search][$i][title].'" target="_blank">'.$json_a[query][search][$i][title].'</a><br/>' .$json_a[query][search][$i][snippet]. '</p>';
	}

// close our wrapper code

echo "</body>";
echo "</html>";

// yup we are done, almost more comments than anything else

?>


