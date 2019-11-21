<?php
    session_start();
    include("usefulfunctions.php");

    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($password != $password2){
        echo"
        <script>
            alert(\"Passwords do not match.\");
            window.location.replace(\"index.html\");
        </script>";
        exit(0);
    }

    require_once('../be/path.inc');
    require_once('../be/get_host_info.inc');
    require_once('../be/rabbitMQLib.inc');


    $client = new rabbitMQClient("testRabbitMQ.ini","testServer");

    $request = array();
    $request['type']        = "registration";
    $request['email']       = $_POST['email'];
    $request['password']    = md5($password);
    $request['firstName']   = $_POST['firstName'];
    $request['lastName']    = $_POST['lastName'];
    $request['message']     = "registration";
    //$loginCheck = $client->send_request($request);
    $registrationCheck = $client->publish($request);

    if ($registrationCheck == 1){
        redirect("Successfully Created Account! Please Log in. Redirecting now...", "index.html", 3);
    }else{
        redirect("Account Creation Failed. Please try again. Redirecting...", "index.html", 3);
    }

?>
    