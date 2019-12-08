<?php
    session_start();
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    ini_set('display_errors' , 1);
    include("usefulfunctions.php");
    require_once('../be/path.inc');
    require_once('../be/get_host_info.inc');
    require_once('../be/rabbitMQLib.inc');

    $client = new rabbitMQClient("be/testRabbitMQ.ini","testServer");

    $request = array();
    $request['type'] = "login";
    $request['email'] = $_POST['email'];
    $request['password'] = md5($_POST['password']);
    $request['message'] = "login";
    $loginCheck = $client->send_request($request);
    //$registrationCheck = $client->publish($request);

    //echo "<div>".$loginCheck."</div>";
    if ($loginCheck == 1){
        $_SESSION['logged'] = true;
        $_SESSION['email'] = $_POST['email'];
        redirect("<span style=\"color:green;\">Successfully Logged in! Redirecting now...</span>", "dashboard.php", 3);
    }else{
        redirect("<span style=\"color:red;\">Login Failed. Please try again. Redirecting...</span>", "index.html", 3);
    }
?>