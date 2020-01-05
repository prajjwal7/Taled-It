<?php
$usnm=$_REQUEST['usnm'];
$NCquery="SELECT notifications FROM users WHERE username='$usnm'";
$NCresult=mysqli_query($conn,$NCquery);
$NCrow=mysqli_fetch_assoc($NCresult);
if($NCrow['notifications'] == ''){
  echo "No notifications";
}
?>
