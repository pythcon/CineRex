<?php
    session_start();
    include("usefulfunctions.php");
    require_once('../be/path.inc');
    require_once('../be/get_host_info.inc');
    require_once('../be/rabbitMQLib.inc');

    $client = new rabbitMQClient("be/testRabbitMQ.ini","testServer");

    $request = array();
    $request['type'] = "addFriend";
    $request['email'] = $_SESSION['email'];
    $request['friendEmail'] = $_POST['friendName'];
    $request['message'] = "addFriend";
    $friendCheck = $client->send_request($request);
    //$registrationCheck = $client->publish($request);

    //echo "<div>".$loginCheck."</div>";
    if ($friendCheck == 1){
        redirect("<span style=\"color:green;\">Successfully Added Friend! Redirecting now...</span>", "friends.php", 3);
    }else{
        redirect("<span style=\"color:red;\">Adding friend failed. Redirecting...</span>", "profile.php", 3);
    }
?>