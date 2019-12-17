<?php
    function loginCheck(){
        require_once('../be/path.inc');
        require_once('../be/get_host_info.inc');
        require_once('../be/rabbitMQLib.inc');
        
        $delay = 3;

        $client = new rabbitMQClient("testRabbitMQ.ini","testServer");
        //check if authenticated
        $request = array();
        $request['type']        = "validate_session";
        $request['sessionId']    = $_SESSION['logged'];
        $request['message']     = "validate_session";
        $sessionCheck = $client->send_request($request);
        //$sessionCheck = $client->publish($request);
        if ($sessionCheck != 1){
            redirect("<span style=\"color:red;\">Not Logged In...Redirecting...</span>", "index.html", $delay);
            exit(0);
        }
    }

    function redirect($message, $targetfile, $delay){
        echo $message;
        
        header("refresh: $delay, url = $targetfile");
        
        exit();
    }

    function notifyUsers($users, $title, $message){
        $subj = "CineRex: Movie Updates";
        $body = "Hello,\n $title $message";
        $headers = 'From: webmaster@cinerex.com' . "\r\n" .
            'Reply-To: webmaster@cinerex.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        
        foreach($users as $u){
            echo"
            <script>
                alert(\"$u\");
                window.location.replace('notifications.php');
            </script>";
            mail($u, $subj, $body, $headers);
        }
        
    }
?>