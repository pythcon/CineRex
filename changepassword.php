<!------------------------------AUTHENTICATION----------------------->
<?php
    session_set_cookie_params(600);
    session_start();
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    ini_set('display_errors' , 1);

    //check if authenticated
    loginCheck(); 
?>
<!------------------------------------------------------------------->
<!------------------------------AUTHENTICATION----------------------->
        <?php
            session_start();
            error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
            ini_set('display_errors' , 1);
            require_once('rabbit/path.inc');
            require_once('rabbit/get_host_info.inc');
            require_once('rabbit/rabbitMQLib.inc');

            $pass = $_POST['password1'];
            $pass2 = $_POST['password2'];
            
            if ($pass != $pass2){
                echo "
                <script>
                    alert(\"Password don't match. Please re-enter a new password.\");
                    window.location.replace(\"changepassword.php\");
                </script>
                ";
                die();
            }
            if (strlen($pass) < 6){
                echo "
                <script>
                    alert(\"Password must be at least 6 characters. Please re-enter a new password.\");
                    window.location.replace(\"changepassword.php\");
                </script>
                ";
                die();
            }
            $bad = false;
            if (!isset ($pass) || !isset ($pass2)){
                $bad = true;
            }
            if ($pass == "" || $pass2 == ""){
                $bad = true;
            }
            if ($bad){
                echo "
                <script>
                    alert(\"Password not valid.\");
                    window.location.replace(\"changepassword.php\");
                </script>
                ";
                die();
            }
            //Successfully passed all tests:
            $email = $_SESSION['email'];
            $pass = md5($pass);
            
            //send to database
            $client = new rabbitMQClient("testRabbitMQ.ini","testServer");

            $request = array();
            $request['type']        = "changepassword";
            $request['email']       = $_POST['email'];
            $request['password']    = $pass;
            $request['message']     = "changepassword";
            //$loginCheck = $client->send_request($request);
            $successfulCheck = $client->publish($request);
            
            if ($successfulCheck != 1){
                die("Somethng went wrong.");
            }
            
            echo"
            <script>
                alert(\"Password Changed. Please log in. \");
                window.location.replace(\"index.html\");
            </script>";
            $_SESSION['logged'] = false;
            session_destroy();
        ?>
<!------------------------------------------------------------------->