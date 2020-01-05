<!-- Posts from the database -->

<?php

    include('connection.php');
    $link2=0;

//What all to show to the user
    $query1="SELECT * FROM playlist ORDER BY timeofpost desc";
    $result1=mysqli_query($conn,$query1);
    while($row1=mysqli_fetch_assoc($result1)){

//To find out the users who have commented / liked the post
        $likedby=explode(",",$row1['likedby']);
        $comments=explode(",",$row1['comments']);
        $comments=array_filter($comments);
        $likedby=array_filter($likedby);
//An array to store the users who have commented on the post and the comments as well.
        $commentbystr=array();
        $theComment=array();

        foreach($comments as $comment){
                $commentor=explode("-",$comment);
                $commentbystr[]=$commentor[0];
                $theComment[]=$commentor[1];
        }

//List of people assosiated with the Post.
        $react=array_merge($likedby,$commentbystr);
        $react[]=$row1['taledby'];
        $react=array_unique($react);
        $react=array_filter($react);

//User's Friend List
        $query2="SELECT profile,friends FROM users WHERE username='$usern'";
        $result2=mysqli_query($conn,$query2);
        $row2=mysqli_fetch_assoc($result2);
        $frnds=explode(",",$row2['friends']);
        $frnds=array_filter($frnds);
        $usrprfl=$row2['profile'];
        if(!$usrprfl)
        $usrprfl="dummy.jpg";

//Checking if the Tale is to be shown.
        $show=0;
        foreach($frnds as $frnd){
            foreach($react as $eachreact){
                if($frnd == $eachreact){
                   $show=$show+1;
                   break;
                 }
              }
              if($show!=0)
              break;
            }

//Display the tale.
        if($show!=0){
          $taleown=$row1['taledby'];
          $query3="SELECT profile FROM users WHERE username='$taleown'";
          $result3=mysqli_query($conn,$query3);
          $row3=mysqli_fetch_assoc($result3);
          $profileown=$row3['profile'];
          if(!$profileown)
          $profileown="dummy.jpg";
          $time = strtotime($row1['timeofpost']);
          $modifiedtime = date("d/m/y", $time);
?>


    <div class="aud">

        <span class="lead">
              <img src="<?php echo $profileown; ?>" style="width:50px;height:50px;border:solid 0.5px black;border-radius:10px;margin-right:1em;">
              <b><?php echo $row1['taledby']; ?></b>
        </span>

        <span class="lead" style="float:right;"><b><?php echo $modifiedtime; ?></b></span><br><br>

        <span class="lead" style="margin-left:2em;margin-right:2em;font-weight:350;"><?php echo $row1['description']; ?></span>

        <p class="lead" style="margin-left:2em;margin-right:2em;font-weight:350;"><?php echo $row1['genres']; ?></p><br>

        <audio controls style="margin-left:23%;">
              <source src="<?php echo $row1['filepath']; ?>" type="audio/mpeg">
        </audio><br>

<!--Like Share Playlist -->
        <div style="width:100%;background-color:rgba(255,255,255,0.5);border:solid 1px green;border-radius:20%;">
            <span>
                  <button class="like btn btn-basic" value="<?php echo $row1['id'];?>" style="padding:0 3em;border:none;font-size:1em;text-decoration:none;font-weight:600;margin-left:2em;">Like <span class="result" style="color:rgb(69,125,222);">(<?php echo $row1['likes']; ?>)</span></button>
                  <button class="comment btn btn-basic" value="<?php echo $row1['id'];?>" style="padding:0 4em;font-size:1em;text-decoration:none;font-weight:600;">Comment</button>
                  <button class="playlist btn btn-basic" value="<?php echo $row1['id'];?>" style="padding:0 3em;font-size:1em;text-decoration:none;font-weight:600;">Playlist</button>
            </span>
        </div>

<!-- Add Comment -->
        <div class="commenthere<?php echo $row1['id'];?> commenthere form-inline" style="display: none;"><br>
            <span><input type="text" style="width:89%;" name="comment" placeholder="Comment Here" class="form-control iscomment<?php echo $row1['id']; ?>">
                  <button class="postcomment<?php echo $row1['id']; ?> btn btn-success" type="submit">Post</button>
            </span><br>
        </div>
        <div class="newcomment<?php echo $row1['id'];?> newcomment" style="display:none;background-color:rgba(255,255,255,0.6);">
            <br>
            <img src="<?php echo $usrprfl; ?>" style="width:50px;height:50px;border:solid 0.5px black;border-radius:10px;">
            <span class="lead display"></span><br>
        </div>

<?php

//All comments on the post
          $commentbystr=array_filter($commentbystr);
          $theComment=array_filter($theComment);
          $i=0;
          $s=sizeof($commentbystr);
          while($i<$s){
            $cp=$commentbystr[$i];
            $query4="SELECT profile FROM users WHERE username='$cp'";
            $result4=mysqli_query($conn,$query4);
            $row4=mysqli_fetch_assoc($result4);
            $commimage=$row4['profile'];
            if($row4['profile']==NULL){
            $commimage="dummy.jpg";
            }

        /*  $comments=array_unique($comments);
          $comments=array_filter($comments);
          if($comments){
          foreach ($comments as $eachcomment) {
            $ec_arr=explode("-",$eachcomment);
          $query4="SELECT profile FROM users WHERE username='$ec_arr[0]'";
          $result4=mysqli_query($conn,$query4);
          $row4=mysqli_fetch_assoc($result4);
          $commimage=$row4['profile'];
          if($row4['profile']==NULL){
          $commimage="dummy.jpg";}*/

?>

          <div class="comments<?php echo $row1['id'];?> comments" style="display:none;background-color:rgba(255,255,255,0.6);">
              <br>
              <img src="<?php echo $commimage; ?>" style="width:50px;height:50px;border:solid 0.5px black;border-radius:10px;">
              <span class="lead"> <?php echo $theComment[$i]; ?></span><br>
          </div>

<?php
      $i=$i+1;
     }
    }
    $show=0;
?>
</div>
<?php
  }
?>
