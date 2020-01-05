<?php

session_start();
//Connect To DB

include('connection.php');

//Display Error
$nameerror=$passerror=$emailerror="";

//Log-In
if(isset($_POST['Login'])){
  require "validlogin.php";
}

//Sign-Up
if(isset($_POST['signup'])){
  require "validsign.php";
}
?>





<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Taled-It</title>
        <link rel="stylesheet" href="bootstrap.min.css">
        <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="fixed.css">
        <link rel="stylesheet" href="styleslogin.css">
  </head>


  <body>


    <div class="container-fluid">

<!-- LOGO -->
       <div class="row">
          <div class="logo">
               <h1>Welcome To</h1>
               <img src="logo11.png" alt="">
          </div>
       </div>

<!-- Login & Sign-Up forms -->
       <div class="row">

            <div class="sign">
                 <div class="forms">

<!-- Sign-Up Form -->
                        <form action="" method="post" class="signup" name="signup">

                            <div class="form-group">
                                <span class="error"><?php echo $nameerror; ?></span>
                                <input  type="text" name="usernameN" class="form-control" placeholder="Username"><br>
                            </div>
                            <div class="form-group">
                                <span class="error"><?php echo $emailerror; ?></span>
                                <input type="email" name="emailN" class="form-control" placeholder="Email"><br>
                            </div>
                            <div class="form-group">
                                <span class="error"><?php echo $passerror; ?></span>
                                <input type="password" name="passwordN" class="form-control" placeholder="Password"><br>
                            </div>

                            <button type="submit" name="signup" class="btn btn-primary signup1">Sign Up</button>

                            <button type="submit" class="btn signin2">Log In</button>

                        </form>

<!-- Login Form -->
                        <form action="" method="post" class="signin" name="signin">

                              <div class="form-group">
                                  <span class="error"><?php echo $nameerror; ?></span>
                                  <input type="text" name="username" class="form-control" placeholder="Username"><br>
                              </div>
                              <div class="form-group">
                                  <span class="error"><?php echo $passerror; ?></span>
                                  <input type="password" name="password" class="form-control" placeholder="Password"><br>
                              </div>

                              <button type="submit" name="Login" class="btn btn-primary signin1">Log In</button>

                              <button type="submit" class="btn signup2">Sign Up</button>

                        </form>

                   </div>
             </div>
       </div>
  </div>



    <script src="jqueryslim.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="bootstrap.min.js"></script>

<!-- Toggle Between the Login and Sign-Up Forms -->
    <script>
            $(function(){
              $(".signup2").click(function(e){
                    $(".signin").css('display','none');
                    $(".signup").css('display','inline');
                    e.preventDefault();
              });
            });

            $(function(){
              $(".signin2").click(function(e){
                    $(".signup").css('display','none');
                    $(".signin").css('display','inline');
                    e.preventDefault();
              });
            });
    </script>
    
  </body>
</html>
