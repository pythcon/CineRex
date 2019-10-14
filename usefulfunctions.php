<?php
    function loginCheck(){
        //check if authenticated
        if (!$_SESSION['logged']){
            echo"
            <script>
                alert(\"Not logged in...\");
                window.location.replace(\"/index.html\");
            </script>";
            exit();
        }
    }

    function redirect($message, $targetfile, $delay){
        echo $message;
        
        header("refresh: $delay, url = $targetfile");
        
        exit();
    }
?>