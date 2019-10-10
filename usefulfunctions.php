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
?>