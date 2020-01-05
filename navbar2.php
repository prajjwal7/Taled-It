<?php
     $usernm=$_SESSION['un'];
?>
<div class="container-fluid navigator">
  <nav class="navbar navbar-expand-md navbar-light  fixed-top" style="background-color: rgb(21,255,80);">
         <a class="navbar-brand" href="#">TALED-IT</a>
         <ul class="navbar-nav mr-auto ">
            <li class="nav-item">
                <a class="nav-link" href="profile.php"><i class="fa fa-user fa-lg"><b><?php echo $usernm; ?></b></i></a>
            </li>
         </ul>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navs">
              <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse" id="navs">

              <ul class="navbar-nav ml-auto">
                 <li class="nav-item">
                     <a class="nav-link" href="loggedin.php"><span class="fa fa-home fa-lg">Home</span></a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href=""><span class="fa fa-bell fa-lg">Notifications</span></a>
                 </li>

                 <li class="nav-item">
                     <a class="nav-link" href="logout.php"><span class="fa fa-road fa-lg">Log-Out</span></a>
                 </li>
               </ul>
          </div>
    </nav>
</div>
