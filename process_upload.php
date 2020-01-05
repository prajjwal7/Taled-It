<?php

  include('connection.php');

  $fileName = mysqli_real_escape_string($conn,$_FILES["tale"]["name"]);
  $audioType = mysqli_real_escape_string($conn,$_FILES["tale"]["type"]);
  $hash = trim(stripslashes(htmlspecialchars($_POST['hash'])));
  $descrip=trim(stripslashes(htmlspecialchars($_POST['description'])));

    if(substr($audioType,0,5)== "audio")
    {
         move_uploaded_file($_FILES['tale']['tmp_name'],"Tales/$fileName");
         $filePath=trim(stripslashes(htmlspecialchars("Tales/$fileName")));
         $query="INSERT into playlist (id,fileName,filePath,genres,description,timeofpost)
         VALUES(NULL,'$fileName','$filePath','$hash','$descrip',NOW())";
         mysqli_query($conn,$query);
    }
?>
