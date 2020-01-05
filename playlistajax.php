<?php
   $id=$_REQUEST['id'];
   $un=$_REQUEST['un'];
   include('connection.php');
   $Pquery="SELECT favourites FROM users WHERE username='$un'";
   $Presult=mysqli_query($conn,$Pquery);
   $Prow=mysqli_fetch_assoc($Presult);
   $fav=$Prow['favourites'];
   $fav=$id.",".$fav;
   $UPquery="UPDATE users SET favourites='$fav' WHERE username='$un'";
   mysqli_query($conn,$UPquery);
   echo "Added!";
?>
