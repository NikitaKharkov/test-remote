<?php
/**
 * ValidationException - Creates an exception that will include a validation header when printed and will print in the order specified
 *        
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @version  1.0.1
 *
 * @author   William Bond [wb] <will@imarc.net>
 * 
 * @changes  1.0.1  Fixed bug with ordered messages [wb, 2007-05-04]
 * @changes  1.0.0  Initial implementation [wb, 2007-03-14]
 */
class ValidationException extends StandardException
{
	/**
     * Prints the message using a validation header and an unordered list, optionally sending field names in as parameters to control the order of the fields in the message
     * 
     * @since  1.0.1
     * 
     * @param  string $field_1  This field would show up first in the message
     * @param  string $field_2  This field would show up seconds in the message, etc
     * @return void
     */
    public function printMessage() 
    {
        $backup_message = $this->message;
        
        $args = func_get_args();
        if (sizeof($args) > 0) {
            
            $messages = array_merge(array_filter(explode("\n", $backup_message)));
            $new_messages = array();
            $found = array();
            
            foreach ($args as $field) {
                // Wordify the field
                $field = preg_replace('/([^\w\']id($|[^\w\'])|(^|[^\w\'])[\w\'])/e', 'strtoupper("\1")', str_replace('_', ' ', $field));
                for ($i = sizeof($messages)-1; $i >= 0; $i--) {
                    if (strpos($messages[$i], $field) === 0) {
                        array_push($new_messages, $messages[$i]);
                        $found[$i] = TRUE;
                    }            
                }
            }
            
            for ($i = sizeof($messages)-1; $i >= 0; $i--) {
                if (!isset($found[$i])) {
                    array_unshift($new_messages, $messages[$i]);
                    $found[$i] = TRUE;
                }            
            }
            
            $message = join("\n", $new_messages);
        } else {
            $message = $backup_message;   
        }
        
        $message = str_replace(' ID', '', $message);
        $messages = array_merge(array_filter(explode("\n", $message)));
        
        $this->message = "<strong>The following items did not validate:</strong><br />";
        $this->message .= "<ul>\n<li>" . join("</li>\n<li>", $messages) . "</li>\n</ul>";
        
        parent::printMessage();
        
        $this->message = $backup_message;
    }
}
        	
?>