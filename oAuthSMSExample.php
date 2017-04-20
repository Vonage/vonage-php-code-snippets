<?php


if (php_sapi_name() != 'cli') {
	throw new Exception('Please run this App from the command line.');
}

define('TOKEN', 'oauth_token');
define('SECRET', 'oauth_token_secret');

/*
* A simple driver for OAuth access to Nexmo. 
*/
class nexmoOauthDriver{

	//request, authorize and access compliments $this->oauth_baseurl.
	public $request_string = null;
	public $authorize_string = null;
	public $access_string = null;
	
	//Your Nexmo consumer key and secret. 
	public $consumer_key = null;
	public $consumer_secret = null;

	//URL parameters.
	public $params = null;
	  //the token retrieved using OAuth from Nexmo.
	public $token = null;
	  //All tokens.
	//public $tokens = null;

	//Tracing OAuth access.
	public $authorized = null;
	public $access = null;

	//OAuth object.
	public $oauth = null;
	
	//OAuth tokens.
	//Request.
	public $request_token = null;
	public $request_token_secret = null;

	//Access.
	public $access_token = null;
	public $access_token_secret = null;
	
	//URLS
	public $oauth_baseurl = null;
	public $nexmo_requesturl = null;
	public $response = null;
	
	
	/**
	 * Initiate the driver. 
	 */
	function nexmoOauthDriver(){

		$this->request_string = 'request_token';
		$this->authorize_string = 'authorize';
		$this->access_string = 'access_token';
		
		$this->oauth_baseurl = 'https://dashboard.nexmo.com/oauth/';
			
		/*
		* The consumer key and secret for your App.
		* You find this information in Dashboard.
		*/
		$this->consumer_key = '<YOUR Consumer Key>';
		$this->consumer_secret = '<YOUR Consumer Secret>';

		//Create a new OAuth object using your Nexmo Consumer Key and Consumer Secret
		$this->oauth = new OAuth( $this->consumer_key  , $this->consumer_secret);	
	}
	
	/*
	 * Retrive an OAuth request token and secret, then authorize OAuth access to Nexmo.
	 * You call this function initially to retrieve the access token.
	 * 
	 * Do not retrieve a request after you have an access token. This invalidates the 
	 * access token.   
	 */
	function authorizeOAuthAccessToNexmo()
	{
        try {
			//Retrieve the OAuth token from Nexmo			
        	$this->token = $this->oauth->getRequestToken( $this->oauth_baseurl . $this->request_string  );
        	//Set the local token objects
        	$this->request_token = $this->token[TOKEN];
        	$this->request_token_secret = $this->token[SECRET];
	
		} catch (Exception $e){
			echo $e->getMessage();
			return;
		}
			
		$authorization_url = $this->oauth_baseurl 
			. $this->authorize_string 
			. '?' 
			. http_build_query(array(TOKEN => $this->request_token));
		
		echo "Open the following URL and press Authorize:\n" . $authorization_url  ;
		echo "When you have finished, press any key:\n";
		$enter = trim(fgets(STDIN));
		$this->authorized = true;	
	}
	
	/*
	 * Retrieve an OAuth access token from Nexmo using the request token and key.
	 * You use this token for calls to nexmo until it is revoked. 
	 */
	function getAccessToken()
	{
		if ($this->authorized)
		{
			//Set the OAuth object to the request token retrieved in authorizeOAuthAccessToNexmo.
			$this->oauth->setToken($this->request_token, $this->request_token_secret);
			try{
				//Retrieve an access token.
				$token = $this->oauth->getAccessToken($this->oauth_baseurl . $this->access_string);
				$this->access_token = $this->token[TOKEN];
				$this->access_token_secret = $this->token[SECRET];
				$this->access = true;
			} catch (Exception $e){
				echo $e->getMessage();
				return;
			}
		}
		else
			$this->authorizeOAuthAccessToNexmo();
	}
	
	function setAccessToken()
	{
		$this->access_token = 'af0b7de82e99fa54ec853d0291af5496';
		$this->access_token_secret = '5fbfff8c36a21f3b8a2d3e896831b043';
		$this->access = true;
	}
	
	/*
	 * A base function to make any requests to Nexmo. 
	 */
	function makeRequest( )
	{
		if ($this->access)
		{
			//Set the OAuth object to the access token retrieved in getAccessToken.
			$this->oauth->setToken($this->access_token, $this->access_token_secret);
			try{
		
				$this->oauth->fetch($this->nexmo_requesturl, $this->params, OAUTH_HTTP_METHOD_GET,
								array('Accept' =>  'application/json'));
				$this->response = $this->oauth->getLastResponseInfo();
				
			} catch(Exception $e) {
				echo $e->getMessage();
					return;
			}		
		}
		else 
			$this->getAccessToken();
	}
	
	/*
	 * Returns the response from your requests. Handle the contents of the response 
	 * outside this class.
	 */
	function getResponse()
	{
		return $this->response;
	}
	
	/*
	 * Send an SMS.
	 */
	function sendSMS()
	{   
		$this->params = array('from' => 'NexmoOauth' , 'text' => 'hello from Nexmo', 'to' => 'xxxxxxxxxxx' );
	 	$this->nexmo_requesturl = 'https://rest.nexmo.com/sms/json?';
	 	$this->makeRequest();	 	
	}
	
}	
	
 /*
  * Initiate the driver and send an SMS.
 */
	 
 $nexmoDriver = new nexmoOauthDriver();
 $nexmoDriver->authorizeOAuthAccessToNexmo(); 
 $nexmoDriver->getAccessToken();
 $nexmoDriver->sendSMS();
