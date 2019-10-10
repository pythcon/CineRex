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

    require_once('rabbit/path.inc');
    require_once('rabbit/get_host_info.inc');
    require_once('rabbit/rabbitMQLib.inc');


    $client = new rabbitMQClient("testRabbitMQ.ini","testServer");

    $request = array();
    $request['type']        = "registration";
    $request['email']       = $_POST['email'];
    $request['password']    = $password;
    $request['firstName']   = $_POST['firstName'];
    $request['lastName']    = $_POST['lastName'];
    $request['message']     = "registration";
    $loginCheck = $client->send_request($request);
    $registrationCheck = $client->publish($request);

    echo "<html><body>";
    //echo "<div>".$loginCheck."</div>";
    if ($registrationCheck == 1){
        echo "<div>Successfully Created Account!</div>";
        $_SESSION['logged'] = true;
    }else{
        echo "<div>Account Creation Failed!</div>";
    }

    echo "</body></html>";
    exit(0);

?>
    