<?php
    function loginCheck(){
        //check if authenticated
        $request = array();
        $request['type']        = "validate_session";
        $request['sessionId']    = session_id();
        $request['message']     = "validate_session";
        //$loginCheck = $client->send_request($request);
        $sessionCheck = $client->publish($request);
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
?>