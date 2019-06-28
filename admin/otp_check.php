<?php   session_start();  

if(!$_SESSION['emp_data'])
{
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard </title>

   <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
  
<style type="text/css">body {
      /*background-image: url(https://outrightdev.link/interview_process/images/logo.png);*/
    background-repeat: no-repeat;
    background-size: 100%;
  margin: 0;
  padding: 0;
  /*background-color: black;*/
  height: 100vh;
}
#login .container #login-row #login-column #login-box {
  margin-top: 120px;
  max-width: 600px;
  height: 320px;
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
}</style>
</head>
<body>





    <div id="login">
        <!-- <h3 class="text-center text-white pt-5">OTP submit</h3>
        <h2 class="text-center" style="color: red" id="wrongotp"></h2> -->
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="">
                            <h3 class="text-center text-info"></h3>
                            
                            <div class="form-group" >
                                <label for="usernaame" class="text-info">Enter otp: <hr>OTP  send to   <?php echo $_SESSION['email'];?></label><br>
                                <input type="text" name="otp" id="useraname" class="form-control" required="">
                            </div>
                           
                            <div class="form-group">
                                
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                                <a href="index.php">Resend otp</a>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>



<?php

// print_r($_SESSION['emp_data']);
// //echo $_SESSION['otpno'];

   if (isset($_REQUEST['submit']) )
{ 


//die; 

if($_REQUEST['otp']==$_SESSION['otpno'])
{
  $_SESSION['otpcheck']="true";

  header("location:dashboard.php");
}
else
{
  // <!-- echo $_REQUEST['otp'];
  // echo $_SESSION['otpno']; -->
echo "
<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
<script>
swal('TRY AGAIN!', 'WRONG OTP !', 'error');

</script>";

}
}
?>

