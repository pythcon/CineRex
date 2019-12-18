#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('login.php.inc');


function doLogin($username,$password)
{
    // lookup username in databas
    // check password
    $file = __FILE__.PHP_EOL;
	$PathArray= explode("/", $file);
	
	$login = new loginDB();
    LogMessage("A login was attempted", $PathArray[8]);
	return $login->validateLogin($username,$password);
    //return false if not valid
}

//REGISTRATION
function doAPICall($movieTitle){
    $url = "http://www.omdbapi.com/?i=tt3896198&apikey=92e1a0bb&t="; //$movieTitle
    $url = $url.urlencode($movieTitle);

    $fp = fopen ( $url , "r" ); 
    $contents = "";
    while ( $more = fread ( $fp, 1000  ) ) {      $contents .=  $more ;   }
    return $contents ;  
}



function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "API":
        return doAPICall($request['movieTitle']);
    
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>

