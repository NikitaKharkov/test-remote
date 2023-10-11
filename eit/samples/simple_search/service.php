<?php
/* This DataService class uses PHP's cURL to connect to the
*  EBSCOhost Web Service.  The methods are as follows:
*     - DataService->connect( service_url )
*          This function initializes the class with the URL of the data
*          service.
*     - DataService->send( command, parameters[ name=>value ] )
*          This function sends a command using the HTTP GET protocol.
*          The parameters are appended onto the service URL.
*     - DataService->recieve()
*     	   This function returns the output from the web service call.
*/		   	 

class DataService
{

	private $service_url;    // Holds the URL of the service
	private $response;		 // Holds the response of a service call
	
	public function DataService() {}
	
	// Set the Service URL
	public function connect( $u_service_url )
	{
		$this->service_url = $u_service_url;
	}
	
	// Sends a command. If the web service is located at
	// http://example.com/service.aspx/ , the command 'Info' would
	// would look as follows:
	//	 http://example.com/service.aspx/Info?param1=value&param2=value
	public function send( $command, $params )
	{
		$send_url = $this->service_url;
		
		$send_url .= $command;
		
		if( $params != null )
		{
			foreach( $params as $key => $value )
			{
				$delimiter = ( preg_match( '/\?/', $send_url ) ) ? '&' : '?';
				$send_url .= $delimiter . $key . '=' . $value;
			}
		}
		
		// Create a cURL instance
		$ch = curl_init();
		
		// Set the cURL Parameters
		curl_setopt ($ch, CURLOPT_URL, $send_url );
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 0);
		
		// Execute the call, and store the results.
		$xml = curl_exec($ch);
		
		curl_close($ch); 
		
		$this->response = $xml;
	}
	
	public function recieve()
	{
		return $this->response;
	}
}


?>