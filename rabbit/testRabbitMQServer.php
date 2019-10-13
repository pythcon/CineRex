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
    $login = new loginDB();
    return $login->validateLogin($username,$password);
    //return false if not valid
}

//REGISTRATION
function doRegister($username, $password, $firstName, $lastName){
    $login = new loginDB();
    return $login->register($username,$password, $firstName, $lastName);
    //returns false if registration fails
}

//Password Change
function doChangePassword($username, $password){
    $login = new loginDB();
    return $login->changePassword($username, $password);
    //returns false if registration fails
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
    case "login":
      return doLogin($request['email'],$request['password']);
    case "registration":
      return doRegister($request['email'],$request['password'],$request['firstName'],$request['lastName']);
    case "changepassword":
      return doChangePassword($request['email'],$request['password']);
    case "validate_session":
      return doValidate($request['sessionId']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>

