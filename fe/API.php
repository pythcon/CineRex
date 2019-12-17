<?php
$movieTitle=$_GET["movieTitle"];
$url = "http://www.omdbapi.com/?i=tt3896198&apikey=92e1a0bb&t="; //$movieTitle
$url = $url.urlencode($movieTitle);

$fp = fopen ( $url , "r" ); 
$contents = "";
while ( $more = fread ( $fp, 1000  ) ) {      $contents .=  $more ;   }
echo $contents ;  

?>