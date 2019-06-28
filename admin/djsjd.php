<?php   if (isset($_REQUEST['submit']))
{
if($_REQUEST['otp']=$_SESSION['otp'])
{
  header("location:dashboard.php");
}
}
?>