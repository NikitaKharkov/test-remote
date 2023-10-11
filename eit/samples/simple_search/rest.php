<?php
/**
* This DataService class uses PHP's cURL to connect to the
*  EBSCOhost Web Service.  The methods are as follows:
*     - DataService->connect( _service_url )
*          This function initializes the class with the URL of the data
*          service.
*     - DataService->send( command, parameters[ name=>value ] )
*          This function sends a command using the HTTP GET protocol.
*          The parameters are appended onto the service URL.
*     - DataService->recieve()
*     	   This function returns the output from the web service call.
*
* PHP version 5
*
* LICENSE: This source file is subject to version 3.01 of the PHP license
* that is available through the world-wide-web at the following URI:
* http://www.php.net/license/3_01.txt.  If you did not receive a copy of
* the PHP License and are unable to obtain it through the web, please
* send a note to license@php.net so we can mail you a copy immediately.
*
* @category  Simple_Search
* @package   PackageName
* @author    EBSCO Publishing's <author@example.com>
* @author    Persistent System Limited <minal@persistent.co.in>
* @copyright 1997-2005 The PHP Group
* @license   http://www.php.net/license/3_01.txt  PHP License 3.01
* @link      http://pear.php.net/package/PackageName
*/		   	 

class DataService
{
    private $_service_url;    // Holds the URL of the service
    private $_response;		 // Holds the _response of a service call
    
    public function DataService() 
    {
    }
    
    /**
    *This function initializes the class with the URL of the data
    *service.
    *
    *@param string $u_service_url URL of the data service sent by the calling script 
    *
    *@return Does not return anything
    *
    */
    public function connect( $u_service_url )
    {
        //Sets the URL for the current intitiated object
        $this->_service_url = $u_service_url; 
    }
    
    /**
    *Sends a command. If the web service is located at
    *http://example.com/service.aspx/ , the command 'Info' would
    *would look as follows:
    *http://example.com/service.aspx/Info?param1=value&param2=value
    *
    *@param string $command Method to call from webservice
    *
    *@param array  $params  Parameters to append to call the service
    *
    *@return Does not return anything
    *    
    */
    public function send( $command, $params )
    {
        $send_url = $this->_service_url;
        $send_url .= $command; //append the Method name to the service URL
        //append the parameters needed for the result to the service URL
        if ( $params != null ) {
            foreach ( $params as $key => $value ) {
                $delimiter = (preg_match('/\?/', $send_url)) ? '&' : '?';
                $send_url .= $delimiter . $key . '=' . $value;
            }
        }
        
        // Create a cURL instance
        $ch = curl_init();
        
        // Set the cURL Parameters
        curl_setopt($ch, CURLOPT_URL, $send_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        //If using a Proxy Server to request the web service add the following cURL parameters.
        /*curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 0);
        curl_setopt($ch, CURLOPT_PROXY, 'http://mycompany.com:8080'); 
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'mycompany\username:password); 
        curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_NTLM);*/
        // Execute the call, and store the results in $xml.
        $xml = curl_exec($ch);
        //echo $xml;
        curl_close($ch); 
        $this->_response = $xml; //Set the response in _response attribute
    }
    /**
    *Send response.Returns the output from the web service call.
    *
    *@return Returns the response received by curl_exec
    *
    */
    public function recieve()
    {
        return $this->_response; //return the response attribute of initiated object which is XML document.
    }
}


?>