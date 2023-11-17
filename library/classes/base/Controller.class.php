<?php
/**
 * Controller - Abstract class to base controller classes on
 *        
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @version  3.0.2
 *
 * @author   William Bond  [wb] <will@imarc.net>
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 * 
 * @requires  Foundation 2.0.0
 * 
 * @changes  3.0.2   Added a transaction wrapper around creating objects to help reduce execution time [wb, 2007-11-14]
 * @changes  3.0.1   Fixed an issue with finding the primary key from sql in performSql() [jt & wb, 2007-08-15]
 * @changes  3.0.0   Moved out of beta [wb, 2007-08-14]
 * @changes  3.0.0b8 Fixed performSql() so it detects the object name from the first field of the sql statement [wb, 2007-07-30]
 * @changes  3.0.0b7 Added an optional second parameter to performSql() to specify the class to create the objects with [wb, 2007-07-11]
 * @changes  3.0.0b6 Added mssql and case sensitivity support to createLikeClause() [jt, 2007-07-06]
 * @changes  3.0.0b5 Changed error messaging to use retrieveRecordName() for child classes [wb, 2007-06-26]
 * @changes  3.0.0b4 Now required Foundation 2.0.0b4+ [wb, 2007-06-14]
 * @changes  3.0.0b3 Now requires Foundation 2.0.0b3+ [wb, 2007-05-25]
 * @changes  3.0.0b2 Now requires Foundation 2.0.0b2+ [wb, 2007-04-05]
 * @changes  3.0.0b1 Version bump for new debug/exception code, updated dependencies [wb, 2007-03-19]
 * @changes  2.2.0b  Added listObjects() default method to find every record of an object in the database [wb, 2007-03-19]
 * @changes  2.1.0b  Added new debugging and exception code [wb, 2007-03-14]
 * @changes  2.1.0   Removed requirement for findObjects() method to exist when calling createObjects(), improved error messaging [wb, 2007-01-08]
 * @changes  2.0.1   Fixed a small bug in cleanValue() for arrays [wb, 2006-11-27]
 * @changes  2.0.0   Updated to user Database 6.0.0 and Cache 2.0.0, general code audit, fixed code standards violations [wb, 2006-11-16]
 * @changes  1.0.4   Fixed some strict error reporting issues [wb, 2006-09-27]
 * @changes  1.0.3   Fixed bug where database keys were not being retrieved from the Cache [wb, 2006-09-20]
 * @changes  1.0.2   Fixed a bug with cleanValue() for date and datetime [wb, 2006-09-08]
 * @changes  1.0.1   Fixed a bug with checking ids [wb, 2006-09-05]
 * @changes  1.0.0   Initial implementation [wb, 2006-07-26]
 */
abstract class Controller extends Foundation
{
	/**
	 * Constructor;
	 * 
	 * @since 1.0.0
	 * 
	 * @param  object $objects   Reference to objects object
	 * @return void
	 */
	public function __construct() 
	{
	    parent::__construct();
		$this->checkVersion('Foundation', '2.0.0');
	}
    
    
    /**
     * Returns version number of the Controller class
     * 
     * @since  2.0.0
     * 
     * @param  void
     * @return string  version 
     */
    public static function getControllerVersion() 
    {
        return '3.0.2';
    }

    
    /* ------------------------------------------------- */
    /* FIND METHOD HELPERS
    /* ------------------------------------------------- */
    
    
    /**
     * Verifies the order by option selected, throws an exception if it doesn't exist
     * 
     * @since 1.0.0
     * 
     * @param  string $order_by        The order by name
     * @param  array $valid_order_bys  An array of valid order bys (name => SQL)
     * @return string  The SQL of the order by
     */
    protected function verifyOrderBy($order_by, $valid_order_bys)
    {    
	    if (!in_array($order_by, array_keys($valid_order_bys))) {
    		throw new FatalException('Invalid order by specified');
		}
        
        return $valid_order_bys[$order_by];
    }
    
    
    /**
     * Creates a compound like clause for a like search of a database
     * 
     * Example:
     *   parameter values:
     *     $fields_to_match = array('field1', 'field2', 'field3')
     *     $terms = 'one way'
     * 
     *   generated sql:
     *     ((field1 LIKE '%one%' OR field2 LIKE '%one%' OR field3 LIKE '%one%') AND (field1 LIKE '%way%' OR field2 LIKE '%way%' OR field3 LIKE '%way%'))
     *
     * @since 1.0.0
     * 
     * @param  array $fields_to_search  The fields to search in the database
     * @param  string $terms            The search terms to look for in the database
     * @param  boolean $case_sensitive  Whether or not the like clause should be case_sensitive, defaults to false.
     * @return string  The like clause
     */
    protected function createLikeClause($fields_to_search, $terms, $case_sensitive=FALSE)
    {
		// Set case sensitivity variables
		$lower_start = ' lower(';
		$lower_end   = ')';
		if ($case_sensitive) {
			$lower_start = '';
			$lower_end   = '';
	    }	
	
	    // Break up the search terms by spaces
	    $terms_array = explode(' ', addslashes($terms));
		    
		if ($this->Database->getDatabaseType() == 'mysql' || $this->Database->getDatabaseType() == 'mssql') {
		    $like = "LIKE";
		} elseif ($this->Database->getDatabaseType() == 'pgsql') {
		    $like = "ILIKE";
	    }
			
	    $sql = '';
	    foreach ($terms_array as $term) {
		    $sql .= "AND (";
		    // Make a potentially disgusting number of like statements
		    foreach ($fields_to_search as $field_to_search) {
			    $sql .= $lower_start . $field_to_search . $lower_end . " " . $like . $lower_start . " '%" . $term . "%'" . $lower_end . " OR \n";
		    }
		    // Remove the trailing OR off the end and add the )
		    $sql = substr($sql, 0, strlen($sql)-5) . ') '; 
	    } 
	    
	    // Remove the first AND from the sql
	    return substr($sql, 4);   
	    
    }
    
    
    
    /**
     * Takes an SQL statement and returns an array of the values from it
     * 
     * @since  1.0.0
     * 
     * @param  string $sql         The sql to execute
     * @param  string $class_name  The name of the class to use when creating objects, by default it looks for a table with the primary key being the first field from the select statement
     * @return mixed  An array of ids or FALSE if error
     */
    protected function performSql($sql, $class_name=NULL)
    {   
        // Get the ids
        $output = array();
        $key = '';
        $result = $this->Database->query($sql);

        $this->throwIfError($this->Database, 'FatalException');
        
        while ($row = $this->Database->getRow($result)) {
            if (empty($key)) { $keys = array_keys($row); $key = $keys[0]; }
            $output[] = $row[$key];   
        }   
        
	    if (empty($output)) {
            if ($class_name === NULL) {
	            preg_match('#^\s*SELECT\s+(?:\w+\.)?(\w+),?\s+#i', $sql, $matches);
	            $id = $matches[1];
	            $keys = $this->Database->getKeys();
	            foreach ($keys as $table => $key_type_array) {
	            	if ($id == $key_type_array['primary_key_field']) {
	            		$object_name = $table;	
	            		break;	
					}
				}
	            $class_name = $this->tableToClass($object_name);
			}
            $object = new $class_name();
            throw new NoResultsException('No ' . $this->pluralize($object->retrieveRecordName()) . ' could be found');   
        }
       	return $output;   
    }
    
    
    
    /* ------------------------------------------------- */
    /* DYNAMIC METHOD METHODS
    /* ------------------------------------------------- */
    
    
    
    /**
     * Handles undefined methods and routes them to appropriate helpers
     * 
     * @since  1.0.0
     * 
     * @param  string $method_name  The method called
     * @param  array $arguments     The arguments passed to the method
     * @return mixed  The return value of the helper method called
     */
    public function __call($method_name, $arguments)
    {
        $underscore_method_name = $this->underscoreNotation($method_name);   
        list($method, $type) = explode('_', $underscore_method_name, 2); 
        
        $argument_list = '';
        $total_arguments = sizeof($arguments);
        for ($i = 0; $i < $total_arguments; $i++) {
            $argument_list .= ($i) ? ', ' : '';
            $argument_list .= '$arguments[' . $i . ']';    
        }
        
        switch ($method) {     
            case "create":
                $internal_method = 'createObjects';
                break;
            case "list":
                $internal_method = 'listObjects';
                break;
            default:
                throw new FatalException('Unknown method, ' . $method_name . ', called');
                break;
        }
        
        $code  = '$return = $this->';
        $code .= $internal_method;
        $code .= '($type';
        if (!empty($argument_list)) {
            $code .= ', ' . $argument_list . ');';    
        } else {
            $code .= ');';   
        }
        eval($code);

        /** @var $return eval() function result */
        return $return;
    }
    
    
    /**
     * Creates other objects
     * 
     * @since  1.0.0
     * 
     * @param  string $field   The type of object to create
     * @param  array $ids      The items to create
     * @param  integer $limit  The maximum number of objects to create
     * @param  integer $page   The page of objects to create: if limit=5 and page=1 the first five would be shown, limit=5 and page=2 the next five would be shown
     * @return mixed  An associative array of id => object
     */
    protected function createObjects($type, $ids, $limit=0, $page=1)
    {
        $plural_type = $this->camelCase($type, TRUE);
        $type = $this->camelCase($this->singularize($type), TRUE);
        
        // Limit the ids to the range specified
        if ($limit && $page) {
            $total_ids = sizeof($ids);
            if ($limit * ($page-1) > $total_ids) {
                $page = 1;    
            }     
            $ids = array_slice($ids, $limit * ($page-1), $limit);
        }
        
        // Create the objects
        if (!class_exists($type)) {
            throw new FatalException('Unknown class, ' . $type . ', specified');	
		}
        $output = array();
        $this->Database->startTransaction();
        foreach ($ids as $id) {
            $output[$id] = new $type($id);
        }  
        $this->Database->commitTransaction();
       return $output;     
    }   
    
    
    /**
     * Slims findObjects() and createObjects() into a single call
     * 
     * @since  1.0.0
     * 
     * @param  string $type  The type of object to find/create
     * @return mixed  An associative array of id => object
     */
    protected function listObjects($type)
    {
        $plural_type = $this->camelCase($type, TRUE);
        
        if (method_exists($this, 'find' . $plural_type)) {   
	        $arguments = func_get_args();
	        array_shift($arguments);
	        
	        $argument_list = '';
	        $total_arguments = sizeof($arguments);
	        for ($i = 0; $i < $total_arguments; $i++) {
	            $argument_list .= ($i) ? ', ' : '';
	            $argument_list .= '$arguments[' . $i . ']';    
	        }
	        
	        $code  = '$ids = $this->find' . $plural_type . '(' . $argument_list . ');';
	        eval($code);
	        
	        $code  = '$return = $this->createObjects(\'' . $type . '\', $ids);';
	        eval($code);

            /** @var $return - eval() function result */
	        return $return;     
		} else {
			throw new FatalException('list' . $plural_type . '() needs a method find' . $plural_type . '() to be defined to work properly');	
		}
    }
    
    
    /* ------------------------------------------------- */
    /* STRING METHODS
    /* ------------------------------------------------- */
    
    
    /**
     * Takes a value and cleans it up based on the passed data type
     * 
     * @since  1.0.0
     * 
     * @param  string $value  The value to clean
     * @param  string $type   The type of the value ('string', 'boolean', 'array', 'integer', 'date', 'datetime', 'float')
     * @return void
     */
    protected function cleanValue($value, $type)
    {
        // Handle boolean values
        if ($type == 'boolean') {
			$value = strtolower($value);
			if ($value == 'false' || $value == 'f' || !$value) {
				return FALSE;
			} else {
				return TRUE;
			}
	    
        // Handle arrays
        } elseif ($type == 'array') {
            if (is_string($value) && strpos($value, ',') !== FALSE) {
                $value = explode(',', $value);
                $value = array_merge(array_filter($value));    
            }
            settype($value, 'array');
			return $value;
        
        // Handle dates
        } elseif ($type == 'date') {
            if ($value) {
                return convert_date(trim($value), 'mysql_date');
            } else {
                return NULL;
            }    
            
        // Handles datetimes
        } elseif ($type == 'datetime') {
            if ($value) {
                return convert_date(trim($value), 'mysql_datetime');
            } else {
                return NULL;
            }
            
        // Handle other values    
        } else {
			return trim($value);
        }
	    	
    }
    
}

?>
