<?php

    //Function to Validate Data
    function validate($data){
       $data= trim(stripslashes(htmlspecialchars($data)));
       return $data;
    }


    //Empty Fields And Validation
    if(!$_POST["username"]){
       $nameerror="Please enter Username.<br>";
    }
    else{
       $username=validate($_POST["username"]);
    }
    if(!$_POST["password"]){
       $passerror="please enter your Password.<br>";
    }
    else{
       $password=validate($_POST["password"]);
    }

    //Comparing Credentials
    if($username && $password){
       $query="SELECT username,password FROM users WHERE username='$username'";
       $result=mysqli_query($conn,$query) or die(mysqli_error());
       if(mysqli_num_rows($result)>0){
          $row=mysqli_fetch_assoc($result);
          $_SESSION['un'] = $row['username'];
          if( $row['password'] == $password ){
             $_SESSION['loggedin']=TRUE;
             header('location:loggedin.php');
          }
          else{
             $passerror="Wrong Password<br>";
          }
       }
     }

?>
