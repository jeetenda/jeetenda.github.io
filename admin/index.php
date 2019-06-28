
<?php 
error_reporting(0);
session_start();
 if($_SESSION['emp_data'] &&  $_SESSION['otpcheck'])
{
    header("location:dashboard.php");
}?>
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
        <h3 class="text-center text-white pt-5"></h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="login.php">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email id ">
                            </div>
                            <div class="form-group" style="display: none;">
                                <label for="usernaame" class="text-info">Enter otp:</label><br>
                                <input type="emaila" name="usernamea" id="useraname" class="form-control">
                            </div>
                           
                            <div class="form-group">
                                
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>





<script>
function ajax_js_submit() {
  
var email = document.getElementById("email").value;

// Returns successful data submission message when the entered information is stored in database.
var dataString = 'email=' + email ;
if ( email=='') {
alert("Please Fill All Fields ");

} else {
// AJAX code to submit form.
$.ajax({
type: "POST",
url: "login.php",
data: dataString,
cache: false,
success: function(html) {
alert(html);

}
});
}
return false;
}

</script>