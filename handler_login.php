<?php
    include("usefulfunctions.php");
    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');

    $client = new rabbitMQClient("testRabbitMQ.ini","testServer");

    $request = array();
    $request['type'] = "login";
    $request['email'] = $_POST['email'];
    $request['password'] = $_POST['password'];
    $request['message'] = "login";
    $loginCheck = $client->send_request($request);
    $loginCheck2 = $client->publish($request);

    echo "<html><body>";
    //echo "<div>".$loginCheck."</div>";
    if ($loginCheck == 1){
        echo "<div>Successfully Logged in!</div>";
    }else{
        echo "<div>Login Unsuccessful!</div>";
    }

    echo "</body></html>";
    exit(0);

?>
    

    