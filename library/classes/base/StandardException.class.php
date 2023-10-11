<?php
/**
 * StandardException - Creates an exception with a printing functionality
 *        
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @version  1.1.0
 *
 * @author   William Bond [wb] <will@imarc.net>
 * 
 * @changes  1.1.0  Added setMessage() [wb, 2007-08-17]
 * @changes  1.0.0  Initial implementation [wb, 2007-03-09]
 */
class StandardException extends Exception
{
	/**
	 * Prints the message using the class variable $this->css_class for the css class. If $this->css_class has not been defined, the underscore notation version of the classname will be used
	 * 
	 * @since  1.0.0
	 * 
	 * @param  void
	 * @return void
	 */
	public function printMessage() 
	{
		$css_class = strtolower(preg_replace(array("/([a-z0-9])([A-Z])/", "/([a-z])([A-Z0-9])/"), '\1_\2', get_class($this)));
		echo '<div class="exception ' . $css_class . '">' . smart_nl2br($this->getMessage()) . '</div>';
	}
	
	
	/**
	 * Lets you override the default message with a custom one
	 * 
	 * @since  1.1.0
	 * 
	 * @param  string $message  The new message
	 * @return void
	 */
	public function setMessage($message) 
	{
		$this->message = $message;
	}
}
        	
?>