<?php
    session_start();
    include("usefulfunctions.php");
    require_once('../be/path.inc');
    require_once('../be/get_host_info.inc');
    require_once('../be/rabbitMQLib.inc');

    //check to see if user is logged in
    loginCheck();

    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    ini_set('display_errors' , 1);

        $client = new rabbitMQClient("testRabbitMQ.ini","testServer");

        $request = array();
        $request['type'] = "getProfile";
        $request['code'] = $_POST['friendCode'];
        $request['message'] = "getProfile";
        $profileEmail = $client->send_request($request);
        //$likes = $client->publish($request);

?>
<!DOCTYPE html>
<html>
<head>
<style>

table, th, td {
	
	border: 1px solid black;
}



.center {
          display: block;
          margin-left: auto;
          margin-right: auto;
          width: 50%;
        }
	ul {
          list-style-type: none;
          margin: 0;
          padding: 0;
          overflow: hidden;
          background-color: #FF0000;
        }
        li {
          float: left;
        }
        li a {
          display: block;
          color: white;
          text-align: center;
          padding: 14px 16px;
          text-decoration: none;
        }
        li a:hover {
          background-color: #111;
        }
		
        }
        h1 {
            color: green;
            text-align:center;
            text-decoration: underline;
        }
        h2{
            color: black;
            text-align:center;
        }
		

</style>
</head>
<body>

<ul>
 <li><a href="index.html">Home</a></li>
	  <li><a href="dashboard.php">Dashboard</a></li> 
	  	  <li><a href="preferences.php">My List</a></li> 
	  	  <li><a href="preferences.php">My Friends</a></li> 
  <li><a href="changepassword.php">Change Password</a></li>
 
 <li><a href="handler_logout.php">Logout</a></li>


</ul>

<img src="Dino2.jpg" style="width:300px; height:300px;" class = "center" align ="auto">

<h1>Profile Page</h1>
<h2>User: <?php echo "<b>$profileEmail</b>";?></h2>
<div style="margin:auto;">
    <form action="handler_addfriend.php" method="post">
        <?php echo"<input type='hidden' value='$profileEmail' name='friendName'>";?>
        <input type="submit" value="Add Friend">
    </form>
</div>
<div>
    <?php

        $client = new rabbitMQClient("testRabbitMQ.ini","testServer");

        $request = array();
        $request['type'] = "getLikes";
        $request['email'] = $profileEmail;
        $request['message'] = "getLikes";
        $likes = $client->send_request($request);
        //$likes = $client->publish($request);
        $likesArray = explode(",", $likes);

        $out = "<table><th><td>Likes</td></th>";
        for($x = 0; $x < count($likesArray); $x++){
            $out .= "<th>" .$likesArray[$x] ."</td></th>";
        }
        $out .= "<table>";
        echo $out;
    ?>
</div><br>
<div>
    <?php

        $client = new rabbitMQClient("testRabbitMQ.ini","testServer");

        $request = array();
        $request['type'] = "getDislikes";
        $request['email'] = $profileEmail;
        $request['message'] = "getDislikes";
        $dislikes = $client->send_request($request);
        //$dislikes = $client->publish($request);
        $dislikesArray = explode(",", $dislikes);
        //table styling

        $out = "<table><tr><td>Dislikes</td></tr>";

        $out = "<table><th><td>Dislikes</td></th>";

        for($x = 0; $x < count($dislikesArray); $x++){
            $out .= "<th>" .$dislikesArray[$x] ."</td></th>";
        }
        $out .= "<table>"; 
        echo $out;
    ?>
</div>

</body>
</html>
