
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
	  	  <li><a href="preferences.php">Likes/Dislikes</a></li> 
  <li><a href="changepassword.php">Change Password</a></li>
 
 <li><a href="handler_logout.php">Logout</a></li>


</ul>

<img src="popcorn.jpg" style="width:300px; height:300px;" class = "center" align ="auto">

<h1> Here are your liked and disliked movies!</h1>

    <div>
        <?php
            session_start();
            include("usefulfunctions.php");
            require_once('rabbit/path.inc');
            require_once('rabbit/get_host_info.inc');
            require_once('rabbit/rabbitMQLib.inc');

            $client = new rabbitMQClient("testRabbitMQ.ini","testServer");

            $request = array();
            $request['type'] = "getLikes";
            $request['email'] = $_SESSION['email'];
            $request['message'] = "getLikes";
            //$loginCheck = $client->send_request($request);
            $likes = $client->publish($request);
            $likesArray = explode(",", $likes);
        
            $out = "<table><tr><td>Likes</td></tr>";
            for($x = 0; $x < count($likesArray); $x++){
                $out .= "<tr><td>" .$likesArray[$x] ."</td></tr>";
            }
            $out .= "<table>";
            echo $out;
        ?>
    </div>
        <?php
            session_start();
            include("usefulfunctions.php");
            require_once('rabbit/path.inc');
            require_once('rabbit/get_host_info.inc');
            require_once('rabbit/rabbitMQLib.inc');

            $client = new rabbitMQClient("testRabbitMQ.ini","testServer");

            $request = array();
            $request['type'] = "getDislikes";
            $request['email'] = $_SESSION['email'];
            $request['message'] = "getDislikes";
            //$loginCheck = $client->send_request($request);
            $dislikes = $client->publish($request);
            $dislikesArray = explode(",", $dislikes);
        
            $out = "<table><tr><td>Dislikes</td></tr>";
            for($x = 0; $x < count($dislikesArray); $x++){
                $out .= "<tr><td>" .$dislikesArray[$x] ."</td></tr>";
            }
            $out .= "<table>";
            echo $out;
        ?>
    <div>
    
    </div>

</body>
</html>
