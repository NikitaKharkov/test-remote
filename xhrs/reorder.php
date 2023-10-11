<?php
/* --------------------------------------------------------------------- */
/* AJAX reordering page (for use with Record class)
/* 
/* @author  William Bond [wb] <will@imarc.net>
/* --------------------------------------------------------------------- */

require_once($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 

$type           = request_value('type');
$id             = request_value('id');
$new_order      = request_value('new_order');

try {
    $$type = new $type($id);
    $$type->changeOrder($new_order);
    
// Handle errors
} catch (Exception $e) {
    header("HTTP/1.1 500 Internal Server Error");     
}
?>