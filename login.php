<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #D7D85A;
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



body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 50%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 10%;
}

button:hover {
  opacity: 0.8;
}

.loginbtn {
  width: auto;
  padding: 10px 18px;
  }

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}



span.psw {
  float: right;
  padding-top: 16px;
}


@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
 
}
</style>
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

        <form action='/action_page.php'>
          <li><input type='text' placeholder='Search..' name='search'></li>

          <button type='submit'>Submit</button>

        </form>

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