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
    $request['password'] = $_POST['password'];
    $request['message'] = "login";
    $loginCheck = $client->send_request($request);
    //$registrationCheck = $client->publish($request);

    //echo "<div>".$loginCheck."</div>";
    if ($loginCheck == 1){
        redirect("Successfully Logged in! Redirecting now...", "dashboard.php", 3);
        $_SESSION['logged'] = true;
    }else{
        redirect("Login Failed. Please try again. Redirecting...", "index.html", 3);
    }
?>