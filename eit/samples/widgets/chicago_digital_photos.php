<html>
    <head>
        <title>Images from the University of Chicago Digital Repository</title>
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

        $searchURL = "http://photoarchive.lib.uchicago.edu/db.xqy?keywords=" . urlencode($_GET["q"]);

        // create curl resource
        $ch = curl_init();
        // set url
        curl_setopt($ch, CURLOPT_URL, $searchURL);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);
        
        if ((substr_count($output,"thumbimage")) > 0) {
            for ($i = 0; $i < 4; $i++) {        
                $output = substr($output,strpos($output,'<div class="thumbimage'));
                $image = substr($output,0,strpos($output,'</div>')+6);    
                $output = substr($output,strpos($output,'</div>')+6);
                $image = str_replace("db.xqy","http://photoarchive.lib.uchicago.edu/db.xqy",$image);
                $image = str_replace("a href","a target=\"_blank\" href",$image);
                echo $image;
            }
            echo '<a href="' . $searchURL . '" target="_blank" style="clear:both;display:block;color:#005BC6;text-decoration:none;font-size:0.67em;font-family:Tahoma,Verdana,Arial,sans-serif;padding-top:4px;">Find More</a>';
        } else {        
            echo '<div>No results from the Photographic Archives.</div>';
            echo '<a href="http://photoarchive.lib.uchicago.edu/" target="_blank" style="clear:both;display:block;color:#005BC6;text-decoration:none;font-size:0.67em;font-family:Tahoma,Verdana,Arial,sans-serif;padding-top:4px;">Search the University of Chicago Photographic Archives</a>';
        }
?>

    </body>
</html>