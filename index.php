
<!DOCTYPE html>
<html>
<meta charset = "UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
<!--IF NOT LOGGED IN-->
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
	  <li><a href='dashboard.php'>User Dashboard</a></li>

     


    </ul>
    ";
}


?>

<div style="width:100%;">
<div style="float:left; width:50%;">

<img src="popcorn.jpg" style="width:300px; height:300px;" class = "center" align ="auto">

<h1>Latest Movies!</h1>

 <!-- Slideshow container -->
<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="Joker.jpg" style="width:100%">
  <div class="text">The Joker</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img src="IT.jpg" style="width:100%">
  <div class="text">IT Chapter Two</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img src="ScaryStories.jpg" style="width:100%">
  <div class="text">Scary Stories to tell in the Dark</div>
</div>



</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>
</div>

<div style= "float:right; width:50%">
 <h1>  Movie Information:</h1>
  <input id = 'movieTitle' name = 'movieTitle' placeholder='Enter Movie name' autocomplete='off' min='0' required>
  <button id = 'btn' type = 'BUTTON'><b><font color= ' #008000'>Search Movie</font></b></button>
  
   <br>

<div id= "B"></div>
</div>
</div>
<script>

var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 4000); // Change image every 4 seconds
}

</script>
    <div class= "split right">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        
        <script type = "text/javascript"> 
         $(document).ready( function(){

           $("button").click(function(){ 

             var movieTitle = $("#movieTitle").val();

             if(movieTitle != ''){

                 $.ajax({
                     type:         "GET",
                     url:         "API.php",
                     data:         "movieTitle="+movieTitle,

                     beforeSend: function(){         
                        $("#B").html("Grabbing Movie Data....");
                     },

                     error: function(xhr, status, error) {  
                        alert( "Error Mesaage:  \r\nNumeric code is: "  + xhr.status + " \r\nError is " + error);   
                     },

                     success: function(result){
                        r = JSON.parse(result);
                        res = "<br> Movie Name: "+r.Title+"<br><br> Year: "+r.Year+"<br> <br> Rated: "+r.Rated+"<br><br> Genre: "+r.Genre+"<br>";
                         
                        //get imdbID to store in like/dislike database
                        var imdbID = r.IMDBID;
                        document.cookie = imdbID;

                        poster = "<img src='"+r.Poster+"'>"
                        
                        //like/dislike button
                        like = "<button class='dislike'><i class='fa fa-thumbs-o-down' aria-hidden='true'></i></button><button class='like'><i class='fa fa-thumbs-o-up' aria-hidden='true'></i></button>";
                         
                        $("#B").html(res + poster + like);
                    }
                });
             };    
          });   
        });                

        </script>

    </div>
</body>
</html>
