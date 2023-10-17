<?php
/**
 * common functions and includes
 * 
 * Copyright 2002 - 2007, iMarc <info@imarc.net>
 * 
 * @version  5.2.3
 * 
 * @author  Dave Tufts      [dt] <dave@imarc.net>
 * @author  William Bond    [wb] <will@imarc.net>
 * @author  Fred LeBlanc    [fl] <fred@imarc.net>
 * @author  Patrick McPhail [pm] <patrick@imarc.net>
 * @author  Bill Bushee     [bb] <bill@imarc.net>
 * @author  Jeff Turcotte   [jt] <jeff@imarc.net>
 * @author  Dan Collins     [dc] <dan@imarc.net>
 * 
 * @requires  PHP 5+
 * 
 * @changes  5.2.4   smart_nl2br() now properly supports the small and big tags [pm, 2007-11-09]
 * @changes  5.2.3   Fixed link_maker() so that it won't chop urls in the middle of htmlentities and will ensure the links produced are valid html [wb, 2007-10-31]
 * @changes  5.2.2   Fixed form_value() to use smart_htmlentities() instead of html_entities() [dc, 2007-10-12]
 * @changes  5.2.1   Added the code tag to the non-structure elements of smart_nl2br [wb, 2007-10-12]
 * @changes  5.2.0   Added unhtmlentities() [wb, 2007-08-13]
 * @changes  5.1.2   Fixed a bug in convert_to_url() [wb, 2007-07-20]
 * @changes  5.1.1   Fixed db_value() to use the SQL spec method of escaping single quotes [wb, 2007-07-14]
 * @changes  5.1.0   Added in_imarc() function [dt, 2007-06-27]
 * @changes  5.0.3   Short tag fix [wb, 2007-06-20]
 * @changes  5.0.2   smart_nl2br() now properly supports the abbr tag [dt, 2007-06-15]
 * @changes  5.0.1   smart_nl2br() now properly supports the acronym tag [dt, 2007-06-14]
 * @changes  5.0.0   Renamed file from common.php to base.functions.php, removed automatic inclusion of common.conf.php, added base_get_version() [dt, 2007-05-15]
 * @changes  4.6.2   Fixed an issue where cleanup could improperly remove some html entities, fixed form_value too [wb, 2007-05-07]
 * @changes  4.6.1   Fixed xml_value() to handle utf-8 chars with numeric entities [wb, 2007-04-19]
 * @changes  4.6.0   Added smart_htmlentities() and updated cleanup() to create htmlentities for all unicode characters [wb, 2007-04-19]
 * @changes  4.5.0   Added in_cidr() function and updated phpdoc comments to iMarc code standards [wb, 2007-03-07]
 * @changes  4.4.4   Added option to rich_text_editor preventing automatic URLs conversion to local absolute values [fl, 2007-03-07]
 * @changes  4.4.3   Fixed rich_text_editor support for image alignment [jt, 2007-03-02]
 * @changes  4.4.2   Fixed a strict error reporting issue with print_dom_js() [wb, 2007-02-22]
 * @changes  4.4.1   Fixed bug with print_dom_js() where onchange attributes were not being created properly [wb, 2007-02-20]
 * @changes  4.4.0   Added xml_value() method [wb, 2007-01-31]
 * @changes  4.3.0   Added add_to_onunload() method [jt, 2007-01-03]
 * @changes  4.2.3   Fixed a bug introduced in 4.2.1 [wb, 2006-11-30]
 * @changes  4.2.2   Fixed a bug in print_dom_js where encoded ampersands inside of hrefs were not being properly parsed [wb, 2006-11-21]
 * @changes  4.2.1   Fixed bug in form_value() where html tags weren't encoded so closing textarea tags would break a form [wb, 2006-11-20]
 * 
 * See http://wiki.imarc.net/wikka/CommonChangeLog for the complete change log
 */


/**
 * Returns the version of this file
 * 
 * @since  2.9.0
 * 
 * @param  void
 * @return string  The version of this file
 */
function base_get_version()
{
	return '5.2.3';
}

/**
 * [Depreciated]
 */
function common_get_version()
{
	return base_get_version();
}



/* --------------------------------------------------------------------- */
/* Miscellaneous Functions
/* 
/* Various helper functions that don't fit into another category
/* --------------------------------------------------------------------- */


/**
 * Returns a random string of specified length
 * 
 * @since  2.0.0
 * 
 * @param  integer $length      number of characters random string should be
 * @param  string  $characters  what characters to use when generating the string ('alpha', 'numeric', 'alphanumeric')
 * @return string  alphanumeric random string of length chars
 */
function random_string($length, $characters='alphanumeric')
{
	$character_map = array('alphanumeric' => '0123456789ABCDEFGHIJKLMNPOQRSTUVWXYZabcdefghijklmnopqrstuvwxyz',
                           'alpha'        => 'ABCDEFGHIJKLMNPOQRSTUVWXYZabcdefghijklmnopqrstuvwxyz',
                           'numeric'      => '0123456789');
    $keys = array_keys($character_map);
    if (!isset($character_map[$characters])) { $characters = @array_shift($keys); }
    
    srand((double) microtime() * intval(rand(1,1000000)));
	$chars = $character_map[$characters];
    $chars_len = strlen($chars);
	$string = '';
	while (strlen($string) < $length) {
		$string .= substr($chars, (rand() % $chars_len), 1);
	}
	return $string;
}


/**
 * Grabs page function from REQUEST and checks it against valid values, can override REQUEST page function value
 * 
 * @since 3.2.0
 * 
 * @param  array  $valid_page_functions  The valid values for page_function
 * @param  string $page_function         The page function to check
 * @return string  The page function to use
 */
function page_function($valid_page_functions, $page_function=NULL)
{
	// Use either the passed page function, or one from request
	if (empty($page_function)) {	
		$page_function = (!empty($_REQUEST['page_function'])) ? $_REQUEST['page_function'] : NULL;
	}
	// Make sure the page function is valid
	if (!in_array($page_function, $valid_page_functions)) {
		$page_function = $valid_page_functions[0];
	}
	return $page_function;	
}


/**
 * Returns odd/even, used for alternating row colors
 *
 * @since 3.9.0
 *
 * @param  mixed $series  Series of $i to use
 * @return string
 */
function get_background($series=0)
{
	static $i = array();

	if (!isset($i[$series])) {
		$i[$series] = 0; 
	}

	++$i[$series];
	
	$ret = ($i[$series] % 2) ? 'odd' : 'even';
	return $ret;
}


/**
 * Checks if ip address is in any one of the cidr ranges or equal to one of the ip addresses supplied
 * 
 * @since 4.5.0
 * 
 * @param  string $ip    The ip address we are checking
 * @param  mixed  $cidr  String or array of cidr range(s) or ip address(es)
 * @return boolean   TRUE if ip address is in at least one of the cidr ranges 
 */
function in_cidr($ip, $cidr) 
{	
	$cidr_array = (is_array($cidr)) ? $cidr : array($cidr);
	
	foreach ($cidr_array as $cidr_range) {
		$ip_arr       = explode('/', $cidr_range);
		if (empty($ip_arr[1])) { $ip_arr[1] = 32; }
		$network_long = ip2long($ip_arr[0]);
		$mask_long    = pow(2,32)-pow(2,(32-$ip_arr[1]));
		$ip_long      = ip2long($ip);
		if (($ip_long & $mask_long) == $network_long) {
			return TRUE;
		}
	}
	
	return FALSE;
}

/**
 * Checks if user's IP is coming from iMarc's office
 * 
 * @since 5.1.0
 * 
 * @param  void
 * @return boolean   TRUE if user is in iMarc's cidr range 
 */
function in_imarc() 
{	
	return (bool) in_cidr($_SERVER['REMOTE_ADDR'], '74.211.142.0/26');
}




/* --------------------------------------------------------------------- */
/* Messaging Functions
/* 
/* Functions that deal with messaging
/* --------------------------------------------------------------------- */


/**
 * Prints a stylized message
 *
 * @since  1.0.0
 * 
 * @param  string $message  the string to be printed
 * @param  string $class    css class
 * @return void
 */
function print_message($message, $class=NULL)
{
	echo (!empty($class)) ? '<div class="' . $class . '">' : '<div>';
	echo $message . '</div>';
}



/**
 * Prints out messages, errors or notes if they exist
 *
 * @since 3.11.0
 * 
 * @param  string $message  The message to print
 * @param  string $error    The error message to print
 * @param  string $note     The note to print
 * @param  string $warning  The warning to print
 * @return void
 */
function print_all_messages($message=NULL, $error=NULL, $note=NULL, $warning=NULL)
{
	if (!empty($message)) { print_message($message, 'success'); }
	if (!empty($error))   { print_message($error, 'error'); }
	if (!empty($note))    { print_message($note, 'info'); }
	if (!empty($warning)) { print_message($warning, 'warning'); }	
}



/* --------------------------------------------------------------------- */
/* Text/HTML/Code Display Functions
/* 
/* Functions that change html/text/code for (mainly) display purposes
/* --------------------------------------------------------------------- */


/**
 * Converts almost any date format, to a specified format
 * 
 * Valid formats for $format param:
 *    - timestamp       RETURNS unix timestamp
 *    - mm/dd           RETURNS 11/26
 *    - mm/dd/yy        RETURNS 11/26/73
 *    - mm/dd/yyyy      RETURNS 11/26/1973
 *    - short           RETURNS Nov 26, 1973
 *    - long            RETURNS Tuesday, November 26, 1973
 *    - datetime        RETURNS Tuesday, November 26, 1973 5:24 pm
 *    - mysql_date      RETURNS 1973-11-26
 *    - mysql_datetime  RETURNS 1973-11-26 17:24:59
 *    - mysql_timestamp RETURNS 19731126172459
 *    - mssql_datetime  RETURNS 1973-11-26 17:24:59.000
 *    - php             RETURNS formatting from $php_formatting (default is November 26, 1973)
 *    - php|m/d/Y       RETURNS shorthand php formatting. replace m/d/Y with php date() {@link http://php.net/date PHP.net date()}
 *    - NULL            RETURNS November 26, 1973
 * 
 * @since  1.0.0
 * 
 * @param  string $date            date to be converted. default date is current timestamp.
 * @param  string $format          date format to be returned (see below for VALID FORMATS)
 * @param  string $php_formatting  custom php date format if 'format' is set to 'php'
 * @return string  The date in the format specified
 */
function convert_date($date='', $format='', $php_formatting='F j, Y')
{
	if (!$date) { $date = time(); }
	
	if ($date == '0000-00-00' || $date == '0000-00-00 00:00:00') {
		return NULL;
	}
	
	if (is_numeric($date)) {
		if (strlen($date) == 10 || strlen($date) == 9) {
			// A Unix Timestamp (9 or 10 digit number for most common dates)
			$time = $date;
		} elseif ((strlen($date) == 8) || (strlen($date) == 14)) {
			// SQL timestamp(8) or timestamp(14) formats:
			// 19731126172459 or 19731126
			$year   = (int) substr($date, 0, 4);
			$month  = (int) substr($date, 4, 2);
			$day    = (int) substr($date, 6, 2);
			if (strlen($date) == 14) {
				$hour   = (int) substr($date, 8, 2);
				$minute = (int) substr($date, 10, 2);
				$second = (int) substr($date, 12, 2);
			} else {
                $hour   = 0;
                $minute = 0;
                $second = 0;   
            }
			$time = mktime($hour,$minute,$second,$month,$day,$year);
		} else {
			return NULL;
		}
	} else {
		$time = strtotime($date);
	}
	
	// If strtotime didn't work, we'll give up...
	if ((int) $time == -1) {
		$time = '';
	}
	if (empty($time)) { return NULL; }
	
    $lower_format = strtolower($format);
    	
	// OUTPUT FORMATTING
	if ($lower_format == 'timestamp') {
		return $time;                                          // return a UNIX Timestamp
	} elseif ($lower_format == 'mm/dd') {
		return date('m/d', $time);                            // return "11/26"
	} elseif ($lower_format == 'mm/dd/yy') {
		return date('m/d/y', $time);                          // return "11/26/73"
	} elseif ($lower_format == 'mm.dd.yy') {
		return date('m.d.y', $time);                          // return "11.26.73"
	} elseif ($lower_format == 'mm/dd/yyyy') {
		return date('m/d/Y', $time);                          // return "11/26/1973"
	} elseif ($lower_format == 'short') {
		return date('M j, Y', $time);			              // "Nov 26, 1973"
	} elseif ($lower_format == 'long') {
		return date('l, F j, Y', $time);                      // "Tuesday, November 26, 1973"
	} elseif ($lower_format == 'datetime') {
		return date('l, F j, Y g:i a', $time);                // "Tuesday, November 26, 1973 5:24 pm"
	} elseif ($lower_format == 'mysql_date') {
		return date('Y-m-d', $time);                          // "1973-11-26"
	} elseif ($lower_format == 'mysql_datetime') {
		return date('Y-m-d H:i:s', $time);                    // "1973-11-26 17:24:59"
	} elseif ($lower_format == 'mysql_timestamp') {
		return date('YmdHis', $time);                         // "19731126172459"
	} elseif ($lower_format == 'mssql_datetime') {
		return date('Y-m-d H:i:s.000', $time);                // "1973-11-26 17:24:59.000"
	} elseif ($lower_format == 'php') {
		return date($php_formatting, $time);                  // $php_formatting, uses default (below) if none
	} elseif (stripos($format, 'php|') !== FALSE) {
		$php_formatting = trim(str_replace('php|', '', $format));
		return date($php_formatting, $time);                  // Shorthand to php_format date/time
	} else {
		return date('F j, Y', $time);                         // "November 26, 1973" (the DEFAULT)
	}
}


/**
 * Debugging function, prints input through, <pre> tag and print_r() function 
 * 
 * @since  2.5.0
 * 
 * @param  mixed   $input         any data you want
 * @param  boolean $quit          if true, exit() is called after output
 * @param  boolean $show_objects  Should we show the Objects class from the print_r?
 * @return void
 */
function trace($mixed, $quit=FALSE, $show_objects=FALSE)
{
	$variable = print_r($mixed, TRUE);
	
    if (!$show_objects) {
		// Use a recursive regular expression to strip out the objects private variable
        $variable = preg_replace('/^\s+\[objects:(?:protected|private)\] => Objects Object\s+(\((((?>[^()]+)|(?1))*)\))\s*^/ims', '', $variable);
	}
	
	echo "<pre>\n";
	print_r($variable);
	echo "</pre>\n";
	if ($quit) { exit; }
}


/**
 * Shortcut function for using optical clean truncate
 * 
 * @since 3.2.0
 * 
 * @param  string  $text    The page function to display after reload
 * @param  numeric $length  The desired optical length
 * @param  string  $font    The typeface to use for optical checking
 * @return mixed  The truncated text, or FALSE if error
 */
function clean_truncate_optical($text, $length, $font)
{
	static $ct;
	if (!is_object($ct)) { $ct = new CleanTruncate(); }	
	return $ct->truncate($text, $length, $font);
}


/**
 * Makes clickable links out of URLs, email addresses and web addresses
 *
 * @since  2.12.0
 * 
 * @param  string  $text   Block of text
 * @param  integer $limit  Shorten link text to n chars, 0 for no limit
 * @return string  Block of text with links around URLs, email addresses, and web addresses 
 */
function link_maker($text='', $limit=0)
{
	// Make sure the limit is an integer
	$limit = (((int) $limit) < 1) ? 0 : (int) $limit;
	
	// Set up an array of regular expressions for preg_replace
	$regex_array = array("#([\n ])((?:[a-z]+?)://(?:[^,\t \n\r\<\>]+))#ie",                      /* (1) http://xx.yyy/path (URLs)   	*/
						 "#([\n ])(www\.(?:[a-z0-9\-]+(?:\.[a-z]+)+)(?:/[^,\t \n\r\<\>]*)?)#ie", /* (2) www.xx.yyy/path (web addresses) */
						 "#([\n ])((?:[a-z0-9\-_.]+?)@(?:[\w\-]+\.(?:[\w\-\.]+\.)?[\w]+))#ie"    /* (3) name@xx.yyy (email addresses)   */
						);
	$text = ' ' . $text;
	$text = preg_replace($regex_array, "link_maker_callback('$1', '$2', " . $limit . ")", $text);
	return substr($text, 1);
}


/**
 * Callback function for preg_replace in link_maker(). Wraps matched text in a tags.
 *
 * @since  2.12.0
 * 
 * @param  string  $white_space  The space or newline preceding the url
 * @param  string  $link_text    The text to be created into a link
 * @param  integer $limit        Shorten link text to n chars
 * @return string  The link text wrapped in an a tag
 */
function link_maker_callback($white_space, $link_text, $limit)
{
    // The first part of the returned value is the white space
	$return = $white_space;
	$link_text = unhtmlentities($link_text);
	
	// The second part is an a tag with the appropriate protocol or handler
	if (stripos($link_text, '://') !== FALSE) {
		$return .= '<a href="' . smart_htmlentities($link_text) . '">';
	} elseif (stripos($link_text, '@') !== FALSE) {
		$return .= '<a href="mailto:' . smart_htmlentities($link_text) . '">';
	} else {
		$return .= '<a href="http://' . smart_htmlentities($link_text) . '">';
	}
	
	// If there is a limit, trim the link text down to that length
	$link_text = ($limit && strlen($link_text) > $limit) ? substr($link_text, 0, $limit) . '...' : $link_text;
	
	// The third part of what is returned is the url and closing a tag
	$return .= smart_htmlentities($link_text) . '</a>';
	
	return $return;
}


/**
 * Returns input with line breaks if no HTML structure tags are present
 *
 * @since  3.1.0
 * 
 * @param  string $text  Input text, with or without existing HTML tags
 * @return string  Adds line breaks to text if text
 */
function smart_nl2br($text='')
{
	$non_structure_tags = '<strong><b><em><i><a><span><acronym><abbr><code><big><small>';
	$stripped_stucture  = strip_tags($text, $non_structure_tags);
	
	return ($text == $stripped_stucture) ? nl2br($text) : $text;
}



/* --------------------------------------------------------------------- */
/* Text/HTML Manipulation Functions
/* 
/* Functions that handle cleaning and reformatting text and html
/* --------------------------------------------------------------------- */


/**
 * Takes in a string that needs to be cleaned and made into html-safe output. properly processes Microsoft Word copy and paste.
 * 
 * @since  2.6.0
 * 
 * @param  string  $text       The text that needs to be processed
 * @param  boolean $plaintext  If the replacements should only be done with plaintext (doesn't replace symbols)
 * @return string  The cleaned up text    
 */
function cleanup($text, $plaintext=FALSE)
{

	// Convert some common extended characters to ASCII
	if ($plaintext) {
		$chars = array(chr(226).chr(128).chr(156) => '"',           /* curly double quote left */
		               chr(226).chr(128).chr(159) => '"',           /* alternate curly double quote left */
		               chr(226).chr(128).chr(157) => '"',           /* curly double quote right */
		               chr(226).chr(128).chr(147) => '-',           /* em-dash */
		               chr(226).chr(128).chr(149) => '-',           /* quotation dash */ 
		               chr(226).chr(128).chr(152) => "'",           /* curly single quote left */
		               chr(226).chr(128).chr(155) => "'",           /* alternate curly single quote left */
		               chr(226).chr(128).chr(153) => "'",           /* curly single quote right */
                       chr(226).chr(132).chr(162) => '(TM)',        /* trademark */
		               chr(226).chr(128).chr(186) => chr(155),      /* little right arrow */
		               chr(226).chr(128).chr(185) => chr(139),      /* little left arrow */
                       chr(194).chr(187) => chr(187),               /* double right arrow */
		               chr(194).chr(171) => chr(171),               /* double left arrow */
		               chr(194).chr(169) => chr(169),               /* copyright symbol */
		               chr(194).chr(174) => chr(174),               /* registered symbol */
					   chr(195).chr(169) => chr(233),               /* e acute */
		               chr(147) => '"',                             /* alternate alternate curly double quote left */ 
		               chr(148) => '"',                             /* alternate curly double quote right */ 
		               chr(150) => '-',                             /* en-dash */
		               chr(151) => '-',                             /* en-dash */
		               chr(145) => "'",                             /* alternate alternate curly single quote left */
		               chr(146) => "'"                              /* curly single quote right */
		               ); 
		
		// Clean the text
		$text = str_replace(array_keys($chars), array_values($chars), $text);     
	
	// Convert all high order characters to htmlentities
	} else {
		$text = smart_htmlentities($text);
		
		// Since we don't want to break any html, change the html special characters back
		static $html_special_char_map = array(
			'&#34;'  => '"',
			'&quot;' => '"',
			'&apos;' => "'",
			'&#39;'  => "'",
			'&lt;'   => '<',
			'&#60;'  => '<',
			'&gt;'   => '>',
			'&#62;'  => '>',
			'&#38;'  => '&',
			'&amp;'  => '&'	
			);
		$text = str_replace(array_keys($html_special_char_map), array_values($html_special_char_map), $text);
	}
					
	return $text;
}


/**
 * Calls htmlentities on the text provided after auto detecting utf-8 or iso-8859-1
 * 
 * @since  4.6.0
 * 
 * @param  string $text  The text to encode
 * @return string  The encoded text
 */
function smart_htmlentities($text) 
{
	// Check the encoding for
	$is_utf8 = preg_match('%(?:[\xC2-\xDF][\x80-\xBF]|\xE0[\xA0-\xBF][\x80-\xBF]|[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}|\xED[\x80-\x9F][\x80-\xBF]|\xF0[\x90-\xBF][\x80-\xBF]{2}|[\xF1-\xF3][\x80-\xBF]{3}|\xF4[\x80-\x8F][\x80-\xBF]{2})+%xs', $text);
	$char_set = ($is_utf8) ? 'UTF-8' : 'ISO-8859-1';
	$text = htmlentities($text, ENT_COMPAT, $char_set);	
	
	// Windows sets a bunch of characters for the unused part of iso-8859-1
	$windows_char_map = array(
		chr(130) => '&lsquor;',
		chr(131) => '&fnof;',
		chr(132) => '&ldquor;', 
		chr(133) => '&hellip;',
		chr(134) => '&dagger;',
		chr(135) => '&Dagger;',
		chr(136) => '&#136;',
		chr(137) => '&permil;',
		chr(138) => '&Scaron;', 
		chr(139) => '&lsaquo;',
		chr(140) => '&OElig;', 
		chr(145) => '&lsquo;',
		chr(146) => '&rsquo;', 
		chr(147) => '&ldquo;',  
		chr(148) => '&rdquo;', 
		chr(149) => '&bull;',
		chr(150) => '&ndash;',
		chr(151) => '&mdash;',
		chr(152) => '&tilde;',
		chr(153) => '&trade;',
		chr(154) => '&scaron;', 
		chr(155) => '&rsaquo;',
		chr(156) => '&oelig;', 
		chr(159) => '&Yuml;');
	
	return str_replace(array_keys($windows_char_map), array_values($windows_char_map), $text);	
}


/**
 * Calls html_entity_decode using the proper character set
 * 
 * @since  5.2.0
 * 
 * @param  string $text  The text to encode
 * @return string  The encoded text
 */
function unhtmlentities($text) 
{
	// Check the encoding for
	$is_utf8 = preg_match('%&#(25[7-9]|3[0-9]{2}|\d{4});|
							&(oelig|scaron|yuml|fnof|circ|
							  tilde|alpha|beta|gamma|delta|
							  epsilon|zeta|eta|theta|iota|
							  kappa|lambda|mu|nu|xi|omicron|
							  pi|rho|sigmaf|sigma|tau|upsilon|
							  phi|chi|psi|omega|thetasym|upsih|
							  piv|ensp|emsp|thinsp|zwnj|zwj|
							  lrm|rlm|ndash|mdash|lsquo|rsquo|
							  sbquo|ldquo|rdquo|bdquo|dagger|
							  bull|hellip|permil|prime|lsaquo|
							  rsaquo|oline|frasl|euro|image|
							  weierp|real|trade|alefsym|larr|
							  uarr|rarr|darr|harr|crarr|forall|
							  part|exist|empty|nabla|isin|notin|
							  ni|prod|sum|minus|lowast|radic|
							  prop|infin|ang|and|or|cap|cup|
							  int|there4|sim|cong|asymp|ne|
							  equiv|le|ge|sub|sup|nsub|sube|
							  supe|oplus|otimes|perp|sdot|
							  lceil|rceil|lfloor|rfloor|lang|
							  rang|loz|spades|clubs|hearts|diams
							 );%xi', $text);
	$char_set = ($is_utf8) ? 'UTF-8' : 'ISO-8859-1';
	return html_entity_decode($text, ENT_COMPAT, $char_set);	
}


/**
 * Takes the input text, replaces bad characters, using cleanup(), properly encodes characters, leaves html alone and converts some basic html to xhtml
 * Contains code found on php.net
 * 
 * @since  2.10.0
 *  
 * @param  string  $text        The text to be processed
 * @param  boolean $addslashes  If slashes should be added to the ouput (for database insertion)
 * @return string  The converted/fixed/cleaned string    
 */
function xhtmlify($text, $addslashes=FALSE)
{	
	// Clean any crazy characters out of the text
	$text = cleanup($text);

	// Pass the code through the html to xhtml convertor
	$regexp = "<\s*\/?\s*[\w:]+(?:\s+[\w:]+(?:\s*=\s*(?:\"[^\"]*?\"|'[^']*?'|[^'\">\s]+))?)*\s*\/?\s*>";
	$text = preg_replace('/' . $regexp . '/ie', "convert_tag_to_xhtml('$0')", $text);

	// Ignore html tags and entities in the form &#*; where * represents one or more digits
	$pattern = "<\s*\/?\s*[\w:]+(?:\s+[\w:]+(?:\s*=\s*(?:\"[^\"]*?\"|'[^']*?'|[^'\">\s]+))?)*\s*\/?\s*>|&(?:#\d+|\w+);";
	preg_match_all('/' . $pattern . '/', $text, $tag_matches, PREG_SET_ORDER);

	$text_matches = preg_split ('/' . $pattern . '/', $text);
    $original_text_matches = $text_matches;
    
	// Get the reverse translation table for htmlentities
	$trans_tbl = array_flip(get_html_translation_table(HTML_ENTITIES));
	
	// For all text other than html tags and special html entities, decode html entities, and then recode them (to prevent double encoding)
	foreach($text_matches as $key => $value) {
		$ret = strtr($value, $trans_tbl);
		$text_matches[$key] = htmlentities($ret);
        // Return html comments to original form
        $text_matches[$key] = str_replace('&lt;!--', '<!--', $text_matches[$key]);
        $text_matches[$key] = str_replace('--&gt;', '-->', $text_matches[$key]);
	}

	// Combine all of the html tags, entities and other text back together
	$inside_script = FALSE;
    for ($i=0;$i<count($text_matches);$i++) {
		if(isset($tag_matches[$i][0])) {
            if ($inside_script) {
                $text_matches[$i] = $original_text_matches[$i] . $tag_matches[$i][0];
            } else {
                $text_matches[$i] .= $tag_matches[$i][0];    
            }
            // Set the inside script flag
            if (preg_match('#<\s*script#i', $tag_matches[$i][0])) {
                $inside_script = TRUE;
            }
            // If this is a script tag, don't encode anything until we find the close script tag
            if (preg_match('#<\s*/\s*script#i', $tag_matches[$i][0])) {
                $inside_script = FALSE;
            }
        }
	}
	$output_text = implode($text_matches);
    
    if ($addslashes) {
        $output_text = addslashes($output_text);
    }
  
	return $output_text;
} 


/**
 * Takes a properly formed html tag and converts it to xhtml
 * 
 * @since  2.10.0
 *  
 * @param  string $tag  The tag to be converted
 * @return string  The converted tag    
 */
function convert_tag_to_xhtml($tag)
{
	// Only single and double quotes are backslashed by the e modifier in
	// preg_replace, so we shouldn't do a full stripslashes since that
	// strips single backslashes and converts double backslashes to singles
	$tag = str_replace("\\\"", '"', $tag);
	$tag = str_replace("\\'", "'", $tag);
	
	// Tags that do not have a closing tag
	$single_tags = array('area', 'base', 'basefont', 'br', 'col', 'frame', 'hr', 'img', 'input', 'isindex', 'link', 'meta', 'param');
	
	// Remove the opening < and any whitespace
	$tag = ltrim(substr($tag, 1));
	
    $closing_tag = FALSE;

    // Check if it is a closing tag
	if($tag{0} == '/') {
		$closing_tag = TRUE;
		$tag = ltrim(substr($tag, 1));	
	}
	
	$space_pos = strpos($tag, ' ');
	
	if($space_pos !== FALSE) {
		// Get the tag name
		$tag_name = strtolower(substr($tag, 0, $space_pos));
		
		// Get the rest of the tag (the attributes)
		$attributes = rtrim(substr($tag, $space_pos, strlen($tag)-$space_pos-1));
		if(strlen($attributes) > 0) {
			// If a / is included at the end of the tag, strip it off
			if($attributes{strlen($attributes)-1} == '/') {
				$attributes = substr($attributes, 0, strlen($attributes)-1);
			}	
			
			// Use a regex to match all possible attribute formats
			$regexp = "\s+([\w:]+)(\s*=\s*(?:(\"|')(.*?)\\3|[^'\">\s]+))?";
			$matches = array();
			preg_match_all('/' . $regexp . '/i', $attributes, $matches);
			
		}
	} else {
		$tag_name = strtolower(substr($tag, 0, strlen($tag)-1));
		if($tag_name{strlen($tag_name)-1} == '/') {
			$tag_name = substr($tag_name, 0, strlen($tag_name)-1);
		}	
	}
	
	// Rebuild the tag in xhtml style (tag and attribute names in lower case and with / at the end of single tags)
	$output_tag = '<';
	// If this is a closing tag add the / at the beginning
	if($closing_tag) {
		$output_tag .= '/';	
	}
	$output_tag .= $tag_name;
	
    $attributes_to_add = '';
    
	// Check to see if there are any attributes to add in
	if(isset($matches) && is_array($matches) && sizeof($matches) > 0) {
		
        // Detect the quote type to use for unquote values. This is required since sometimes html tags
        // are embedded in script tags, and using the wrong type of quote would cause a script error
        $quotes_array = $matches[3];
        if (is_array($quotes_array)) {
            $quote_type = '';
            foreach ($quotes_array as $quote) {
                $quote = trim($quote);
                if (!empty($quote)) {
                    if (empty($quote_type)) {
                        $quote_type = $quote;
                    } elseif ($quote_type != $quote) {
                        $quote_type = '"';
                        break;
                    }   
                }    
            }
            if (empty($quote_type)) {
                $quote_type = '"';   
            }
        } elseif (!empty($quotes_array)) {
            $quote_type = $quotes_array;
        }   
        
        for($i=0;$i<sizeof($matches[0]);$i++) {
			$output_tag .= ' ' . strtolower($matches[1][$i]);
			// If the attribute does not have a value, set the value to the attribute name (changes selected to selected="selected")
			if(strlen($matches[2][$i]) < 1) {
				$output_tag .= '="' . $matches[1][$i] . '"';
			} else {
				// Handle links
				if($matches[1][$i] == 'href') {
					// If we have javascript in a link, take it out and create an onclick
                    $href_matches = array();
                    if (preg_match( '/^\s*javascript\s*:(.*)\s*$/i', $matches[4][$i], $href_matches)) {
                        $matches[2][$i] = '=' . $matches[3][$i] . '#' . $matches[3][$i];
                        $href_matches[1] = trim($href_matches[1]);
                        $attributes_to_add .= ' onclick=' . $matches[3][$i] . $href_matches[1];
                        if ($href_matches[1]{strlen($href_matches[1])-1} != ';') {
                            $attributes_to_add .= ';';
                        }   
                        $attributes_to_add .= ' return false;' . $matches[3][$i];     
                   
                    // If this is a normal href attribute, encode ampersands that are not already part of html entities
                    } else {
                        $matches[2][$i] = preg_replace('/&(?!(#[\d]+|[a-zA-Z]+);)/', '&amp;', $matches[2][$i]);
                    }
				}
				
                // Remove spaces from between the attribute name and the value
                $matches[2][$i] = trim($matches[2][$i]);
                while (substr($matches[2][$i], 0, 2) == "= ") {
                    $matches[2][$i] = '=' . substr($matches[2][$i], 2);    
                }
                
                // If the attribute value is not quoted, add quotes
				if(substr($matches[2][$i], 0, 2) != '="' && substr($matches[2][$i], 0, 2) != "='") {
					$output_tag .= '=' . $quote_type . substr($matches[2][$i], 1) . $quote_type;	
				} else {
					$output_tag .= $matches[2][$i];
				}
			}		
		}
	}
	
    // If we created a new attribute, throw it on the end
    if (!empty($attributes_to_add)) {
        $output_tag .= $attributes_to_add;    
    }
    
	// If it is a single tag, add the / at the end
	if(in_array($tag_name, $single_tags)) {
		$output_tag .= ' /';	
	}
	$output_tag .= '>';
	
	return $output_tag;
		
}

   
/**
 * Converts string to a url-friendly string (strips out non-word characters and replaces spaces with _) 
 *
 * @since  2.11.0
 * 
 * @param  string $title  Title to convert
 * @return string  The converted title
 */
function convert_to_url($title)
{
	$title = convert_accented_characters($title);
	$title = unhtmlentities($title);
	
	$title = trim(preg_replace('/[^\w ]/', '', $title));
	$title = preg_replace('/[ ]+/', '_', $title);
	
	return strtolower($title);
}


/**
 * Replaces accented characters with non-accented characters. Helper function for convert_to_url
 * 
 * @since  2.11.0
 * 
 * @param  string $text  Text to convert
 * @return string  The text with all accented characters replaced by normal ones
 */
function convert_accented_characters($text)
{
    $characters_table = array (
		'&Agrave;' => 'A',    '&#192;' => 'A',    '' => 'A',    '&Aacute;' => 'A',    '&#193;' => 'A',    '' => 'A',
		'&Acirc;'  => 'A',    '&#194;' => 'A',    '' => 'A',    '&Atilde;' => 'A',    '&#195;' => 'A',    '' => 'A',
		'&Auml;'   => 'A',    '&#196;' => 'A',    '' => 'A',    '&Aring;'  => 'A',    '&#197;' => 'A',    '' => 'A',
		'&AElig;'  => 'AE',   '&#198;' => 'AE',   '' => 'AE',   '&Ccedil;' => 'C',    '&#199;' => 'C',    '' => 'C',
		'&Egrave;' => 'E',    '&#200;' => 'E',    '' => 'E',    '&Eacute;' => 'E',    '&#201;' => 'E',    '' => 'E',
		'&Ecirc;'  => 'E',    '&#202;' => 'E',    '' => 'E',    '&Euml;'   => 'E',    '&#203;' => 'E',    '' => 'E',
		'&Igrave;' => 'I',    '&#204;' => 'I',    '' => 'I',    '&Iacute;' => 'I',    '&#205;' => 'I',    '' => 'I',
		'&Icirc;'  => 'I',    '&#206;' => 'I',    '' => 'I',    '&Iuml;'   => 'I',    '&#207;' => 'I',    '' => 'I',
		'&ETH;'    => 'D',    '&#208;' => 'D',    '' => 'D',    '&Ntilde;' => 'N',    '&#209;' => 'N',    '' => 'N',
		'&Ograve;' => 'O',    '&#210;' => 'O',    '' => 'O',    '&Oacute;' => 'O',    '&#211;' => 'O',    '' => 'O',
		'&Ocirc;'  => 'O',    '&#212;' => 'O',    '' => 'O',    '&Otilde;' => 'O',    '&#213;' => 'O',    '' => 'O',
		'&Ouml;'   => 'O',    '&#214;' => 'O',    '' => 'O',    '&Oslash;' => 'O',    '&#216;' => 'O',    '' => 'O',
		'&Ugrave;' => 'U',    '&#217;' => 'U',    '' => 'U',    '&Uacute;' => 'U',    '&#218;' => 'U',    '' => 'U',
		'&Ucirc;'  => 'U',    '&#219;' => 'U',    '' => 'U',    '&Uuml;'   => 'U',    '&#220;' => 'U',    '' => 'U',
		'&Yacute;' => 'Y',    '&#221;' => 'Y',    '' => 'Y',    '&agrave;' => 'a',    '&#224;' => 'a',    '' => 'a',
		'&aacute;' => 'a',    '&#225;' => 'a',    '' => 'a',    '&acirc;'  => 'a',    '&#226;' => 'a',    '' => 'a',
		'&atilde;' => 'a',    '&#227;' => 'a',    '' => 'a',    '&auml;'   => 'a',    '&#228;' => 'a',    '' => 'a',
		'&aring;'  => 'a',    '&#229;' => 'a',    '' => 'a',    '&aelig;'  => 'ae',   '&#230;' => 'ae',   '' => 'ae',
		'&ccedil;' => 'c',    '&#231;' => 'c',    '' => 'c',    '&egrave;' => 'e',    '&#232;' => 'e',    '' => 'e',
		'&eacute;' => 'e',    '&#233;' => 'e',    '' => 'e',    '&ecirc;'  => 'e',    '&#234;' => 'e',    '' => 'e',
		'&euml;'   => 'e',    '&#235;' => 'e',    '' => 'e',    '&igrave;' => 'i',    '&#236;' => 'i',    '' => 'i',
		'&iacute;' => 'i',    '&#237;' => 'i',    '' => 'i',    '&icirc;'  => 'i',    '&#238;' => 'i',    '' => 'i',
		'&iuml;'   => 'i',    '&#239;' => 'i',    '' => 'i',    '&ntilde;' => 'n',    '&#241;' => 'n',    '' => 'n',
		'&ograve;' => 'o',    '&#242;' => 'o',    '' => 'o',    '&oacute;' => 'o',    '&#243;' => 'o',    '' => 'o',
		'&ocirc;'  => 'o',    '&#244;' => 'o',    '' => 'o',    '&otilde;' => 'o',    '&#245;' => 'o',    '' => 'o',
		'&ouml;'   => 'o',    '&#246;' => 'o',    '' => 'o',    '&oslash;' => 'o',    '&#248;' => 'o',    '' => 'o',
		'&ugrave;' => 'u',    '&#249;' => 'u',    '' => 'u',    '&uacute;' => 'u',    '&#250;' => 'u',    '' => 'u',
		'&ucirc;'  => 'u',    '&#251;' => 'u',    '' => 'u',    '&uuml;'   => 'u',    '&#252;' => 'u',    '' => 'u',
		'&yacute;' => 'y',    '&#253;' => 'y',    '' => 'y',    '&yuml;'   => 'y',    '&#255;' => 'y',    '' => 'y'        
	);
	
	return str_replace(array_keys($characters_table), array_values($characters_table), $text);
}



/* --------------------------------------------------------------------- */
/* Output Buffer Functions
/* 
/* Handle adding and modifying items related to the output buffer
/* --------------------------------------------------------------------- */


/**
 * Add some html in the head tag
 * 
 * @since 3.2.0
 * 
 * @param  string  $html       The html to add to the head tag
 * @param  boolean $once       If the html should only be added if it is not currently present in the head
 * @param  boolean $beginning  If the html should be inserted at the beginning of the head tag, otherwise it goes at the end
 * @return void
 */
function add_to_head($html, $once=TRUE, $beginning=TRUE)
{
	// Make sure the output buffer is on
	$output_buffer = ob_get_contents();
	ob_clean();
	if($output_buffer === FALSE) { die('Please add \'ob_start();\' to the first line of this page'); }
	
	// Add the html to the head
	if (stripos($output_buffer, $html) === FALSE || !$once) {
		if ($beginning) {
            $output_buffer = str_ireplace('<head>', "<head>\n" . $html . "\n", $output_buffer);
        } else {
            $output_buffer = str_ireplace('</head>', "\n" . $html . "\n</head>", $output_buffer);   
        }
	}
	
	echo $output_buffer;    
}


/**
 * Add some javascript to the onload attribute of the body tag, also if no onload exists, create it
 * 
 * @since 3.2.0
 * 
 * @param  string $javascript   The javascript to add to the onload attribute
 * @return void
 */
function add_to_onload($javascript)
{
	// Make sure the output buffer is on
	$output_buffer = ob_get_contents();
	ob_clean();
	if($output_buffer === FALSE) { die('Please add \'ob_start();\' to the first line of this page'); }
	
	// Find the body tag, extract the onload statement
	$regexp = "/<body((?:\s+(?:(?!onload)[\w:])+=(?:\"[^\"]*\"|'[^']*')?)*)(\s+onload=(\"|')(.*)\\3)?((?:\s+(?:(?!onload)[\w:])+(?:=(?:\"[^\"]*?\"|'[^']*?'))?)*)\s*>/iU";
	$matched = preg_match($regexp, $output_buffer, $matches);
	if (!$matched) { die('I couldn\'t find the body tag, something is very wrong with the html'); }
	
	// If the onload is surrounded by single quotes, change all
	// single quotes in what we are adding to double quotes
	$new_onload = $javascript;
	if (!empty($matches[3]) && $matches[3] == "'") {
		$new_onload = str_replace("'", '"', $new_onload);		
	}
	
	// If there is any existing javascript, add our new javascript to it
	if (!empty($matches[4])) {
		$new_onload = $matches[4] . ' ' . $new_onload;	
	}
	
	// Reuse the old onload quote style
	if (!empty($matches[3])) {
		$quote = $matches[3];	
	} else {
		$quote = '"';	
	}
	
	// Build the body tag from the attributes we extracted and the newly created onload
	$new_body_tag = '<body' . $matches[1] . ' onload=' . $quote . $new_onload . $quote . $matches[5] . '>';
	
	// Replace the current body tag with the new one
	$regexp2 = "/<\s*body(?:\s+[\w:]+(?:=(?:\"[^\"]*?\"|'[^']*?'))?)*\s*>/iU";
	$output_buffer = preg_replace($regexp2, $new_body_tag, $output_buffer);
	
	echo $output_buffer;    
}


/**
 * Add some javascript to the onunload attribute of the body tag, also if no onunload exists, create it
 * 
 * @since 4.3.0
 * 
 * @param  string $javascript   The javascript to add to the onunload attribute
 * @return void
 */
function add_to_onunload($javascript)
{
	// Make sure the output buffer is on
	$output_buffer = ob_get_contents();
	ob_clean();
	if($output_buffer === FALSE) { die('Please add \'ob_start();\' to the first line of this page'); }
	
	// Find the body tag, extract the onload statement
	$regexp = "/<body((?:\s+(?:(?!onload)[\w:])+=(?:\"[^\"]*\"|'[^']*')?)*)(\s+onload=(\"|')(.*)\\3)?((?:\s+(?:(?!onload)[\w:])+(?:=(?:\"[^\"]*?\"|'[^']*?'))?)*)\s*>/iU";
	$matched = preg_match($regexp, $output_buffer, $matches);
	if (!$matched) { die('I couldn\'t find the body tag, something is very wrong with the html'); }
	
	// If the onload is surrounded by single quotes, change all
	// single quotes in what we are adding to double quotes
	$new_onunload = $javascript;
	if (!empty($matches[3]) && $matches[3] == "'") {
		$new_onunload = str_replace("'", '"', $new_onunload);		
	}
	
	// If there is any existing javascript, add our new javascript to it
	if (!empty($matches[4])) {
		$new_onunload = $matches[4] . ' ' . $new_onunload;	
	}
	
	// Reuse the old onload quote style
	if (!empty($matches[3])) {
		$quote = $matches[3];	
	} else {
		$quote = '"';	
	}
	
	// Build the body tag from the attributes we extracted and the newly created onload
	$new_body_tag = '<body' . $matches[1] . ' onunload=' . $quote . $new_onunload . $quote . $matches[5] . '>';
	
	// Replace the current body tag with the new one
	$regexp2 = "/<\s*body(?:\s+[\w:]+(?:=(?:\"[^\"]*?\"|'[^']*?'))?)*\s*>/iU";
	$output_buffer = preg_replace($regexp2, $new_body_tag, $output_buffer);
	
	echo $output_buffer;    
}


/* --------------------------------------------------------------------- */
/* Location Functions
/* 
/* Page redirection and current location functions
/* --------------------------------------------------------------------- */


/**
 * Return the current protocol (http or https) followed by :// and the hostname. Most commonly used for header redirection
 * 
 * @since  2.10.0
 * 
 * @param  void
 * @return string  Full server address    
 */
function server_address()
{
    if(isset($_SERVER['HTTPS']) && strlen($_SERVER['HTTPS']) > 0) {
		$server_address = 'https://';
	} else {
		$server_address = 'http://';
	}
	return $server_address . $_SERVER['HTTP_HOST'];
}


/**
 * Redirects the user to the current page, optionally specifying page_function and other querystring parameters
 * 
 * @since 3.2.0
 * 
 * @param  string $page_function  The page function to display after reload
 * @param  string $extra          Extra query string parameters to include
 * @return void
 */
function redirect_self($page_function=NULL, $extra=NULL)
{
	// Make sure the output buffer is on
	if(ob_get_contents() === FALSE) { die('Please add \'ob_start();\' to the first line of this page'); }
    
    $self = server_address() . $_SERVER['PHP_SELF'];
	if (!empty($page_function)) {
		$self .= '?page_function=' . $page_function;
	}	
	if (!empty($extra)) {
		$self .= (strpos($self, '?') !== FALSE) ? '&' : '?';
        $self .= $extra;
	}
	header('Location: ' . $self);
	exit;
}


/**
 * Redirects the user to another page on the current site
 *
 * @since 3.11.0
 * 
 * @param  string $page  The page to redirect to (must be an absolute web path, i.e. /login/index.php)
 * @return void
 */
function redirect_site($page)
{
    // Make sure the output buffer is on
	if(ob_get_contents() === FALSE) { die('Please add \'ob_start();\' to the first line of this page'); }
    
	if (stripos($page, server_address()) !== 0) {
        if ($page{0} != '/') {
            $page = '/' . $page;    
        }
        $page = server_address() . $page;    
    }
	header('Location: ' . $page);
	exit;    
}




/* --------------------------------------------------------------------- */
/* Javascript Functions
/* 
/* Display and manipulate various javascript related code
/* --------------------------------------------------------------------- */


/**
 * Function to add TinyMCE rich text editor to a page.
 * 
 * @since 3.7.0
 * 
 * @param  mixed  $ids        The ids of the text areas to be replaced with the editor
 * @param  string $css_files  The web path to a css file, array of css files, or comma seperated list of css files to use for the content in the editor   
 * @param  string $js_dirs    The web path to the javascript dir
 * @return void
 */
function rich_text_editor($ids, $css_files='', $js_dir='/js/rich_text_editor/')
{
	if (empty($ids)) {
		die('Please specify one or more textareas to replace with the rich text editor');
	} elseif (is_array($ids)) {
		$ids = implode(',', $ids);
	} else {
		$ids = str_replace(' ', '', $ids);	
	}
    
    // Make sure we have an array of css files
    if (empty($css_files)) {
		die('There are no valid css files specified for the rich text editor. The second parameter of rich_text_editor() must contain a list if css files to use.');
	} elseif (!is_array($css_files) && strpos($css_files, ',') !== FALSE) {
		$css_files = explode(',', $css_files);
	} elseif (!is_array($css_files)) {
        $css_files = array($css_files);   
    }
	
    // Check each css file and then set it to run through the css proxy script
    $new_css_files = array();
    foreach ($css_files as $css_file) {
        $css_path = $_SERVER['DOCUMENT_ROOT'] . $css_file;
        if (file_exists($css_path) && !is_dir($css_path) && is_readable($css_path)) {
            $new_css_files[] = $js_dir . 'css_proxy.php?file=' . urlencode($css_file);
        }    
    }
    if (empty($new_css_files)) {
        die('There are no valid css files specified for the rich text editor');   
    }
    $css_files = join(',', $new_css_files);
    
    //	
	if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $js_dir) || !is_dir($_SERVER['DOCUMENT_ROOT'] . $js_dir) || !file_exists($_SERVER['DOCUMENT_ROOT'] . $js_dir . 'tiny_mce_gzip.php')) {
		die('The rich text editor javascript could not be found');
	}
	
	add_to_head('<script type="text/javascript" src="' . $js_dir . 'tiny_mce_gzip.php"></script>', TRUE, FALSE);

$init_block = <<<DATA
<script type="text/javascript">
<!--
tinyMCE.init({
	mode : "exact",
    elements : "$ids",
	entity_encoding : "named",
	theme : "advanced",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_buttons1 : "spellchecker,separator,cut,copy,paste,separator,undo,redo,separator,link,unlink,anchor,image,table,separator,code,help",
	theme_advanced_buttons2 : "bold,italic,underline,separator,justifyleft,justifycenter,justifyright,separator,bullist,numlist,seperator,outdent,indent,seperator,sup,separator,forecolor,formatselect",
	theme_advanced_buttons3 : "",
	plugins : "imagemanager,inlinepopups,contextmenu,spellchecker,table,advlink,media",
	inline_styles : true,
	convert_fonts_to_spans : true,
	convert_urls : false,
	fix_list_elements : true,
	fix_table_elements : true,
	content_css : "$css_files",
    extended_valid_elements : 'iframe[name|src|framespacing|border|frameborder|scrolling|title|height|width]',
	valid_elements : ""
+"a[accesskey|charset|class|coords|dir<ltr?rtl|href|hreflang|id|lang|name|onblur|onclick|ondblclick|onfocus|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|rel|rev|shape<circle?default?poly?rect|style|tabindex|target|title|type],"
+"abbr[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"acronym[class|dir<ltr?rtl|id|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"address[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"area[accesskey|alt|class|coords|dir<ltr?rtl|href|id|lang|nohref<nohref|onblur|onclick|ondblclick|onfocus|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|shape<circle?default?poly?rect|style|tabindex|title|target],"
+"big[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"blockquote[dir|style|cite|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"br[class|id|style|title],"
+"caption[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"cite[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"code[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"col[align<center?char?justify?left?right|char|charoff|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|span|style|title|valign<baseline?bottom?middle?top|width],"
+"colgroup[align<center?char?justify?left?right|char|charoff|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|span|style|title|valign<baseline?bottom?middle?top|width],"
+"dd[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"del[cite|class|datetime|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"dfn[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"div[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"dl[class|compact<compact|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"dt[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"em/i[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"fieldset[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"h1[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"h2[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"h3[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"h4[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"h5[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"h6[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"hr[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"img[align<top?bottom?middle?left?right|alt|class|dir<ltr?rtl|height|id|ismap<ismap|lang|longdesc|name|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|src|style|title|usemap|width],"
+"ins[cite|class|datetime|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"kbd[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"label[accesskey|class|dir<ltr?rtl|for|id|lang|onblur|onclick|ondblclick|onfocus|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"legend[align<bottom?left?right?top|accesskey|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"li[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title|type|value],"
+"map[class|dir<ltr?rtl|id|lang|name|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"menu[class|compact<compact|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"ol[class|compact<compact|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|start|style|title|type],"
+"optgroup[class|dir<ltr?rtl|disabled<disabled|id|label|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"option[class|dir<ltr?rtl|disabled<disabled|id|label|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|selected<selected|style|title|value],"
+"p[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"pre/listing/plaintext/xmp[align|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title|width],"
+"q[cite|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"samp[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"script[charset|defer|language|src|type],"
+"select[class|dir<ltr?rtl|disabled<disabled|id|lang|multiple<multiple|name|onblur|onclick|ondblclick|onfocus|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|size|style|tabindex|title],"
+"small[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"span[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"strong/b[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"style[dir<ltr?rtl|lang|media|title|type],"
+"sub[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"sup[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"table[border|cellpadding|cellspacing|class|dir<ltr?rtl|frame|height|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|rules|style|summary|title|width],"
+"tbody[align<center?char?justify?left?right|char|class|charoff|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title|valign<baseline?bottom?middle?top],"
+"td[abbr|align<center?char?justify?left?right|axis|char|charoff|class|colspan|dir<ltr?rtl|headers|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|rowspan|scope<col?colgroup?row?rowgroup|style|title|valign<baseline?bottom?middle?top],"
+"tfoot[align<center?char?justify?left?right|char|charoff|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title|valign<baseline?bottom?middle?top],"
+"th[abbr|align<center?char?justify?left?right|axis|char|charoff|class|colspan|dir<ltr?rtl|headers|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|rowspan|scope<col?colgroup?row?rowgroup|style|title|valign<baseline?bottom?middle?top],"
+"thead[align<center?char?justify?left?right|char|charoff|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title|valign<baseline?bottom?middle?top],"
+"tr[abbr|align<center?char?justify?left?right|char|charoff|class|rowspan|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title|valign<baseline?bottom?middle?top],"
+"tt[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"u[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
+"ul[class|compact<compact|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title|type],"
+"var[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title]"
});
//-->
</script>
DATA;

    add_to_head($init_block, TRUE, FALSE);
}


/**
 * Creates javascript to do dom creation of a string of html
 *
 * @since 3.10.0
 * 
 * @param  string  $html         The html to turn into javascript dom commands
 * @param  boolean $add_to_body  If you want the outermost tag added to the body, if not return value will be outermost tags variable name
 * @return mixed  If the flag add_to_body is true, NULL, otherwise it returns the js variable that references the outermost tag
 */
function print_dom_js($html, $add_to_body=FALSE)
{
	static $tag_number = 0;
	
	$regexp = "/<\s*(\/)?\s*([\w:]+)((?:\s+[\w:]+\s*=\s*(\"|').*?\\4)*)\s*(\/)?\s*>|[^<]+|<\!--.*?-->/";
    $success = preg_match_all($regexp, $html, $matches, PREG_SET_ORDER);
    
    $tag_stack = array();
    $last_tag  = NULL;
    $event_attributes = array('onblur','onchange','onclick','ondblclick','onfocus','onkeydown','onkeypress','onkeyup','onmousedown','onmousemove','onmouseout','onmouseover','onmouseup','onsubmit');
    $first_tag = NULL;
    
    foreach ($matches as $match) {
        
        // HTML Tag
        if (sizeof($match) > 1) {
            $match[2] = strtolower($match[2]);
            
            // If we are inside of a table, make sure we append a tbody, or else rows won't work in IE
            if ($last_tag == 'table' && $match[2] != 'tbody') {
                echo 'var tag' . $tag_number . " = document.createElement('tbody');\n";
                echo 'tag' . $tag_stack[0] . ".appendChild(tag" . $tag_number . ");\n";
                array_unshift($tag_stack, $tag_number);
                $last_tag == 'tbody';
                $tag_number++;   
            }
            
            // This is just a closing tag, so pop the 
            if ($match[1] == '/') {
                array_shift($tag_stack); 
                continue;          
            }
            
            echo 'var tag' . $tag_number . " = document.createElement('" . $match[2] . "');\n";
            
            // Handle all of the tag's attribuets
            $success = preg_match_all("/([\w:]+)\s*=\s*(\"|')(.*?)\\2/", $match[3], $attributes, PREG_SET_ORDER);    
            foreach ($attributes as $attribute) {
                $attribute[3] = trim($attribute[3]);
                
                // Handle event attributes
                if (in_array($attribute[1], $event_attributes)) {
                    if ($attribute[3]{strlen($attribute[3])-1} != ';' && $attribute[3]{strlen($attribute[3])-1} != '}') {
                        $attribute[3] .= ';';    
                    }
                    echo 'tag' . $tag_number . "." . $attribute[1] . " = function () { " . $attribute[3] . " }\n";
                    
                // Handle css classes
                } elseif ($attribute[1] == 'class') {
                    echo 'tag' . $tag_number . ".className = '" . $attribute[3] . "';\n";
                    
                // Handle css styles
                } elseif ($attribute[1] == 'style') {
                    $styles = explode(';', $attribute[3]);
                    foreach ($styles as $style) {
                        if (!trim($style)) { continue; }
                        list ($selector, $value) = explode(':', $style);
                        echo 'tag' . $tag_number . ".style." . preg_replace('/(-([a-z0-9]))/e', 'strtoupper("\2")', $selector) . " = " . $attribute[2] . trim($value) . $attribute[2] . ";\n";
                    }    
                    
                // Handle everything else
                } else {
                    echo 'tag' . $tag_number . ".setAttribute('" . $attribute[1] . "', " . $attribute[2] .  preg_replace('/(&.*?;)/e', 'html_entity_to_js_unicode("\\1")', $attribute[3]) . $attribute[2] . ");\n";
                }      
            }
            
            if (!empty($first_tag)) {
                // Add this new tag to the parent
                echo 'tag' . $tag_stack[0] . '.appendChild(tag' . $tag_number . ");\n";
            } else {
                $first_tag = 'tag' . $tag_number;   
            }
            
            // If this is not a self closing tag, add it to the tag stack
            if (!isset($match[5])) {
                array_unshift($tag_stack, $tag_number);    
            }
            
            $tag_number++;
            $last_tag = $match[2];
            
        // Text Node
        } elseif ($match[0]{0} != '<') {
            if (trim($match[0])) {
                $text = preg_replace('/^\s+|\s+$/', ' ', $match[0]);
                $text = str_replace("\n", ' ', str_replace("'", "\\'", $text));
                $text = preg_replace('/(&.*?;)/e', 'html_entity_to_js_unicode("\\1")', $text);
                echo 'tag' . $tag_stack[0] . ".appendChild(document.createTextNode('" . $text . "'));\n";
            }    
        }
    }
    
    if ($add_to_body) {
        ?>
        var base_tag = document.body.firstChild;
        while (base_tag && (base_tag.nextSibling || base_tag.firstChild)) {
            if (base_tag.nextSibling) {
                base_tag = base_tag.nextSibling;
            } else if (base_tag && base_tag.tagName != 'SCRIPT' && base_tag.firstChild) {
                base_tag = base_tag.firstChild
            } else if (base_tag && base_tag.tagName == 'SCRIPT') {
                break;
            }
        }
        <?php
        echo 'base_tag.parentNode.appendChild(' . $first_tag . ");\n";
        return;    
    } else {
        return $first_tag;
    }
}


/**
 * Turns an html entity into a javascript unicode string
 *
 * @since 3.10.0
 * 
 * @param  string $entity  The entity to convert
 * @return string  The converted entity
 */
function html_entity_to_js_unicode($entity)
{
    static $entity_to_unicode = array('&fnof;'    => '\u0192',  '&Alpha;'   => '\u0391',  '&Beta;'     => '\u0392',  '&Gamma;'   => '\u0393',
                                      '&Delta;'   => '\u0394',  '&Epsilon;' => '\u0395',  '&Zeta;'     => '\u0396',  '&Eta;'     => '\u0397',
                                      '&Theta;'   => '\u0398',  '&Iota;'    => '\u0399',  '&Kappa;'    => '\u039a',  '&Lambda;'  => '\u039b',
                                      '&Mu;'      => '\u039c',  '&Nu;'      => '\u039d',  '&Xi;'       => '\u039e',  '&Omicron;' => '\u039f',
                                      '&Pi;'      => '\u03a0',  '&Rho;'     => '\u03a1',  '&Sigma;'    => '\u03a3',  '&Tau;'     => '\u03a4',
                                      '&Upsilon;' => '\u03a5',  '&Phi;'     => '\u03a6',  '&Chi;'      => '\u03a7',  '&Psi;'     => '\u03a8',
                                      '&Omega;'   => '\u03a9',  '&alpha;'   => '\u03b1',  '&beta;'     => '\u03b2',  '&gamma;'   => '\u03b3',
                                      '&delta;'   => '\u03b4',  '&epsilon;' => '\u03b5',  '&zeta;'     => '\u03b6',  '&eta;'     => '\u03b7',
                                      '&theta;'   => '\u03b8',  '&iota;'    => '\u03b9',  '&kappa;'    => '\u03ba',  '&lambda;'  => '\u03bb',
                                      '&mu;'      => '\u03bc',  '&nu;'      => '\u03bd',  '&xi;'       => '\u03be',  '&omicron;' => '\u03bf',
                                      '&pi;'      => '\u03c0',  '&rho;'     => '\u03c1',  '&sigmaf;'   => '\u03c2',  '&sigma;'   => '\u03c3',
                                      '&tau;'     => '\u03c4',  '&upsilon;' => '\u03c5',  '&phi;'      => '\u03c6',  '&chi;'     => '\u03c7',
                                      '&psi;'     => '\u03c8',  '&omega;'   => '\u03c9',  '&thetasym;' => '\u03d1',  '&upsih;'   => '\u03d2',
                                      '&piv;'     => '\u03d6',  '&bull;'    => '\u2022',  '&hellip;'   => '\u2026',  '&prime;'   => '\u2032',
                                      '&Prime;'   => '\u2033',  '&oline;'   => '\u203e',  '&frasl;'    => '\u2044',  '&weierp;'  => '\u2118',
                                      '&image;'   => '\u2111',  '&real;'    => '\u211c',  '&trade;'    => '\u2122',  '&alefsym;' => '\u2135',
                                      '&larr;'    => '\u2190',  '&uarr;'    => '\u2191',  '&rarr;'     => '\u2192',  '&darr;'    => '\u2193',
                                      '&harr;'    => '\u2194',  '&crarr;'   => '\u21b5',  '&lArr;'     => '\u21d0',  '&uArr;'    => '\u21d1',
                                      '&rArr;'    => '\u21d2',  '&dArr;'    => '\u21d3',  '&hArr;'     => '\u21d4',  '&forall;'  => '\u2200',
                                      '&part;'    => '\u2202',  '&exist;'   => '\u2203',  '&empty;'    => '\u2205',  '&nabla;'   => '\u2207',
                                      '&isin;'    => '\u2208',  '&notin;'   => '\u2209',  '&ni;'       => '\u220b',  '&prod;'    => '\u220f',
                                      '&sum;'     => '\u2211',  '&minus;'   => '\u2212',  '&lowast;'   => '\u2217',  '&radic;'   => '\u221a',
                                      '&prop;'    => '\u221d',  '&infin;'   => '\u221e',  '&ang;'      => '\u2220',  '&and;'     => '\u22a5',
                                      '&or;'      => '\u22a6',  '&cap;'     => '\u2229',  '&cup;'      => '\u222a',  '&int;'     => '\u222b',
                                      '&there4;'  => '\u2234',  '&sim;'     => '\u223c',  '&cong;'     => '\u2245',  '&asymp;'   => '\u2248',
                                      '&ne;'      => '\u2260',  '&equiv;'   => '\u2261',  '&le;'       => '\u2264',  '&ge;'      => '\u2265',
                                      '&sub;'     => '\u2282',  '&sup;'     => '\u2283',  '&nsub;'     => '\u2284',  '&sube;'    => '\u2286',
                                      '&supe;'    => '\u2287',  '&oplus;'   => '\u2295',  '&otimes;'   => '\u2297',  '&perp;'    => '\u22a5',
                                      '&sdot;'    => '\u22c5',  '&lceil;'   => '\u2308',  '&rceil;'    => '\u2309',  '&lfloor;'  => '\u230a',
                                      '&rfloor;'  => '\u230b',  '&lang;'    => '\u2329',  '&rang;'     => '\u232a',  '&loz;'     => '\u25ca',
                                      '&spades;'  => '\u2660',  '&clubs;'   => '\u2663',  '&hearts;'   => '\u2665',  '&diams;'   => '\u2666',
                                      '&nbsp;'    => '\u00a0',  '&iexcl;'   => '\u00a1',  '&cent;'     => '\u00a2',  '&pound;'   => '\u00a3',
                                      '&curren;'  => '\u00a4',  '&yen;'     => '\u00a5',  '&brvbar;'   => '\u00a6',  '&sect;'    => '\u00a7',
                                      '&uml;'     => '\u00a8',  '&copy;'    => '\u00a9',  '&ordf;'     => '\u00aa',  '&laquo;'   => '\u00ab',
                                      '&not;'     => '\u00ac',  '&shy;'     => '\u00ad',  '&reg;'      => '\u00ae',  '&macr;'    => '\u00af',
                                      '&deg;'     => '\u00b0',  '&plusmn;'  => '\u00b1',  '&sup2;'     => '\u00b2',  '&sup3;'    => '\u00b3',
                                      '&acute;'   => '\u00b4',  '&micro;'   => '\u00b5',  '&para;'     => '\u00b6',  '&middot;'  => '\u00b7',
                                      '&cedil;'   => '\u00b8',  '&sup1;'    => '\u00b9',  '&ordm;'     => '\u00ba',  '&raquo;'   => '\u00bb',
                                      '&frac14;'  => '\u00bc',  '&frac12;'  => '\u00bd',  '&frac34;'   => '\u00be',  '&iquest;'  => '\u00bf',
                                      '&Agrave;'  => '\u00c0',  '&Aacute;'  => '\u00c1',  '&Acirc;'    => '\u00c2',  '&Atilde;'  => '\u00c3',
                                      '&Auml;'    => '\u00c4',  '&Aring;'   => '\u00c5',  '&AElig;'    => '\u00c6',  '&Ccedil;'  => '\u00c7',
                                      '&Egrave;'  => '\u00c8',  '&Eacute;'  => '\u00c9',  '&Ecirc;'    => '\u00ca',  '&Euml;'    => '\u00cb',
                                      '&Igrave;'  => '\u00cc',  '&Iacute;'  => '\u00cd',  '&Icirc;'    => '\u00ce',  '&Iuml;'    => '\u00cf',
                                      '&ETH;'     => '\u00d0',  '&Ntilde;'  => '\u00d1',  '&Ograve;'   => '\u00d2',  '&Oacute;'  => '\u00d3',
                                      '&Ocirc;'   => '\u00d4',  '&Otilde;'  => '\u00d5',  '&Ouml;'     => '\u00d6',  '&times;'   => '\u00d7',
                                      '&Oslash;'  => '\u00d8',  '&Ugrave;'  => '\u00d9',  '&Uacute;'   => '\u00da',  '&Ucirc;'   => '\u00db',
                                      '&Uuml;'    => '\u00dc',  '&Yacute;'  => '\u00dd',  '&THORN;'    => '\u00de',  '&szlig;'   => '\u00df',
                                      '&agrave;'  => '\u00e0',  '&aacute;'  => '\u00e1',  '&acirc;'    => '\u00e2',  '&atilde;'  => '\u00e3',
                                      '&auml;'    => '\u00e4',  '&aring;'   => '\u00e5',  '&aelig;'    => '\u00e6',  '&ccedil;'  => '\u00e7',
                                      '&egrave;'  => '\u00e8',  '&eacute;'  => '\u00e9',  '&ecirc;'    => '\u00ea',  '&euml;'    => '\u00eb',
                                      '&igrave;'  => '\u00ec',  '&iacute;'  => '\u00ed',  '&icirc;'    => '\u00ee',  '&iuml;'    => '\u00ef',
                                      '&eth;'     => '\u00f0',  '&ntilde;'  => '\u00f1',  '&ograve;'   => '\u00f2',  '&oacute;'  => '\u00f3',
                                      '&ocirc;'   => '\u00f4',  '&otilde;'  => '\u00f5',  '&ouml;'     => '\u00f6',  '&divide;'  => '\u00f7',
                                      '&oslash;'  => '\u00f8',  '&ugrave;'  => '\u00f9',  '&uacute;'   => '\u00fa',  '&ucirc;'   => '\u00fb',
                                      '&uuml;'    => '\u00fc',  '&yacute;'  => '\u00fd',  '&thorn;'    => '\u00fe',  '&yuml;'    => '\u00ff',
                                      '&quot;'    => '\u0022',  '&amp;'     => '\u0026',  '&lt;'       => '\u003c',  '&gt;'      => '\u003e',
                                      '&OElig;'   => '\u0152',  '&oelig;'   => '\u0153',  '&Scaron;'   => '\u0160',  '&scaron;'  => '\u0161',
                                      '&Yuml;'    => '\u0178',  '&circ;'    => '\u02c6',  '&tilde;'    => '\u02dc',  '&ensp;'    => '\u2002',
                                      '&emsp;'    => '\u2003',  '&thinsp;'  => '\u2009',  '&zwnj;'     => '\u200c',  '&zwj;'     => '\u200d',
                                      '&lrm;'     => '\u200e',  '&rlm;'     => '\u200f',  '&ndash;'    => '\u2013',  '&mdash;'   => '\u2014',
                                      '&lsquo;'   => '\u2018',  '&rsquo;'   => '\u2019',  '&sbquo;'    => '\u201a',  '&ldquo;'   => '\u201c',
                                      '&rdquo;'   => '\u201d',  '&bdquo;'   => '\u201e',  '&dagger;'   => '\u2020',  '&Dagger;'  => '\u2021',
                                      '&permil;'  => '\u2030',  '&lsaquo;'  => '\u2039',  '&rsaquo;'   => '\u203a');
    
    if ($entity{1} != '#') {
        $entity = $entity_to_unicode[$entity];   
    } elseif ($entity[2] == 'x') {
        $unicode = substr($entity, 3, strlen($entity)-1);
        while (strlen($unicode) < 4) {
            $unicode = '0' . $unicode;   
        }
        $entity = '\u' . $unicode; 
    } else {
        $unicode = strtolower(base_convert(substr($entity, 2, strlen($entity)-1), 10, 16));  
        while (strlen($unicode) < 4) {
            $unicode = '0' . $unicode;   
        }
        $entity = '\u' . $unicode; 
    }
    return $entity;
}




/* --------------------------------------------------------------------- */
/* Value Functions
/* 
/* Manipulate values for access, display, storage, etc
/* --------------------------------------------------------------------- */


/**
 * Takes a field from the $_REQUEST array and cleans it based on the data type passed
 * 
 * @since 3.11.0
 * 
 * @param  string $field    The field to grab from the $_REQUEST array
 * @param  string $type     The data type of the field - any valid PHP datatype or leave blank to not cast your return
 * @param  mixed  $default  Any non-null value passed will be used as the default value (if no value was found via $_REQUEST)
 * @return void
 */
function request_value($field, $type='', $default=NULL)
{
	$return = (isset($_REQUEST[$field])) ? $_REQUEST[$field] : $default;
	if ($type == "array") {
		if (is_string($return) && strpos($return, ',') !== FALSE) {
			$return = explode(',', $return);
		}
		if (get_magic_quotes_gpc() && is_array($return)) {
			$return = array_map('stripslashes', $return);
		} elseif (get_magic_quotes_gpc() && !empty($return)) {
            $return = stripslashes($return);            
        }
	} else {
		if ($type == 'bool' || $type == 'boolean') {
			$return = (strtolower($return) == 'false' || strtolower($return) == 'f' || !$return) ? FALSE : TRUE;
		}
		if (get_magic_quotes_gpc()) {
			$return = stripslashes($return);
		}
	}
	if ($type) {
		settype($return, $type);
	}
	return $return;
}


/**
 * Modifies a value so it won't break a input tag value attribute or a textarea tag
 *
 * @since 3.11.0
 * 
 * @param  string  $value  The value to modify
 * @param  boolean $csv    Combine the values into a csv string
 * @return string  The modified value
 */
function form_value($value, $csv=FALSE)
{
	if ($csv) {
		settype($value, 'array');
		return join(',', array_map('htmlentities', $value));
	} else {
		return smart_htmlentities($value);
	}
}

/**
 * Modifies a value for use in a SQL statement
 *
 * @since 3.14.0
 * 
 * @param  string $value  The value to modify
 * @return string  The modified value
 */
function db_value($value)
{
	return str_replace("'", "''", $value);
}

/**
 * Modifies a value so it is safe to display in html
 *
 * @since 4.0.0
 * 
 * @param  string $value  The value to modify
 * @return string  The modified value
 */
function html_value($value)
{
	return xhtmlify($value);
}

/**
 * Modifies a value so it is safe to display in xml
 *
 * @since 4.4.0
 * 
 * @param  string $value  The value to modify
 * @return string  The modified value
 */
function xml_value($value)
{
	static $named_to_numeric_map = array(
		'&yuml;'    => '&#255;',  '&minus;'   => '&#45;',   '&circ;'     => '&#94;',   '&tilde;'   => '&#126;',
		'&Scaron;'  => '&#138;',  '&lsaquo;'  => '&#139;',  '&OElig;'    => '&#140;',  '&lsquo;'   => '&#145;',
		'&rsquo;'   => '&#146;',  '&ldquo;'   => '&#147;',  '&rdquo;'    => '&#148;',  '&bull;'    => '&#149;',
		'&ndash;'   => '&#150;',  '&mdash;'   => '&#151;',  '&tilde;'    => '&#152;',  '&trade;'   => '&#153;',
		'&scaron;'  => '&#154;',  '&rsaquo;'  => '&#155;',  '&oelig;'    => '&#156;',  '&Yuml;'    => '&#159;',
		'&yuml;'    => '&#255;',  '&OElig;'   => '&#338;',  '&oelig;'    => '&#339;',  '&Scaron;'  => '&#352;',
		'&scaron;'  => '&#353;',  '&Yuml;'    => '&#376;',  '&fnof;'     => '&#402;',  '&circ;'    => '&#710;',
		'&tilde;'   => '&#732;',  '&Alpha;'   => '&#913;',  '&Beta;'     => '&#914;',  '&Gamma;'   => '&#915;',
		'&Delta;'   => '&#916;',  '&Epsilon;' => '&#917;',  '&Zeta;'     => '&#918;',  '&Eta;'     => '&#919;',
		'&Theta;'   => '&#920;',  '&Iota;'    => '&#921;',  '&Kappa;'    => '&#922;',  '&Lambda;'  => '&#923;',
		'&Mu;'      => '&#924;',  '&Nu;'      => '&#925;',  '&Xi;'       => '&#926;',  '&Omicron;' => '&#927;',
		'&Pi;'      => '&#928;',  '&Rho;'     => '&#929;',  '&Sigma;'    => '&#931;',  '&Tau;'     => '&#932;',
		'&Upsilon;' => '&#933;',  '&Phi;'     => '&#934;',  '&Chi;'      => '&#935;',  '&Psi;'     => '&#936;',
		'&Omega;'   => '&#937;',  '&alpha;'   => '&#945;',  '&beta;'     => '&#946;',  '&gamma;'   => '&#947;',
		'&delta;'   => '&#948;',  '&epsilon;' => '&#949;',  '&zeta;'     => '&#950;',  '&eta;'     => '&#951;',
		'&theta;'   => '&#952;',  '&iota;'    => '&#953;',  '&kappa;'    => '&#954;',  '&lambda;'  => '&#955;',
		'&mu;'      => '&#956;',  '&nu;'      => '&#957;',  '&xi;'       => '&#958;',  '&omicron;' => '&#959;',
		'&pi;'      => '&#960;',  '&rho;'     => '&#961;',  '&sigmaf;'   => '&#962;',  '&sigma;'   => '&#963;',
		'&tau;'     => '&#964;',  '&upsilon;' => '&#965;',  '&phi;'      => '&#966;',  '&chi;'     => '&#967;',
		'&psi;'     => '&#968;',  '&omega;'   => '&#969;',  '&thetasym;' => '&#977;',  '&upsih;'   => '&#978;',
		'&piv;'     => '&#982;',  '&ensp;'    => '&#8194;', '&emsp;'     => '&#8195;', '&thinsp;'  => '&#8201;',
		'&zwnj;'    => '&#8204;', '&zwj;'     => '&#8205;', '&lrm;'      => '&#8206;', '&rlm;'     => '&#8207;',
		'&ndash;'   => '&#8211;', '&mdash;'   => '&#8212;', '&lsquo;'    => '&#8216;', '&rsquo;'   => '&#8217;',
		'&sbquo;'   => '&#8218;', '&ldquo;'   => '&#8220;', '&rdquo;'    => '&#8221;', '&bdquo;'   => '&#8222;',
		'&dagger;'  => '&#8224;', '&Dagger;'  => '&#8225;', '&bull;'     => '&#8226;', '&hellip;'  => '&#8230;',
		'&permil;'  => '&#8240;', '&prime;'   => '&#8242;', '&Prime;'    => '&#8243;', '&lsaquo;'  => '&#8249;',
		'&rsaquo;'  => '&#8250;', '&oline;'   => '&#8254;', '&frasl;'    => '&#8260;', '&euro;'    => '&#8364;',
		'&image;'   => '&#8465;', '&weierp;'  => '&#8472;', '&real;'     => '&#8476;', '&trade;'   => '&#8482;',
		'&alefsym;' => '&#8501;', '&larr;'    => '&#8592;', '&uarr;'     => '&#8593;', '&rarr;'    => '&#8594;',
		'&darr;'    => '&#8595;', '&harr;'    => '&#8596;', '&crarr;'    => '&#8629;', '&lArr;'    => '&#8656;',
		'&uArr;'    => '&#8657;', '&rArr;'    => '&#8658;', '&dArr;'     => '&#8659;', '&hArr;'    => '&#8660;',
		'&forall;'  => '&#8704;', '&part;'    => '&#8706;', '&exist;'    => '&#8707;', '&empty;'   => '&#8709;',
		'&nabla;'   => '&#8711;', '&isin;'    => '&#8712;', '&notin;'    => '&#8713;', '&ni;'      => '&#8715;',
		'&prod;'    => '&#8719;', '&sum;'     => '&#8721;', '&minus;'    => '&#8722;', '&lowast;'  => '&#8727;',
		'&radic;'   => '&#8730;', '&prop;'    => '&#8733;', '&infin;'    => '&#8734;', '&ang;'     => '&#8736;',
		'&and;'     => '&#8743;', '&or;'      => '&#8744;', '&cap;'      => '&#8745;', '&cup;'     => '&#8746;',
		'&int;'     => '&#8747;', '&there4;'  => '&#8756;', '&sim;'      => '&#8764;', '&cong;'    => '&#8773;',
		'&asymp;'   => '&#8776;', '&ne;'      => '&#8800;', '&equiv;'    => '&#8801;', '&le;'      => '&#8804;',
		'&ge;'      => '&#8805;', '&sub;'     => '&#8834;', '&sup;'      => '&#8835;', '&nsub;'    => '&#8836;',
		'&sube;'    => '&#8838;', '&supe;'    => '&#8839;', '&oplus;'    => '&#8853;', '&otimes;'  => '&#8855;',
		'&perp;'    => '&#8869;', '&sdot;'    => '&#8901;', '&lceil;'    => '&#8968;', '&rceil;'   => '&#8969;',
		'&lfloor;'  => '&#8970;', '&rfloor;'  => '&#8971;', '&lang;'     => '&#9001;', '&rang;'    => '&#9002;',
		'&loz;'     => '&#9674;', '&spades;'  => '&#9824;', '&clubs;'    => '&#9827;', '&hearts;'  => '&#9829;',
		'&diams;'   => '&#9830;', '&nbsp;'    => '&#160;',  '&iexcl;'    => '&#161;',  '&cent;'    => '&#162;',
		'&pound;'   => '&#163;',  '&curren;'  => '&#164;',  '&yen;'      => '&#165;',  '&brvbar;'  => '&#166;',
		'&sect;'    => '&#167;',  '&uml;'     => '&#168;',  '&copy;'     => '&#169;',  '&ordf;'    => '&#170;',
		'&laquo;'   => '&#171;',  '&not;'     => '&#172;',  '&shy;'      => '&#173;',  '&reg;'     => '&#174;',
		'&macr;'    => '&#175;',  '&deg;'     => '&#176;',  '&plusmn;'   => '&#177;',  '&sup2;'    => '&#178;',
		'&sup3;'    => '&#179;',  '&acute;'   => '&#180;',  '&micro;'    => '&#181;',  '&para;'    => '&#182;',
		'&middot;'  => '&#183;',  '&cedil;'   => '&#184;',  '&sup1;'     => '&#185;',  '&ordm;'    => '&#186;',
		'&raquo;'   => '&#187;',  '&frac14;'  => '&#188;',  '&frac12;'   => '&#189;',  '&frac34;'  => '&#190;',
		'&iquest;'  => '&#191;',  '&Agrave;'  => '&#192;',  '&Aacute;'   => '&#193;',  '&Acirc;'   => '&#194;',
		'&Atilde;'  => '&#195;',  '&Auml;'    => '&#196;',  '&Aring;'    => '&#197;',  '&AElig;'   => '&#198;',
		'&Ccedil;'  => '&#199;',  '&Egrave;'  => '&#200;',  '&Eacute;'   => '&#201;',  '&Ecirc;'   => '&#202;',
		'&Euml;'    => '&#203;',  '&Igrave;'  => '&#204;',  '&Iacute;'   => '&#205;',  '&Icirc;'   => '&#206;',
		'&Iuml;'    => '&#207;',  '&ETH;'     => '&#208;',  '&Ntilde;'   => '&#209;',  '&Ograve;'  => '&#210;',
		'&Oacute;'  => '&#211;',  '&Ocirc;'   => '&#212;',  '&Otilde;'   => '&#213;',  '&Ouml;'    => '&#214;',
		'&times;'   => '&#215;',  '&Oslash;'  => '&#216;',  '&Ugrave;'   => '&#217;',  '&Uacute;'  => '&#218;',
		'&Ucirc;'   => '&#219;',  '&Uuml;'    => '&#220;',  '&Yacute;'   => '&#221;',  '&THORN;'   => '&#222;',
		'&szlig;'   => '&#223;',  '&agrave;'  => '&#224;',  '&aacute;'   => '&#225;',  '&acirc;'   => '&#226;',
		'&atilde;'  => '&#227;',  '&auml;'    => '&#228;',  '&aring;'    => '&#229;',  '&aelig;'   => '&#230;',
		'&ccedil;'  => '&#231;',  '&egrave;'  => '&#232;',  '&eacute;'   => '&#233;',  '&ecirc;'   => '&#234;',
		'&euml;'    => '&#235;',  '&igrave;'  => '&#236;',  '&iacute;'   => '&#237;',  '&icirc;'   => '&#238;',
		'&iuml;'    => '&#239;',  '&eth;'     => '&#240;',  '&ntilde;'   => '&#241;',  '&ograve;'  => '&#242;',
		'&oacute;'  => '&#243;',  '&ocirc;'   => '&#244;',  '&otilde;'   => '&#245;',  '&ouml;'    => '&#246;',
		'&divide;'  => '&#247;',  '&oslash;'  => '&#248;',  '&ugrave;'   => '&#249;',  '&uacute;'  => '&#250;',
		'&ucirc;'   => '&#251;',  '&uuml;'    => '&#252;',  '&yacute;'   => '&#253;',  '&thorn;'   => '&#254;');
    
    $value = html_entity_decode($value, ENT_COMPAT, 'UTF-8');
    $value = smart_htmlentities($value);
    $value = str_replace(array_keys($named_to_numeric_map), array_values($named_to_numeric_map), $value);
    return str_replace("'", '&apos;', $value);
}



/* --------------------------------------------------------------------- */
/* Requirement Checks
/* 
/* Manipulate values for access, display, storage, etc
/* --------------------------------------------------------------------- */


/**
 * Magic Quotes - version 4+ of this file expects magic quotes to be off
 * 
 */
if (get_magic_quotes_gpc() === 1) {
	echo "You're using version 4+ of iMarc's common.php library, which expects PHP's magic quotes to be off. ";
	echo "Unfortunately, this site seems to have them on. To fix this edit Apache's VitualHost configuration ";
	echo "for this domain by adding the following line: <br /><br />\n\n";
	echo "php_flag magic_quotes_gpc 0 <br /><br />";
	echo "Also, review code that interacts with the database. Variables going to the database should be ";
	echo "wrapped with db_value(\$var)";
	exit;
}
?>