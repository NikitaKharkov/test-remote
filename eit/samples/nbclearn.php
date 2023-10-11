<?php
    $security_token = $_GET['security_token'];
    $target_url = $_GET['target_url'];
    
    $auth_url = "https://www.nbclearn.com/portal/security/encryptregcode/" . $security_token;

    $session = curl_init($auth_url); 	               // Open the Curl session
    curl_setopt($session, CURLOPT_HEADER, false); 	       // Don't return HTTP headers
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);   // Do return the contents of the call
    $response = curl_exec($session); 	                       // Make the call
    //header("Content-Type: text/xml"); 	               // Set the content type appropriately
    curl_close($session); // And close the session

    //$data = array('token' => '$response');

    //$session = curl_init(urldecode($target_url));
    //curl_setopt($handle, CURLOPT_POST, true);
    //curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
    //curl_exec($handle);
    
    //https://highered.nbclearn.com/portal/site/HigherEd/browse?cuecard=3218
?>

<form action='<?php echo urldecode($target_url); ?>' method='post' name='frm'>
<?php
    echo "<input type='hidden' name='token' value='".$response."'>";
?>
</form>
<script language="JavaScript">
document.frm.submit();
</script>