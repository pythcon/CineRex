<?php


if (!isset($_POST))
{
	$msg = "NO POST MESSAGE SET, POLITELY FUCK OFF";
	echo json_encode($msg);
	exit(0);
}
$request = $_POST;
$response = "unsupported request type, politely FUCK OFF";
switch ($request["type"])
{
	case "login":
		$response = "";
		$response .= "login, yeah we can do that";


		require_once('path.inc');
                require_once('get_host_info.inc');
                require_once('rabbitMQLib.inc');

                $client = new rabbitMQClient("testRabbitMQ.ini","testServer");

                $request = array();
                $request['type'] = "login";
                $request['username'] = $_POST['uname'];
                $request['password'] = $_POST['pword'];
                $request['message'] = "hello";
                $response2 = $client->send_request($request);
                $response2 = $client->publish($request);

		$response .= " ".$response2;
                echo json_encode($response);
                echo "\n\n";
	break;
}

exit(0);

?>
