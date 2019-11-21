<?php
    session_start();
    include("usefulfunctions.php");
    require_once('rabbit/path.inc');
    require_once('rabbit/get_host_info.inc');
    require_once('rabbit/rabbitMQLib.inc');

    $client = new rabbitMQClient("testRabbitMQ.ini","testServer");

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