<?php
    session_start();
    $_SESSION["logged"] = false;
    session_destroy();
    //redirect
    header("location:index.html");
?>