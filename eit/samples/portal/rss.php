<?php
/**
* This file will simply retrieve the RSS reed in $url, and will display it
* using XSLT
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


require "functions.php" ; // Misc. Functions

//Pass paramenters and URL for RSS feed
xml_header("rss.xsl");

$url = "http://rss.ebscohost.com/AlertSyndicationService/Syndication.asmx/GetFeed?guid=3030448";

$xml = curl_get($url);

$xml = str_replace('<?xml version="1.0" encoding="utf-8"?>', '', $xml);
$xml = preg_replace('/<rss(.*?)>/', '<ep_feed>', $xml);
$xml = preg_replace('/<\/rss>/', '</ep_feed>', $xml);
$xml = preg_replace('/<description>(.*?)<\/description>/', '<description></description>', $xml);

echo $xml;


?>
