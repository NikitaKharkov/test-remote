<?php
/**
 * Debugging functions
 *
 * These functions will eventually go into common.php
 */

/**
 * Filters debugging for iMarc computers
 * 
 * @param  void
 * @return boolean  If the debug message should be shown
 */
function debug_filter()
{
    if (in_cidr($_SERVER['REMOTE_ADDR'], '74.211.142.0/26')) {
        return TRUE;
    } 
    return FALSE;    
}


/**
 * Prints debugging information, uses the PRINT_DEBUG_FILTER_FUNCTION constant to optionally call a filtering method in order to show debug messages to certain users
 * 
 * @param  string  $message         A debugging message to print
 * @param  boolean $full_backtrace  If a full backtrace should be shown
 * @param  boolean $return          If the debug info should be returned instead of printed
 * @return void
 */
function print_debug($message, $full_backtrace)
{
    // If an array is passed in we want the contents, not the word 'Array'
    if (is_array($message)) {
        $message = print_r($message, TRUE);    
    }
    
    $message = rtrim('<span class="backtrace">' . format_backtrace($full_backtrace) . '</span>' . "\n" . $message);
    $display = FALSE;
    
    // Lets try to use the debug filtering method if we can
    if (defined('PRINT_DEBUG_FILTER_FUNCTION') && function_exists(PRINT_DEBUG_FILTER_FUNCTION)) {
        $filter_function = PRINT_DEBUG_FILTER_FUNCTION;
        if ($filter_function()) {
            $display = TRUE;
        }    
    } else {
        $display = TRUE;
    }    
    
    // Sometimes we may want to get the debug rather than print it
    if ($display) {
        echo '<pre class="debug">' . $message . '</pre>';    
    }
}


/**
 * Creates a single or multi-line formatted backtrace
 *                                                                      
 * @param  boolean $full_backtrace  If a full backtrace should be created, instead of a single line
 * @return string  The formatted backtrace
 */
function format_backtrace($full_backtrace)
{
    $output = '';
    $bt = debug_backtrace();
    // Make this backtrace work for debug called from a class or a prodecural file
    $func = (isset($bt[1]['function'])) ? $bt[1]['function'] : NULL;
    $func_2 = (isset($bt[2]['function'])) ? $bt[2]['function'] : NULL; 
    $i = ($func == 'print_debug' || $func == 'printDebug' || ($func == '__construct' && strpos($bt[1]['class'], 'Exception') !== FALSE)) ? 1 : 0;
    $i = ($func_2 == 'printDebug' || ($func_2 == '__construct' && strpos($bt[2]['class'], 'Exception') !== FALSE)) ? 2 : $i;
    
    // We always want at least the place the debug was called, but possibly the full backtrace
    do {
        $output_prepend = "\n";
        if ($i < sizeof($bt) - 1 && isset($bt[$i+1]['function'])) {
            if ($bt[$i+1]['function'] == '__call' || $bt[$i+1]['function'] == 'eval') { $i++; continue; }
            $output_prepend = $bt[$i+1]['function'] . '()' . $output_prepend;
        }    
        if ($i < sizeof($bt) - 1 && isset($bt[$i+1]['class'])) {
            $output_prepend = $bt[$i+1]['class'] . $bt[$i+1]['type'] . $output_prepend;
        }
        if (isset($bt[$i]['file'])) {
            $output_prepend = str_replace(" - \n", "\n", $bt[$i]['file'] . '(' . $bt[$i]['line'] . ') : ' . $output_prepend);
        
        // This is for virtual function calls
        } else {
            $output_prepend = str_replace(" - \n", "\n", $bt[$i-1]['file'] . '(' . $bt[$i-1]['line'] . ') : ' . $output_prepend);   
        }
        $output = $output_prepend . $output;
        $i++;
    } while ($i < sizeof($bt) && $full_backtrace);
    
    return trim($output);   
}

?>