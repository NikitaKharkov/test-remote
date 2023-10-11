<?php
/**
 * Cache - A caching class that helps prevent duplicate computation
 *        
 * Copyright 2006, iMarc <info@imarc.net>
 * 
 * @version  2.2.0
 *
 * @author   William Bond [wb] <will@imarc.net>
 * 
 * @changes  2.2.0  Added ability to turn off permanent data file functionality [wb, 2007-03-07]
 * @changes  2.1.0  Changed functionality so cache txt file is only saved when permanent cache data is changed [wb, 2006-12-20]
 * @changes  2.0.0  Added setPermanentData() and getPermanentData() methods - USES A FILESYSTEM FILE TO SAVE PERMANENT DATA - CHECK FILE PATHS BEFORE USING ON A LIVE SITE [wb, 2006-11-02]
 * @changes  1.0.0  Initial implementation [wb, 2006-07-25]
 */
class Cache
{

	/**
	 * Current file version
	 * 
	 * @var array
	 */
	private $version = '2.2.0';
    
    /**
	 * Data cache
	 * 
	 * @var array
	 */
	private $cache = array();
    
    /**
     * Permanent data cache
     * 
     * @var array
     */
    private $permanent_cache = array();
    
    /**
     * The file to use for permanent data storage
     * 
     * @var string
     */
    private $permanent_data_file;
    
    /**
     * Flag to indicate if we need to save permanent data to filesystem
     * 
     * @var boolean
     */
    private $data_changed;
    
    /**
     * If permanent data should be stored in a file
     * 
     * @var boolean
     */
    private $permanent_data_file_enabled;
        
	
	/**
	 * Constructor; loads permanent data
	 * 
	 * @since 1.0.0
	 * 
	 * @param  string $permanent_data_file           The absolute filesystem path to the file to user for permanent data storage, if NULL uses DOCUMENT_ROOT/uploads/cache_class_permanent_data.txt
	 * @param  boolean $permanent_data_file_enabled  If the permanent data file should be used
	 * @return void
	 */
	public function __construct($permanent_data_file=NULL, $permanent_data_file_enabled=TRUE) 
	{
        $this->permanent_data_file_enabled = $permanent_data_file_enabled;
        if ($this->permanent_data_file_enabled) {
	        if (empty($permanent_data_file)) {
	            $permanent_data_file = $_SERVER['DOCUMENT_ROOT'] . '/uploads/cache_class_permanent_storage.txt';    
	        }
	        $this->permanent_data_file = $permanent_data_file;    
	        
	        if (!file_exists($this->permanent_data_file)) {
	            if (!is_writable(dirname($this->permanent_data_file))) {
	                die('The Cache class permanent data file does not exist and the directory is not writable');
	            }    
	        } elseif (!is_writable($this->permanent_data_file)) {
	            die('The Cache class permanent data file is not writable');   
	        } else {
	            $this->permanent_cache = @unserialize(file_get_contents($this->permanent_data_file));
	            if (!$this->permanent_cache) {
	                $this->permanent_cache = array();
	            }    
	        }
	        
	        $this->data_changed = FALSE;
		}
	}
	
	
	/**
	 * Returns version number
	 * 
	 * @since 1.0.0
	 * 
	 * @param  void
	 * @return string $version 
	 */
	public function getVersion() 
	{
        return $this->version;
	}
    
    
    /**
     * Adds data to the cache
     * 
     * @since  1.0.0
     * 
     * @param  string $class_name  The name of the class
     * @param  string $variable    The variable to store
     * @param  string $data        The data to store
     * @return void
     */
    public function setData($class_name, $variable, $data) {
	    if (!isset($this->cache[$class_name])) {
            $this->cache[$class_name] = array();    
        }
        $this->cache[$class_name][$variable] = $data;            
    }
    
    
    /**
     * Gets data from the cache
     * 
     * @since  1.0.0
     * 
     * @param  string $class_name  The name of the class
     * @param  string $variable    The variable to get
     * @return mixed  The cached data, or NULL if doesn't exist
     */
    public function getData($class_name, $variable) {
        if (!isset($this->cache[$class_name]) || !isset($this->cache[$class_name][$variable])) {
            return NULL;  
        }
        return $this->cache[$class_name][$variable];            
    }
    
    
    /**
     * Adds data to the permanent cache
     * 
     * @since  2.0.0
     * 
     * @param  string $class_name  The name of the class
     * @param  string $variable    The variable to store
     * @param  string $data        The data to store
     * @return void
     */
    public function setPermanentData($class_name, $variable, $data) {
        if (!isset($this->permanent_cache[$class_name])) {
            $this->permanent_cache[$class_name] = array();    
        }
        $this->permanent_cache[$class_name][$variable] = $data;
        $this->data_changed = TRUE;            
    }
    
    
    /**
     * Gets data from the permanent cache
     * 
     * @since  2.0.0
     * 
     * @param  string $class_name  The name of the class
     * @param  string $variable    The variable to get
     * @return mixed  The cached data, or NULL if doesn't exist
     */
    public function getPermanentData($class_name, $variable) {
        if (!isset($this->permanent_cache[$class_name]) || !isset($this->permanent_cache[$class_name][$variable])) {
            return NULL;  
        }
        return $this->permanent_cache[$class_name][$variable];            
    }
    
    
    /**
     * Saves permanent data to the disk
     * 
     * @since 2.0.0
     * 
     * @param  void
     * @return void
     */
    public function __destruct()
    {
        if ($this->permanent_data_file && $this->data_changed) {
        	file_put_contents($this->permanent_data_file, serialize($this->permanent_cache));
		}
    }

}
?>
