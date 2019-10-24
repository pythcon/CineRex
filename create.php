<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
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
    <img src="popcorn.jpg" alt="Avatar" class="avatar" style ="width:200px;height:200px;">
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