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
	  <li><a href="dashboard.php">Dashboard</a></li> 
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
                        $("#B").html(res + poster);
                    }
                });
             };    
          });   
        });                

        </script>

    </div>
</body>

</html>
