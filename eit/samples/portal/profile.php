<?php
/**
* Enter your profile information for
* connecting to the EBSCOhost database
* here.
* 
* PHP version 5
*
* LICENSE: This source file is subject to version 3.01 of the PHP license
* that is available through the world-wide-web at the following URI:
* http://www.php.net/license/3_01.txt.  If you did not receive a copy of
* the PHP License and are unable to obtain it through the web, please
* send a note to license@php.net so we can mail you a copy immediately.
*
* @category  Simple_Search
* @package   PackageName
* @author    EBSCO Publishing's <author@example.com>
* @author    Persistent System Limited <minal@persistent.co.in>
* @copyright 1997-2005 The PHP Group
* @license   http://www.php.net/license/3_01.txt  PHP License 3.01
* @link      http://pear.php.net/package/PackageName
*/	


if( !isset( $_COOKIE["profile"]) || !isset( $_COOKIE["password"] ))
	die( header( "Location: ../auth.php?fwd=portal/"));

$profile 		= $_COOKIE["profile"];
$password		= $_COOKIE["password"];
$database="a9h";
	
?>