
<body>
<?php 
 session_start();

 // ini_set('display_errors',1);
 // error_reporting(E_ALL);
//unset all seesion on index page--------------------------------
session_destroy();
session_start();
include('config.php');
//$_REQUEST['email']='jeetendra@outrightcrm.com';
   //check email id exists or not----------------------------------------------------------------
 if (isset($_REQUEST['email']) )
   {
   
                   
                    $get_entry_list_parameters = array(

         //session id
         // 'session' => $session_id,
         "session" => $_SESSION['session_id'],
         //The name of the module from which to retrieve records
         'module_name' => 'outr_employee',

         //The SQL WHERE clause without the word "where".
         'query' => " outr_employee.id  in (SELECT email_addr_bean_rel.bean_id FROM email_addresses LEFT JOIN email_addr_bean_rel ON email_addr_bean_rel.email_address_id = email_addresses.id where email_addresses.email_address = '".$_REQUEST['email']."' ) ",
         
         //The SQL ORDER BY clause without the phrase "order by".
         'order_by' => "",

         //The record offset from which to start.
         'offset' => '0',

         //Optional. A list of fields to include in the results.
         'select_fields' => array(
              'id',
              'sick_leave_c',
              'casual_leave_c',
              'total_leave_c',
              'probation_period_c',
              'name',
              
         ),

       
         'link_name_to_fields_array' => array(
            'email_addr_bean_rel'
         ),

    
    );
// print_r($get_entry_list_parameters);
     $get_entry_list_result = call_curl('get_entry_list', $get_entry_list_parameters);

  
    $_SESSION['record_id']=$get_entry_list_result->entry_list['0']->id;
    $_SESSION['emp_data']=$get_entry_list_result->entry_list['0']->name_value_list;
   //  echo  "<pre>";
   //  print_r($get_entry_list_result);
   // print_r($_SESSION['emp_data']->name->value);
//----------code for otp varification -----if email id found-----------------------------------------------------
    if($_SESSION['record_id'])
    {


    	$_SESSION['email']=$_REQUEST['email'];
        if(!$_SESSION['otpno']){
			$_SESSION['otpno']=rand(100000, 999999);}//OTP generate

			require_once 'mailer/class.phpmailer.php'; 
			   //creates object
			  $mail = new PHPMailer(true); 
			   $email      = $_SESSION['email'];
			   $subject    = "OTP from outrightcrm login ";
			         
			   $message  = "<h1 style='color:Green'> Hi your otp for employee login  is  <hr> ". $_SESSION['otpno'];
			 try
			   {
			    $mail->IsSMTP(); 
			    $mail->isHTML(true);
			    $mail->SMTPDebug  = 0;                     
			    $mail->SMTPAuth   = true;                  
			    $mail->SMTPSecure = "ssl";                 
			    $mail->Host       = "smtp.gmail.com";      
			    $mail->Port        = '465';             
			    $mail->AddAddress($email);
			    $mail->Username   ="shriganpatinamah@gmail.com";  
			    $mail->Password   ="OutRightCRM1234#";            
			    $mail->SetFrom('noreply@outrightcrm.com','outrightcrm.com');
			    $mail->AddReplyTo("noreply@outrightcrm.com","outrightcrm.com");
			    $mail->Subject    = $subject;
			    $mail->Body    = $message;
			    $mail->AltBody    = $message;
			     
			    if($mail->Send())
			    {
			     
			     $msg = "Hi, Your mail successfully sent to".$email." ";}
			     //echo "<script>window.location='otp_check.php'</script>";
                   header("location:otp_check.php");


                }
                catch(phpmailerException $ex)
               {
                $msg = "<div class='alert alert-warning'>".$ex->errorMessage()."</div>";

   
                }
 

}
else {  echo "
            <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
            <script>
            // swal('TRY AGAIN!', 'Email id not found !', 'error');
            swal('TRY AGAIN!', 'Email id not found !', 'error').then( () => {
    location.href = 'index.php'
})
           </script>
            ";             }
   }
   
    
      ?>





















