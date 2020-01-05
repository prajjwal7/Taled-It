<?php
   $cmt=$_REQUEST['cmt'];
   $id=$_REQUEST['id'];
   $un=$_REQUEST['un'];
   echo $cmt;
   include('connection.php');
   $Cquery="SELECT comments FROM playlist WHERE id='$id'";
   $Cresult=mysqli_query($conn,$Cquery);
   $Crow=mysqli_fetch_assoc($Cresult);
   $newComments=$un."-".$cmt.",".$Crow['comments'];
   $UCquery="UPDATE playlist SET comments='$newComments' WHERE id='$id'";
   mysqli_query($conn,$UCquery);
?>
