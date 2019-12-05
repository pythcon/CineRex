#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('login.php.inc');
require_once('logging.php');


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

//Validate Session
function doValidate($sessionLogged){
    return $sessionLogged;
    //returns false if registration fails
}

//Like a movie
function doAddLikedMovie($email, $title){
    $login = new loginDB();
    return $login->likeMovie($email, $title);
}

//Dislike a movie
function doAddDislikedMovie($email, $title){
    $login = new loginDB();
    return $login->dislikeMovie($email, $title);
}

//get likes
function doGetLikes($email){
    $login = new loginDB();
    //echo $login->getLikes($email);
    return $login->getLikes($email);
}

//get dislikes
function doGetDislikes($email){
    $login = new loginDB();
    return $login->getDislikes($email);
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
    case "like":
        return doAddLikedMovie($request['email'], $request['title']);
    case "dislike":
        return doAddDislikedMovie($request['email'], $request['title']);
    case "getLikes":
        return doGetLikes($request['email']);
    case "getDislikes":
        return doGetDislikes($request['email']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>

