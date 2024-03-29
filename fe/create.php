<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
    
    <style>
/* CSS styling for the NAV Bar */ 
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #FF0000;
}
/* CSS styling for the Nav Bar buttons */
li {
  float: left;
}
/* more styling for the buttons*/
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
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}
/* Text field CSS styling */
input[type=text], input[type=password], input[type=email] {
  width: 50%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}
/* CSS Styling for create account button */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 50%;
}
button:hover {
  opacity: 0.8;
}
/* Cancel button CSS Styling*/
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}
/* CSS styling for images*/
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}
img.avatar {
  width: 40%;
  border-radius: 50%;
}
.container {
  padding: 16px;
}
message {
  display:none;
  background: #f1f1f1;
  color: #000;
  position: relative;
  padding: 20px;
  margin-top: 10px;
}
message p {
  padding: 10px 35px;
  font-size: 18px;
}
.invalid {
  color: red;
}
.invalid:before {
  position: relative;
  left: -35px;
  content: "✖";
}
.valid {
  color: green;
}
.valid:before {
  position: relative;
  left: -35px;
  content: "✔";
}
span.psw {
  float: right;
  padding-top: 16px;
}
/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 50%;
  }
}
</style>
<body>

<body>
<ul>
 <li><a href="index.html">Home</a></li>
	
  <li><a href="login.html">Log In</a></li>
  <li><a href="create.html"> Create Account</a></li>

</ul>

<h2>User Account Creation</h2>

<form action="handler_registration.php" method="post">
  <div class="imgcontainer">
    <img src="Dino2.jpg" alt="Avatar" class="avatar" style ="width:200px;height:200px;">
  </div>

  <div class="container">
    
	
	
	
	<label for="firstName"><b>Enter your First Name</b></label><br>
    <input type="text" placeholder="Johnny" name="firstName" required><br>
      
    <label for="lastname"><b>Enter your Last Name</b></label><br>
    <input type="text" placeholder="Appleseed" name="lastName" required><br>
      
	<label for="email"><b>Type in an email</b></label><br>
    <input type="email" placeholder="Enter Email" name="email" required><br>

    <label for="password"><b>Enter a Password</b></label><br>
    <input type="password" placeholder="Enter Password" name="password" id="password" required 
	pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
	title="Must contain at least one number and one uppercase and lowercase letter, 
	and at least 8 or more characters" ><br>
	
	
    <label for="password2"><b>Re-Enter Password</b></label><br>
    <input type="password" placeholder="Enter Password" name="password2" required><br>
        
    <button type="submit">Create Account</button>
  
  </div>
<div id="message">
  <h3>Password must contain the following:</h3>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div>
  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
  </div>
</form>


				
<script>
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>



</body>
</html>