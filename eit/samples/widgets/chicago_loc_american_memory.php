<html>
    <head>
        <title>Images from the American Environmental Photographs</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style type="text/css">
                        
            .thumbimage {
                float:left;
                margin-right:10px;
                margin-bottom:4px;
            }
            .thumbimage a img {
                max-width:55px;
                max-height:55px;
                padding:4px;
                background-color:white;
                border:1px solid silver;
                
                box-shadow:2px 2px 3px #666;
                -webkit-box-shadow:2px 2px 3px #666;
            }
                
        </style>

    </head>
    <body>
       <?php

//set POST variables
$url = 'http://memory.loc.gov/cgi-bin/query';
$fields = array(
            'queryaep' => urlencode($_GET["q"]),
            'search_coll' => urlencode("GO"),
            'directory' => urlencode("ammem"),
            'Stemming' => urlencode("Yes"),
            'allwords' => urlencode("1")
        );

//url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);

$begin_link = strpos($result,'<a href="/cgi-bin/query/f?aep');
$end_link = strpos($result,'Gallery</a>')+11;
$length_link = $end_link - $begin_link;
$link_to_gallery = substr($result,$begin_link,$length_link);
$link_to_gallery = str_replace("/cgi-bin/","http://memory.loc.gov/cgi-bin/",$link_to_gallery);

$url_to_gallery = substr($link_to_gallery,strpos($link_to_gallery,"http://"));
$url_to_gallery = substr($url_to_gallery,0,strpos($url_to_gallery,"\""));

$ch2 = curl_init();
        // set url
        curl_setopt($ch2, CURLOPT_URL, $url_to_gallery);

        //return the transfer as a string
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch2);

        // close curl resource to free up system resources
        curl_close($ch2);
        
        if ((substr_count($output,'<a class="collect')) > 0) {
            for ($i = 0; $i < 4; $i++) {
                if ((substr_count($output,'<a class="collect')) > 0) {

                $output = substr($output,strpos($output,'<a class="collect'));
                $image = substr($output,0,strpos($output,'</a>')+4);
                $output = substr($output,strpos($output,'</a>')+4);
                $image = str_replace("/cgi-bin","http://memory.loc.gov/cgi-bin",$image);
                $image = str_replace("href","target=\"_blank\" href",$image);
                $image = substr($image,0,strpos($image,"<br")) . "</a>";
                echo "<div class=\"thumbimage\">" . $image . "</div>";
                }
            }
            echo '<a href="' . $url_to_gallery . '" target="_blank" style="clear:both;display:block;color:#005BC6;text-decoration:none;font-size:0.67em;font-family:Tahoma,Verdana,Arial,sans-serif;padding-top:4px;">Find More</a>';
        } else {        
            echo '<div>No results from the American Environmental Photographs.</div>';
            echo '<a href="http://memory.loc.gov/ammem/collections/ecology/index.html" target="_blank" style="clear:both;display:block;color:#005BC6;text-decoration:none;font-size:0.67em;font-family:Tahoma,Verdana,Arial,sans-serif;padding-top:4px;">Search the University of Chicago Photographic Archives</a>';
        }
        

        ?>
    </body>
</html>