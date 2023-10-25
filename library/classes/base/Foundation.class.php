<?php
/**
 * Foundation - Lowest level abstract class that provides common services for Record, Controller and related classes
 *        
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @version  2.0.1
 *
 * @author   William Bond    [wb] <will@imarc.net>
 * @author   Patrick McPhail [pm] <patrick@imarc.net>
 * @author   Fred LeBlanc    [fl] <fred@imarc.net>
 * 
 * @requires  Database 6.3.0+, Cache 2.2.0b+, Inflector 1.0.5+, Objects 2.0.0+, Record 3.0.0b1+
 * 
 * @changes  2.0.1   Fixed some capitalization in wordify() [wb, 2007-11-15]
 * @changes  2.0.0   Moved out of beta [wb, 2007-08-14]
 * @changes  2.0.0b4 Now required Record 3.0.0b16+, no longer saves association to objects class [wb, 2007-06-14]
 * @changes  2.0.0b3 Now uses Objects singleton [wb, 2007-05-25]
 * @changes  2.0.0b2 Now requires Database 6.3.0+ [wb, 2007-04-05]
 * @changes  2.0.0b1 Bumped version for new debug/exception code, now requires RecordClass 3.0.0b1+ [wb, 2007-03-19]
 * @changes  1.1.1b  Added new debugging/exception code [wb, 2007-03-14]
 * @changes  1.1.1   Fixed underscoreNotation(), regular expression edit. [wb, 2007-01-16]
 * @changes  1.1.0   Added throwDebugException() [wb, 2007-01-08]
 * @changes  1.0.2   Fixed boundary bugs with underscoreNotation() and camelCase() [wb + fl, 2007-01-03]
 * @changes  1.0.1   Fixed underscoreNotation() bug [wb+pm, 2006-12-01]
 * @changes  1.0.0   Initial implementation [wb, 2006-11-16]
 *
 * @property Inflector $Inflector
 * @property Database $Database
 * @property Session $Session
 * @property Validator $Validator
 * @property Cache $Cache
 * @property FileUpload $FileUpload
 */
abstract class Foundation
{
    
    /**
     * Error message
     * 
     * @var string
     */
    protected $error;
    
    /**
     * If debugging is enabled
     * 
     * @var boolean
     */
	protected $debug;
    
	/**
     * Constructor;
     * 
     * @since 1.0.0
     * 
	 * @param  void
     * @return void
     */
	public function __construct() 
    {
		$objects = Objects::getInstance();
        $this->error   = '';
        
        // Check supporting file versions
        $this->checkVersion('Record',            '3.0.0');
		$this->checkVersion($objects,            '2.0.0');
		$this->checkVersion($objects->Database,  '7.0.0');
		$this->checkVersion($objects->Cache,     '2.2.0');
        $this->checkVersion($objects->Inflector, '1.0.5');    
    }
    
    
    /**
     * Turns debugging on or off, will override global DEBUG flag
     * 
     * @since 1.1.1b
     * 
     * @param  boolean $enabled  If debugging should be enabled
     * @return void 
     */
    public function setDebug($enabled) 
    {
        $this->debug = ($enabled) ? TRUE : FALSE;
    }
    
    
    /**
     * Prints a debug message if class debugging is enabled or global debugging is enabled and class debugging is not set
     * 
     * @since 1.1.1b
     * 
     * @param  string $message          The debug message
     * @param  boolean $full_backtrace  Show the full backtrace of function calls, etc
     * @return void 
     */
    public function printDebug($message, $full_backtrace) 
    {
        $print = ($this->debug || (!is_bool($this->debug) && defined('DEBUG') && DEBUG)) ? TRUE : FALSE;
        if (!$print) { return; }
        if (function_exists('print_debug')) {
            print_debug($message, $full_backtrace);    
        } else {
            echo '<pre class="debug">' . $message . '</pre>';
        }
    }
    
    
    /**
     * compares class's version number to a version number that we expect
     * 
     * @since  1.0.0
     * 
     * @param  string $class             the class object to check or a class name for checking abstract classes
     * @param  string $required_version  lowest version of object that we can use
     * @return void
     */
    protected function checkVersion($class, $required_version)
    {
        if (is_object($class)) {
            $class_name    = get_class($class);
            $class_version = $class->getVersion();     
        } else {
            $class_name    = $class;
            $code          = '$class_version = ' . $class . '::get' . $class . 'Version();';
            eval($code);  
        }
        
        // Make sure we at least have the minimum version
        if (strnatcmp($class_version, $required_version) < 0) {
            throw new Exception(get_class($this) . ' class: requires ' . $class_name . ' class version ' . $required_version . ' or newer');
        }
        
        // Make sure we are running the same major version
        $class_major    = substr($class_version, 0, strpos($class_version, '.'));
        $required_major = substr($required_version, 0, strpos($required_version, '.'));
        if ($class_major != $required_major) {
            throw new Exception(get_class($this) . ' class: only works with the ' . $class_name . ' class major version ' . $required_major);        
        }
    }
    
    
    /**
     * Returns version number of the Foundation class
     * 
     * @since  1.0.0
     * 
     * @param  void
     * @return string  version 
     */
    public static function getFoundationVersion() 
    {
        return '2.0.1';
    }
    
    
    /**
     * Returns version number
     * 
     * @since  1.0.0
     * 
     * @param  void
     * @return string  version 
     */
    public function getVersion() 
    {
        return $this->version;
    }
    
    
    /**
     * Return an object via the Objects object
     * 
     * @since  1.0.0
     * 
     * @param  string $class_name  The name of the class to get
     * @return void
     */
    public function __get($class_name)
    {
		return Objects::getInstance()->$class_name;
    }
    
    
    /**
     * Returns error message
     * 
     * @since  1.0.0
     * 
     * @param  void
     * @return mixed  False if no error, error string otherwise 
     */
    public function getError() 
    {
        return (empty($this->error)) ? FALSE : $this->error;
    }
    
    
    /**
     * Resets the error message
     * 
     * @since  1.0.0
     * 
     * @param  void
     * @return void 
     */
    public function resetError() 
    {
        $this->error = '';
    }
    

    /**
     * If there are any errors, throw an exception. Will also clean up uploaded files if throwing exception on self
     * 
     * @since  1.0.0
     * 
     * @param  object $object  The object to check for an error, otherwise checks self
     * @param  string $type    The type of exception to throw
     * @return void
     */
    public function throwException($object=NULL, $type='StandardException') 
    {
        trigger_error("The method throwException() has been DEPRECATED, please use throwIfError() instead", E_USER_WARNING);  
        $this->throwIfError($object, $type);
    }
    
    
    /**
     * If there are any errors, throw an exception
     * 
     * @since  1.1.1b
     * 
     * @param  object $object  The object to check for an error, otherwise checks self
     * @param  string $type    The type of exception to throw
     * @return void
     */
    public function throwIfError($object=NULL, $type='StandardException') 
    {
        if (!is_object($object)) { $object = $this; }
        if ($object->getError()) {
            throw new $type($object->getError());            
        }   
    }

    
    /* ------------------------------------------------- */
    /* DATABASE METHODS
    /* ------------------------------------------------- */   
       
    
    /**
     * Determines what fields in the current table are the primary keys
     * 
     * @since  1.0.0
     * 
     * @param  void
     * @return void
     */
    protected function cacheDatabaseKeys()
    {       
        $database_keys = $this->Database->getKeys();
        foreach ($database_keys as $table => $key_arrays) {
            foreach ($key_arrays as $name => $values) {
                $this->setCache($name, $values, $this->tableToClass($table));  
            }  
        }
    }
    

    /**
     * Sets the database feild info
     * 
     * @since  1.0.0
     * 
     * @param  void
     * @return void
     */
    protected function cacheDatabaseFieldInfo()
    {
        $database_field_info = $this->Database->getStructure();
        foreach ($database_field_info as $table => $field_info) {
            $this->setCache('field_info', $field_info, $this->tableToClass($table));  
        }
    }
    
    
    /**
     * Allows checking of IDs against the table specified
     * 
     * @since  1.0.0
     * 
     * @param  string $table  The table the ids are referencing (in underscore notation) 
     * @param  array $ids     The IDs to check    
     * @return boolean  If the IDs were all valid
     */
    protected function checkIds($table, $ids) 
    {        
        // Short circuit if we have nothing to check
        if (empty($ids)) {
            return TRUE;   
        } elseif (!is_array($ids)) {
            $ids = array($ids);       
        }
        
        // Get the primary key for the table specified
        $primary_key_field = $this->getCache('primary_key_field', $this->tableToClass($table));
        if ($primary_key_field === NULL) {
            $this->cacheDatabaseKeys();
            $this->cacheDatabaseFieldInfo();        
            $primary_key_field = $this->getCache('primary_key_field', $this->tableToClass($table));
        }
        
        // Check the IDs
        $sql = "SELECT " . $primary_key_field . " FROM " . $table . " WHERE " . $primary_key_field . " IN ('" . join("','", array_map('addslashes', $ids)) . "')";
        $result = $this->Database->query($sql);
        
        try {
            if ($this->Database->numRows($result)) {
                $db_ids = array();
                while ($row = $this->Database->getRow($result)) {
                    $db_ids[] = $row[$primary_key_field];       
                }
                sort($ids);
                sort($db_ids);
                if ($ids != $db_ids) {
                    throw new Exception();   
                }
                return TRUE;
                    
            } else {
                throw new Exception();       
            }
        
        // Handle if none were found, or at least one wasn't found
        } catch (Exception $e) {
            $this->error .= "The " . $this->wordify($this->singularize($table)) . " specified could not be found\n";
            return FALSE;    
        }
    }              
    
    
    /* ------------------------------------------------- */
    /* STRING METHODS
    /* ------------------------------------------------- */
    
    
    /**
     * Converts upper camel case to underscore notation
     * 
     * @since  1.1.0
     * 
     * @param  string $string  The string to convert     
     * @return string  The converted string
     */
    protected function underscoreNotation($string)
    {
        if (stripos($string, '_') !== FALSE) { return $string; }
        $string = preg_replace("/([a-z0-9A-Z])([A-Z])/", '\1_\2', $string);
	    $string = preg_replace("/([a-zA-Z])([A-Z0-9])/", '\1_\2', $string);
	    return strtolower($string);    
    }
    
    
    /**
     * Converts underscore notation to upper camel case
     * 
     * @since  1.1.0
     * 
     * @param  string $string  The string to convert  
     * @param  string $upper   If the camel case should be UpperCamelCase   
     * @return string  The converted string
     */
    protected function camelCase($string, $upper=FALSE)
    {
        if ($upper) {
        	if (strtolower($string) != $string) { 
            	return $string;
			}
			$string = ucfirst($string);
        } elseif (!$upper && (strtolower($string) != $string || strpos($string, '_') === FALSE)) {
        	return $string;	
		}

        return preg_replace_callback(
            '/(_([a-z0-9]))/',
            function ($m) { return strtoupper($m[2]); },
            $string
        );
    }
    
    
    /**
     * Takes a camelCase or underscore notation string and pluralizes it
     * 
     * @since  1.0.0
     * 
     * @param  string $string  The string to pluralize 
     * @return string  The pluralized string
     */
    protected function pluralize($string)
    {
        // A single token, it just needs to be pluralized
        if (!preg_match('/_|[A-Z]/', $string)) {
			return $this->Inflector->pluralizeNoun($string);
        
        // Otherwise only singularize the last word
        } else {
            // Handle camelCase
            $camel_case = FALSE;
            if (strpos($string, '_') === FALSE) {
                $camel_case = TRUE;
                $string = $this->underscoreNotation($string);
            }
            $split = explode('_', $string);
            $last_index = sizeof($split) - 1;
			$split[$last_index] = $this->Inflector->pluralizeNoun($split[$last_index]);
            $string = join('_', $split);
            if ($camel_case) { $string = $this->camelCase($string); }
            return $string;
        }
    }
    
    
    /**
     * Takes a camelCase or underscore notation string and singularizes it
     * 
     * @since  1.0.0
     * 
     * @param  string $string  The string to singularize
     * @return string  The singularized string
     */
    protected function singularize($string)
    {
        // A single token, it just needs to be singularized
        if (!preg_match('/_|[A-Z]/', $string)) {
			return $this->Inflector->singularizeNoun($string);
        
        // Otherwise only singularize the last word
        } else {
            // Handle camelCase
            $camel_case = FALSE;
            if (strpos($string, '_') === FALSE) {
                $camel_case = TRUE;
                $string = $this->underscoreNotation($string);
            }
            $split = explode('_', $string);
            $last_index = sizeof($split) - 1;
            $split[$last_index] = $this->Inflector->singularizeNoun($split[$last_index]);
            $string = join('_', $split);
            if ($camel_case) { $string = $this->camelCase($string); }
            return $string;
        }
    }
    
    
    /**
     * Returns the string converted from lowercase with _s to word uppercase with spaces
     * 
     * @since 1.0.0
     * 
     * @param  mixed $string  The string (or array of strings) to convert
     * @return mixed  The converted string (or array of strings)
     */
    protected function wordify($string)
    {
        if (is_array($string)) {
            foreach ($string as &$temp) {
                $temp = preg_replace_callback(
                    '/(\b(id|swf|pdf|url|css)\b|\b\w)/',
                    function ($m) {
                        return strtoupper($m[1]);
                    },
                    str_replace('_', ' ', $temp)
                );
            }    
        } else {
            $string = preg_replace_callback(
                '/(\b(id|swf|pdf|url|css)\b|\b\w)/',
                function ($m) {
                    return strtoupper($m[1]);
                },
                str_replace('_', ' ', $string)
            );
        }

        return $string;    
    }
    
    
    /**
     * Returns the class name for a database table specified
     * 
     * @since 1.0.0
     * 
     * @param  string $table_name  The database table
     * @return string  The class name
     */
    protected function tableToClass($table_name)
    {
        return $this->camelCase($this->singularize($table_name), TRUE);   
    }
    
    
    /**
     * Returns the database table name for a class specified
     * 
     * @since 1.0.0
     * 
     * @param  string $class_name  The class name
     * @return string  The database table
     */
    protected function classToTable($class_name)
    {
        return $this->underscoreNotation($this->pluralize($class_name));   
    }
    
    
        /* ------------------------------------------------- */
    /* CACHE METHODS
    /* ------------------------------------------------- */
    
    
    /**
     * Returns a variable from the cache
     * 
     * @since  1.0.0
     * 
     * @param  string $variable  The variable to get 
     * @param  string $class     The class to get the variable for 
     * @return string  The value stored in the cache
     */
    protected function getCache($variable, $class=NULL)
    {
        if (empty($class)) { $class = get_class($this); }
        return $this->Cache->getPermanentData($class, $variable);       
    }
    
    
    /**
     * Sets a variable to the cache
     * 
     * @access protected
     * @since  1.0.0
     * 
     * @param  string $variable  The variable to set
     * @param  mixed $value      The value to set 
     * @param  string $class     The class to store the variable for 
     * @return void
     */
    protected function setCache($variable, $value, $class=NULL)
    {
        if (empty($class)) { $class = get_class($this); }
        $this->Cache->setPermanentData($class, $variable, $value);       
    }
    
    
    /**
     * Loads class variables from the Cache class
     * 
     * @since  1.0.0
     * 
     * @param  mixed $variables  The variable(s) to get 
     * @return boolean  If all of the variables existed and were loaded
     */
    protected function loadFromCache($variables)
    {
        settype($variables, 'array');
        foreach ($variables as $variable) {
            if ($this->Cache->getPermanentData(get_class($this), $variable) === NULL) {
                return FALSE;
            }    
        }
        foreach ($variables as $variable) {
            $this->$variable = $this->Cache->getPermanentData(get_class($this), $variable);
        }       
        return TRUE;
    }
    
    
    /**
     * Saves class variables to the Cache class
     * 
     * @since  1.0.0
     * 
     * @param  mixed $variables  The variable(s) to save 
     * @return void
     */
    protected function saveToCache($variables)
    {
        settype($variables, 'array');
        foreach ($variables as $variable) {
            $this->Cache->getPermanentData(get_class($this), $variable, $this->$variable);
        }       
    }
    
}

?>