<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function LogMessage($e,$extFile){
	
	$file=__FILE__.PHP_EOL;
	$user= explode("/",$file);
	$string= trim(preg_replace('/\s+', ' ', $extFile));
	
	$loggingmsg= array();
	$loggingmsg['date'] = date("M-d-y");
	$loggingmsg['day'] = date("l");
	$loggingmsg['time']= date("h:i:sa");
	$loggingmsg['user']= $user[2];
	$loggingmsg['text']=$e;
	$loggingmsg['file']= $string;
	
	$message= implode(" - ", $loggingmsg);
	
	error_log($message.PHP_EOL,3,"var/log/error.txt");
}


?>