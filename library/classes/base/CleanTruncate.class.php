<?php
/**
 * Truncates a text string to an optical width
 * 
 * Copyright 2006, iMarc <info@imarc.net>
 * 
 * @version  1.3.1
 *  
 * @author   Dave Tufts    [dt] <dave@imarc.net>
 * @author   William Bond  [wb] <will@imarc.net>
 * @author   Fred LeBlanc  [fl] <fred@imarc.net>
 * @author   Bill Bushee   [bb] <bill@imarc.net>
 * 
 * @changes  1.3.1  Replaced '...' with &hellip; in  [wb, 2007-11-01]
 * @changes  1.3.0  Added ability to split on line breaks, in addition to spaces [wb, 2006-12-01]
 * @changes  1.2.0  Added default typeface (Arial) to truncate, updated truncate word loop amount (from 3 to 5) [fl 2006-08-15]
 * @changes  1.1.0  Added Verdana and Arial, plus showTypefaces(), getVersion() and getError() methods [wb, 2006-04-27]
 * @changes  1.0.0  Initial release [dt 2006-03-24]
 */
class CleanTruncate
{
	/**
	 * Version number: major.minor.bug-fix
	 * 
	 * @var string
	 */
	private $version = "1.3.1";
    
    /**
	 * Error message
	 * 
	 * @var string
	 */
    private $error;
    
    /**
	 * Typeface array currently loaded
	 * 
	 * @var array
	 */
	private $typeface = array();
	
    /**
	 * Currently defined typefaces and corresponding method
	 * 
	 * @var array
	 */
	private $typeface_map = array('Arial'           => 'loadTypefaceArial',
                                  'Verdana'         => 'loadTypefaceVerdana',
                                  'Mono'            => 'loadTypefaceMono',
                                  'Courier New'     => 'loadTypefaceMono',
                                  'Times New Roman' => 'loadTypefaceTimes');
	
	/**
	 * Constructor; loads typeface
	 * 
     * @access public
     * @since  1.0.0
     * 
	 * @param  void
	 * @return object
	 */
	public function __construct()
	{
        
	}
	
    
    /**
	 * Returns the version of the class
	 * 
     * @access public
     * @since  1.1.0
     * 
	 * @param  void
     * @return string  The current class version
	 */
	public function getVersion()
    {
		return $this->version;	
	}
    
    
    /**
	 * Get the current error (if exists)
	 * 
	 * @access public
	 * @since  1.1.0
	 * 
	 * @param  void
	 * @return mixed  The error string if set, or false if no error
	 */
	public function getError()
	{
		return (!empty($this->error)) ? $this->error : FALSE;	
	}
    
    	
	/**
	 * Cleanly truncates a text string to specified length (or less) at a space
	 * 
     * @access public
     * @since  1.0.0
     * 
	 * @param  string text      text to truncate
	 * @param  string length    maximum length (optical based)
     * @param  string typeface  The typeface to use for length checking
	 * @return mixed  truncated text or FALSE if error
	 */
	public function truncate($text, $length, $typeface='Arial')
	{
		$success = $this->setTypeface($typeface);
        if (!$success) {
            return FALSE;    
        }
        
        $my_text = trim((string) $text);
		$length  = (int) $length;
		if ($this->getOpticalWidth($my_text, $typeface) <= $length) {
			return $text; // text is already short enough
		}
		
        // Start with a string a little too long and trim from there
        $my_text = $this->truncateText($my_text, $length + 4);
		
		// loop through text; remove the last word each time, max 5 times
		for($i=0; $i < 5; $i++) {
			if ($this->getOpticalWidth($my_text, $typeface) <= $length) {
				return $this->formatReturn($text, $my_text);
			}
			$my_text = $this->removeLastWord($my_text);
		}
		return $this->formatReturn($text,  substr($my_text, 0, ($length - 2)) );
	}

	/**
	 * Returns optical width of a string
	 * 
     * @access public
     * @since  1.0.0
     * 
	 * @param  string text      Text string to inspect
     * @param  string typeface  The typeface to use for length checking
	 * @return mixed  (float) optical width of $text or FALSE if error 
	 */
	public function getOpticalWidth($text, $typeface)
	{
		$success = $this->setTypeface($typeface);
        if (!$success) {
            return FALSE;    
        }
        
        $optical_width = 0;
		for ( $i = 0; $i < strlen($text); ++$i) {
			$optical_width += $this->getCharacterWidth($text{$i});
		}
		return (float) $optical_width;
	}
	
    
	/**
	 * Truncated text string to a specific optical width
	 * 
     * @access private
     * @since  1.0.0
     * 
	 * @param  string text        Text string to truncate
	 * @param  integer max_width  Optical width to truncate
	 * @return string  Text truncated to optical $max_width
	 */
	private function truncateText($text, $max_width)
	{
		$return_string  = '';
		$optical_width  = 0;
	
		for ($i = 0; $i < strlen($text); ++$i) {
			$optical_width += $this->getCharacterWidth($text{$i});
			if ($max_width < $optical_width) { break; }
			$return_string .= $text{$i};
		}        
        
        return $return_string;
	}

    
	/**
	 * Formats truncated text, if altered from original, elipses are added
	 * 
     * @access private
     * @since  1.0.0
     * 
	 * @param  string original_text   The original text
	 * @param  string truncated_text  The truncated text
	 * @return string  truncated text; if different from original text, elipses are appended
	 */
	private function formatReturn($original_text, $truncated_text)
	{
		if ($truncated_text != $original_text) {
			return $truncated_text . '&hellip;';
		} else {
			return $truncated_text;
		}
	}
	
    
	/**
	 * Returns optical width of a character (using the current $this->typeface)
	 * 
     * @access private
     * @since  1.0.0
     * 
	 * @param  string char  A single character
	 * @return float   optical width of character
	 */
	private function getCharacterWidth($char)
	{
		return (isset($this->typeface[$char{0}])) ? $this->typeface[$char{0}] : 1;	
	}

    
	/**
	 * Removes last word of a string
	 * 
     * @access private
     * @since  1.0.0
     * 
	 * @param  string text
	 * @return text minus last word
	 */
	private function removeLastWord($text)
	{
		$last_space = strrpos($text, ' ');
        $last_line_break = strrpos($text, "\n");
        if ($last_line_break > $last_space) {
            $last_space = $last_line_break;    
        }
		if ($last_space !== FALSE) {
			$text = substr($text, 0, $last_space);
		}
		return $text;
	}

    
	/**
	 * Sets typeface as array of optical width percentages, relative to lowercase 'n'
	 * 
     * @access private
     * @since  1.0.0
     * 
	 * @param  string typeface  typeface to use
	 * @return boolean  if the typeface was successfully set
	 */
	private function setTypeface($typeface='times')
	{
        $this->error = '';
        
        // allow lenient input; only match first 4 chars of typeface
		$typeface = substr(strtolower($typeface), 0, 4);
		
        // Map our current list of types to the lower-case 4 char long version (ex: Arial => aria, Verdana => verd)
        $new_keys = array_keys($this->typeface_map);
        for ($i=0; $i < sizeof($new_keys); $i++) {
            $new_keys[$i] = substr(strtolower($new_keys[$i]), 0, 4);
        }
        
		$typeface_match = array_combine($new_keys, array_keys($this->typeface_map));
        
        if (!in_array($typeface, $new_keys)) {
            $this->error = 'Typeface specified is not supported';
            return FALSE;
        }
        
        $method_name = $this->typeface_map[$typeface_match[$typeface]];
        $this->typeface = $this->$method_name();
        return TRUE;
	}

    
	/**
	 * Loads optical width info for any monospaced typeface, 
	 * 
     * @access private
     * @since  1.0.0
     * 
	 * @param  void
	 * @return array  typeface optical width info
	 */
	private function loadTypefaceMono()
	{
		return array(
			'A'=>1.00, 'B'=>1.00, 'C'=>1.00, 'D'=>1.00, 'E'=>1.00, 'F'=>1.00, 'G'=>1.00, 'H'=>1.00, 'I'=>1.00, 'J'=>1.00, 
			'K'=>1.00, 'L'=>1.00, 'M'=>1.00, 'N'=>1.00, 'O'=>1.00, 'P'=>1.00, 'Q'=>1.00, 'R'=>1.00, 'S'=>1.00, 'T'=>1.00, 
			'U'=>1.00, 'V'=>1.00, 'W'=>1.00, 'X'=>1.00, 'Y'=>1.00, 'Z'=>1.00,
			'a'=>1.00, 'b'=>1.00, 'c'=>1.00, 'd'=>1.00, 'e'=>1.00, 'f'=>1.00, 'g'=>1.00, 'h'=>1.00, 'i'=>1.00, 'j'=>1.00, 
			'k'=>1.00, 'l'=>1.00, 'm'=>1.00, 'n'=>1.00, 'o'=>1.00, 'p'=>1.00, 'q'=>1.00, 'r'=>1.00, 's'=>1.00, 't'=>1.00, 
			'u'=>1.00, 'v'=>1.00, 'w'=>1.00, 'x'=>1.00, 'y'=>1.00, 'z'=>1.00, 
			'1'=>1.00, '2'=>1.00, '3'=>1.00, '4'=>1.00, '5'=>1.00, '6'=>1.00, '7'=>1.00, '8'=>1.00, '9'=>1.00, '0'=>1.00, 
			'.'=>1.00, '-'=>1.00, ' '=>1.00, '?'=>1.00, '@'=>1.00, '#'=>1.00, '('=>1.00, ')'=>1.00, '!'=>1.00, ','=>1.00,
            ';'=>1.00, '*'=>1.00, '$'=>1.00, "'"=>1.00, '"'=>1.00,
		);
	}
	
    
	/**
	 * Returns optical width info for Times/Times New Roman 
	 * 
     * @access private
     * @since  1.0.0
     * 
	 * @param  void
	 * @return array  typeface optical width info
	 */
	private function loadTypefaceTimes()
	{
		return array(
			'A'=>1.38, 'B'=>1.23, 'C'=>1.23, 'D'=>1.46, 'E'=>1.31, 'F'=>1.15, 'G'=>1.46, 'H'=>1.46, 'I'=>0.76, 'J'=>0.92, 
			'K'=>1.46, 'L'=>1.38, 'M'=>1.92, 'N'=>1.46, 'O'=>1.46, 'P'=>1.15, 'Q'=>1.53, 'R'=>1.38, 'S'=>1.00, 'T'=>1.31, 
			'U'=>1.46, 'V'=>1.38, 'W'=>1.92, 'X'=>1.46, 'Y'=>1.46, 'Z'=>1.31,
			'a'=>1.07, 'b'=>1.07, 'c'=>0.92, 'd'=>1.00, 'e'=>0.92, 'f'=>0.76, 'g'=>1.00, 'h'=>1.00, 'i'=>0.61, 'j'=>0.61, 
			'k'=>1.00, 'l'=>0.50, 'm'=>1.62, 'n'=>1.00, 'o'=>1.00, 'p'=>1.07, 'q'=>1.00, 'r'=>0.83, 's'=>0.83, 't'=>0.69, 
			'u'=>1.00, 'v'=>1.00, 'w'=>1.46, 'x'=>1.00, 'y'=>1.00, 'z'=>0.92, 
			'1'=>0.84, '2'=>1.07, '3'=>0.92, '4'=>1.15, '5'=>0.92, '6'=>1.00, '7'=>1.07, '8'=>0.92, '9'=>1.00, '0'=>1.07, 
			'.'=>0.46, '-'=>0.76, ' '=>0.92, '?'=>1.00, '@'=>1.69, '#'=>1.15, '('=>0.61, ')'=>0.61, '!'=>0.61, 
		);
	}
    
    
    /**
	 * Returns optical width info for Arial (12 px no AA)
	 * 
     * @access private
     * @since  1.1.0
     * 
	 * @param  void
	 * @return array  typeface optical width info
	 */
	private function loadTypefaceArial()
	{
		return array(
			'A'=>1.00, 'B'=>1.14, 'C'=>1.29, 'D'=>1.29, 'E'=>1.14, 'F'=>1.00, 'G'=>1.29, 'H'=>1.29, 'I'=>0.43, 'J'=>0.71, 
			'K'=>1.14, 'L'=>1.00, 'M'=>1.29, 'N'=>1.29, 'O'=>1.29, 'P'=>1.14, 'Q'=>1.29, 'R'=>1.29, 'S'=>1.14, 'T'=>1.00, 
			'U'=>1.29, 'V'=>1.00, 'W'=>1.57, 'X'=>1.00, 'Y'=>1.00, 'Z'=>1.00,
			'a'=>1.00, 'b'=>1.00, 'c'=>0.86, 'd'=>1.00, 'e'=>1.00, 'f'=>0.43, 'g'=>1.00, 'h'=>1.00, 'i'=>0.43, 'j'=>0.43, 
			'k'=>0.86, 'l'=>0.43, 'm'=>1.57, 'n'=>1.00, 'o'=>1.00, 'p'=>1.00, 'q'=>1.00, 'r'=>0.57, 's'=>1.00, 't'=>0.43, 
			'u'=>1.00, 'v'=>0.71, 'w'=>1.29, 'x'=>0.71, 'y'=>0.71, 'z'=>0.71, 
			'1'=>1.00, '2'=>1.00, '3'=>1.00, '4'=>1.00, '5'=>1.00, '6'=>1.00, '7'=>1.00, '8'=>1.00, '9'=>1.00, '0'=>1.00, 
			'.'=>0.43, '-'=>0.57, ' '=>0.43, '?'=>1.00, '@'=>1.71, '#'=>1.00, '('=>0.57, ')'=>0.57, '!'=>0.43, ','=>0.43,
            ';'=>0.43, '*'=>0.71, '$'=>1.00, "'"=>0.29, '"'=>0.57, 
		);
	}
    
    
    /**
	 * Returns optical width info for Verdana (12 px no AA)
	 * 
     * @access private
     * @since  1.1.0
     * 
	 * @param  void
	 * @return array  typeface optical width info
	 */
	private function loadTypefaceVerdana()
	{
		return array(
			'A'=>1.00, 'B'=>1.00, 'C'=>1.13, 'D'=>1.13, 'E'=>1.00, 'F'=>0.88, 'G'=>1.13, 'H'=>1.13, 'I'=>0.63, 'J'=>0.63, 
			'K'=>1.00, 'L'=>0.88, 'M'=>1.25, 'N'=>1.13, 'O'=>1.25, 'P'=>1.00, 'Q'=>1.13, 'R'=>1.00, 'S'=>1.00, 'T'=>0.88, 
			'U'=>1.13, 'V'=>1.00, 'W'=>1.63, 'X'=>1.00, 'Y'=>0.88, 'Z'=>1.00,
			'a'=>1.00, 'b'=>1.00, 'c'=>0.75, 'd'=>1.00, 'e'=>1.00, 'f'=>0.50, 'g'=>1.00, 'h'=>1.00, 'i'=>0.38, 'j'=>0.50, 
			'k'=>0.88, 'l'=>0.38, 'm'=>1.38, 'n'=>1.00, 'o'=>1.00, 'p'=>1.00, 'q'=>1.00, 'r'=>0.63, 's'=>0.88, 't'=>0.63, 
			'u'=>1.00, 'v'=>0.88, 'w'=>1.38, 'x'=>0.88, 'y'=>0.88, 'z'=>0.88, 
			'1'=>1.00, '2'=>1.00, '3'=>1.00, '4'=>1.00, '5'=>1.00, '6'=>1.00, '7'=>1.00, '8'=>1.00, '9'=>1.00, '0'=>1.00, 
			'.'=>0.38, '-'=>0.63, ' '=>0.50, '?'=>0.88, '@'=>1.50, '#'=>1.25, '('=>0.63, ')'=>0.63, '!'=>0.63, ','=>0.50,
            ';'=>0.63, '*'=>1.00, '$'=>1.00, "'"=>0.38, '"'=>0.75, 
		);
	}
}


?>
