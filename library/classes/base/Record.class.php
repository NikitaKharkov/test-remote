<?php
/**
 * Record - Automatically handles database tables, see wiki for details about features and limitations
 *        
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @version  3.2.3
 *
 * @author   William Bond    [wb] <will@imarc.net>
 * @author   Fred LeBlanc    [fl] <fred@imarc.net>
 * @author   Bill Bushee     [bb] <bill@imarc.net>
 * @author   Jeff Turcotte   [jt] <jeff@imarc.net>
 * @author   Patrick McPhail [pm] <patrick@imarc.net>
 *
 * @requires Foundation 2.0.0b3+, Validator 2.7.0+, ImageMagick 2.2.0+, FileUpload 5.3.0+
 *
 * @changes  3.2.3     Fixed another bug in printOrderingSelectBox() and an issue with the ordering field option [wb, 2007-11-19]
 * @changes  3.2.2     Fixed a bug in printOrderingSelectBox() [wb, 2007-11-19]
 * @changes  3.2.1     Fixed an issues where previously uploaded files would be moved to the temp dir if another validation issue happened [wb, 2007-11-07]
 * @changes  3.2.0     fixed a bug and added features to findIds(). Will now correctly handle linked children. [jt, 2007-11-6]
 * @changes  3.1.1     fixed a bug where requiring child_ids in parseRequest was throwing a depreciated warning [wb + pm, 2007-10-12]
 * @changes  3.1.0     Ported a feature addition by Jeff over to the framework, added two printDebug calls in uploadFile [wb + pm, 2007-09-11]
 * @changes  3.0.7     Fixed bugs with uploading multiple files named the same, where cascading delete children would fail for ordered children and where calling load() would not reset related data [wb, 2007-09-14]
 * @changes  3.0.6     Fixed a bug with cascading deletes [wb, 2007-09-06]
 * @changes  3.0.5     Fixed a bug in checkFileUploadFieldOption that was pointing to a bad file name [pm, 2007-08-29]
 * @changes  3.0.4     Fixed a bug with temporary file values for non-temporary files [wb, 2007-08-22]
 * @changes  3.0.3     Fixed a bug with child and conditional validation [wb, 2007-08-22]
 * @changes  3.0.2     Fixed a bug where load would not reload child ids through a link table [wb + dc, 2007-08-15]
 * @changes  3.0.1     parseRequest can now accept an array in parameter 1 for $required_fields [pm, 2007-08-15]
 * @changes  3.0.0     Fixed a bug with temporary files for file upload fields [wb, 2007-08-14]
 *                  
 * See http://wiki.imarc.net/wikka/RecordClassChangeLog for the complete change log
 */
abstract class Record extends Foundation
{

	/**
	 * If the information should already be in the database
	 * 
	 * @var boolean
	 */
	protected $existing;
	
	/**
	 * The name the database table
	 * 
	 * @var string
	 */
	protected $database_table;
    
    /**
     * The name of a record
     * 
     * @var string
     */
    protected $record_name;
    
    /**
	 * The primary key field for the database table
	 * 
	 * @var string
	 */
	protected $primary_key_field;
    
    /**
	 * The primary key value for the record
	 * 
	 * @var mixed
	 */
	protected $primary_key_value;
    
    /**
	 * The structure of the database table
	 * 
	 * @var array
	 */
	protected $field_info;
    
    /**
	 * The values of the current record, this will be auto populated by the getValues() method
	 * 
	 * @var array
	 */
	protected $values = array();
    
    /**
	 * If the values have been loaded from the database
	 * 
	 * @var boolean
	 */
	protected $values_loaded;
    
    /**
	 * The foreign keys in this table
	 * 
	 * @var array
	 */
	protected $foreign_keys = array();
    
    /**
	 * The child key (foreign keys that point to this table) info: array of 'child_table' => table that holds the child key, 'child_field' => field in the child table, 'field' => field pointed to in this table
	 * 
	 * @var array
	 */
	protected $child_keys = array();
    
    /**
	 * The unique keys for the table, used for handling 'ordering' fields
	 * 
	 * @var array
	 */
	protected $unique_keys = array();
    
    /**
	 * Special options for fields
	 * 
	 * @var array
	 */
	protected $field_options = array();
    
    /**
	 * Validatation rules that takes into account more than one field
	 * 
	 * @var array
	 */
	protected $validation_rules = array();
    
    /**
	 * Holds old file name for file upload field, these are used to delete the files once a successful store() is performed
	 * 
	 * @var array
	 */
	protected $old_file_name = array();
	
	/**
	 * Holds flags if the user selected the delete checkbox for a field
	 * 
	 * @var array
	 */
	protected $delete_flagged = array();
	
	/**
	 * Indicates if files from be moved from the temp dir to the normal dir on save
	 * 
	 * @var array
	 */
	protected $move_back_from_temp_dir = array();
    
    /**
	 * Holds the field name used for ordering
	 * 
	 * @var string
	 */
	protected $ordering_field;
    
    /**
	 * Other ordering fields (used to tell what other keys we need to use when selecting other items)
	 * 
	 * @var array
	 */
	protected $other_ordering_fields = array();
    
    /**
	 * Holds the old ordering value
	 * 
	 * @var mixed
	 */
	protected $old_ordering_value;
    
    /**
	 * Holds the old other ordering values
	 * 
	 * @var array
	 */
	protected $old_other_ordering_values = array();
    
    /**
	 * Holds the max ordering value
	 * 
	 * @var mixed
	 */
	protected $max_ordering_value;
    
    /**
	 * Holds the where field for ordering
	 * 
	 * @var mixed
	 */
	protected $where_field;
    
    /**
	 * Holds the where value for ordering
	 * 
	 * @var mixed
	 */
	protected $where_value;
    
    /**
	 * Flag to indicate if a method call is coming from inside the class
	 *
	 * @var boolean
	 */
	protected $self_call = FALSE;

    /**
	 * An array of child tables and any intialized child objects for that table
	 *
	 * @var array
	 */
	protected $child_objects = array();
    
    /**
	 * A backup copy of the $_REQUEST array
	 *
	 * @var array
	 */
	protected $backup_request;
    
    /**
	 * A backup copy of the $_FILES array
	 *
	 * @var array
	 */
	protected $backup_files;
	
	/**
	 * Allow execution of cascadeDeleteAllFiles()
	 *
	 * @var boolean
	 */
	protected $allow_cascade_delete = FALSE;
    
    /**
     * The name of the temp dir for holding temporary file uploads    
     */
    const TEMP_FILE_DIR = '_record_class_temp_dir';
	
	/**
	 * Constructor;
	 * 
	 * @since  1.0.0
	 * 
	 * @param  boolean $existing  If the record should be treated as new, or should be loaded from the database
	 * @param  mixed $id          ID of the record
	 * @return void
	 */
	public function __construct($id=NULL)
	{        
		// Add local references to some objects
		parent::__construct();        
		
		// Check supporting file versions
		$this->checkVersion('Foundation',     '2.0.0');
		$this->checkVersion($this->Validator, '3.0.0');
        
        $this->existing = ($id !== NULL) ? TRUE : FALSE;
        
        $this->error = '';
        
        $this->configure();
        $this->assignDatabaseTable();
        $this->assignRecordName();
        $this->assignKeys();
        $this->assignFieldInfo();
        
		// If we are looking for an existing item, set the id
		($this->existing) ? $this->initializeExisting($id) : $this->initializeNew($id);   
	}	
    
    
    /**
     * Returns version number of the Record class
     * 
     * @since  2.0.0
     * 
     * @param  void
     * @return string  version 
     */
    public static function getRecordVersion() 
	{
		return '3.2.3';
    }
    
    
    
    /* ------------------------------------------------- */
    /* INITIALIZATION METHODS
    /* ------------------------------------------------- */
    
    
    /**
     * Placeholder method that allows setting of field options and validation rules
     * 
     * @since  3.0.0
     * 
     * @param  void
     * @return void
     */
    protected function configure()
    { 
    }
    
    
    /**
     * Sets the database table to a modified version of the class name. Assumes the class name is the form ClassName of the database table class_name.
     * 
     * @since  3.0.0
     * 
     * @param  void
     * @return void
     */
    protected function assignDatabaseTable()
    {
	    if (!$this->loadFromCache('database_table')) {
            $this->database_table = $this->classToTable(get_class($this)); 
            $this->saveToCache('database_table');
        }   
    }
    
    
    /**
     * Retrieve's the database table used by this record
     * 
     * @since  3.0.0
     * 
     * @param  void
     * @return void
     */
    public function retrieveDatabaseTable()
    { 
        return $this->database_table;
    }
    
    
    /**
     * Sets the object name to use when referring to a record
     * 
     * @since  3.0.0
     * 
     * @param  void
     * @return void
     */
    protected function assignRecordName()
    {
        $this->record_name = $this->wordify($this->underscoreNotation(get_class($this)));   
    }
    
    
    /**
     * Retrieve's the name of the record
     * 
     * @since  3.0.0
     * 
     * @param  void
     * @return void
     */
    public function retrieveRecordName()
    { 
        return $this->record_name;
    }
    
    
    /**
     * Sets the database feild info
     * 
     * @since  3.0.0
     * 
     * @param  void
     * @return void
     */
    protected function assignFieldInfo()
    {
        if (!$this->loadFromCache('field_info')) {
            $this->cacheDatabaseFieldInfo();
            $this->loadFromCache('field_info');
            if (empty($this->field_info)) {
                throw new FatalException("There was an error determining the database structure for the table: '" . $this->database_table . "'");    
            }
        }
        if (isset($this->field_info[$this->primary_key_field]['auto_increment'])) {
            unset($this->field_info[$this->primary_key_field]);
        }
    }
    
    
    /**
	 * Determines what fields in the current table are the primary keys
     * 
     * @since  3.0.0
     * 
     * @param  void
     * @return void
     */
    protected function assignKeys()
    {       
        // Try to get the data from the cache
        if (!$this->loadFromCache(array('primary_key_field', 'foreign_keys', 'child_keys', 'unique_keys'))) {
            $this->cacheDatabaseKeys();
            $this->loadFromCache(array('primary_key_field', 'foreign_keys', 'child_keys', 'unique_keys'));
            if (empty($this->primary_key_field)) {
                throw new FatalException("There was an error determining the database primary key for the table: '" . $this->database_table . "'");    
            }
        }
    }
    
    
    /**
     * Performs actions for a record that already exists
     * 
     * @since  3.0.0
	 * 
     * @param  mixed $id  The primary key value
     * @return void
     */
    protected function initializeExisting($primary_key_value)
    {
        $this->primary_key_value = $primary_key_value;

        $this->printDebug("The " . $this->record_name . " '" . $primary_key_value . "' is being loaded", TRUE);
        $this->load();
    }
    
    
    /**
     * Performs actions for a new record
     * 
     * @since  3.0.0
     * 
     * @param  mixed $id  The id of the record being created
     * @return void
     */
    protected function initializeNew()
    {
        $date_formats = array('date'     => 'Y-m-d',
                              'datetime' => 'Y-m-d H:i:s',
                              'time'     => 'H:i:s');
        
        // Handle field options
        foreach ($this->field_options as $field => $options) {
            foreach ($options as $option => $value) {
                $type = (isset($this->field_info[$field]['type'])) ? $this->field_info[$field]['type'] : NULL;    
                
                if (($option == 'date_created' || $option == 'date_updated') && isset($date_formats[$type])) {
                    $this->values[$field] = date($date_formats[$type]);
                     
                } elseif (($option == 'random_alphanumeric' || $option == 'random_numeric') && ($type == 'varchar' || $type == 'text')) {
                    $method = 'generate' . $this->camelCase($field, TRUE);
                    $this->$method();        
                }
            }   
        }
        
        // Handle many-to-many child keys
        foreach ($this->child_keys as $child_key) {
            if (isset($child_key['link_table'])) {
                $field = $this->pluralize($child_key['child_primary_key']);
                $this->values[$field] = array();       
            }
        }
    }

    
    
    /* ------------------------------------------------- */
    /* DATA ACCESS/MANIPULATION METHODS
    /* ------------------------------------------------- */
    
    
    /**
     * Gets the primary key value
     * 
     * @since  3.0.0
     * 
     * @param  boolean $formatted  If the primary key is a string, run it through html entities
     * @return mixed  The primary key value
     */
    public function getPrimaryKey($formatted=FALSE)
    {
        if ($formatted && isset($this->field_info[$this->primary_key_field])) {
            return htmlentities($this->primary_key_value);    
        }
        return $this->primary_key_value;    
    }
    
    
    /**
     * Pulls the information for the object from the $_REQUEST array
     * 
     * @since  1.0.0
     * 
     * @param  mixed $required_field  Pass any number of arguments consisting of field name to force them to be checked even if there is no entry in the $_REQUEST superglobal (useful for checkboxes), can also pass fields as an array.
     * @return void
     */
    public function parseRequest()
    {
        $required_fields = func_get_args();

		if ((sizeof($required_fields) === 1) && (is_array($required_fields[0]))) {
			$required_fields = array_shift($required_fields);		
		}

        $this->fixRequest();
        
        $this->printDebug("The filtered and fixed \$_REQUEST superglobal:\n" . print_r($_REQUEST, TRUE), TRUE);
        
		$this->determineOrderingFields(FALSE);
        
        // Handle regular fields
        foreach ($this->field_info as $field => $info) {
            if (isset($this->field_options[$field]['file_upload'])) {
                $this->uploadFile($field); 
			} elseif (isset($_REQUEST[$field])) {
                $method = 'set' . $this->camelCase($field, TRUE);
                $this->$method($this->requestValue($field));
            }
        }
        
        // Handle link tables for child keys
        foreach ($this->child_keys as $child_key) {
            // Only handle link tables
            if (isset($child_key['link_table'])) {
                $field = $this->pluralize($child_key['child_primary_key']);
                if (isset($_REQUEST[$field])) {
                    $method = 'link' . $this->camelCase($field, TRUE);
                    $this->$method($this->requestValue($field, TRUE));
                }
            }
        }  
        
        // Populate required fields that were not found with default or NULL values
        foreach ($required_fields as $required_field) {
            if (!isset($_REQUEST[$required_field])) {
                $method = 'set' . $this->camelCase($required_field, TRUE);
                $value = NULL;
                if (isset($this->field_info[$required_field]['default'])) {
                	$value = $this->field_info[$required_field]['default'];	
				}
                $old_self_call = $this->self_call;
				$this->self_call = TRUE;
                $this->$method($value);
				$this->self_call = $old_self_call;
            }    
        }
        
        $this->printDebug("The contents of \$this->values:\n" . print_r($this->values, TRUE), FALSE);
        
    }
    
    
    /**
     * Pulls the information for the object from the $_REQUEST array, presumming information is formatted in child table field names (database_table_field_name[])
     * 
     * @since  3.0.0
     * 
     * @param  integer $child_number  What child number this is (zero based)
     * @param  string $required_field  Pass any number of arguments consisting of field name to force them to be checked even if there is no entry in the $_REQUEST superglobal (useful for checkboxes)
     * @return void
     */
    public function parseRequestAsChild($child_number)
    {
        $required_fields = array_slice(func_get_args(), 1);
        
        $this->filterRequestFiles($child_number, $required_fields);
        $args = '';
        for ($i=0; $i < sizeof($required_fields); $i++) {
            if (!empty($args)) { $args .= ','; }
            $args .= '$required_fields[' . $i . ']';    
        }
        eval('$this->parseRequest(' . $args . ');');
        $this->restoreRequestFiles($child_number);
    }
    

    
    /**
     * Pulls the information for child objects from the $_REQUEST array
     * 
     * @since  1.7.0
     * 
     * @param  string $child_table  The child table to create the objects and parse the request for
     * @param  string $field        Pass any number of arguments consisting of field name to force them to be checked even if there is no entry in the $_REQUEST superglobal (useful for checkboxes)
     * @return void
     */
    public function parseRequestChildren($child_table)
    {
        $required_fields = array_slice(func_get_args(), 1);
        
        // Find info about the child table we are parsing for
        $child_key_info = NULL;
        foreach ($this->child_keys as $child_key) {
            if ($child_key['child_table'] == $child_table && !isset($child_key['link_table'])) {
                $child_key_info = $child_key;
                break;
            }
        }
        if ($child_key_info === NULL) {
            throw new FatalException("Could not find the table, '" . $child_table . "' in the child table list");
        }

        $this->child_objects[$child_table] = array();
        
        $child_primary_key_field = $child_table . '_' . $child_key_info['child_primary_key'];
        if (isset($_REQUEST[$child_primary_key_field]) && !is_array($_REQUEST[$child_primary_key_field])) {
            throw new FatalException("The field, '" . $child_primary_key_field . "', is not set or is not an array");
        } elseif (!isset($_REQUEST[$child_primary_key_field])) {
            return TRUE;    
        }
        
        $child_class_name = $this->tableToClass($child_table);
        
        $child_primary_keys = $_REQUEST[$child_primary_key_field];
        $total_keys = sizeof($child_primary_keys);
        
        // Set up the command to call parseRequest on the child
        $command = '$this->child_objects[$child_table][$i]->parseRequestAsChild($i';
        $total_required_fields = sizeof($required_fields);
        for ($j=0; $j < $total_required_fields; $j++) {
            $command .= ', $required_fields[' . $j . ']';   
        }
        $command .= ');';
		
        for ($i=0; $i < $total_keys; $i++) {
            // See if the object exists
            try {
                if (empty($child_primary_keys[$i])) {
                    $child_primary_keys[$i] = NULL;
                    throw new Exception();   
                }
				$this->child_objects[$child_table][$i] = new $child_class_name($child_primary_keys[$i]);

            // Try to create the object from scratch
            } catch (Exception $e) {
                try {
					$this->child_objects[$child_table][$i] = new $child_class_name($child_primary_keys[$i]);

                // If we can't even create a new instance, something is wrong
                } catch (Exception $f) {
                    $object = new $child_class_name();
                    $this->error .= "There was an error creating " . $object->retrieveRecordName() . " #" . $i . "\n";
                    return FALSE;
                }    
            }
			
			if ($this->debug) {
				$this->child_objects[$child_table][$i]->setDebug(TRUE);	
			}
			
            // Call parse request for the child object
            eval($command);
        }
        
        $this->printDebug(sizeof($this->child_objects[$child_table]) . " child objects created for the table '" . $child_table . "'", TRUE);
    }
    
    
    /**
     * Parses through $_REQUEST and $_FILES and splits out the values for the child number specified
     * 
     * @since  1.9.0
     * 
     * @param  integer $child_number         The child number to parse out
     * @param  array $other_fields_to_parse  Fields (beyond the fields in the database) to parse out for this child
     * @return void
     */
    protected function filterRequestFiles($child_number, $other_fields_to_parse=array())
    {
        // Handle parsing the request as a child
        if ($child_number !== NULL && is_int($child_number) && $child_number > -1) {
            $this->backup_request = $_REQUEST;
            $this->backup_files   = $_FILES;
            
            $_REQUEST = array();
            foreach ($this->backup_request as $field => $value) {
                if (strpos($field, $this->database_table) === 0 && is_array($value)) {
                    $field_name = substr($field, strlen($this->database_table)+1, strlen($field)-strlen($this->database_table)-1);
                    if (isset($this->field_info[$field_name]) || in_array($field_name, $other_fields_to_parse) || $this->primary_key_field == $field_name) {
                        // Handle sparse checkbox arrays here by requiring that the value of the checkbox be the item id
                        $temp_child_number = $child_number;
                        if (sizeof($value) != sizeof($this->backup_request[$this->database_table . '_' . $this->primary_key_field])) {
                            $found = FALSE;
                            for ($k=0; $k < sizeof($value); $k++) {
                                if ($value[$k] == $this->backup_request[$this->database_table . '_' . $this->primary_key_field][$child_number]) {
                                    $temp_child_number = $k;
                                    $found = TRUE;    
                                }
                            }
                            if (!$found) {
                                $temp_child_number = -1;
                                $value[-1] = NULL;
                            }    
                        }
                        $_REQUEST[$field_name] = $value[$temp_child_number];    
                    } 
                    // Handle delete_upload_field flags for arrays of file uploads, there must be a better way to do this
                    if (substr($field_name, 0, 7) == 'delete_') {
                        $field_to_delete = substr($field_name, 7);
                        foreach ($this->field_options as $_field => $options) {
                            if ($_field == $field_to_delete && isset($options['file_upload'])) {
                                foreach ($value as $file) {
                                    if (isset($this->values[$field_to_delete]) && $file == $this->values[$field_to_delete]) {
                                        $_REQUEST[$field_name] = TRUE;
                                    }
                                }
                            }    
                        }
                    }
                    // Handle temporary_upload_field flags for arrays of file uploads
                    if (substr($field_name, 0, 10) == 'temporary_') {
                        $field_with_temp = substr($field_name, 10);
                        foreach ($this->field_options as $_field => $options) {
                            if ($_field == $field_with_temp && isset($options['file_upload'])) {
								$_REQUEST[$field_name] = $this->backup_request[$field][$child_number];
							}    
                        }
                    }             
                } 
            }
            
            $_FILES = array();
            foreach ($this->backup_files as $field => $value) {
                if (strpos($field, $this->database_table) === 0 && is_array($value['name'])) {
                    $field_name = substr($field, strlen($this->database_table)+1);
                    if ((isset($this->field_info[$field_name]) || in_array($field_name, $other_fields_to_parse)) && isset($this->field_options[$field_name]['file_upload'])) {
                        $_FILES[$field_name]['name']     = $value['name'][$child_number];
                        $_FILES[$field_name]['type']     = $value['type'][$child_number];
                        $_FILES[$field_name]['tmp_name'] = $value['tmp_name'][$child_number];
                        $_FILES[$field_name]['error']    = $value['error'][$child_number];
                        $_FILES[$field_name]['size']     = $value['size'][$child_number];    
                    }              
                } 
            }    
        }    
    }
    
    
    /**
     * Restores the $_REQUEST and $_FILES array
     * 
     * @since  1.9.0
     * 
     * @param  integer $child_number  The child number to parse out
     * @return void
     */
    protected function restoreRequestFiles($child_number)
    {
        // Reset the $_REQUEST and $_FILES arrays
        if ($child_number !== NULL && is_int($child_number) && $child_number > -1) {
            $_REQUEST = $this->backup_request;
            $_FILES   = $this->backup_files;   
        }      
    }
    
    
    /**
     * Gets called right before ->setFieldName() methods are called in ->parseRequest()
     * 
     * @since  2.0.0
     * 
     * @param  void
     * @return void
     */
    protected function fixRequest()
    {   
    }
    
    
    /**
     * Returns an array of all fields in the form field_name => value. You probably want to use this with extract()
     * 
     * @since  1.1.0
     * 
     * @param  void
     * @return array  An array of field_name => value for all values in the record
     */
    public function getAllValues()
    {
        $output = array();
        
        // Grab all of the regular fields
		$this->self_call = TRUE;
		foreach ($this->field_info as $field => $info) {
			$method = 'get' . $this->camelCase($field, TRUE);
			$output[$field] = $this->$method();
		}  
		$this->self_call = FALSE;
        
        // Handle all child keys
        $other_fields = array();
        foreach ($this->child_keys as $child_key) {
            $field = $this->pluralize($child_key['child_primary_key']);
            $method = 'find' . $this->camelCase($field, TRUE);
            $output[$field] = $this->$method(FALSE);
            $other_fields[] = $field;
        }
        
        // Handle other values (defined by the extending class)
        $custom_fields = array_diff(array_keys($this->values), array_keys($this->field_info), $other_fields);
        foreach ($custom_fields as $field) {
			$method = 'get' . $this->camelCase($field, TRUE);
			if (method_exists($this, $method)) {
				$output[$field] = $this->$method();        
			} else {
				$output[$field] = $this->values[$field];
			}   
        }
        
        return $output;  
    }
    
    
    /**
     * Returns an array of all fields for the children of child_table in the form child_table_field_name[] => value. You probably want to use this with extract()
     * 
     * @since  1.7.0
     * 
     * @param  string $child_table  The child table to extract all of the values for
     * @return array  An array of field_name => value for all values in the record
     */
    public function getAllValuesChildren($child_table)
    {
        // Find info about the child table we are getting
        $child_key_info = NULL;
        foreach ($this->child_keys as $child_key) {
            if ($child_key['child_table'] == $child_table && !isset($child_key['link_table'])) {
                $child_key_info = $child_key;
                break;
            }
        }
        if ($child_key_info === NULL) {
            throw new FatalException("Could not find the table, '" . $child_table . "' in the child table list");
        }
        
        $output = array();
        
        if (isset($this->child_objects[$child_table])) {
            $children = $this->child_objects[$child_table];    
        } else {
            $create_method = 'create' . $this->camelCase($child_table, TRUE);
            $children = $this->$create_method(0, 1, FALSE);
        }
        
        $i = 0;
        foreach ($children as $child) {
            $values = $child->getAllValues();
            foreach ($values as $field => $value) {
                if (!isset($output[$child_table . '_' . $field])) {
                    $output[$child_table . '_' . $field] = array();
                }    
                $output[$child_table . '_' . $field][$i] = $value;
            }
            if (!isset($output[$child_table . '_' . $child_key_info['child_primary_key']])) {
                $output[$child_table . '_' . $child_key_info['child_primary_key']] = array(); 
            }
            $output[$child_table . '_' . $child_key_info['child_primary_key']][$i] = $child->getPrimaryKey();
            $i++;
        }  
        
        return $output;  
    }
    
    
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
        list($method, $field) = explode('_', $underscore_method_name, 2); 
        
        switch ($method) {
            case "set":
                $internal_method = 'assignValue';
                break;
            case "link":
                $internal_method = 'linkIds';
                break;
            case "get":
                $internal_method = 'retrieveValue';
                break;
            case "find":
                $internal_method = 'findIds';
                break;        
            case "create":
                $internal_method = 'createObjects';
                break;
            case "upload":
                $internal_method = 'uploadFile';
                break;
            case "generate":
                $internal_method = 'generateValue';
                break;
            default:
                throw new FatalException("Unknown method, '" . $method_name . "', called");
                break;
        }
        
        $code = '$return = $this->' . $internal_method . '($field';
        $total_arguments = sizeof($arguments);
        for ($i = 0; $i < $total_arguments; $i++) {
            $code .= ', $arguments[' . $i . ']';    
        }
        $code .= ');';
        eval($code);
        
        return $return;
    }
    
    
    /**
     * Sets a value
     * 
     * @since  3.0.0
     * 
     * @param  string $field  The field to set
     * @param  mixed $value   The value to set
     * @return boolean  If the value was successfully set
     */
    protected function assignValue($field, $value)
    {		
		// Handle known fields
        if (isset($this->field_info[$field])) {
			
			if (isset($this->field_options[$field]['random_alphanumeric']) || isset($this->field_options[$field]['random_numeric'])) {
				throw new FatalException("The field, '" . $field . "', can not be manually set because it has either the random_alphanumeric or random_numeric field option");	
			}
			
            // If it is read only, flag an error
            if (isset($this->field_options[$field]['read_only'])) {
                throw new FatalException("The field '" . $field . "' is read only");
            
            // If the file is a file upload field, let the user know
            } elseif (isset($this->field_options[$field]['file_upload'])) {
                throw new FatalException("The field '" . $field . "' is a file upload field, please use uploadFieldName()");
                
            // As long as it is not read only, set the value
            } else {
				$this->determineOrderingFields(FALSE);
                if ($field == $this->ordering_field) {
                    $this->old_ordering_value = (isset($this->values[$field])) ? $this->values[$field] : NULL;   
                } elseif (in_array($field, $this->other_ordering_fields) && !empty($this->values[$field]) && $this->values[$field] != $value) {
                    $this->old_other_ordering_values[$field] = $this->values[$field];   
                }
                
                // Handle the link field option
                if (isset($this->field_options[$field]['link']) && !empty($value)) {
                	$value = trim($value);
                	if ($value[0] == '/') {
                		$value = server_address() . $value;
					} elseif (!preg_match('#^((http|https|ftp)://)#i', $value)) {
						$value = 'http://' . $value;
					}	
				}
							
                if ($this->primary_key_field == $field) {
                    $this->primary_key_value = $this->standardizeValue($field, $value);
                    return TRUE;    
                }
                
                $this->values[$field] = $this->standardizeValue($field, $value);
                return TRUE;
            }           
            
        }
        
        // Handle child fields    
        try {
	        // Check to see if the field is an array of ids for a link table
            $singular_field_name = $this->singularize($field);
	        
	        foreach ($this->child_keys as $child_info) {
	            if (isset($child_info['link_table']) && $child_info['child_primary_key'] == $singular_field_name) {
	                if (!$this->self_call) {
						trigger_error("The method set" . $this->camelCase($field, TRUE) . "() has been DEPRECATED for setting related ids, please use link" . $this->camelCase($field, TRUE) . "() instead", E_USER_WARNING);
					} 
            		return $this->linkIds($field, $value);
	            }    
	        }
	    
		} catch (StandardException $e) {
            throw $e;
		}
        
        // Handle the primary key
        if ($this->primary_key_field == $field) {
            $this->primary_key_value = $value;   
        }
        
        throw new FatalException("The field '" . $field . "' does not appear to be a valid field");
    }
    
    
    /**
     * Sets ids via a linking table
     * 
     * @since  3.0.0
     * 
     * @param  string $field  The field to set
     * @param  mixed $value   The value to set
     * @return boolean  If the value was successfully set
     */
    protected function linkIds($field, $value)
    {		
		// Check to see if the field is an array of ids for a link table
        $singular_field_name = $this->singularize($field);
        
        foreach ($this->child_keys as $child_info) {
            if (isset($child_info['link_table']) && $child_info['child_primary_key'] == $singular_field_name) {
                settype($value, 'array');
                $this->values[$field] = array_merge(array_filter($value));
                return TRUE;
            }    
        }
        
        // Otherwise the programmer got something wrong
        throw new FatalException("The field '" . $field . "' does not appear to be a valid field");  
    }
    
    
    /**
     * Generates a value
     * 
     * @since  1.0.0
     * 
     * @param  string $field  The field to generate a value for
     * @return string  The generated value
     */
    protected function generateValue($field)
    {
        // Handle known fields
        if (isset($this->field_info[$field])) {
            
			foreach ($this->field_options[$field] as $option => $value) {
                if ($option == 'random_alphanumeric') {
					$this->values[$field] = random_string($value);
					return $this->values[$field];
                } elseif ($option == 'random_numeric') {
                    $this->values[$field] = random_string($value, 'numeric');
                    return $this->values[$field];
				}   
			}
			
            throw new FatalException("The field '" . $field . "' does not appear to have either random_alphanumeric or random_numeric field option set");
 
        } 
        
        throw new FatalException("The field '" . $field . "' does not appear to be a valid field");  
    }
    
    
    /**
     * Gets a value
     * 
     * @since  3.0.0
     * 
     * @param  string $field         The field to get
     * @param  mixed $formatted      If the field should be encoded/formated based on data type, non-datetime data types accept booleans, datetime data types accept a formatting string for convert_date()
     * @param  string $version_name  If the field is a file upload that resizes an image to multiple sizes, use this to get the different sizes
     * @return mixed  The value
     */
	protected function retrieveValue($field, $formatted=FALSE, $version_name=NULL)
	{			
        // Handle known fields
        if (isset($this->field_info[$field])) {
			
			if ((isset($this->field_options[$field]['random_alphanumeric']) || isset($this->field_options[$field]['random_numeric'])) && !$this->existing && isset($this->field_info[$field]['unique'])) {
				if ($this->self_call) {
					return NULL;	
				}
				throw new FatalException("The field '" . $field . "' has either the random_alphanumeric or random_numeric field option set, and is has a unique constraint in the database. Because of this, the value can only be accessed once the record is saved.");	
			}
			
			// If we have the value, return it
			if (isset($this->values[$field])) {
				$field_type = $this->field_info[$field]['type'];
				
                // Handle money formatting
                if ($field_type == 'float' && isset($this->field_options[$field]['money']) && $formatted) {
                    return '$' . number_format($this->values[$field], '2', '.', ',');   
                
                // If encoding is requested for file uploads, return the absolute web server path
                } elseif (isset($this->field_options[$field]['file_upload']) && $formatted) {
                    $option_array =& $this->field_options[$field]['file_upload'];
                    if ($version_name === NULL) {
                        $dir  = $option_array['directory'];
                        $file = $this->values[$field];
                    } else {
                        $dir = $option_array['versions'][$version_name]['directory'];
                        $file = $this->values[$field];
                        if ($option_array['versions'][$version_name]['output_type']) {
                            $file = substr($file, 0, strrpos($file, '.')) . '.' . $option_array['versions'][$version_name]['output_type'];
                        }
                    }
                    if (!file_exists($dir . $file)) {
                        if (file_exists($dir . self::TEMP_FILE_DIR . '/' . $file)) {
                            return str_replace($_SERVER['DOCUMENT_ROOT'] , '', $dir) . self::TEMP_FILE_DIR . '/' . $file;   
                        }
                        return NULL;
                    }
                    $output_dir  = str_replace($_SERVER['DOCUMENT_ROOT'] , '', $dir);
                    // If we are returning a temporary file, add the temp dir to the path
                    $output_dir .= (isset($this->old_file_name[$field])) ? self::TEMP_FILE_DIR . '/' : '';
                    return $output_dir . $file;   
                       
                // Encode strings with htmlentities if requested
                } elseif (($field_type == 'varchar' || $field_type == 'text' || $field_type == 'enum') && !isset($this->field_options[$field]['xhtml']) && $formatted) {
                    return xhtmlify($this->values[$field]);
                
                // If encoding is requested for booleans, show Yes/No
                } elseif ($field_type == 'boolean' && $formatted) {
                    return ($this->values[$field]) ? 'Yes' : 'No'; 
                
                // If encoding is requested for date, date_time or time pass it through convert date
				} elseif (($field_type == 'date' || $field_type == 'datetime' || $field_type == 'time') && $formatted) {
					if ($formatted === TRUE) {
						$time_value = strtotime($this->values[$field]);
                        if ($field_type == 'date') {
							return date('n/j/y', $time_value);
						} elseif ($field_type == 'datetime') {
							return date('n/j/y g:ia', $time_value);
						} elseif ($field_type == 'time') {
							return date('g:ia', $time_value);
						}
					} else {
						return date($formatted, strtotime($this->values[$field]));	
					}
                
                // Normal value return
                } else {
                    return $this->values[$field];    
                }
            
            // Otherwise return NULL
            } else {
                return NULL;
            }
            
        // Handle primary key    
        } elseif ($field == $this->primary_key_field) {
        	return $this->getPrimaryKey();	
		
        // Handle child fields
        } else {
            
            try {
            	$ids = $this->findIds($field);
            	trigger_error("The method get" . $this->camelCase($field, TRUE) . "() has been DEPRECATED for getting related ids, please use find" . $this->camelCase($field, TRUE) . "() instead", E_USER_WARNING); 
            	return $ids;	
            	
			} catch (StandardException $e) {
	            throw $e;
			}
        }   
        
        throw new FatalException("The field '" . $field . "' does not appear to be a valid field"); 
    }
    
    
    /**
     * Finds child ids from many-to-many relationships or one-to-many relationships
     * 
     * @since  3.0.0
     * 
     * @param  string $field              The field to get, should be the plural of the child table primary key
     * @param  boolean $throw_exception   If a NoResultsException should be thrown when no ids are found
	 * @param  string $linked_field_name  The field name of the linked table to use when looking for ids
     * @return array  The ids
     */
    protected function findIds($field, $throw_exception=TRUE, $linked_field_name=NULL)
	{	
        // Check to see if the field is an array of ids for a link table
        $singular_field_name = $this->singularize($field);
		
		
		// Check to see if there are any duplicates and order link tables first
		$child_table_ordered                = array();
		$child_info_with_linked_field_names = array();
		foreach($this->child_keys as $child_info) {
			if ($linked_field_name && isset($child_info['child_field']) && $child_info['child_field'] == $linked_field_name) {
				array_push($child_info_with_linked_field_names, $child_info);
			} else if (isset($child_info['link_table'])) {
				array_unshift($child_table_ordered, $child_info);
			} else {
				array_push($child_table_ordered, $child_info);
			}
		}
		$ordered_child_keys = array_merge($child_info_with_linked_field_names, $child_table_ordered);


		foreach ($ordered_child_keys as $child_info) {
            $process = FALSE;
            
            // If the table is a link table
            if (isset($child_info['link_table']) && $child_info['child_primary_key'] == $singular_field_name) {
                
                // The ids may already be loaded
                if (isset($this->values[$field])) {
                    return $this->values[$field];
                
                // Otherwise get the info from the database
                } else {
		            $sql  = "SELECT l." . $child_info['link_child_primary_key'] . " FROM " . $child_info['link_table'] . " AS l ";
                    $sql .= "INNER JOIN " . $child_info['child_table'] . " AS c ON c." . $child_info['child_primary_key'] . " = l." . $child_info['link_child_primary_key'] . " ";
		            $sql .= $this->linkTablesForSqlOrderBy($field, $child_info['child_table']);
		            $sql .= "WHERE l." . $child_info['link_field'] . " = '" . addslashes($this->primary_key_value) . "' ";
		            if (isset($this->field_options[$field]) && isset($this->field_options[$field]['sql_order_by'])) {
		                $sql .= "ORDER BY " . $this->field_options[$field]['sql_order_by'];
		            }
		            $process = TRUE;    
                }
                
            // Load non-link tables when requested    
            } elseif (!isset($child_info['link_table']) && $child_info['child_primary_key'] == $singular_field_name) {
				if (empty($this->primary_key_value)) {
					if (!$throw_exception) {
                		return array();
					} else {
                        $child_class = $this->tableToClass($child_info['child_table']);
                        $child = new $child_class();
						throw new NoResultsException('No ' . $this->pluralize($child->retrieveRecordName()) . ' could be found');	
					}
                		                                                          
				} elseif (!empty($this->primary_key_value) && !isset($this->values[$field])) {
					$sql  = "SELECT c." . $child_info['child_primary_key'] . " FROM " . $child_info['child_table'] . " AS c ";
                    $sql .= $this->linkTablesForSqlOrderBy($field, $child_info['child_table']);
                    $sql .= "WHERE c." . $child_info['child_field'] . " = '" . addslashes($this->primary_key_value) . "' ";
                    if (isset($this->field_options[$field]) && isset($this->field_options[$field]['sql_order_by'])) {
                        $sql .= "ORDER BY " . $this->field_options[$field]['sql_order_by'];    
					}
					$process = TRUE;
					
				} elseif (isset($this->values[$field])) {
					return $this->values[$field];	
				}
            }  
			
            if ($process) {
                $result = $this->Database->query($sql);
		        if ($this->Database->numRows($result)) {
		            $keys = NULL;
		            $this->values[$field] = array();
					while ($row = $this->Database->getRow($result)) {
		                if (empty($keys)) {
		                	$keys = array_keys($row);
		                	$key = $keys[0];	
						}
		                $this->values[$field][] = $row[$key];
		            }    
		        } else {
		            if (!$throw_exception) {
                		return array();
					} else {
                        $child_class = $this->tableToClass($child_info['child_table']);
                        $child = new $child_class();
						throw new NoResultsException('No ' . $this->pluralize($child->retrieveRecordName()) . ' could be found');	
					}	
				}
				return $this->values[$field];	
			}
        }    
        
        
        
        // Otherwise the programmer got something wrong
        throw new FatalException('Unknown field, ' . $field . ', specifed');
    }
    
    
    /**
     * Creates SQL to link tables together for an sql order by field option
     * 
     * @since  3.0.0
     * 
     * @param  string $field        The field to check an sql order by for
     * @param  string $child_table  The table that would be linked in the sql order by
     * @return string  One or more INNER JOIN statements to be added to the FROM clause of an SQL statement
     */
    protected function linkTablesForSqlOrderBy($field, $child_table)
    {
    	if (isset($this->field_options[$field]) && isset($this->field_options[$field]['sql_order_by'])) {
            // See if their are any foreign tables referenced in the sql_order_by
            $tables_found = preg_match_all('/\b([a-z0-9_]+)\.[a-z0-9_]+\b/i', $this->field_options[$field]['sql_order_by'], $foreign_tables);
            $foreign_tables = $foreign_tables[1];
			$foreign_tables = array_diff($foreign_tables, array($this->database_table, $child_table, 'c', 'l'));
            $foreign_tables = array_unique($foreign_tables);
            
            // Find the info about the foreign tables
            $sql = '';
            $foreign_keys = $this->getCache('foreign_keys', $this->tableToClass($child_table));
			foreach ($foreign_tables as $foreign_table) {
                $found = FALSE;
                foreach ($foreign_keys as $foreign_key) {
                    if ($foreign_key['foreign_table'] == $foreign_table) {
                        $found = TRUE;
                        $sql .= "INNER JOIN " . $foreign_key['foreign_table'] . " ON c." . $foreign_key['field'] . ' = ' . $foreign_key['foreign_table'] . "." . $foreign_key['foreign_field'] . " ";        
                    }
                }    
                if (!$found) {
                    throw new FatalException("The foreign table, '" . $foreign_table . "', specified in the sql_order_by field option for the field '" . $field . "' could not be linked properly");    
                }
            }  
            return $sql;   
        }
        return '';	    
    }
    
    
    /**
     * Creates other objects
     * 
     * @since  1.0.0
     * 
     * @param  string $table             The table to create objects from
     * @param  integer $limit            The maximum number of objects to create
     * @param  integer $page             The page of objects to create: if limit=5 and page=1 the first five would be shown, limit=5 and page=2 the next five would be shown
     * @param  boolean $throw_exception  If a NoResultsException should be thrown if no objects are found
     * @param  string  $linked_field_name The name of the field to look for in the child table
     * @return array  An associative array of object_ids => objects, negative descending integer keys are used for objects that don't have an id
     */
    protected function createObjects($table, $limit=0, $page=1, $throw_exception=TRUE, $linked_field_name=NULL)
    {
        // Check to see if the object is from a foreign key
        foreach ($this->foreign_keys as $foreign_key) {
            $singular_table = $this->singularize($foreign_key['foreign_table']);
            if ($table == $singular_table) {
                // Check to make sure there is a class for this
                $class_name = $this->camelCase($singular_table, TRUE);
                if (!class_exists($class_name)) {
                    throw new FatalException("The class '" . $class_name . "' has not been defined");    
                }
                
                if ($limit === FALSE && empty($this->values[$foreign_key['field']])) {
                	return NULL;	
				} else {
	                // Create the object
					return new $class_name($this->values[$foreign_key['field']]);
				}
			}    
        }
        
        // Check to see if the object is from a child key
        foreach ($this->child_keys as $child_key) {
            if ($table == $child_key['child_table']) {
                // Check to make sure there is a class for this
                $class_name = $this->tableToClass($child_key['child_table']);
                if (!class_exists($class_name)) {
                    throw new FatalException("The class '" . $class_name . "' has not been defined");    
                }
                
                $output = array();
                if (isset($this->child_objects[$child_key['child_table']])) {
                    $no_key = -1;
                    
                    $objects = $this->child_objects[$child_key['child_table']];
					// Limit the objects to the range specified
				    if ($limit && $page) {
				        $total_objects = sizeof($objects);
				        if ($limit * ($page-1) > $total_objects) {
				            $page = 1;    
				        }     
				        $objects = array_slice($objects, $limit * ($page-1), $limit);
				    }
                    
                    foreach ($objects as $child_object) {
                        $obj_key = ($child_object->getPrimaryKey()) ? $child_object->getPrimaryKey() : $no_key;
                        if ($obj_key == $no_key) {
                            --$no_key;   
                        }
                        $output[$obj_key] = $child_object;
                    }    
                } else {
                    // Get the ids
                    $method = 'find' . $this->camelCase($this->pluralize($child_key['child_primary_key']), TRUE, $linked_field_name);
					$child_key_values = $this->$method($throw_exception);

                    // Limit the ids to the range specified
			        if ($limit && $page) {
			            $total_ids = sizeof($child_key_values);
			            if ($limit * ($page-1) > $total_ids) {
			                $page = 1;    
			            }     
			            $child_key_values = array_slice($child_key_values, $limit * ($page-1), $limit);
			        }
                    
                    // Create the objects
                    foreach ($child_key_values as $child_key_value) {
						$object = new $class_name($child_key_value);
						$output[$object->getPrimaryKey()] = $object;
                    }
                }
                return $output;
            }    
        }
        
        // Otherwise the programmer got something wrong
        throw new FatalException('The database table, ' . $table . ', does not appear to be related to this object');
    }
    
    
    
    /* ------------------------------------------------- */
    /* FILE UPLOAD METHODS
    /* ------------------------------------------------- */
    
    
    /**
     * Uploads a file
     * 
     * @since  1.0.0
     * 
     * @param  string $field  The field to upload the file for
     * @return string  The current filename for the field or FALSE if error
     */
    protected function uploadFile($field)
    {       
        $this->checkVersion($this->FileUpload,  '5.3.0');
        
        // Error out if the field is not a file upload
        if (!isset($this->field_options[$field]['file_upload'])) {
            throw new FatalException("The field '" . $field . "' does not have the file_upload field option set");    
        }
        
        $this->checkFileUploadFieldOption($field);
		$this->cleanTempFileDirs($field);
		$directory = $this->field_options[$field]['file_upload']['directory'];    
        
        $debug_print = (isset($_FILES[$field])) ? $_FILES[$field] : array();
        $this->printDebug("The \$_FILES superglobal for the field '" . $field . "':\n" . print_r($debug_print, TRUE), TRUE);
        
        // Set the file upload options based on the field options
        $this->FileUpload->setOverwriteMode(2);
        if (isset($this->field_options[$field]['file_upload']['mimetype'])) {
            $this->FileUpload->setAcceptableTypes($this->field_options[$field]['file_upload']['mimetype']);
		} else {
			$this->FileUpload->setAcceptableTypes('');
		}
        if (isset($this->field_options[$field]['file_upload']['max_size'])) {
            $this->FileUpload->setMaxFilesize($this->field_options[$field]['file_upload']['max_size']);
		} else {
			$this->FileUpload->setMaxFilesize(0);
		}
        
        // Try and upload the file
		$this->FileUpload->resetError();
		$file_name = $this->FileUpload->upload($field, $directory);
        $set_new = FALSE;
	   
		$upload_error = $this->FileUpload->getError();
		if (!empty($upload_error) && $upload_error  != 'No file was uploaded') {
            if (isset($this->field_options[$field]['file_upload']['mimetype_message']) && stripos($upload_error, 'files may be uploaded') !== FALSE) {
                $this->error .= $this->wordify($field) . ': ' . $this->field_options[$field]['file_upload']['mimetype_message'] . "\n"; 
            } else {
                $this->printDebug("The following FileUpload error occured:\n" . $this->FileUpload->getError(), TRUE);
                $this->error .= $this->wordify($field) . ': ' . $upload_error . "\n"; 
            } 
            
            return FALSE;
        }
		
		// If there is a temporary file, it has already been processed
		if (!$file_name && !empty($_REQUEST['temporary_' . $field]) && file_exists($directory . self::TEMP_FILE_DIR . '/' . $_REQUEST['temporary_' . $field]) && !isset($_REQUEST['delete_' . $field])) {
			$set_new = TRUE;
			$delete_old = TRUE;
			$file_name = $_REQUEST['temporary_' . $field];
			$this->move_back_from_temp_dir[$field] = TRUE;
		
		// Otherwise, do the full processing
		} else {
			
			// Remove any temporary file we did have
			if (!empty($_REQUEST['temporary_' . $field])) {
				$this->deleteFiles($field, $_REQUEST['temporary_' . $field], TRUE);	
			}
			
	        // If the field requires a file
	        if ($this->field_info[$field]['not_null']) {
	            if (!$file_name && (!$this->existing || isset($_REQUEST['delete_' . $field]))) {
					$replacement_message  = 'Please upload a';
	                $replacement_message .= (preg_match('/^[aeiou]/i', $field)) ? 'n ' : ' ';
	                $replacement_message .= $this->wordify($field);
					
					$this->delete_flagged[$field] = TRUE;
	                $this->error .= str_replace('No file was uploaded', $replacement_message, $upload_error). "\n";
					return FALSE;
	            }
	        }

	        // If a file was upload, replace the old file
	        if ($file_name) {
	            $delete_old = TRUE;  
	            $set_new = TRUE;
	        
	        // If no file was uploaded, the user selected delete AND didn't have temporary file, delete the current file
	        } elseif (!$file_name && isset($_REQUEST['delete_' . $field]) && empty($_REQUEST['temporary_' . $field])) {
	            $delete_old = TRUE;  
	            $set_new = TRUE;
	            $file_name = '';
				$this->delete_flagged[$field] = TRUE;
	        }
			
			// Check to see if the file can be run through the workflow
            $is_workflow_mimetype = FALSE;
			$file_array = $this->FileUpload->getFile();
			if (in_array($file_array['type'], array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/tiff', 'image/tif'))) {
				$is_workflow_mimetype = TRUE;
			}
			
			try {

                $delete_master = FALSE;
           
                // If image version resizing was requested
	            if ($file_name && $is_workflow_mimetype && (isset($this->field_options[$field]['file_upload']['versions']) || isset($this->field_options[$field]['file_upload']['workflow']))) {
	                
	                // Create a master copy of the image to create all resizings from
	                $master_file = $directory . $file_name;  
                    
                    // Allow resizing of the version and master file
                    $combined_versions = (isset($this->field_options[$field]['file_upload']['versions'])) ? $this->field_options[$field]['file_upload']['versions'] : array();
                    if (isset($this->field_options[$field]['file_upload']['workflow'])) {
                        $temp_array = array('workflow' => $this->field_options[$field]['file_upload']['workflow']);
                        $temp_array['directory'] = $this->field_options[$field]['file_upload']['directory'];
                        if (isset($this->field_options[$field]['file_upload']['output_type'])) {
                            $temp_array['output_type'] = $this->field_options[$field]['file_upload']['output_type'];
                        }  
                        $combined_versions['__primary'] = $temp_array;  
                    }
                    
                    // Loop through each version and resize it
                    foreach ($combined_versions as $version => $options) {
	                    $file_extension = substr($file_name, strrpos($file_name, '.')+1);
                        $new_extension = (isset($options['output_type'])) ? strtolower($options['output_type']) : $file_extension;

                        $workflow = new ImageWorkflow($master_file);
	                    foreach ($options['workflow'] as $method => $parameters) {
                            if ($method == 'resize') {
                                $workflow->resizeImage((isset($parameters['width'])) ? $parameters['width'] : 0,
                                                       (isset($parameters['height'])) ? $parameters['height'] : 0,
                                                       (isset($parameters['allow_enlarge'])) ? $parameters['allow_enlarge'] : FALSE);
                            }
                            if ($method == 'centerCrop') {
                                $workflow->centerCropImage((isset($parameters['width'])) ? $parameters['width'] : 0,
                                                           (isset($parameters['height'])) ? $parameters['height'] : 0);
                            }  
                            if ($method =='squareCrop') {
                                $workflow->squareCropImage();
                            }  
                        }
                        $workflow->setAllowOverwrite(TRUE);
                        $workflow->process($options['directory'] . str_replace('.' . $file_extension, '.' . $new_extension, $file_name));
                        if (str_replace('.' . $file_extension, '.' . $new_extension, $file_name) != $file_name && $version == '__primary') {
                            $delete_master = TRUE;
                            $file_name = str_replace('.' . $file_extension, '.' . $new_extension, $file_name);    
                        }
	                }
	            }
                
                if ($delete_master) {
                    unset($master_file);   
                }
	            
	            // Move the files to the temp dir so users don't have to re-upload
				$file_name = $this->moveFilesToTempDir($field, $file_name);
				if ($set_new && !empty($file_name)) {
					$this->move_back_from_temp_dir[$field] = TRUE;
				}
				
	        } catch (Exception $e) {
	        
	            // Clean up any files that we uploaded, resized, etc as long as they aren't the same name as the current file for the field
	            $current_file_no_extension = (isset($this->values[$field])) ? substr($this->values[$field], 0, strrpos($this->values[$field], '.')) : '';
	            $new_file_no_extension     = substr($file_name, 0, strrpos($file_name, '.'));
	            if ($current_file_no_extension != $new_file_no_extension) {
	                $this->deleteFiles($field, $file_name);
	            } 
	            
	            if ($e->getMessage() != '') {
	                throw new StandardException($e->getMessage());
	            } 
	            return FALSE;     
				
	        }
		}
        
        // If we are supposed to set the file name, do it
        if ($set_new) {
            if ($delete_old && isset($this->values[$field]) && $this->values[$field] != $file_name) {
                $this->old_file_name[$field] = $this->values[$field];
            }
            $this->values[$field] = $file_name;
		}
		
        return (isset($this->values[$field])) ? $this->values[$field] : NULL;
    }

    
    /**
     * Makes sure all the file upload field option values are kosher
	 * 
     * @since  1.17.0
     * 
     * @param  string $field  The field to check the field option for
     * @return void
	 */
    protected function checkFileUploadFieldOption($field)
    {
        $option_array =& $this->field_options[$field]['file_upload']; 
        if (substr($option_array['directory'], -1) != '/' && substr($option_array['directory'], -1) != '\\') {
            $option_array['directory'] .= '/';    
        } 
        // Make sure the directory is writable
        if (!file_exists($option_array['directory']) || !is_writable($option_array['directory'])) {
            throw new FatalException('The directory ' . $option_array['directory'] . ' (for the field ' . $field . ') does not exist or is not writable');   
        }  
        // Create temp dirs so users don't have to re-upload files if validation occurs
        if (!file_exists($option_array['directory'] . self::TEMP_FILE_DIR . '/')) {
            $old_umask = umask(0000);
            mkdir($option_array['directory'] . self::TEMP_FILE_DIR . '/', 0777);    
            umask($old_umask);
        }
        
        if (isset($option_array['versions'])) {
            foreach ($option_array['versions'] as $version => $options) {
			    if (substr($option_array['versions'][$version]['directory'], -1) != '/' && substr($option_array['versions'][$version]['directory'], -1) != '\\') {
				    $option_array['versions'][$version]['directory'] .= '/';    
			    } 
                // Make sure the directory is writable
	            if (!file_exists($option_array['versions'][$version]['directory']) || !is_writable($option_array['versions'][$version]['directory'])) {
	                throw new FatalException('The directory ' . $option_array['versions'][$version]['directory'] . ' (for the field ' . $field . ') does not exist or is not writable');   
	            }  
                // Create temp dirs so users don't have to re-upload files if validation occurs
                if (!file_exists($option_array['versions'][$version]['directory'] . self::TEMP_FILE_DIR . '/')) {
				    $old_umask = umask(0000);
				    mkdir($option_array['versions'][$version]['directory'] . self::TEMP_FILE_DIR . '/', 0777);	
				    umask($old_umask);
			    }
                $output_type = $option_array['versions'][$version]['output_type'];
                if ($output_type != 'gif' && $output_type != 'jpg') {
                    throw new FatalException('Field ' . $field . ": output_type sub option valid values are 'gif' and 'jpg'");    
                }  
		    }
        }
    }
    
    
    /**
     * Gets all of the directories for a field
     * 
     * @since  3.0.0
     * 
     * @param  string $field   The field to get directories for
     * @return void
     */
    protected function listAllDirectories($field)
    {
        $dirs = array($this->field_options[$field]['file_upload']['directory']);
        if (isset($this->field_options[$field]['file_upload']['versions'])) {
            foreach ($this->field_options[$field]['file_upload']['versions'] as $version => $option) {
                $dirs[] = $option['directory'];
            } 
        }
        return $dirs;    
    }
    
    
    /**
     * Cleans up out-of-date files from the temp dir
	 * 
     * @since  3.0.0
     * 
     * @param  string $field   The field to clean up
     * @return void
     */
    protected function cleanTempFileDirs($field)
    {
     	$dirs = $this->listAllDirectories($field);
        foreach ($dirs as $dir) {
     		$dir = $dir . self::TEMP_FILE_DIR . '/';
     		$files = scandir($dir);
     		$files = array_diff($files, array('.', '..'));
     		foreach ($files as $file) {
				if (!empty($_REQUEST['temporary_' . $field]) && $file == $_REQUEST['temporary_' . $field]) {
					continue;
				}
				if (filemtime($dir . $file) < strtotime('-1 hour')) {
					unlink($dir . $file);		
				}
			}
		}   
    }
    
    
    /**
     * Deletes the files for the field specified using the supplied filename as a basis
     * 
     * @since  1.17.0
     * 
     * @param  string $field      The field to use for getting extensions
     * @param  string $file_name  The file name to use as basis for determining file names to delete
     * @param  boolean $temp_dir  If the files should be deleted from the temp dir
     * @return void
     */
    protected function deleteFiles($field, $file_name, $temp_dir=FALSE)
    {
        $files = $this->getExistingFilenameVariations($field, $file_name, $temp_dir);
		$debug_files = '';
			
		foreach ($files as $current_file) {	
            $debug_files .= $current_file . "\n";
            unlink($current_file);    
        }      
        
		$this->printDebug("The following file were deleted for the field '" . $field . "':\n" . $debug_files, TRUE);
    }
    
    
    /**
     * Moves files from the regular dir to the temp dir
     * 
     * @since  3.0.0
     * 
     * @param  string $field      The field to use for getting extensions
     * @param  string $file_name  The file name to use as basis for determining file names to delete
     * @param  boolean $temp_dir  If the files should be deleted from the temp dir
     * @return string  The new file name (could possibly change due to naming conflicts)
     */
    protected function moveFilesToTempDir($field, $file_name)
    {
		if (empty($file_name)) { return $file_name; }
		$new_file_name = $file_name;
		$existing_files = $this->getExistingFilenameVariations($field, $file_name);
		do {
			if (isset($new_files)) {
				$new_file_name = $this->createNewFileName($new_file_name);	
			}
			$new_files = $this->getExistingFilenameVariations($field, $new_file_name, TRUE);
		} while (file_exists($new_files[0]));	
		
		$new_files = array_combine($existing_files, $new_files);
		foreach ($new_files as $current_file => $temp_file) {	
			$old_umask = umask(0000);
			rename($current_file, $temp_file);   
			chmod($temp_file, 0777);
			umask($old_umask);
		} 
        
		return $new_file_name;     
    }
    
    
    /**
     * Moves files from the temp dir to the regular dir
     * 
     * @since  3.0.0
	 * 
     * @param  string $field      The field to use for getting extensions
     * @param  string $file_name  The file name to use as basis for determining file names to delete
     * @param  boolean $temp_dir  If the files should be deleted from the temp dir
     * @return string  The new file name (could possibly change due to naming conflicts) 
     */
	protected function moveFilesFromTempDir($field, $file_name)
    {
		if (empty($file_name)) { return $file_name; }
		$new_file_name = $file_name;
		$existing_files = $this->getExistingFilenameVariations($field, $file_name, TRUE);
		do {
			if (isset($new_files)) {
				$new_file_name = $this->createNewFileName($new_file_name);	
			}
			$new_files = $this->getExistingFilenameVariations($field, $new_file_name);
		} while (file_exists($new_files[0]));
		
		$new_files = array_combine($existing_files, $new_files);	
		foreach ($new_files as $current_file => $perm_file) {	
			$old_umask = umask(0000);
			rename($current_file, $perm_file); 
			chmod($perm_file, 0777); 
			umask($old_umask); 
		} 
		
		return $new_file_name;
    }
    
    
    /**
     * Get a list of the filename variations for a specific file in a specific field
     * 
     * @since  3.0.0
     * 
     * @param  string $field      The field to use for getting extensions
     * @param  string $file_name  The file name to use as basis for determining file names
     * @param  boolean $temp_dir  If the files should be looked for in the temp dir
     * @return void
     */
    protected function getExistingFilenameVariations($field, $file_name, $temp_dir=FALSE)
    {
        $this->checkFileUploadFieldOption($field);
        $option_array = $this->field_options[$field]['file_upload'];
                    
        $current_file_no_extension = substr($file_name, 0, strrpos($file_name, '.'));
        
        $dir_append = ($temp_dir) ? self::TEMP_FILE_DIR . '/' : ''; 
        $files = array($option_array['directory'] . $dir_append . $file_name);
        
        if (isset($option_array['versions'])) {
            foreach ($option_array['versions'] as $version => $options) {
                if (!isset($options['output_type'])) {
                    $current_file = $options['directory'] . $dir_append . $file_name;    
                } else {
                    $current_file = $options['directory'] . $dir_append . $current_file_no_extension . '.' . $options['output_type'];   
                }
			    $files[] = $current_file;    
            }   
        }   
        
        return $files;
    }
    
    
    /**
     * Create a new file name using the FileUpload class rules
     * 
     * @since  3.0.0
     * 
     * @param  string $file_name  The file name that needs to be made unique
     * @return string  The new file name
     */
    protected function createNewFileName($file_name)
    {
        $path_info = pathinfo($_SERVER['DOCUMENT_ROOT'] . '/' . $file_name);      
        $base_file_name = preg_replace('#\.' . preg_quote($path_info['extension'], '#') . '$#', '', $file_name);
        if (preg_match('#_copy(\d+)$#', $base_file_name, $matches)) {
        	$new_number = $matches[1] + 1;
        	$new_base_file_name = preg_replace('#_copy\d+$#', '_copy' . $new_number, $base_file_name);
		} else {
			$new_base_file_name = $base_file_name . '_copy1';	
		}
        return $new_base_file_name . '.' . $path_info['extension'];
    }
    
    
    /**
     * THIS IS NOT MEANT TO BE CALLED PUBLICLY. Deletes the files for all fields in this object, and recursively calls this function for all cascading children.
     * 
     * @since  3.0.0
     * 
     * @param  void
     * @return void
     */
    public function cascadeDeleteAllFiles()
    {
        $this->printDebug("Cascade delete was just called", TRUE);   
        
        if (!$this->allow_cascade_delete) {
        	throw new FatalException('The method cascadeDeleteAllFiles() is not meant to be called publicly');
		}
        
        // Delete uploaded files
        foreach ($this->field_options as $field => $options) {
            if (isset($options['file_upload']) && !empty($this->values[$field])) {
                $this->deleteFiles($field, $this->values[$field]); 
            }   
        }
        
        // Cascade delete files on cascading children
        foreach ($this->child_keys as $child_key) {
	        if (!empty($child_key['on_delete']) && $child_key['on_delete'] == 'cascade') {
	            $code = '$children = $this->create' . $this->camelCase($child_key['child_table'], TRUE) . '(0, 1, FALSE);';
                eval($code);
                foreach ($children as $child) {
                    $child->cascadeDeleteAllFiles();
				}    
	        } 
	    }
        
        $this->allow_cascade_delete = FALSE;
    }
    
    
	/**
	 * Displays the current file html including the temporary file hidden field and the delete file checkbox
	 * 
	 * @since  3.0.0
	 * 
	 * @param  string $field      The field to print the current file html for
	 * @param  boolean $as_child  If the html is for a child table
	 * @return void
	 */
	public function printCurrentFileUploadHtml($field, $as_child=FALSE)
	{
		// Error out if the field is not a file upload
		if (!isset($this->field_options[$field]['file_upload'])) {
			throw new FatalException('The field ' . $field . ' does not have the file_upload field option set');    
		}
		
		$this->checkFileUploadFieldOption($field);
		$directory = $this->field_options[$field]['file_upload']['directory'];
		
		$code = '$temp_file = $this->get' . $this->camelCase($field, TRUE) . '();';
		eval($code);
		$file = $temp_file;
		if (!isset($this->old_file_name[$field]) && $this->existing) {
			$temp_file = '';
		}
		$temporary_field_name = ($as_child) ? $this->database_table . '_temporary_' . $field . '[]' : 'temporary_' . $field;
		echo '<input type="hidden" name="' . $temporary_field_name . '" value="' . $temp_file . '" />';
		
		$code = '$file_with_dir = $this->get' . $this->camelCase($field, TRUE) . '(TRUE);';
		eval($code);
		
		static $number = 1;
		
		if (trim($file_with_dir) && !is_dir($_SERVER['DOCUMENT_ROOT'] . $file_with_dir) && file_exists($_SERVER['DOCUMENT_ROOT'] . $file_with_dir)) {
			echo '<span class="current_file">';
			echo 'Current: <a href="' . $file_with_dir . '">' . $file . '</a>';
			echo '</span> ';
			echo '<span class="delete_checkbox">';
			$delete_field_name = ($as_child) ? $this->database_table . '_delete_' . $field . '[]' : 'delete_' . $field;
			echo '<input type="checkbox" class="checkbox" name="' . $delete_field_name . '" id="delete_' . $field . '_' . $number . '" value="' . form_value($file) . '"';
			echo (!empty($this->delete_flagged[$field])) ? ' checked="checked"' : '';
			echo ' /> ';
			echo '<label for="delete_' . $field . '_' . $number . '">Delete</label>';
			echo '</span>';
			$number++;
		}    
	}
    
	
    
	/* ------------------------------------------------- */
	/* DATA STORAGE METHODS
	/* ------------------------------------------------- */
    
    
    /**
	 * Loads data from the database
	 * 
	 * @since  1.0.0
	 * 
	 * @param  void
	 * @return void
	 */
	public function load() 
	{
        if (!$this->existing) {
            throw new FatalException('The record specified has not been stored in the database yet'); 
        }
        
        if (empty($this->field_info)) {
            throw new FatalException('The record specified has not been initialized properly: no field info loaded');     
        }
		
        // Create the sql
        $sql = "SELECT * FROM " . $this->database_table . " WHERE " . $this->primary_key_field . " = '" . addslashes($this->primary_key_value) . "'";   
		
	
        // Get the info from the database
        $result = $this->Database->query($sql);
        if (!$this->Database->numRows($result)) {
            throw new NotFoundException('The requested ' . $this->wordify($this->underscoreNotation(get_class($this))) . ' could not be found'); 
        }
        $row = $this->Database->getRow($result);
		
		// Reset all values
		$this->values = array();
		
        // Check each field as it is being pulled out of the database, handle booleans specially
        foreach ($this->field_info as $field => $info) {
            if ($info['type'] == 'boolean') {
                if ($row[$field] == '0' || $row[$field] == 'f') {
                    $this->values[$field] = FALSE;	
				} elseif ($row[$field] == '1' || $row[$field] == 't') {
					$this->values[$field] = TRUE;	
				} else {
					$this->values[$field] = NULL;	
				}
            } elseif ($info['type'] == 'varchar' || $info['type'] == 'text') {
				$this->values[$field] = $this->valueFilterOut($field, $row[$field]);
                
            // Fixes the crappy MS windows dll for mssql that turns the integer 0 into a space. The Database class removed the space, but here we need the right data type.
			} elseif ($this->Database->getDatabaseType() == 'mssql' && $info['type'] == 'integer' && $row[$field] === '') {
            	$this->values[$field] = 0;
            	
            } else {
                $this->values[$field] = $row[$field];
            }                   
        }
        
        // Get child items from the database
        foreach ($this->child_keys as $child_key) {
            // Get child ids for tables that are joined by a link table, non-link table children are loaded when requested
			if (isset($child_key['link_table'])) {
                $field = $this->pluralize($child_key['child_primary_key']);
				$this->findIds($field, FALSE);
			}    
        }
        
        $this->printDebug("The contents of \$this->values:\n" . print_r($this->values, TRUE), TRUE);
        
        $this->values_loaded = TRUE;
        return;
	}
    
    
    
    /**
	 * Validates all of the information in the record, throws an exception if something does not validate
	 * 
	 * @since 1.0.0
	 * 
	 * @param  boolean $check_child_and_foreign_keys  If we should validate all values that are child or foreign keys
     * @param  boolean $throw_exception               If we should throw an exception when an error occurs (you only want to turn this off if you are chaining validate() with validateChildren())
	 * @return void
	 */
	public function validate($check_child_and_foreign_keys=TRUE, $throw_exception=TRUE)
    {
        // Validate all of the fields
        foreach ($this->field_info as $field => $info) {
		    // Make sure ordering fields have a value, if not, add the next available value
            if (isset($this->field_options[$field]['ordering']) && empty($this->values[$field])) {
				$this->values[$field] = $this->determineMaxOrderingValue() + 1;   
            }
            if (isset($this->values[$field])) {
				$value = $this->values[$field];
			} elseif ($field == $this->primary_key_field) {
				$value = $this->primary_key_value;
			} else {
				$value = NULL;
			}
			
			$this->validateDatabase($field, $value);    
			
			// Handle email field option
			if (!empty($this->field_options[$field]['email']) && !empty($value)) {
				$result = $this->Validator->validateEmail($value);
				if (!$result) {
					$this->error .= $this->wordify($field) . " should be in format: name@example.com\n";	
				}
			}
		}
        foreach ($this->validation_rules as $rule) {
			$keys = array_keys($rule);
			$type = $keys[0];
			$info = $rule[$type];
			// Handle multiple field validation
			if ($type == 'only_one' || $type == 'one_or_more') {
				$only_one = ($type == 'only_one') ? TRUE : FALSE;
				$this->validateMultiple($only_one, $info);
			
			// Handle conditional validation
			} elseif ($type == 'conditional') {
				if (!isset($info['field']) || !isset($info['required_fields'])) {
					throw new FatalException("The following validation rule does not contain all of the required array keys:\n" . print_r($rule, TRUE));		
				}
				$info['values'] = (isset($info['values'])) ? $info['values'] : array();
				$this->validateConditional($info['field'], $info['required_fields'], $info['values']);
				
			// Handle linked-table validation
			} elseif ($type == 'link') {
				if (!isset($this->values[$info]) || !is_array($this->values[$info]) || sizeof($this->values[$info]) < 1) {
					$keys = $this->Database->getKeys();
					foreach ($keys as $table => $key_type_array) {
		            	if ($this->singularize($info) == $key_type_array['primary_key_field']) {
		            		break;	
						}
					}
					$this->error .= "Please select at least one " . $this->wordify($this->singularize($table)) . "\n"; 
				}				
			
			// Handle checking child tables
			} elseif ($type == 'child') {
				if (!isset($this->child_objects[$info]) || sizeof($this->child_objects[$info]) < 1) {
					$this->error .= "Please add at least one " . $this->wordify($this->singularize($info)) . "\n";	
				}
			}
        }
        
        // Make sure everything we are referencing exists
        if ($check_child_and_foreign_keys) {
            foreach ($this->child_keys as $child_key) {
                $field = $this->pluralize($child_key['child_primary_key']);   
                if (isset($this->values[$field])) {
                    $this->checkIds($child_key['child_table'], $this->values[$field]);
                }
            } 
            foreach ($this->foreign_keys as $key_info) {
                if (!empty($this->values[$key_info['field']])) {
                    $this->checkIds($key_info['foreign_table'], $this->values[$key_info['field']]);
                }   
            }
        }
        
        if ($throw_exception) {

            $this->throwIfError(NULL, 'ValidationException');
        }   
    }
    
    
    /**
     * Validates child objects for the child table specified
     * 
     * @since  1.8.0
     * 
     * @param  string $child_table                    The child table to validate the objects for
     * @param  boolean $check_child_and_foreign_keys  If we should validate all values that are child or foreign keys
     * @param  boolean $throw_exception               If we should throw an exception when an error occurs (you only want to turn this off if you are chaining validate() with validateChildren())
     * @return void
     */
    public function validateChildren($child_table, $check_child_and_foreign_keys=TRUE, $throw_exception=TRUE)
    {
        // Find info about the child table we are trying to validate
        $child_key_info = NULL;
        foreach ($this->child_keys as $child_key) {
            if ($child_key['child_table'] == $child_table && !isset($child_key['link_table'])) {
                $child_key_info = $child_key;
                break;
            }
        }
        if ($child_key_info === NULL) {
            throw new FatalException('Unknown child table, ' . $child_table . ', specified');
        }

        if (isset($this->child_objects[$child_table]) && is_array($this->child_objects[$child_table]) && sizeof($this->child_objects[$child_table]) > 0) {
            $total_children = sizeof($this->child_objects[$child_table]);
            $object_name = $this->wordify($this->singularize($child_table), TRUE);
            $child_field_method = 'set' . $this->camelCase($child_key_info['child_field'], TRUE);  
            for ($i=0; $i < $total_children; $i++) {
                try {
                    $value = $this->primary_key_value;
                    if (empty($value)) {
                        $value = '-1';   
                    }
                    $this->child_objects[$child_table][$i]->$child_field_method($value);
                    $this->child_objects[$child_table][$i]->validate($check_child_and_foreign_keys);    
                } catch (Exception $e) {
                    $errors = explode("\n", $e->getMessage());
                    foreach ($errors as $child_error) {
                        if (!empty($child_error)) {
                            $this->error .= $object_name . ' ' . ($i+1) . ': ' . $child_error . "\n"; 
                        }   
                    }    
                }
            }
            if ($throw_exception) {
                $this->throwIfError(NULL, 'ValidationException');
            }   
        }
        
        return;
    }
    
    
    
    /**
	 * Stores the current data into the database, throw exception on error
	 * 
	 * @since 1.0.0
	 * 
	 * @param  boolean $use_transaction  If a transaction should be created (only set to false if you are manually starting a transaction)
	 * @return void
	 */
	public function store($use_transaction=TRUE) 
	{
        try {            
            $temp_files_moved = FALSE;
            
            $this->validate();
            
            if ($use_transaction) {
                $this->Database->startTransaction();
                $this->throwIfError($this->Database, 'Exception');
            }
            
            $this->afterValidation();
            
    	    $fields = array();
            $values = array();
            
            // Get a list of all foreign key fields
            $foreign_key_fields = array();
            foreach ($this->foreign_keys as $foreign_key) {
                $foreign_key_fields[$foreign_key['field']] = TRUE;    
            }
            
			$this->determineOrderingFields(FALSE);
            // If one of the other fields in the unique constraint for ordering has changed, we need to do some special stuff
            if (!empty($this->old_other_ordering_values)) {
                // Move the old values back in, so we can move this item to the end as not to leave a gap
                $temp = array();
                foreach ($this->old_other_ordering_values as $field => $old_val) {
                    $temp[$field] = $this->values[$field];
                    $this->values[$field] = $old_val;   
                }
                
                // Reorder using the old other ordering field values
                $this->self_call = TRUE;
				$this->changeOrder($this->determineMaxOrderingValue());
                $this->self_call = FALSE;
                
                // Put back in the real values and set this item to the end of the new list it is in
                foreach ($temp as $field => $new_val) {
                    $this->values[$field] = $new_val;   
                }    
				$this->values[$this->ordering_field] = $this->determineMaxOrderingValue() + 1;
                $this->old_ordering_value = $this->values[$this->ordering_field];
            }
			
			
			// Move temporarily uploaded files into the real dirs
			foreach ($this->field_options as $_field => $_options) {
				foreach ($_options as $_option => $_values) {
					if ($_option == 'file_upload' && isset($this->move_back_from_temp_dir[$_field])) {
						$this->values[$_field] = $this->moveFilesFromTempDir($_field, $this->values[$_field]);	
					}
				}		
			}
			$temp_files_moved = TRUE;
			
            foreach ($this->field_info as $field => $info) {
			
                if (!$this->existing && $this->ordering_field && $field == $this->ordering_field) {
                    $this->old_ordering_value = -1;   
                } elseif ($this->ordering_field && $field == $this->ordering_field && empty($this->old_ordering_value)) {
                    $this->old_ordering_value = $this->values[$this->ordering_field];
                    // If the ordering value has not changed, don't set it in the SQL so that if a delete occurs the numbering doesn't get screwed up
                    continue;   
                }
                
				$type = $info['type'];
                
				if ($field == $this->primary_key_field) {
					$value = $this->primary_key_value;
				} else {
					if (isset($this->values[$field])) {
                        $value = $this->values[$field];
                    } else {
                        $value = NULL;    
                    }
				}
                
				if (!array_key_exists($field, $this->values) && $field != $this->primary_key_field) {
                    continue;
				}
				
                if (isset($foreign_key_fields[$field])) {
                    $values[] = ($value) ? "'" . db_value($value) . "'" : 'NULL';
                } elseif ($field == $this->ordering_field) {
                    $values[] = $this->old_ordering_value;
                } else {
					if (is_null($value)) {
                        if (isset($this->field_options[$field]['date_updated'])) {
                            $values[] = "CURRENT_TIMESTAMP";    
                        } elseif ($info['not_null'] || array_key_exists('default', $info)) {
                            $values[] = 'DEFAULT';    
                        } else {
	                        $values[] = 'NULL';    
						}
                    } elseif ($type == 'date' || $type == 'datetime' || $type == 'time') {
						if (isset($this->field_options[$field]['date_updated'])) {
                            $values[] = "CURRENT_TIMESTAMP";    
                        } else {
                            $values[] = "'" . $value . "'";
                        }
					} elseif ($type == 'boolean') {
                    	$values[] = ($value) ? "'1'" : "'0'";
                	} elseif ($type == 'float' || $type == 'integer') {
                    	$values[] = $value;
					} elseif ($type == 'enum') {
						$values[] = "'" . db_value($value) . "'";
					} elseif ($type == 'varchar' || $type == 'text') {
                    	$values[] = "'" . db_value($this->valueFilterIn($field, $value)) . "'";
					} else {
						throw new FatalException('Unknown field type, ' . $type . ', found in field info array');
					}
                }
                $fields[] = $field;
            }
                  
			
            // Handle updating existing information
    	    if ($this->existing) {
                $sql  = "UPDATE " . $this->database_table . " SET ";
                
                $total_fields = sizeof($fields);
                for ($i = 0; $i < $total_fields; $i++) {
                    $sql .= $fields[$i] . ' = ' . $values[$i];
                    $sql .= ($i != $total_fields-1) ? ', ' : ' ';   
                }
                
                $sql .= "WHERE " . $this->primary_key_field . " = '" . $this->primary_key_value . "'";
                
            // Handle inserting new info    
		    } else {
	            $sql  = "INSERT INTO " . $this->database_table . " (";
                
                $total_fields = sizeof($fields);
                $values_sql = '';
                for ($i = 0; $i < $total_fields; $i++) {
                    $sql        .= $fields[$i];
                    $sql        .= ($i != $total_fields-1) ? ', ' : ''; 
                    $values_sql .= $values[$i];
                    $values_sql .= ($i != $total_fields-1) ? ', ' : '';   
                }
                
                $sql .= ") VALUES (";
                $sql .= $values_sql;
                $sql .= ")";
		    }
         
		    $result = $this->Database->query($sql);
            $this->throwIfError($this->Database, 'Exception');
            
            if ($this->ordering_field) {
				$this->determineMaxOrderingValue();    
            }
            
            if (!$this->existing && !isset($this->field_info[$this->primary_key_field])) {
                $this->primary_key_value = $this->Database->getId();
                $this->printDebug("The ID '" . $this->primary_key_value . "' was just created", TRUE);	
		    }
		     
            $child_error_flagged = FALSE;
            
            // Loop through the child keys and save them in the database
            foreach ($this->child_keys as $child_key) {
                
                // Get child ids for tables not joined by a link table
                if (isset($child_key['link_table'])) {
                    $sql = "DELETE FROM " . $child_key['link_table'] . " WHERE " . $child_key['link_field'] . " = '" . addslashes($this->primary_key_value) . "'";
                    $result = $this->Database->query($sql);
                    $this->throwIfError($this->Database);
                    
                    $plural_key_name = $this->pluralize($child_key['child_primary_key']);
                    if (isset($this->values[$plural_key_name])) {
                        foreach ($this->values[$plural_key_name] as $key) {
                            $sql = "INSERT INTO " . $child_key['link_table'] . " (" . $child_key['link_field'] . ", " . $child_key['link_child_primary_key'] . ") VALUES ('" . addslashes($this->primary_key_value) . "', '" . addslashes($key) . "')";
                            $result = $this->Database->query($sql);
                            $this->throwIfError($this->Database);    
                        }    
                    }
                
                // If we have any child objects to store, do it now
                } elseif (isset($this->child_objects[$child_key['child_table']])) {
                    
                    // Find all of the existing children
                    $old_children_sql = "SELECT " . $child_key['child_primary_key'] . " FROM " . $child_key['child_table'] . " WHERE " . $child_key['child_field'] . " = '" . addslashes($this->primary_key_value) . "'";
                    $old_children_result = $this->Database->query($old_children_sql);
                    
                    $old_children = array();
                    if ($this->Database->numRows($old_children_result)) {
                        while ($row = $this->Database->getRow($old_children_result)) {
                            $old_children[] = $row[$child_key['child_primary_key']];
                        }   
                    }
                    
                    // Get a list of new children
                    $new_children = array();
                    foreach ($this->child_objects[$child_key['child_table']] as $child_object) {
                        $new_children[] = $child_object->getPrimaryKey();   
                    }
                    
                    // Get rid of of children not being updated
                    $children_to_delete = array_diff($old_children, $new_children);
                    $child_class_name = $this->camelCase($this->singularize($child_key['child_table']), TRUE);                    
                    foreach ($children_to_delete as $ctd_id) {
                        try {
							$ctd = new $child_class_name($ctd_id);
							$ctd->delete(FALSE);
                        } catch (Exception $e) { }       
                    }
                    
                    // Save all of the new children
                    $total_children = sizeof($this->child_objects[$child_key['child_table']]);
                    $object_name = $this->wordify($this->underscoreNotation($child_class_name));
                    $child_field_method = 'set' . $this->camelCase($child_key['child_field'], TRUE);
                    for ($k=0; $k < $total_children; $k++) {
                        try {
                            // Make sure the child field points to this record
                            $this->child_objects[$child_key['child_table']][$k]->$child_field_method($this->primary_key_value);
                            $this->child_objects[$child_key['child_table']][$k]->store(FALSE);

                        } catch (Exception $e) {
							if (!$child_error_flagged) {
								$child_error_flagged = get_class($e);
							} elseif ($child_error_flagged != get_class($e)) {
								$child_error_flagged = TRUE;	
							}
                            $errors =explode("\n", $e->getMessage());
                            foreach ($errors as $child_error) {
                                if (!empty($child_error)) {
                                    $this->error .= $object_name . ' ' . ($k+1) . ': ' . $child_error . "\n"; 
                                }   
							} 
						}   
                    }
                    
                }
                    
            }
            
            if ($child_error_flagged) {
				if ($child_error_flagged === TRUE) {
					throw new Exception();   
				} else {
					throw new $child_error_flagged($this->error);	
				}
            }
            
            // We didn't change the order in the insert/update, but rather we will let the changeOrder method deal with it
            if (!empty($this->ordering_field) && $this->values[$this->ordering_field] != $this->old_ordering_value) {
                $this->self_call = TRUE;
                $this->changeOrder(NULL);   
                $this->self_call = FALSE;
            }
		    
		    if ($use_transaction) {
		        $this->Database->commitTransaction();
            }
		        
            if (!$this->existing) {
                $this->existing = TRUE;   
            }
            
            // Everything worked great, so lets delete all of the old files
            foreach ($this->old_file_name as $field => $file_name) {
                $this->deleteFiles($field, $file_name);
            }
            
        } catch (Exception $e) {
            
			// Move the new files back to the temp dir
			if ($temp_files_moved) {
				foreach ($this->field_options as $_field => $_options) {
					foreach ($_options as $_option => $_values) {
						if ($_option == 'file_upload' && isset($this->values[$_field]) && $this->move_back_from_temp_dir[$_field]) {
							$this->values[$_field] = $this->moveFilesToTempDir($_field, $this->values[$_field]);	
						}
					}		
				}		
			}
			
            if (!$this->existing) {
				$this->primary_key_value = NULL;   
			}
            
            if ($use_transaction) {
				$this->Database->rollbackTransaction(); 
            }
			
            // If we don't get a normal exception, preserver the message
            if (get_class($e) != 'Exception') {
				throw $e;   
            }
			
			$this->printDebug("The following exception caused the store to fail:\n" . $e->getMessage(), TRUE);
			$this->error .= "Error saving " . $this->wordify($this->underscoreNotation(get_class($this))) . " in the database\n"; 
			$this->throwIfError();   
        }
	}
	
	
	/**
	 * Deletes the current data from the database and removes uploaded files, throws exception on error
	 * 
	 * @since  1.0.0
	 * 
	 * @param  boolean $use_transaction  If a transaction should be created (only set to false if you are manually starting a transaction)
	 * @param  boolean $delete_files     If all files should be deleted
	 * @return void 
	 */
	public function delete($use_transaction=TRUE, $delete_files=TRUE) 
	{
        try {
            $this->allow_cascade_delete = TRUE;
            
            if ($use_transaction) {
                $this->Database->startTransaction();
                $this->throwIfError($this->Database);
            }
			
			$this->determineOrderingFields(FALSE);
            
            // Check for a restricting ON DELETE clauses
			foreach ($this->child_keys as $child_key) {
				if (!empty($child_key['on_delete']) && ($child_key['on_delete'] == 'no_action' || $child_key['on_delete'] == 'restrict')) {
					$code = '$child_ids = $this->find' . $this->camelCase($this->pluralize($child_key['child_primary_key']), TRUE) . '(FALSE);';
	            	eval($code);
	            	if (!empty($child_ids)) {
	            	 	throw new StandardException('The ' . $this->wordify($this->underscoreNotation(get_class($this))) . ' you selected could not be deleted because there are one or more ' . $this->wordify($child_key['child_table']) . ' that reference it', 100);
					}    
	            } 
	        }
            
            // If there is ordering for this table, first move the item to the end, then delete so we don't leave a hole in the middle
            if (!empty($this->ordering_field)) {
                $this->self_call = TRUE;
				$this->changeOrder($this->determineMaxOrderingValue());   
                $this->self_call = FALSE;
            }
			
			// Cascade delete cascading children
	        foreach ($this->child_keys as $child_key) {
	            if (!empty($child_key['on_delete']) && $child_key['on_delete'] == 'cascade') {
	            	$code = '$children = $this->create' . $this->camelCase($child_key['child_table'], TRUE) . '(0, 1, FALSE);';
	            	eval($code);
                    $this->child_objects[$child_key['child_table']] = $children;
	            	foreach ($children as $child) {
						$child->load();
						$child->delete(FALSE, FALSE);
					}    
	            } 
	        }
			
            $sql = "DELETE FROM " . $this->database_table . " WHERE " . $this->primary_key_field . " = '" . addslashes($this->primary_key_value) . "'";
    	    
    	    $result = $this->Database->query($sql);
		    $this->throwIfError($this->Database);
		    
            $this->primary_key_value = NULL;
            $this->existing = FALSE; 
            
            if ($use_transaction) {
                $this->Database->commitTransaction();
            }
            
            if ($delete_files) {
            	$this->cascadeDeleteAllFiles();	
			}
            
        } catch (Exception $e) {
            
            if ($use_transaction) {
                $this->Database->rollbackTransaction();
            }
            
            $this->printDebug("The following exception caused the delete to fail:\n" . $e->getMessage(), TRUE);
			
			if (get_class($e) == 'StandardException' && $e->getCode() == 100) {
				throw $e;	
			}
			
			$this->error .= "Error deleting " . $this->wordify($this->underscoreNotation(get_class($this))) . " from the database\n";
			$this->throwIfError();
        }  
	}
    
    
    /**
     * Gets called right after ->validate() in the ->store() method
     * 
     * @since  2.4.0
     * 
     * @param  void
     * @return void
     */
    protected function afterValidation()
    {   
    }
    
    
    /**
	 * Allows any sort of data transformation to be done before the (string) data is saved to the database
	 * 
	 * @since  1.0.0
	 * 
	 * @param  string $field  The field being filtered
     * @param  mixed $value   The value being stored
	 * @return mixed  The transformed value
	 */
	protected function valueFilterIn($field, $value) 
	{
        return $value;        
	}
    
    
    /**
	 * Allows any sort of data transformation to be done as the (string) data is pulled from the database
	 * 
	 * @since  1.0.0
	 * 
	 * @param  string $field  The field being filtered
     * @param  mixed $value   The value being retrieved
	 * @return mixed  The transformed value
	 */
	protected function valueFilterOut($field, $value) 
	{
        return $value;        
	}
    
    
    
    /* ------------------------------------------------- */
    /* REORDERING METHODS
    /* ------------------------------------------------- */
    
    
    /**
	 * Changes the ordering of the record (based on the ordering_field variable)
	 * 
	 * @since  1.3.0
	 * 
	 * @param  integer $new_order  The new order for this record
	 * @return void 
	 */
	public function changeOrder($new_order) 
	{
		$this->determineOrderingFields();
        try {
            if ($this->old_ordering_value && $new_order == $this->old_ordering_value) {
                return TRUE;   
            }
            
            if ($new_order !== NULL) {
                $this->assignValue($this->ordering_field, $new_order);
            }
            
            if (!$this->self_call) {
                $this->Database->startTransaction();
                $this->throwIfError($this->Database);    
            }
            
			$total_items = $this->determineMaxOrderingValue();            
            
            // Handle new items
            if ($this->old_ordering_value == -1) {
                $start_item = $this->values[$this->ordering_field];
                $end_item = $total_items;    
                $direction = 'up';
            
            // Handle existing items
            } else {
                if ($this->values[$this->ordering_field] > $this->old_ordering_value) {
                    $direction = 'down';   
                    $start_item = $this->old_ordering_value + 1;
                    $end_item = $this->values[$this->ordering_field];
                } else {
                    $direction = 'up';   
                    $start_item = $this->values[$this->ordering_field];
                    $end_item = $this->old_ordering_value - 1;
                }  
            } 
            
            // We are moving a block of items up
            if ($direction == 'up') {
                $distance_down = $total_items + 2;
                $distance_up = $total_items + 3;    
                
            // We are moving a block of items down    
            } else {
                $distance_down = $total_items + 2;
                $distance_up = $total_items + 1;
            }
            
			$this->determineOrderingWhereData();
            
            if ($end_item > 0) {
                // Move the items down
                $sql = "UPDATE " . $this->database_table . " SET " . $this->ordering_field . " = " . $this->ordering_field . " - " . $distance_down . " WHERE " . $this->where_field . " = '" . $this->where_value . "' AND " . $this->ordering_field . " >= '" . $start_item . "' AND " . $this->ordering_field . " <= '" . $end_item . "'";
                $result = $this->Database->query($sql);
                $this->throwIfError($this->Database);
            }
            
            // Update this item
            $sql = "UPDATE " . $this->database_table . " SET " . $this->ordering_field . " = '" . $this->values[$this->ordering_field] . "' WHERE " . $this->primary_key_field . " = '" . addslashes($this->primary_key_value) . "'";
            $result = $this->Database->query($sql);          
            $this->throwIfError($this->Database); 
            
            if ($end_item > 0) {    
                // Move them back up
                $sql = "UPDATE " . $this->database_table . " SET " . $this->ordering_field . " = " . $this->ordering_field . " + " . $distance_up . " WHERE " . $this->where_field . " = '" . $this->where_value . "' AND " . $this->ordering_field . " < -1";
                $result = $this->Database->query($sql);
                $this->throwIfError($this->Database);
            }           
            
            if (!$this->self_call) {
                $this->Database->commitTransaction();       
            }
            
        } catch (Exception $e) {
            
            if (!$this->self_call) {
                $this->Database->rollbackTransaction();
            }
            
            $this->printDebug("The following exception caused the changeOrder to fail:\n" . $e->getMessage(), TRUE);
            $this->error .= "An error occured when reordering the item\n";
			$this->throwIfError();
        }  
	}
    
    
    /**
	 * Displays a move up/move down sitemanager buttons
	 * 
	 * @since  1.3.0
	 * 
	 * @param  string $javascript  If the javascript is not located at /js/reorder.js, pass the location here
     * @param  string $ajax        If the ajax page is not located at /ajax/reorder.php, pass the location here
     * @param  string $up_image    If the move up button is not located at http://sitemanager.imarc.net/images/sitemanager/order_up.gif
     * @param  string $down_image  If the move down button is not located at http://sitemanager.imarc.net/images/sitemanager/order_down.gif
	 * @return void
	 */
    public function printSiteManagerOrderingButtons($javascript=NULL, $ajax=NULL, $up_image=NULL, $down_image=NULL)
    {
		$this->determineOrderingFields(); 
        if ($javascript === NULL) {
            $javascript = '/js/reorder.js';
        } 
        if ($ajax === NULL) {
            $ajax = '/ajax/reorder.php';
        } 
        if ($up_image === NULL) {
            $up_image = 'http://sitemanager.imarc.net/images/sitemanager/order_up.gif';
        }
        if ($down_image === NULL) {
            $down_image = 'http://sitemanager.imarc.net/images/sitemanager/order_down.gif';
        }
        
        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $javascript)) {
            die('Unable to locate the reording js file ' . $javascript);
        } 
        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $ajax)) {
            die('Unable to locate the reording ajax file ' . $ajax);
        } 
        
        add_to_head('<script type="text/javascript" src="' . $javascript . '"></script>');     

       	$alt    = ($this->values[$this->ordering_field] == 1) ? 'Move Up (Disabled)' : 'Move Up';
        $src    = ($this->values[$this->ordering_field] == 1) ? str_replace('.gif', '_na.gif', $up_image) : $up_image;
        if ($this->values[$this->ordering_field] == 1) {
            $onclick = 'return false;';
        } else {
			$onclick = "reorder('" . $ajax . '?type=' . get_class($this) . "', '" . $this->primary_key_value . "', this, " . ($this->values[$this->ordering_field] - 1) . ", " . $this->determineMaxOrderingValue() . ", 'up'); return false;";
        }
        
        echo '<a href="#" onclick="' . $onclick . '"><img src="' . $src . '" alt="' . $alt . '" title="' . $alt . '" /></a>'; 
        
		$alt    = ($this->values[$this->ordering_field] == $this->determineMaxOrderingValue()) ? 'Move Down (Disabled)' : 'Move Down';
		$src    = ($this->values[$this->ordering_field] == $this->determineMaxOrderingValue()) ? str_replace('.gif', '_na.gif', $down_image) : $down_image;
		if ($this->values[$this->ordering_field] == $this->determineMaxOrderingValue()) {
            $onclick = 'return false;';
        } else {
			$onclick = "reorder('" . $ajax . '?type=' . get_class($this) . "', '" . $this->primary_key_value . "', this, " . ($this->values[$this->ordering_field] + 1) . ", " . $this->determineMaxOrderingValue() . ", 'down'); return false;";
        }
        
        echo '<a href="#" onclick="' . $onclick . '"><img src="' . $src . '" alt="' . $alt . '" title="' . $alt . '" /></a>';
    }
    
    
    /**
	 * Displays a select box for the ordering field
	 * 
	 * @since  3.0.0
	 * 
	 * @param  void
	 * @return void
	 */
    public function printOrderingSelectBox()
    {
		$this->determineOrderingFields(); 
        echo "<select name=\"" . $this->ordering_field . "\">\n";
		$max_ordering_value = $this->determineMaxOrderingValue();
    	if (!$this->existing) {
    		$max_ordering_value++;	
		}
		
		$code = '$current_value = $this->get' . $this->camelCase($this->ordering_field, TRUE) . '();';
		eval($code);
		if (empty($current_value)) {
		 	$current_value = $max_ordering_value;
		} 
		
		for ($i=1; $i<=$max_ordering_value; $i++) {
			echo "\t<option value=\"" . $i . "\"";
			echo ($current_value == $i) ? ' selected="selected"' : '';
			echo ">" . $i . "</option>\n";	
		}
    	echo "</select>\n";	    
    }
    
    
    /**
	 * Determines the ordering field info
     * 
     * @since  3.0.0
     * 
     * @param  boolean $throw_exception  If an exception should be thrown if no ordering field exists
     * @return void
     */
	protected function determineOrderingFields($throw_exception=TRUE)
    {
        if (!$this->loadFromCache(array('ordering_field', 'other_ordering_fields'))) {
            foreach ($this->field_options as $field => $options) {
                if (isset($options['ordering'])) {
                    $this->ordering_field = $field;
                    break;
                }   
            }
            if (!empty($this->ordering_field)) {
                foreach ($this->unique_keys as $constraint => $fields) {
                    if (in_array($this->ordering_field, $fields)) {
                        $this->other_ordering_fields = array_merge(array_diff($fields, array($this->ordering_field)));
                        break;   
                    }
                }   
            }
            $this->saveToCache(array('ordering_field', 'other_ordering_fields'));
        } 
        if ($throw_exception && empty($this->ordering_field)) {
            throw new FatalException('No field has the ordering field option set');    
        }   
    }
    
    
    /**
	 * Determines the max order value
     * 
     * @since  3.0.0
     * 
     * @param  void
     * @return void
     */
	public function determineMaxOrderingValue()
    {
		$this->determineOrderingFields(); 
        if (!isset($this->max_ordering_value)) {
			// Determine how many items we are dealing with
			$this->determineOrderingWhereData();
            $this->max_ordering_value = $this->Database->simpleSelect('max(' . $this->ordering_field . ')', $this->database_table, $this->where_field, $this->where_value); 
            if (empty($this->max_ordering_value)) {
            	$this->max_ordering_value = 0;	
			}
        }  
        return $this->max_ordering_value;
    }
    
    
    /**
     * Creates where clause data for order queries
     * 
     * @since  3.0.0
     * 
     * @param  void
     * @return array  The 0 element is all of the ordering fields and all of the values except for the last ordering field, the 1 element is the value for the last ordering field
     */
	protected function determineOrderingWhereData()
    {
        $this->determineOrderingFields(); 
        if (empty($this->ordering_field)) {
            throw new FatalException('No field has the ordering field option set');     
        }
        
        if (!isset($this->where_field) || !isset($this->where_value)) {
            $where_field = '';
            if (sizeof($this->other_ordering_fields) > 1) {
                $other_fields = array_slice($this->other_ordering_fields, 1);
                foreach ($other_fields as $other_field) {
                    $where_field .= $other_field . ' = ';
                    if ($this->field_info[$other_field]['type'] == 'boolean') {
                        $where_field .= ($this->values[$other_field]) ? "TRUE" : "FALSE"; 
                        $where_field .= " AND ";
                    } else {
                        $where_field .= "'" . addslashes($this->values[$other_field]) . "' AND ";
                    }              
                }
                $where_field .= $this->other_ordering_fields[0];
                $where_value = $this->values[$this->other_ordering_fields[0]];
            
            } elseif (sizeof($this->other_ordering_fields) == 1) {
                $where_field = $this->other_ordering_fields[0];
                if ($this->field_info[$where_field]['type'] == 'boolean') {
                    $where_value = ($this->values[$where_field]) ? "TRUE" : "FALSE"; 
                } else {
                    $where_value = addslashes($this->values[$where_field]);
                } 
                
            } else {
                $where_field = '1';
                $where_value = 1;
            } 
            
            $this->where_field = $where_field;
            $this->where_value = $where_value;
        }

        return TRUE;  
    }
    
    
    
    /* ------------------------------------------------- */
    /* DATA VALIDATION/STANDARDIZATION
    /* ------------------------------------------------- */
    
    
    /**
     * Cleans a field value based on the field type, empty values become NULL
     *
     * @since  1.0.0
     * 
     * @param  string $field  The field the value is going to be stored in
     * @param  mixed $value   The value to standardize
     * @return string  The standardized value
     */
    protected function standardizeValue($field, $value)
    {
	    if (is_string($value)) { $value = trim($value); }
		$type = $this->field_info[$field]['type'];
        
	    // Set empty values to NULL
        if ($type == 'boolean' && empty($value) && $value !== FALSE) {
		    return NULL;    
	    } elseif ($type == 'integer' || $type == 'float' || $type == 'date' || $type == 'datetime' || $type == 'time') {
            if ($value === '' || $value === NULL) {
                return NULL;
            }   
        } elseif (($type == 'text' || $type == 'enum' || $type == 'varchar') && empty($value) && $value !== '0' && $value !== 0) {
			return NULL;	
		}
        
        // Handle values that are supposed to become dates
        if ($type == 'date' || $type == 'datetime') {
            // Fix short dates where the year is before 1970
            if ($this->field_info[$field]['type'] == 'date' || $this->field_info[$field]['type'] == 'datetime') {
                if (preg_match('#^(\d{1,2}/\d{1,2}/)(\d{2})((?!\d)..*)?$#', trim($value), $matches)) {
                    if ($matches[2] > date('y', strtotime('+5 years'))) {
                        $value = $matches[1] . '19' . $matches[2];
                        if (isset($matches[3])) {
                            $value .= $matches[3];   
                        }
                    }        
                }    
            }
            
            $new_value = convert_date($value, 'mysqli_datetime');
            // If we can't standardize the date let the validator catch it
            if ($new_value === NULL) {
                return $value;
            }       
            return $new_value;
        } 
        
        // Handle time values
        if ($type == 'time') {
            $new_value = strtotime($value);
            if (!empty($new_value)) {
                $new_value = date('H:i:s', $new_value);
            } else {
                // If we can't standardize the time let the validator catch it
                return $value;
            }        
            return $new_value;
        }
        
        // Handle money values
        if ($type == 'float' && isset($this->field_options[$field]['money'])) {
            if (empty($value)) {
                return '0.00';   
            }
            return str_replace(array(',','$'), '', $value);     
        }
        
        // Strings can be cleaned up
	    if (is_string($value)) {
		    if (isset($this->field_options[$field]['xhtml'])) {
			    //return html_entity_decode($value, FALSE);
				return xhtmlify($value, FALSE);
		    }
			return cleanup($value, TRUE);    
        }    
        // Other values just pass through
        return $value;    
    }

    
    /**
     * Takes a field from the $_REQUEST array and cleans it based on the field type
     * 
     * @since  1.0.0
     * 
     * @param  string $field   The field to grab from the $_REQUEST array
     * @param  boolean $array  If the value should be treated like an array (will split on commas if found)
     * @return void
     */
    protected function requestValue($field, $array=FALSE)
    {
        if ($array) {
            if (isset($_REQUEST[$field])) {
                if (is_string($_REQUEST[$field]) && strpos($_REQUEST[$field], ',') !== FALSE) {
                    $value = array_map('trim', explode(',', $_REQUEST[$field]));
                    $value = array_merge(array_filter($value));    
                } else {
                    $value = $_REQUEST[$field];
                    settype($value, 'array');
                }
                if (get_magic_quotes_gpc()) {
                    $value = array_map('stripslashes', $value);
                }
                return $value;
            }
            return array();      
        }
        
        if ($this->field_info[$field]['type'] == 'boolean') {
		    if (isset($_REQUEST[$field])) {
			    $value = strtolower($_REQUEST[$field]);
			    if ($value == 'false' || $value == 'f' || !$value) {
				    return FALSE;
			    }
                return TRUE;
		    }
            return FALSE;	
	    } else {
		    if (isset($_REQUEST[$field])) {
			    $value = $_REQUEST[$field];
			    if (get_magic_quotes_gpc()) {
				    $value = stripslashes($value);
			    }
			    return $value;
		    }
            return NULL;
        }
    }
    
    
    /**
	 * Checks a value against the database, sets an error if value does not validate
	 * 
	 * @since  1.0.0
	 * 
	 * @param  string $field  The name of the field
     * @param  mixed $value   The value to validate
	 * @return boolean  If the value validated
	 */
	protected function validateDatabase($field, $value) 
	{
        // Check normal database validation
		$this->Validator->resetError();
		$success = $this->Validator->validateDatabase($this->Database, $this->database_table, $field, $value);
     	if (!$success) {
			$is_up = isset($this->field_options[$field]['file_upload']);
			$error = $this->Validator->getError(TRUE);
			
			if (!$is_up || ($is_up && strpos($error, 'needs to have a value') === FALSE)) {
     			$this->error .= $error;
     			$this->Validator->resetError();
				return FALSE;
     		}
     	}
        
        // Handle fields with unique constraints
        if (isset($this->field_info[$field]['unique'])) {
            if ($this->existing) {
                $where_field = $this->primary_key_field . " <> '" . addslashes($this->primary_key_value) . "' AND " . $field;
            } else {
                $where_field = $field;    
            }    
			foreach($this->unique_keys as $unique_constraint) {
				
				// Handle unique constraints with multiple fields
				if (in_array($field, $unique_constraint) && sizeof($unique_constraint) > 1) {
					foreach($unique_constraint as $field_name) {
						
						
																	
						// If there is a value to check, check it
						if (isset($this->values[$field_name]) && $this->values[$field_name] !== NULL) {
						    $where_sql .= " AND " . $field_name . " = '" . $this->values[$field_name] . "'";
						// Otherwise if there is a default, check it
						} elseif (!empty($this->field_info[$field_name]['default']) || $this->field_info[$field_name]['default'] === 0 || $this->field_info[$field_name]['default'] === '0') {
							$where_sql .= " AND " . $field_name . " = DEFAULT";
						} else {
							$where_sql .= " AND " . $field_name . " IS NULL";	
						}
					}
					$sql = "SELECT " . $field . " FROM " . $this->database_table . " WHERE 1 = 1" . $where_sql;
					$result = $this->Database->query($sql);
					$exists = $this->Database->numRows($result);
					if ($exists && !$this->existing) {
						$error_string = "The values specified for " . implode(", ", array_map(array($this, 'wordify'), $unique_constraint)) . " already exists in the database\n";
						if (strpos($this->error, $error_string) === FALSE) {
							$this->error .= $error_string;
						}
						return FALSE;	
					}

				} elseif (in_array($field, $unique_constraint)) {
					// Make sure we generate a unique random string or value for unique fields
					if (isset($this->field_options[$field]['random_alphanumeric']) || isset($this->field_options[$field]['random_numeric'])) {
						$generate = FALSE;
						do {
							if ($generate) {
								$value = $this->generateValue($field);	
							}
							$exists = $this->Database->simpleSelect($field, $this->database_table, $where_field, addslashes($value));		
							$generate = TRUE;
						} while ($exists);
						$this->values[$field] = $value; 
					
					// Check and make sure this single field unique constraint is valid
					} else {
						$exists = $this->Database->simpleSelect($field, $this->database_table, $where_field, addslashes($value));
						if ($exists) {
							$this->error .= "The value specified for " . $this->wordify($field) . " already exists in the database\n";
							return FALSE;   
						}
					}
				}
			}
		}
			
		// Handle fields with regex constraints
		if (isset($this->field_info[$field]['regex'])) {
            if (!preg_match($this->field_info[$field]['regex'], $value)) {
                if (isset($this->field_options[$field]['regex_constraint_message'])) {
                    $this->error .= $this->field_options[$field]['regex_constraint_message'] . "\n";
                } else {
                    $this->error .= $this->wordify($field) . ": The value specified contains invalid characters\n";
                }
                return FALSE;   
            }
        }
        
     	return TRUE;   
	}
    
    
    /**
	 * Allows validation of aggregate of fields, requires one field has a value, can stipulate at most one field has a value
	 * 
	 * @since  1.0.0
	 * 
	 * @param  boolean $only_one   If there should be at most one field with a value 
     * @param  array $fields       The fields to validate    
	 * @return boolean  If the values validated
	 */
	protected function validateMultiple($only_one, $fields) 
	{
		try {
            $one_found = FALSE;
            if ($only_one) {
                foreach ($fields as $field) {
                    if (!empty($this->values[$field])) {
                        if ($one_found) {
                            throw new Exception();
                        }
                        $one_found = TRUE;
                    }
                }
				
				if (!$one_found) {
					throw new Exception();
				}
                return TRUE;
                
            } else {
                foreach ($fields as $field) {
                    if (!empty($this->values[$field])) {
                        return TRUE;
                    }    
                }
                throw new Exception();
            }  
        } catch (Exception $e) {
            if ($only_one) {
				$this->error .= "Please enter one of the following: " . join(", ", $this->wordify($fields)) . "\n";
			} else {
                $this->error .= "Please enter at least one of the following: " . join(", ", $this->wordify($fields)) . "\n";
            }
            return FALSE;    
        }
	}
	
	/**
	 * Allows conditional validation
	 * 
	 * @since  2.8.0
	 * 
	 * @param  string $field            The field to cause the validation to occur
	 * @param  mixed  $required_fields  The field(s) that are conditionally required
	 * @param  mixed  $values           The value(s) that $field should be set to before validation occurs 
	 * @return boolean  If the values validated
	 */
	protected function validateConditional($field, $required_fields, $values=array()) 
	{
		settype($required_fields, 'array');
		settype($values, 'array');
		
		if ((!empty($values) && in_array($this->values[$field], $values)) || (empty($values) && $this->values[$field] !== NULL)) {
			foreach ($required_fields as $required_field) {
				if ($this->values[$required_field] === NULL && !preg_match('#^' . $required_field . ' needs to have a value$#i', $this->error)) {
					$this->error .= $this->wordify($required_field) . " needs to have a value\n";			
				}
			}	
		}	
	}
}
?>