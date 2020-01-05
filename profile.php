<?php
//View Own Profile
       session_start();
       include('connection.php');

       $us=$_SESSION['un'];
       $query="SELECT * FROM users WHERE username='$us'";
       $result=mysqli_query($conn,$query);
       $row=mysqli_fetch_assoc($result);

       $image=$row['profile'];
       if(!$row['profile']){
         $image="dummy.jpg";
       }

            if(isset($_POST['EDIT'])){

                $imgName = mysqli_real_escape_string($conn,$_FILES["PHOTO"]["name"]);
                $imgType = mysqli_real_escape_string($conn,$_FILES["PHOTO"]["type"]);
                $nameedit = $_POST['NAME'];
                $emailedit = $_POST['EMAIL'];

                  if(substr($imgType,0,5)== "image")
                  {
                       $delete=$row['profile'];
                       move_uploaded_file($_FILES['PHOTO']['tmp_name'],"profilepic/$imgName");
                       $imgPath=trim(stripslashes(htmlspecialchars("profilepic/$imgName")));
                       $queryedit="UPDATE users SET name='$nameedit',email='$emailedit',profile='$imgPath' WHERE username='$us'";
                       mysqli_query($conn,$queryedit);
                       unlink($delete);
                       header('location:profile.php');
                  }
            }
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="fixed.css">
    <link rel="stylesheet" href="prostyle.css">
  </head>
  <body>

      <?php
         include('navbar2.php');
      ?>

     <div class="profile" style="margin:15vh auto 5vh 42%;">
         <img src="<?php echo $image; ?>" alt="Image Not Found" style="height:200px;width:200px;border:solid 1px black;border-radius:50px;">
     </div>

     <div class="lead name">
     <span><?php echo $row['username']; ?></span><br>
     <span class="btn btn-info toedit">Edit Profile</span>
     </div>

<!-- Form to update info -->
     <div class="col-offset-3 col-sm-6">
          <form class="editprofile" style="display:none;"action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label>Profile Picture</label>
              <input type="file" name="PHOTO" value="<?php echo $row['profile']; ?>" class="form-control">
            </div>
             <div class="form-group">
               <label>Name</label>
               <input type="text" name="NAME" class="form-control" value="<?php echo $row['name']; ?>" placeholder="Your Name">
             </div>
             <div class="form-group">
               <label>Email</label>
               <input type="email" name="EMAIL" class="form-control" value="<?php  echo $row['email'];?>" placeholder="Your Email-Id">
             </div>
             <button type="submit" name="EDIT" class="DEDIT btn btn-info">Save Changes</button>
          </form>
     </div>

<!-- Information -->
       <button type="button" name="about" class="btn form-control lead about" style="background-color:rgb(21,255,80);font-size:1.5rem;margin:1em 23% 0.5em 23%;width:50%;">About</button>
         <div class="info" style="display:none;">
           <div style="margin:2rem auto 2rem 23%;background-color:rgba(21,255,85,0.3);width:50%;text-align:center;">
              <span class="lead" style="margin-top:2rem;"><b>Username : <?php echo $row['username']; ?></b></span><br>
              <span class="lead"><b>Name : <?php echo $row['name']; ?></b></span><br>
              <span class="lead"><b>Date Of Birth : <?php echo $row['dob']; ?></b></span><br>
              <span class="lead" style="margin-bottom:  2rem;"><b>Email : <?php echo $row['email']; ?></b></span><br>
            </div>
         </div>

<!-- Friend List -->
       <button type="button" name="friends" class="btn form-control  friends lead" style="background-color:rgb(21,255,80);font-size:1.5rem;margin:0.5em 23%;width:50%;">Friends</button>
             <br><div class="frdlist" style="display:none;">
                   <?php
                      $friends=$row['friends'];
                      $friendList=explode(",",$friends);
                      foreach ($friendList as $friend)
                       {
                          $newquery="SELECT profile FROM users WHERE username='$friend'";
                          $newResult=mysqli_query($conn,$newquery);
                          $newRow=mysqli_fetch_assoc($newResult);
                          $newImg=$newRow['profile'];
                          if(!$newImg){
                            $newImg="dummy.jpg";
                          }
                   ?>
                 <div class="Bits" style="background-color:rgba(21,255,85,0.4);margin:0.5rem auto 0.5rem 23%;border:solid 1px grey;border-radius:5px;width:50%;padding:2px;">
                   <span><img src="<?php echo $newImg; ?>" style="margin-left: 1em;height:50px;width:50px;border:solid 1px black;border-radius:5px;">
                   <span class="lead" style="padding-left:4em;"><b><?php echo $friend; ?></b></span></span>
                   <br>
                 </div>
                  <?php
                 }
                ?>
         </div>

<!-- Tales -->
       <button type="button" name="stories" class="btn form-control lead stories" style="background-color:rgb(21,255,80);font-size:1.5rem;margin:0.5em 23%;width:50%;">Tales</button>
         <div class="posts" style="display:none;">
           <?php
               include('connection.php');
               $i=0;
               $taledby=$row['username'];
               $talequery="SELECT filepath FROM playlist WHERE taledby='$taledby'";
               $taleres=mysqli_query($conn,$talequery);
               while($talerow=mysqli_fetch_assoc($taleres)){
                 $i=1;
           ?>
               <div class="talesbyowner" style="background-color:rgba(21,255,85,0.4);margin:0.5rem auto 0.5rem 23%;border:solid 1px grey;border-radius:5px;width:50%;padding:2px;">
                <div class="eachtale" style="background:rgba(21,255,85);margin:0.3em 20% 0.1em 20%;border:solid 1px black;border-radius:10px;">
                 <audio controls style="margin:0.2em auto 0.1em 23%;">
                 <source src="<?php echo $talerow['filepath']; ?>" type="audio/mpeg">
                 </audio><br>
                </div>
               </div>
           <?php
               }
               if($i==0)
                 {
               ?>
                 <div class="talesbyowner" style="background-color:rgba(21,255,85,0.4);margin:0.5rem auto 0.5rem 23%;border:solid 1px grey;border-radius:5px;width:50%;padding:2px;">
                          <span class="lead" style="margin-left:1em;"><b><?php echo $row['username']; ?> Hasn't Posted Any Tales Yet.</b></span>
                 </div>
               <?php
             }?>
         </div>



<script src="jqueryslim.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="bootstrap.min.js"></script>
<script>
$(function(){
  $(".toedit").click(function(e){
    $(".editprofile").css('display','inline');
       e.preventDefault();
  });

  $(".about").click(function(e){
    $(".info").css('display','inline');
    $(".frdlist").css('display','none');
    $(".posts").css('display','none');
       e.preventDefault();
  });
  $(".friends").click(function(e){
    $(".info").css('display','none');
    $(".frdlist").css('display','inline');
    $(".posts").css('display','none');
       e.preventDefault();
  });
  $(".stories").click(function(e){
    $(".info").css('display','none');
    $(".frdlist").css('display','none');
    $(".posts").css('display','inline');
       e.preventDefault();
  });
});

</script>

  </body>
</html>
