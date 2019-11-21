<?php
    session_start();
    include("usefulfunctions.php");
    require_once('../be/path.inc');
    require_once('../be/get_host_info.inc');
    require_once('../be/rabbitMQLib.inc');

    sleep (1);

    $client = new rabbitMQClient("testRabbitMQ.ini","testServer");

    $request = array();
    $request['type']        = "like";
    $request['email']       = $_SESSION['email'];
    $request['title']       = $_GET['movieTitle'];
    $request['message']     = "registration";
    //$loginCheck = $client->send_request($request);
    $registrationCheck = $client->publish($request);
?>