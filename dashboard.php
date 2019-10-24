<!DOCTYPE html>
<?php
    session_start();
    include("usefulfunctions.php");

    //check to see if user is logged in
    loginCheck();

?>
<html>
<meta charset = "UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css" />

</head>

<body>
<ul>
 <li><a href="index.html">Home</a></li>
	
  <li><a href="changepassword.php">Change Password</a></li>
  <li><a href="handler_logout.php">Logout</a></li>

</ul>

<h1><b>Welcome back!</b></h1>

<img src="popcorn.jpg" style="width:300px; height:300px;" class = "center" align ="auto">

<h2>Here are your latest movie preferences from your survey!</h2>

</body>

</html>
