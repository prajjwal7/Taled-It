<!--Displaying the recently posted Tales by the owner -->

<?php
    if($fileName!=NULL)
    {
?>

    <div class="aud">
          <span class="lead"><?php echo $usern; ?> just uploaded an audio</span><br>
          <p><?php echo $descrip; ?></p><br>
          <span class="lead"><?php echo $hash; ?></span><br>
          <audio controls>
                <source src="<?php echo $filePath; ?>" type="audio/mpeg">
          </audio><br>
          <b>Like    Comment</b>
    </div>

<?php
    }
?>
