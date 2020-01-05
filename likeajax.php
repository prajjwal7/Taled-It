<?php

    $id = $_REQUEST['id'];
    $un = $_REQUEST['uname'];
  //  echo "Welcome".$id;
    include('connection.php');
    $i=0;
    $Lquery = "SELECT likedby,likes FROM playlist WHERE id='$id'";
    $Lresult = mysqli_query($conn,$Lquery);
    $Lrow= mysqli_fetch_assoc($Lresult);
    $likes=$Lrow['likes'];
    $liker=explode(",",$Lrow['likedby']);
    $liker=array_filter($liker);
    $liker=array_unique($liker);
    foreach($liker as $sliker){
      if($sliker == $un){
        $i++;
        break;
      }
    }
      if($i == 0){
      echo "(".++$likes.")";
      $likedbynew=$Lrow['likedby'].$un.",";
      $ULquery="UPDATE playlist SET likes='$likes',likedby='$likedbynew' WHERE id='$id'";
      $ULresult=mysqli_query($conn,$ULquery);
    }
    if($i == 1){
      echo "(".$likes.")";
    }
?>
