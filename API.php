<?php
sleep (2.5);
$zip=$_GET["zip"];
$url = "http://www.omdbapi.com/?i=tt3896198&apikey=92e1a0bb&t=$zip"; 

$fp = fopen ( $url , "r" ); 
$contents = "";
while ( $more = fread ( $fp, 1000  ) ) {      $contents .=  $more ;   }
echo $contents ;  

?>