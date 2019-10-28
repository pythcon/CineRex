<?php
    session_start();
    include("usefulfunctions.php");
    require_once('rabbit/path.inc');
    require_once('rabbit/get_host_info.inc');
    require_once('rabbit/rabbitMQLib.inc');

    //check to see if user is logged in
    loginCheck();

?>
<!DOCTYPE html>
<html>
<head>
<style>
#list {
	
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
	
	
}

#list td, #list th {
    border: 1px solid #ddd
	padding: 8px;
}

#list tr:nth-child(even){background-color: #f2f2f2;}

#list tr:hover {background-color: #ddd;}

#list th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
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
  <li><a href="changepassword.php">Change Password</a></li>
 
 <li><a href="handler_logout.php">Logout</a></li>


</ul>

<img src="Dino2.jpg" style="width:300px; height:300px;" class = "center" align ="auto">

<h1> Here are your liked and disliked movies!</h1>

    <div>
        <?php

            $client = new rabbitMQClient("testRabbitMQ.ini","testServer");

            $request = array();
            $request['type'] = "getLikes";
            $request['email'] = $_SESSION['email'];
            $request['message'] = "getLikes";
            $likes = $client->send_request($request);
            //$likes = $client->publish($request);
            $likesArray = explode(",", $likes);
        
            $out = "<table id ='list'><td>Likes";
            for($x = 0; $x < count($likesArray); $x++){
                $out .= "<tr>" .$likesArray[$x] ."</td></tr>";
            }
            $out .= "<table>";
            echo $out;
        ?>
    </div><br>
        <?php

            $client = new rabbitMQClient("testRabbitMQ.ini","testServer");

            $request = array();
            $request['type'] = "getDislikes";
            $request['email'] = $_SESSION['email'];
            $request['message'] = "getDislikes";
            $dislikes = $client->send_request($request);
            //$dislikes = $client->publish($request);
            $dislikesArray = explode(",", $dislikes);
			//table styling
            $out = "<table id = 'list'><td>Dislikes";
            for($x = 0; $x < count($dislikesArray); $x++){
                $out .= "<tr>" .$dislikesArray[$x] ."</td></tr>";
            }
            $out .= "<table>"; 
            echo $out;
        ?>
    <div>
    
    </div>

</body>
</html>
