<?php
    session_start();
    include("usefulfunctions.php");
    require_once('rabbit/path.inc');
    require_once('rabbit/get_host_info.inc');
    require_once('rabbit/rabbitMQLib.inc');

    sleep (2.5);

    $client = new rabbitMQClient("testRabbitMQ.ini","testServer");

    $request = array();
    $request['type']        = "dislike";
    $request['email']       = $_SESSION['email'];
    $request['dislike']     = $_GET['movieTitle'];
    $request['message']     = "registration";
    //$loginCheck = $client->send_request($request);
    $registrationCheck = $client->publish($request);
?>