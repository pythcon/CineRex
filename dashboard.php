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
<style>

.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
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
* {box-sizing: border-box}
body {font-family: Verdana, sans-serif; margin:0}
.mySlides {display: none}
img {vertical-align: middle;}



</style>
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
