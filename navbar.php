<?php
     $usernm=$_SESSION['un'];
?>

<!-- NAVBAR -->
<div class="container-fluid navigator">

  <nav class="navbar navbar-expand-md navbar-light  fixed-top" style="background-color: rgb(21,255,80);">

<!-- BRAND LOGO -->
         <a class="navbar-brand" href="#">TALED-IT</a>

<!-- PROFILE PICTURE & USERNAME -->
         <ul class="navbar-nav mr-auto ">
            <li class="nav-item">
                <a class="nav-link" href="profile.php"><i class="fa fa-user fa-lg"><b><?php echo $usernm; ?></b></i></a>
            </li>
         </ul>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navs">
              <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navs">

<!-- SEARCH BAR -->
              <form class="form-inline  my-3 my-lg-0" action="" role="search" method="post" style="width:40% !important;">
                     <input class="form-control search"  type="text" placeholder="Search" name="search" style="width:80%;margin-right:0.6em;"aria-label="Search">
                     <button type="submit"  class="btn btn-primary srch" name="srch" style="">Search</button>
              </form>

<!-- NAVIGATION MENU -->
              <ul class="navbar-nav ml-auto">

                 <li class="nav-item">
                     <a class="nav-link" href="loggedin.php"><span class="fa fa-home fa-lg">Home</span></a>
                 </li>

                 <li class="nav-item dropdown">
                   <?php
                        include('connection.php');
                        $notifquery="SELECT notifications FROM users WHERE username='$usernm'";
                        $notifresult=mysqli_query($conn,$notifquery);
                        $notifrow=mysqli_fetch_assoc($notifresult);
                        $notifs=explode(",",$notifrow['notifications']);
                        $notifs=array_filter($notifs);
                        $l=sizeof($notifs);
                        if($l){
                    ?>
                     <a class="nav-link dropdown-toggle" href="#" id="shownotif" role="button" data-toggle="dropdown"><span style="color:red;"class="fa fa-bell fa-lg notifier">Notifications</span></a>
                     <div class="dropdown-menu" style="padding:4%;" aria-labelledby="shownotif">
                       <?php
                           foreach ($notifs as $notif) {
                             $notif=$notif." ";
                       ?>
                          <a class="dropdown-item" style="font-size:0.5em;background-color:rgba(25,255,81,0.3);padding:2%;"href="#">
                              <span class="lead"><?php echo $notif;?></span>
                          </a>
                          <br>
                        <?php
                         }
                        ?>
                      </div>
                   <?php
                   $delquery="UPDATE users SET notifications=''";
                   mysqli_query($conn,$delquery);
                     }
                     else{
                   ?>
                   <a class="nav-link" href="#"><span class="fa fa-bell fa-lg notifier">Notifications</span></a>
                 <?php
                      }
                  ?>
                 </li>

                 <li class="nav-item">
                     <a class="nav-link" href="logout.php"><span class="fa fa-road fa-lg">Log-Out</span></a>
                 </li>

               </ul>

          </div>
    </nav>
</div>

<?php
    if(isset($_POST['search'])){
      include('search.php');
    }
?>
