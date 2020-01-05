<?php
//Top 7 Tales
   include('connection.php');

   $Hquery="SELECT id,likes FROM playlist ORDER BY likes desc LIMIT 7";
   $Hresult=mysqli_query($conn,$Hquery);

   while( $Hrow=mysqli_fetch_assoc($Hresult) ){
     $id=$Hrow['id'];
     $IHquery="SELECT profile FROM users WHERE id='$id'";
     $IHresult=mysqli_query($conn,$IHquery);
     $IHrow=mysqli_fetch_assoc($IHresult);
     $img=$IHrow['profile'];
     if(!$img)
     $img="dummy.jpg";
     $PHquery="SELECT filepath,taledby FROM playlist WHERE id='$id'";
     $PHresult=mysqli_query($conn,$PHquery);
     $PHrow=mysqli_fetch_assoc($PHresult);
?>

     <div class="hit" style="background-color:rgba(255,255,255,0.4);border-radius:10px;margin:1em;text-align:center;">
           <a href="otherprofile.php?other=<?php echo $PHrow['taledby']; ?>" style="text-decoration:none;color:black;">
              <img src="<?php echo $img; ?>" style="height:30px;width:30px;margin:0.2em;border-radius:5px;" alt="Image Not Found">
              <span class="lead descript" style="font-weight:400;"><?php echo $PHrow['taledby']; ?></span>
           </a>

           <span class="nooflikes" style="font-weight:600;"> &nbsp; <?php echo $Hrow['likes']; ?><span style="font-weight:450;">Likes</span></span><br>

           <audio controls>
                <source src="<?php echo $PHrow['filepath']; ?>">
           </audio>
     </div>

<?php
 }
?>
