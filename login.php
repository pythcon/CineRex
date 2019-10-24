<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>

<?php
    session_start();
if (!$_SESSION['logged']){
    echo "
    <ul>
     <li><a href='index.html'>Home</a></li>

      <li><a href='login.html'>Log In</a></li>
      <li><a href='create.html'> Create Account</a></li>


    </ul>
    ";
}else{
    echo "
    <ul>
     <li><a href='index.html'>Home</a></li>

      <li><a href='changepassword.html'>Change Password</a></li>
      <li><a href='handler_logout.php'>Logout</a></li>

        <form action='/action_page.php'>
          <li><input type='text' placeholder='Search..' name='search'></li>

          <button type='submit'>Submit</button>

        </form>

    </ul>
    ";
}


?>

<h2>Login Form</h2>

<form action="handler_login.php" method="post">
  <div class="imgcontainer">
    <img src="avatar.jpg" alt="Avatar" class="avatar" style ="width:200px;height:200px;">
  </div>

  <div class="container">
    <label for="email"><b>Email</b></label><br>
    <input type="text" placeholder="Enter Email" name="email" required><br>

    <label for="psw"><b>Password</b></label><br>
    <input type="password"  placeholder="Enter Password" name="password" required >
  </div>



  <div class="container" style="background-color:#f1f1f1">
	 <button type="submit" class ="loginbtn">Login</button>
      <button  type="button" style="background-color:#FF0000"> <a href = "index.html">Cancel</a></button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>

</body>
</html>