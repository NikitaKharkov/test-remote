<?php
ob_start();
$filename = $_REQUEST['file'];
$filename = $_SERVER['DOCUMENT_ROOT'] . $filename;

if (!@file_exists($filename)) {
    die('The file specified could not be found');    
}

if (!@is_readable($filename)) {
    die('The file specified could not be read');   
}

header('Content-Type: text/css');
header('Last-Modified: ' . date('D, d M Y H:i:s', filemtime($filename)));
header('Content-Length: ' . @filesize($filename));
header('Cache-Control: ');
header('Expires: ');
header('Pragma: ');

$contents = file_get_contents($filename);
$contents = preg_replace('/(body\s+{([^}]*)})/ie', "_remove_background_elements('$2')", $contents);
echo $contents;

function _remove_background_elements($text) {
    $text = str_replace("\n", ' ', $text);
    $elements = explode(';', $text);
    $new_elements = array();
    foreach ($elements as $element) {
        if (trim($element) && stripos($element, 'background') === FALSE) {
            $new_elements[] = $element . ";";   
        }
    }
    $new_definition  = "body {\n";
    $new_definition .= join("\n", $new_elements);
    $new_definition .= "\n}\n";
    return $new_definition;    
}
?>