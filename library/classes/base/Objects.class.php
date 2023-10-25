<?php
/**
 * Objects - A dynamic class initializer. Classes are initialized when called using preset constructor arguments.
 *        
 * Copyright 2006, iMarc <info@imarc.net>
 *
 * @version  2.0.0
 *
 * @author   William Bond [wb] <will@imarc.net>
 * 
 * @changes  2.0.0  Changed class to a singleton [wb, 2007-05-25]
 * @changes  1.1.1  added isset() to _get() method to prevent getting undefined variable notice [pm, 2006-09-25]
 * @changes  1.1.0  Allow aliasing of class names (for instance to extend a class but have all other code reference it like the base class) [wb, 2006-09-22]
 * @changes  1.0.0  Initial implementation [wb, 2006-07-20]
 *
 * @property Inflector $Inflector
 * @property Database $Database
 * @property Session $Session
 * @property Validator $Validator
 * @property Cache $Cache
 * @property FileUpload $FileUpload
 */
class Objects
{

	/**
	 * Current file version
	 * 
	 * @var array
	 */
	private $version = '2.0.0';
	
	/**
	 * Object constructor arguments
	 * 
	 * @var array
	 */
	private $object_arguments;
    
    /**
	 * Other objects
	 * 
	 * @var array
	 */
	private $objects;
    
	/**
	 * Other aliases
	 * 
	 * @var array
	 */
	private $aliases = array();
	
	/**
	 * The singleton
	 * 
	 * @var object
	 */
	private static $instance;		
	
	
	/**
	 * Constructor;
	 * 
	 * @since 1.0.0
	 * 
	 * @param  void
	 * @return void
	 */
	private function __construct() 
	{
	}
	
	
	/**
	 * Create a singleton of the object
	 * 
	 * @since 1.0.0
	 * 
	 * @param  void
	 * @return object  The singleton of this class
	 */
	public static function getInstance()
	{
		if (!isset(self::$instance)) {
			self::$instance = new Objects();
		}
		return self::$instance;
	}
	
	
	/**
	 * Returns version number
	 * 
	 * @access public
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
     * Sets an alias for a class name
     * 
     * @access public
     * @since  1.1.0
     * 
     * @param  string class_name  The name of the configured class
     * @param  string alias       The class name to interpret as the actual class
     * @return void
     */
    public function setAlias($class_name, $alias)
    {
	    $this->aliases[$alias] = $class_name;            
    }
    
    
    /**
     * Sets the constructor arguments for a specific class
     * 
     * @access public
     * @since  1.0.0
     * 
     * @param  string class_name  The name of the class
     * @return void
     */
    public function configureClass($class_name)
    {        
        $this->object_arguments[$class_name] = array();
        $arguments = func_get_args();
        $trash = array_shift($arguments);
        foreach ($arguments as $argument) {
            $this->object_arguments[$class_name][] = $argument;
        }            
    }
    
    
    /**
     * Return an object of the class specified, initializes the class if neccesary
     * 
     * @access private
     * @since  1.0.0
     * 
     * @param  string class_name  The name of the class
     * @return void
     */
    public function __get($class_name)
    {
        // Check for an alias
        if (isset($this->aliases[$class_name])) {
            $class_name = $this->aliases[$class_name];
        }
        
        // The object has been initialized
        if (isset($this->objects[$class_name]) && is_object($this->objects[$class_name])) {
            return $this->objects[$class_name];    
        
        // The object has not been initialized yet
        } elseif (isset($this->object_arguments[$class_name])) {
            // Initialize the object
            $code  = '$this->objects[$class_name] = new $class_name(';
            $arguments = sizeof($this->object_arguments[$class_name]);
            for ($i=0; $i < $arguments; $i++) {
                $code .= ($i != 0) ? ', ' : '';
                $code .= '$this->object_arguments[$class_name][' . $i . ']';
            }
            $code .= ');';
            
            eval($code);
            
            return $this->objects[$class_name];
        
        // We don't know how to initialize the object
        } else {
            die('No constructor arguments have been specified for the class ' . $class_name);    
        }
    }

}
?>