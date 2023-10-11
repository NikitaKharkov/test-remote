<?php
/**
 * FatalException - Creates an exception that will include debugging information for developers
 *        
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @version  1.0.0
 *
 * @author   William Bond [wb] <will@imarc.net>
 * 
 * @changes  1.0.0  Initial implementation [wb, 2007-03-09]
 */
class FatalException extends StandardException
{
	/**
	 * Constructor;
	 * 
	 * @since  1.0.0
	 * 
	 * @param  string $message  The exception message
	 * @param  integer $code    The exception code
	 * @return void
	 */
	public function __construct($message=NULL, $code=0) 
	{
		if ($message === NULL) { $message = $this->message; }
		$message = format_backtrace(TRUE) . "\n" . $message;
        parent::__construct($message, $code);
	}
}
        	
?>