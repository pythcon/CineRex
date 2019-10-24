<!DOCTYPE html>
<?php
    session_start();
    include("usefulfunctions.php");

    //check to see if user is logged in
    //loginCheck();

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
<div style="width:100%;">
<div style="float:left; width:50%;">
<h1><b>Welcome back!</b></h1>

<img src="popcorn.jpg" style="width:300px; height:300px;" class = "center" align ="auto">

<h2>Here are your latest movie preferences!</h2>

</div>

<div style= "float:right; width:50%">
 <h1>  Movie Information:</h1>
  <input id = 'movieTitle' name = 'movieTitle' placeholder='Enter Movie name' autocomplete='off' min='0' required>
  <button id = 'btn' type = 'BUTTON'><b><font color= ' #008000'>Search Movie</font></b></button>
  
   <br>

<div id= "B"></div>
</div>
</div>

</body>

</html>
