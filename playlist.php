<div class="thelist" style="width:200px;height:auto;">
  <?php
//Display user's playlist
    $usern=$_SESSION['un'];
    include('connection.php');

    $Pquery1="SELECT favourites FROM users WHERE username='$usern'";
    $Presult1=mysqli_query($conn,$Pquery1);
    $Prow1=mysqli_fetch_assoc($Presult1);

    $fav=$Prow1['favourites'];
    $favor=explode(",",$fav);
    $favor=array_unique($favor);
    $favor=array_filter($favor);
    $l=sizeof($favor);
    if($l){
    foreach($favor as $f){
        $qs="SELECT filepath FROM playlist WHERE id='$f'";
        $rs=mysqli_query($conn,$qs);
        $ros=mysqli_fetch_assoc($rs);
?>

    <audio controls>
      <source src="<?php echo $ros['filepath']; ?>" type="audio/mpeg">
    </audio>

<?php
}
}else{
  ?>
  <div class="nolist eachtale" style="font-size:1em;padding:5%;margin-top:30%;border-radius:20px;background-color:rgba(25,251,85,0.3);">
    <span class="lead">You have not added anything to your playlist.<br>Click "Playlist" on your favourite Tales to add them to your playlist.</span>
  <?php
}
?>
</div>
