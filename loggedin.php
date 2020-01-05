<?php

//REDIRECT TO LOGIN / SIGNUP PAGE
      session_start();
      $usern=$_SESSION['un'];
      if(!$_SESSION['loggedin'])
      {
        header('location:login_page.php');
      }

//PROCESS THE UPLOAD
      $fileName="";
      if(isset($_POST['done']))
      {
        include('process_upload.php');
      }
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Taled-It</title>
        <link rel="stylesheet" href="bootstrap.min.css">
        <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="fixed.css">
        <link rel="stylesheet" href="styles_in.css">
  </head>


  <body>

<!--Navbar-->
    <?php
         include('navbar.php');
    ?>

<!-- DIVIDES THE PAGE INTO THREE COLUMNS -->
    <div class="container-fluid" style="margin-top:5em;">

    <div class="row mb-3">
<!-- PLAYLIST -->
          <div class="col-3 playlist" >
          <div style="margin-top:10vh;position:fixed;text-align:center;background-color:rgb(25,255,81);width:22%;border-radius:20px;"><span class="lead" style="font-size:1.5em;">Playlist</span></div><br>
            <div class="playlists" style="overflow:auto;padding:1em;position:fixed;margin-top:12vh;border-radius:20px;background-color:rgb(25,255,81);height:70vh;width:22%;">
                <?php include('playlist.php'); ?>
              </div>
           </div>

<!-- POSTS TO FEED -->
      <div class="col-5 important">
<!--Add file-->
          <?php
          //include('upload.html');
//Added File
          //include('tales.php');
//Posts
          include('AllPosts.php');
          ?>

      </div>

<!-- HITS -->
      <div class="col-4 status">
        <div style="margin-top:10vh;position:fixed;text-align:center;background-color:rgb(25,255,81);width:29%;border-radius:20px;"><span class="lead" style="font-size:1.5em;">Hits</span></div><br>
        <div class="playlists" style="padding:1em;overflow:auto;position:fixed;margin-top:12vh;border-radius:20px;background-color:rgb(25,255,81);height:70vh;width:30%;">
          <?php include('hits.php'); ?>
        </div>
      </div>

    </div>
 </div>

    <script src="jquery3.1.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="bootstrap.min.js"></script>

<!-- TO HIDE THE SEARCH RESULTS -->
    <script>
    $(function(){
       $(".cross").click(function(e){
         $(".list").css('display','none');
         e.preventDefault();
      });
    });
    </script>

<!-- TO SHOW EXTENDED FORM FOR UPLOADING THE FILE -->
    <script>
            $(function(){
              $(".uplbtn").click(function(e){
                  $(".uplbtn").css('display','none');
                  $(".uplform").css('display','inline');
                  e.preventDefault();
              });
            });
    </script>

<!-- HANDLING COMMENT DISPLAY AND NEW COMMENTS -->
    <script>
            $(".comment").click(function(){
                  var id=$(this).val();
                  var $element=$(this);
                  $(".comments").css('display','none');
                  $(".commenthere").css('display','none');
                  $(".newcomment").css('display','none');
                  $(".comments"+id).css('display','inline');
                  $(".commenthere"+id).css('display','inline');
                  $(".postcomment"+id).click(function(){
                        var cmt=$(".iscomment"+id).val();
                        var un="<?php echo $usern; ?>"
                              if(cmt != ''){
                                $(".iscomment"+id).val();
                                $.post(
                                 "commentajax.php",
                                 {cmt: cmt,
                                 id: id,
                                 un:un},
                                 function(data){
                                   $(".newcomment"+id).children("span").text(data);
                                   $(".newcomment"+id).css('display','inline');
                                 }
                              );
                          }
                             $(".commenthere"+id).css('display','none');
                      });
                });
    </script>

<!-- ADDING AUDIOS TO PLAYLIST -->
    <script>
           $(".playlist").click(function(){
              var id=$(this).val();
              var ele=$(this);
              var un="<?php echo $usern; ?>"
              $.post(
                    "playlistajax.php",
                    {id: id,
                    un: un},
                    function(data){
                         $(ele).text(data);
                    }
                 );
            });
    </script>

<!-- HANDLING LIKES ON A POST -->
    <script type="text/javascript">
            $(".like").click(function(){
                  var id=$(this).val();
                  var $element=$(this);
                  var uname="<?php echo $usern; ?>";
                  $.post(
                        "likeajax.php",
                        {id: id,
                        uname: uname},
                        function(data){
                             $($element).children(".result").text(data);
                        }
                  );
            });
    </script>

<!-- FOLLOW SOMEONE -->
    <script>
          $(".join").click(function(){
                var follow=$(this).val();
                var element=$(this);
                var follower="<?php echo $usern; ?>";
                $.post(
                      "follow.php",
                      {follow: follow,
                      follower: follower},
                      function(data){
                          $(element).text(data);
                    }
              );
          });
    </script>



  </body>
</html>
