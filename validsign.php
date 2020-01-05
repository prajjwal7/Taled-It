<?php

  //Function To Validate Data
   function validate($data)
   {
      $data= trim(stripslashes(htmlspecialchars($data)));
      return $data;
   }

   //Display Error
   $usernameN=$emailN=$passwordN="";

   //Empty Fields And Validation
   if(!$_POST["usernameN"]){
       $nameerror="Please enter Username.<br>Do not include whitespaces in your username.<br>";
   }
   else{
       $usernameN=validate($_POST["usernameN"]);
   }
   if(!$_POST["emailN"]){
       $emailerror="Please enter your Email<br>";
   }
   else{
       $emailN=validate($_POST["emailN"]);
   }
   if(!$_POST["passwordN"]){
       $passerror="please enter your Password.<br>";
   }
   else{
       $passwordN=validate($_POST["passwordN"]);
   }

   //Comparing Credentials
   if($usernameN && $emailN && $passwordN){
       $passwordN=password_hash($passwordN,PASSWORD_DEFAULT);

       $queryN="INSERT INTO users (id,username,email,password)
       VALUES (NULL ,'$usernameN','$emailN','$passwordN')";

          if(mysqli_query($conn,$queryN)){
            $_SESSION['loggedin']=TRUE;
            header('location:'.$_SESSION['redirect']);
          }
   }

?>
