<?php

    include("usefulfunctions.php");
    require_once('../dmz/path.inc');
    require_once('../dmz/get_host_info.inc');
    require_once('../dmz/rabbitMQLib.inc');

    $client = new rabbitMQClient("../dmz/testRabbitMQ.ini","APICALL");

    $request = array();
    $request['type'] = "API";
    $request['movieTitle'] = $_GET["movieTitle"];
    $request['message'] = "API";
    $contents = $client->send_request($request);
    //$registrationCheck = $client->publish($request);

    //echo "<div>".$loginCheck."</div>";
    echo $contents;



//without RabbitMQ
/*
$movieTitle=$_GET["movieTitle"];
$url = "http://www.omdbapi.com/?i=tt3896198&apikey=92e1a0bb&t="; //$movieTitle
$url = $url.urlencode($movieTitle);

$fp = fopen ( $url , "r" ); 
$contents = "";
while ( $more = fread ( $fp, 1000  ) ) {      $contents .=  $more ;   }
echo $contents ;  */

?>