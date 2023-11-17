<?php
/**
 * Validator - Data validation class
 * 
 * Copyright 1999-2007 iMarc LLC
 *
 * @version 3.0.2
 *
 * @author Dave Tufts      [dt] <dave@imarc.net>
 * @author William Bond    [wb] <will@imarc.net>
 * @author Fred LeBlanc    [fl] <fred@imarc.net>
 * @author Bill Bushee     [bb] <bill@imarc.net>
 * @author Patrick McPhail [pm] <patrick@imarc.net>
 *
 * @requires PHP 5.0 or higher
 * 
 * @changes 3.0.2   Fixed some capitalization in validateDatabase() [wb, 2007-11-15]
 * @changes 3.0.1   Fixed a bug in validating enum fields [wb, 2007-08-02]
 * @changes 3.0.0   Removed conf file, removed $strip_header_footer for getError() [wb, 2007-05-30]
 * @changes 2.7.1   fixed radio/checkbox bug in getValue() function.  Case else { } now returns empty string instead of NULL  [bb, 2007-04-13]
 * @changes 2.7.0   changed validateDatabase() and __construct so that database related validation does not use headers, footers or line start/endings; update phpdocs to iMarc standards [wb, 2007-03-07]
 * @changes 2.6.2   fixed documentation issues between 2.6.0 and 2.6.1 [wb, 2007-03-01]
 * @changes 2.6.1   fixed a horrendous bug in adding errored fields [pm, 2007-02-22]
 * @changes 2.6.0   updated to handle time data type in validateDatabase() [wb, 2006-10-31]
 * @changes 2.5.2   fixed a strict compliance bug [wb, 2006-09-29]
 * @changes 2.5.1   fixed bug in validateFields function [bb, 2006-09-06]
 * @changes 2.5.0   reworking of private methods to keep code-base tidy and changed functionality so $_FILES array is always checked [wb, 2006-09-06]
 * @changes 2.4.0   added methods cleanFieldName and checkField in support of @email and ^file_name field checking as well as default $_REQUEST / $_FILES field checking. [bb, 2006-08-23]
 * @changes 2.3.1   fixed a horrendous bug in figuring out errored fields [fl, 2006-08-14]
 * @changes 2.3.0   added getErrorFields, which returns an array of fields that errored out [fl, 2006-08-11]
 * @changes 2.2.2   fixed capitalization of field name with ID in them [wb, 2006-08-11]
 * @changes 2.2.1   changed validateValues() to check strlen() instead of empty() [dt, 2006-05-26]
 * @changes 2.2.0   added range checking for validateDatabase() when checking integers [wb, 2006-03-28]
 * @changes 2.1.3   added isset() to request checking, suppresses error notices [dt, 2006-03-03]
 * @changes 2.1.2   multiple bug fixes [dt, 2006-02-03]
 * @changes 2.1.1   fixed compilation of regex in validateEmail function [wb, 2006-01-30]
 * @changes 2.1.0   restructured internals and conf file, added validateDatabase(), validateValues() [wb, 2006-01-24]
 * @changes 2.0.0   updated to comply with new code standards, PHP5 [fl, 2006-01-09]
 * @changes 1.10.1  fixed PHP 'Notice' warnings, removed 'error_message' variable (duplicate of 'error'), cleaned comments, fixed PHP 'Notice' warnings
 * @changes 1.10.0  added get_version()
 * @changes 1.9.0   added get_error() function to allow access to error message from outside class 
 * @changes 1.8.0   added validator.conf.php that constructor checks to define custom messages and updated default html to xhtml
 * @changes 1.7.1   fixed email validation to detect invalid emails (name@@@domain.com)
 * @changes 1.7.0   updated comments for phpdoc
 * @changes 1.6.0   added validate_email function
 * @changes 1.5.0   rewrote comments
 * @changes 1.4.0   added isset() when validating (compatibale with PHP error notices)
 */
class Validator
{
		
	/**
	 * version number
	 * 
	 * @var string
	 */
	private $version = '3.0.2';
	
	/**
	 * HTML formatted error message
	 * 
	 * @var string
	 */
	private $error;
	
	/**
	 * Array of headers for errors
	 * 
	 * @var array
	 */
	private $header;
	
	/**
	 * Array of footers for errors
	 * 
	 * @var array
	 */
	private $footer;
	
	/**
	 * Array of line starts for errors
	 * 
	 * @var array
	 */
	private $line_start;
	
	/**
	 * Array of line ends for errors
	 * 
	 * @var array
	 */
	private $line_end;
	
	/**
	 * Array to hold field info from database, prevents duplicate calls to database->getStructure()
	 * 
	 * @var array
	 */
	private $field_info;
	
	/**
	 * Array of fields causing errors
	 *
	 * @var array
	 */
	private $error_fields;
    
    /**
	 * If a self call is being beformed
	 *
	 * @var boolean
	 */
	private $self_call;
	
	
	/**
	 * Class constructor, initializes class variables
	 * 
	 * @since  1.4.0
	 * 
	 * @param  void
	 * @return void
	 */
	public function __construct()
	{
		// Set up the error messaging
		$this->header        = array('field' => "<strong><span class='red'>Please fill in the following fields</span>:</strong>\n<ul>\n",
									 'email' => "<strong>Email address entered is invalid:</strong>\n<ul>\n");
		$this->footer        = array('field' => "</ul>\n",
									 'email' => "</ul>\n");
		$this->line_start    = array('field' => "<li>",
									 'email' => "<li>");
		$this->line_end      = array('field' => "</li>\n",
									 'email' => "</li>\n");
		
		$this->field_info    = array();
		$this->error_fields  = array();
		$this->error = '';
		
		$this->self_call     = FALSE;
	}
	
	
	/**
	 * Returns the version of the class
	 * 
	 * @since  2.0.0
	 * 
	 * @param  void
	 * @return string  The current class version
	 */
	public function getVersion()
	{
		return $this->version;	
	}
	
	
	/**
	 * Returns the error string.
	 * 
	 * @since  2.0.0
	 * 
	 * @param  void
	 * @return string  The current error message
	 */
	public function getError()
	{
		return $this->error;
	}
	
	
	/**
	 * Resets the error message to nothing
	 * 
	 * @since  2.1.0
	 * 
	 * @param  void
	 * @return void
	 */
	public function resetError()
	{
		$this->error = '';
	}
	
	
	/**
	* Validates a comma-separated string of $required_fields. 
	* 
	* Returns TRUE if all form fields are not NULL, FALSE if at least one fields is NULL.
	* FALSE also sets $this->error
	* 
	* @since 2.0.0
	* 
	* @param  string $required_fields  comma separated string of required form field names
	* @return boolean  If the fields validated successfully
	*/
	public function validateFields($required_fields='')
	{
		if (!$required_fields) {
			return TRUE;
		}
	
        $this->self_call = TRUE;
    
		// Delete all spaces from the field names and place the them in an array.
		$fields = array_filter(array_map('trim', explode (',', $required_fields)));
		$names  = array();
		
		foreach ($fields as $current_field) {	
			
			// "OR" fields - this_field||that_field - double pipe separated field names will check <this_field> or <that_field>
			if (strpos($current_field, '||') !== FALSE) {
				
				$sub_fields = array_filter(array_map('trim', explode('||', $current_field)));
				$name   = '';
                $values = '';
				$invalid_email = FALSE;
                
				// Create a name for the values to check and combine the values together
				foreach ($sub_fields as $current_sub_field) {
					$name  .= ($name) ? ' <strong>or</strong> ' : '';
                    $value  = $this->getValue($current_sub_field);
                    if (substr($current_sub_field, 0, 1) == '@') {
                        $invalid_email = $invalid_email || (!$this->validateEmail($value, FALSE));
                    }
                    $values .= $value;
					$name   .= ucwords(str_replace('_', ' ', $current_sub_field));
				}
				
				if (!$this->validateValues($values, $name) || $invalid_email) {
                    $names[]  = $name;
                    $this->addErrorField($name);
                }
	
			// Regular fields
			} else {
				$value = $this->getValue($current_field);
                $name  = ucwords(str_replace('_', ' ', $current_field));
				
                if (!$this->validateValues($value, $name) || (substr($current_field, 0, 1) == '@' && !$this->validateEmail($value, FALSE))) {
                    $names[] = $name;
                    $this->addErrorField($name);
                }
			}
		}
		
        $this->self_call = FALSE;
        if (count($names)) {
			$error_message = $this->header['field'];
			foreach ($names as $name) {
				$error_message .= $this->line_start['field'] . preg_replace('#(?:\@|\^)([a-z0-9 ]+[a-z0-9])#ie', "ucwords('$1') . ' (format: name@host.com)'", $name) . $this->line_end['field'];    
			}
			$error_message .= $this->footer['field'];
        }
		
		if (!empty($error_message)) {
            $this->error .= $error_message;
            return FALSE;   
        }
        return TRUE;
	}
    
    
    /**
	 * Gets a value from $_REQUEST or $_FILES
	 *
	 * @since  2.5.0
	 *
	 * @param  string $field  The field to get
	 * @return string
	 */
	private function getValue($field)
	{
        $field = (substr($field, 0, 1) == '^' || substr($field, 0, 1) == '@') ? substr($field, 1) : $field;
        if (isset($_FILES[$field]['name'])) {
            return $_FILES[$field]['name'];
        } elseif (isset($_REQUEST[$field])) {
            return $_REQUEST[$field];   
        } else {
            return '';   
        }
    }
    
    
	/**
	 * Adds a field to the error fields array
	 *
	 * @since  2.5.0
	 *
	 * @param  string $field  The field to add
	 * @return string
	 */
	private function addErrorField($field)
	{
		$field = strtolower(str_replace(array(' ', '@', '^'), array('_', '', ''), $field));
		$fields = explode('_<strong>or</strong>_', $field);
		foreach ($fields as $field) {
			array_push($this->error_fields, $field);
		}
	}
	
	
	/**
	 * Returns an array of fields that returned an error
	 *
	 * @since  2.3.0
	 *
	 * @param  void
	 * @return array
	 */
	public function getErrorFields()
	{
		return $this->error_fields;
	}
	
	
	/**
	* Validate that the passed string is in valid email format.
	* 
	* @since  2.0.0
	* 
	* @param  string $email       an email address
	* @param  string $error_type  create error as stand alone or as <li> element.
	* @return boolean            If the email address validated successfully
	*/
	public function validateEmail($email='', $error_type='single')
	{
		if ((!preg_match("/^[A-Z0-9._%'-]+@[A-Z0-9._%-]+\.([A-Z]{2,6}){1,2}$/i", $email))){
			
			if ($error_type == 'single') {
				$error_message  = $this->header['email'] . $this->line_start['email'];
				$error_message .= 'Please enter your email address in the format name@host.com';
				$error_message .= $this->line_end['email'] . $this->footer['email'];
				$this->error .= $error_message;
			}
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	
	/**
	* Validate the values passed are not empty
	* 
	* @since  2.0.0
	* 
	* @param  mixed $values  an array of values or a single value
    * @param  mixed $names   an array of names or a single name
	* @return boolean  If the email address validated successfully
	*/
	public function validateValues($values, $names)
	{
		settype($values, 'array');
        settype($names, 'array');
        
        $error_message = '';        
        // Look through and make sure all of the values are not empty
		for ($i=0; $i < count($values); ++$i) {
			if (!strlen($values[$i])) {
				$error_message .= $this->line_start['field'] . $names[$i] . $this->line_end['field'];
				if (!$this->self_call) {
                    $this->addErrorField($names[$i]);
                }
			}
		}
		
		if ($this->self_call && !empty($error_message)) {
            return FALSE;    
        } elseif (!empty($error_message)) {
			$this->error .= $this->header['field'] . $error_message . $this->footer['field'];
			return FALSE;
		} else {
			return TRUE;
		}
	
	}
	
	
	/**
	* Validate the values passed against the database
	* 
	* @since  2.0.0
	* 
	* @param  object $database  A reference to an instance of the Database class
	* @param  string $table     The table to verify the values against
	* @param  mixed  $fields    Database fields to use for validating the values - can be array or string
	* @param  mixed  $values    Values to check, these need to line up with the fields array - can be array or string
	* @param  mixed  $names     Names to use for the values in the error message, these need to line up with the values array (default is to use field names) - can be array or string
	* @return boolean  If the values validated against the database successfully
	*/
	public function validateDatabase(Database $database, $table, $fields, $values, $names=array())
	{
		if (!is_array($fields) && !is_string($fields)) {
			$this->error .= "Fields passed are not valid\n";	
		}
		if (!is_array($names) && !is_string($names)) {
			$this->error .= "Names passed are not valid\n";	
		}
		
		if (is_string($fields)) {
			$fields = array($fields);	
		}
		if (!is_array($values)) {
			$values = array($values);	
		}
		if (is_string($names)) {
			$names = array($names);	
		}
		
		// Error out if we aren't getting good input
		if (sizeof($fields) !== sizeof($values)) {
			$this->error .= "Fields and values arrays are of a different size\n";
			return FALSE;	
		}
		
		// Use the field names if the names array is screwy
		if (sizeof($names) < sizeof($values)) {
			$names = array();
			for($i=0; $i < sizeof($fields); ++$i) {
                $names[$i] = preg_replace('/(\b(id|swf|pdf|url|css)\b|\b\w)/e', 'strtoupper("\1")', str_replace('_', ' ', $fields[$i]));
			}		
		}
		
		$error_message = '';		
		
		// Get info about the database structure from the Database class
		if	(!array_key_exists($table, $this->field_info)) {
			$this->field_info[$table] = $database->getStructure($table);	
		}
		if (!$this->field_info[$table]) {
			$this->error .= "Unable to retrieve structure for table specified: " . $table . "\n";
			return FALSE;	
		}
		
		// Look through and make sure all of the values are within spec
		for ($i=0; $i < sizeof($values); ++$i) {
			
			// First lets make sure the value doesn't violate a not null constraint
			if ($this->field_info[$table][$fields[$i]]['not_null'] == TRUE && $values[$i] === NULL) {
				$this->addErrorField($fields[$i]);
				$error_message .= $names[$i] . " needs to have a value\n";
			
			} elseif ($values[$i] === NULL) {
				continue;
				
			// If the value is supposed to be a varchar or text, make sure it can be concatenated with a string and that it is not too long
			} elseif (($this->field_info[$table][$fields[$i]]['type'] == 'varchar' || $this->field_info[$table][$fields[$i]]['type'] == 'text') && !is_scalar($values[$i])) {
				$this->addErrorField($fields[$i]);
				$error_message .= $names[$i] . " is not a string\n";
			
			// If the value is supposed to be a varchar, make sure it is not too long
			} elseif ($this->field_info[$table][$fields[$i]]['type'] == 'varchar' && strlen($values[$i]) > $this->field_info[$table][$fields[$i]]['length']) {
				$this->addErrorField($fields[$i]);
				$error_message .= $names[$i] . ' is too long - ' . $this->field_info[$table][$fields[$i]]['length'] . " characters maximum\n";
			
			// If the value is supposed to be an enum, check the valid values                                                            very suspicion; just make provide "null" as default to not break the code;
			} elseif ($this->field_info[$table][$fields[$i]]['type'] == 'enum' && !in_array($values[$i], $this->field_info[$table][$fields[$i]]['valid_values']) && ($value ?? null !== NULL || !isset($this->field_info[$table][$fields[$i]]['default']))) {
				$this->addErrorField($fields[$i]);
				$error_message .= $names[$i] . " is not a valid value\n";
			
			// If the value is supposed to be an integer make sure we have some number
			} elseif ($this->field_info[$table][$fields[$i]]['type'] == 'integer' && (!is_numeric($values[$i]) || strpos($values[$i], '.') !== FALSE)) {
				$this->addErrorField($fields[$i]);
				$error_message .= $names[$i] . " is not a valid integer\n";
			
            // If the value is supposed to be an integer make sure it is not too large
			} elseif ($this->field_info[$table][$fields[$i]]['type'] == 'integer' && is_numeric($values[$i]) && strpos($values[$i], '.') === FALSE && $values[$i] > 2147483647) {
				$this->addErrorField($fields[$i]);
				$error_message .= $names[$i] . " is too large an integer - maximum of 2147483647\n";
                
            // If the value is supposed to be an integer make sure it is not too small
            } elseif ($this->field_info[$table][$fields[$i]]['type'] == 'integer' && is_numeric($values[$i]) && strpos($values[$i], '.') === FALSE && $values[$i] < -2147483648) {
				$this->addErrorField($fields[$i]);
				$error_message .= $names[$i] . " is too small an integer - minimum of -2147483648\n";
            
			// If the value is supposed to be a float make sure we have some number
			} elseif ($this->field_info[$table][$fields[$i]]['type'] == 'float' && !is_numeric($values[$i])) {
				$this->addErrorField($fields[$i]);
				$error_message .= $names[$i] . " is not a valid number\n";
			
			// If the value is supposed to be a boolean make sure it is 
			} elseif ($this->field_info[$table][$fields[$i]]['type'] == 'boolean' && !is_bool($values[$i])) {
				$this->addErrorField($fields[$i]);
				$error_message .= $names[$i] . " is not boolean\n";
			
			// If the value is supposed to be a date make sure it is parseable by strtotime
			} elseif ($this->field_info[$table][$fields[$i]]['type'] == 'date' && (strtotime($values[$i]) === -1 || strtotime($values[$i]) === FALSE)) {
				$this->addErrorField($fields[$i]);
				$error_message .= $names[$i] . " is not a date\n";
			
			// If the value is supposed to be a date/time make sure it is parseable by strtotime
			} elseif ($this->field_info[$table][$fields[$i]]['type'] == 'datetime' && (strtotime($values[$i]) === -1 || strtotime($values[$i]) === FALSE)) {
				$this->addErrorField($fields[$i]);
				$error_message .= $names[$i] . " is not a date/time\n";
			
            // If the value is supposed to be a time make sure it is parseable by strtotime
            } elseif ($this->field_info[$table][$fields[$i]]['type'] == 'time' && (strtotime($values[$i]) === -1 || strtotime($values[$i]) === FALSE)) {
                $this->addErrorField($fields[$i]);
                $error_message .= $names[$i] . " is not a time\n";
            }
		}
		
		// If we have had any errors, set the message
		if (!empty($error_message)) {
			$this->error .= $error_message;
			return FALSE;
		} else {
			return TRUE;
		}
	}
}


?>