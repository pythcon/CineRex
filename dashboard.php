<!DOCTYPE html>
<?php
    session_start();
    include("usefulfunctions.php");
    require_once('rabbit/path.inc');
    require_once('rabbit/get_host_info.inc');
    require_once('rabbit/rabbitMQLib.inc');

    //check to see if user is logged in
    loginCheck();

?>
<html>
    <meta charset = "UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
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
	  <li><a href="dashboard.php">Dashboard</a></li> 
	  <li><a href="preferences.php">Likes/Dislikes</a></li> 
  <li><a href="changepassword.php">Change Password</a></li>
 
 <li><a href="handler_logout.php">Logout</a></li>


</ul>
<div style="width:100%;">
    <div style="float:left; width:50%;">
        <h1><b>Welcome back!</b></h1>

        <img src="popcorn.jpg" style="width:300px; height:300px;" class = "center" align ="auto">

        <h2>Here are your latest movie preferences!</h2>
        
        <!-- Div that holds movie reccomendations-->
        <div>
            
            <?php
            
                $client = new rabbitMQClient("testRabbitMQ.ini","testServer");

                $request = array();
                $request['type']    = "getLikes";
                $request['email']   = $_SESSION['email'];
                $request['message'] = "getLikes";
                $reccomendations = $client->send_request($request);
                //$reccomendations = $client->publish($request);
            
                $reccomendationsArray = explode(",", $reccomendations);
                if (count($reccomendationsArray)>3){
            
                    //loops if there are 0 reccomendations
                    while(true){
                        if (count($reccomendationsArray) < 2){
                            $movieSelector = 0;
                        }else{
                            while ($reccomendationsArray[$movieSelector] == ''){
                                $movieSelector = rand(0,count($reccomendationsArray)-1);
                            }
                        }

                        $command = escapeshellcmd("python3 recomend3.py '$reccomendationsArray[$movieSelector]'");
                        $results = shell_exec($command);//.$reccomendationsArray[$movieSelector]);

                        $resultsArray = explode("\n", $results);

                        //echo "<script>alert(".count($resultsArray).")</script>";
                        if ($resultsArray[0] != ''){
                            break;
                        }

                    }
            
                echo "<div>Because you liked <b>".ucwords($reccomendationsArray[$movieSelector])."</b></div>";
                }else{
                    $notEnoughMovies = true;
                }
                
            ?>
            
           <!--API CALL TO GET RECCOMENDED MOVIE POSTERS-->
           <script type = "text/javascript"> 
             $(document).ready( function(){

               //$("#reccomendationsBtn").click(function(){ 

                 var reccomendations = <?php echo json_encode($resultsArray); ?>;
                 var notEnoughMovies = <?php echo json_encode($notEnoughMovies); ?>;
                 var output = "";
                 var res = "";
                 var x = 0;
                   
                 if (notEnoughMovies){
                    document.getElementById("C").innerHTML = 'You need at least 3 movies in your liked list to display reccomendations. Search up some movies on the side!';
                 }
                 
                 while (x < reccomendations.length){
                 var movieTitle = reccomendations[x];

                 if(movieTitle != ''){
                        
                     $.ajax({
                         type:         "GET",
                         url:          "API.php",
                         data:         "movieTitle="+movieTitle,

                         beforeSend: function(){         
                            $("#C").html("Loading Recommended Movies....<br><table>");
                         },

                         error: function(xhr, status, error) {  
                            alert( "Error Mesaage:  \r\nNumeric code is: "  + xhr.status + " \r\nError is " + error);   
                         },

                         success: function(result){
                            r = JSON.parse(result);
                            res = "<tr><td>Movie Name: "+r.Title + "</td>";

                            output = res + "<td><img style='display:flex;' height='200px' width='150px' src='"+r.Poster+"'></td></tr>";
                            $("#C").append(output);
                        }
                    });
                 };
                     x++;
               }
                 $("#C").append("</table>");
              //});    
            });                

        </script>
            
            
            
            
        </div>
        <div id="C"></div>
    </div>

<div style= "float:right; width:50%">
 <h1>  Movie Information:</h1>
  <input id = 'movieTitle' name = 'movieTitle' placeholder='Enter Movie name' autocomplete='off' min='0' required>
  <button id = 'btn' type = 'BUTTON'><b><font color= ' #008000'>Search Movie</font></b></button>
  
   <br>

<div id= "B"></div>
</div>
</div>
    <div class= "split right">
        
        <script type = "text/javascript"> 
         $(document).ready( function(){

           $("#btn").click(function(){ 

             var movieTitle = $("#movieTitle").val();

             if(movieTitle != ''){

                 $.ajax({
                     type:         "GET",
                     url:          "API.php",
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
                        like = "<button id='dislike'><i class='fa fa-thumbs-o-down' aria-hidden='true'></i></button><button id='like'><i class='fa fa-thumbs-o-up' aria-hidden='true'></i></button>";
                         
                        $("#B").html(res + poster + like);
                        $("#dislike").click(function(){ 

                         if(movieTitle != ''){

                             $.ajax({
                                 type:         "GET",
                                 url:          "dislike.php",
                                 data:         "movieTitle="+r.Title,

                                 beforeSend: function(){         
                                    $("#B").html("Removing Movies like this from your recommended list...");
                                 },

                                 error: function(xhr, status, error) {  
                                    alert( "Error Mesaage:  \r\nNumeric code is: "  + xhr.status + " \r\nError is " + error);   
                                 },

                                 success: function(result){
                                    alert("Added to your disliked list");
                                    $("#B").html(res + poster + like);
                                }
                            });
                         };    
                      });
                      $("#like").click(function(){ 

                         if(movieTitle != ''){

                             $.ajax({
                                 type:         "GET",
                                 url:          "like.php",
                                 data:         "movieTitle="+r.Title,

                                 beforeSend: function(){         
                                    $("#B").html("Adding Movies like this to your recommended list...");
                                 },

                                 error: function(xhr, status, error) {  
                                    alert( "Error Mesaage:  \r\nNumeric code is: "  + xhr.status + " \r\nError is " + error);   
                                 },

                                 success: function(result){
                                    alert("Added to your liked list");
                                    $("#B").html(res + poster + like);
                                }
                            });
                         };    
                      });
                    }
                  });
                };    
            });   
        });                

        </script>

    </div>
</body>

</html>
