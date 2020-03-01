<?php
   $username = 'dd';
   $password = 'ee';
   $FIM_endpoint = 'https://fim.api.eu.fleetmatics.com/token';

   //Call method and set variable to authorization string
   $token = get_token($FIM_endpoint, $username, $password);

   echo $token;

   function get_token($url, $username, $password)
   {
      //Create necessary headers for REST call
      $headers = array();
      $headers[] = make_authorization_header($username, $password);    //Send to function to Base64 encode
      $headers[] = 'Accept: text/plain';                               //Authorization token comes back as plain text
   
      $session = curl_init($url);                             //Initialize transfer with URL
      curl_setopt($session, CURLOPT_HEADER, false);           //Exclude header info in response
      curl_setopt($session, CURLOPT_RETURNTRANSFER, true);    //Return transfer as a string of the return value of curl_exec()
      curl_setopt($session, CURLOPT_HTTPHEADER, $headers);    //Pass in headers
	
      //Execute transfer of $session
      $response = curl_exec($session); 

      //Get http code outcome of the #session transfer	  
      $http_code = curl_getinfo($session, CURLINFO_HTTP_CODE);

      //Measure false response/error	  	  
      if($response === false)
      {
         echo 'Error: '. curl_error($session);
      }
	  
      //ALWAYS close transfer connection 	  	
      curl_close($session);

      //Evaluate variable for non 200(OK) http code	  	  
      if($http_code !== 200)
      {
         echo 'Error: Http Status Code returned '.$http_code;
      }    
   
      return $response;    
   }
   
   function make_authorization_header($username, $password)
   {
      //Base64 encode username:password; note: the ':' must be present between them	  
      $encodedString = base64_encode($username.':'.$password);
	  
      //Return concatenated Authorization string	  
      return 'Authorization: Basic '.$encodedString;
   }
?>