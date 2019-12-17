<?php
    session_start();
    include("usefulfunctions.php");
    require_once('../be/path.inc');
    require_once('../be/get_host_info.inc');
    require_once('../be/rabbitMQLib.inc');

    $movieTitle = $_POST['notify'];
    $message = $_POST['notifyMessage'];

    $client = new rabbitMQClient("be/testRabbitMQ.ini","testServer");

    $request = array();
    $request['type'] = "getUsersWithMovie";
    $request['movie'] = $movieTitle;
    $request['message'] = "getUsersWithMovie";
    $users = $client->send_request($request);
    //$registrationCheck = $client->publish($request);

    notifyUsers($users, $movieTitle, $message);

    echo"
    <script>
        alert(\"Users Notified.\");
        window.location.replace('notifications.php');
    </script>";
?>