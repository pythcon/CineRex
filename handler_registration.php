<?php
    session_start();
    include("usefulfunctions.php");
    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');

    $client = new rabbitMQClient("testRabbitMQ.ini","testServer");

    $request = array();
    $request['type']        = "login";
    $request['email']       = $_POST['email'];
    $request['password']    = $_POST['password'];
    $request['firstName']   = $_POST['firstName'];
    $request['lastName']    = $_POST['lastName'];
    $request['message']     = "login";
    $loginCheck = $client->send_request($request);
    $registrationCheck = $client->publish($request);

    echo "<html><body>";
    //echo "<div>".$loginCheck."</div>";
    if ($registrationCheck == 1){
        echo "<div>Successfully Created Account!</div>";
    }else{
        echo "<div>Account Creation Failed!</div>";
    }

    echo "</body></html>";
    exit(0);

?>
    