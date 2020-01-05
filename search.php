<!-- Search for other users-->

<div class="list" style="margin:0 45% 1vh 18%;position:absolute;overflow:auto;max-width: 100%;max-height:50vh;background-color:rgba(21,255,85);border:solid 1px black;border-radius:15px;z-index:1;">
<?php
      include('connection.php');

      $counts=0;

      $QUERY1="SELECT friends FROM users WHERE username='$usern'";
      $RESULT1=mysqli_query($conn,$QUERY1);
      $ROW1=mysqli_fetch_assoc($RESULT1);

      $QUERY="SELECT username,profile FROM users";
      $RESULT=mysqli_query($conn,$QUERY);

      while($ROW=mysqli_fetch_assoc($RESULT)){
        if(stripos($ROW['username'],$_POST['search'])!==false && $ROW['username']!=$usern){
          $img=$ROW['profile'];
          if(!$img)
          $img="dummy.jpg";
          $counts++;

          if($counts==1){
          ?>
<!--Close button-->
             <button class="btn btn-basic cross"  style="margin:0.3em auto 0.2em 45%;"><span class="fa fa-times-circle fa-lg fa-2x"></span></button><br>
          <?php
         }
       ?>

<!-- Search Results and Link to their profile page -->
        <div class="showlist" style="margin:1vh 0.5em 1vh 0.5em;display:inline-flex;background:rgba(255,255,255,0.4);border:solid 1px white;border-radius:10px;">
          <a href="otherprofile.php?other=<?php echo $ROW['username']; ?>"  style="text-decoration:none;">
             <img src="<?php echo $img; ?>" style="width:50px;height:50px;border:solid 1px black;border-radius:10px;margin:0.1em 0.3em 0.1em 0.3em;">
             <span class="lead" style="color:black;"><b><?php echo $ROW['username']; ?> &nbsp; &nbsp;</b></span>
          </a>

        <?php
             $searchfrnd=explode(",",$ROW1['friends']);
             $match=0;
             foreach($searchfrnd as $unqsearch){
               if($unqsearch == $ROW['username'])
               {
                 $match=1;
                 break;
               }
             }
             if(!$match){
        ?>
<!--Follow Button-->
             <button type="submit" name="join" value="<?php echo $ROW['username']; ?>" class="btn btn-primary join" style="font-size:1em;float:right;margin-top:0;padding:0 1em;margin-right: 1em;">Follow</button><br>

         <?php } ?>
      </div>
<?php
}
}
?>
</div>
