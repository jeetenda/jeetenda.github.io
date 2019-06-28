<?php  
error_reporting(E_ALL);
session_start();

if(!$_SESSION['emp_data'])
{
    echo "error";
}
include('config.php');
// echo $_REQUEST['date_start'].$_REQUEST['date_end'].$_REQUEST['reason'].$_REQUEST['leave_type'].$_REQUEST['leave_days'];   
// $_REQUEST['leave_days']=3;
// $_REQUEST['leave_type']="casual";
// $_REQUEST['date_end']="07/31/2019";
// $_REQUEST['date_start']="07/27/2019";
// $_REQUEST['reason']="ese hi";


//update balance leave in crm database---------------------------------------------------------------------------------------
//if leave is casual --------------------

if($_REQUEST['leave_type']=="casual"){$leave_name="casual_leave_c";}
if($_REQUEST['leave_type']=="sick"){$leave_name="sick_leave_c";}
 $set_entry_parameter = array(
            "session" => $_SESSION['session_id'],
            "module_name" => "outr_employee",
            "name_value_list" => array(
         	array("name" => "id", "value" =>$_SESSION['record_id']),
         	//update record  or entry of record 
         	            // array("name" => "sick_leave_c", "value" => $_SESSION['emp_data']->sick_leave_c->value-$_REQUEST['leave_days']), 
                        array("name" => $leave_name, "value" => $_SESSION['emp_data']->$leave_name->value-$_REQUEST['leave_days']), 
			                 
          
         ),
    );
   

     
      $set_entry_result = call_curl("set_entry", $set_entry_parameter);
      $update = $set_entry_result->id;

      //print_r($set_entry_result);


//----------------------------------------------------------------------------------------------------------------------------
   if($update)
{
  $_REQUEST['date_start'] = date('j-F-Y', strtotime($_REQUEST['date_start'])); 
  $_REQUEST['date_end'] = date('j-F-Y', strtotime($_REQUEST['date_end'])); 
  if($_REQUEST['hd1']=="true"){$half_day1=" *(Half Day)";}
  if($_REQUEST['hd2']=="true"){$half_day2=" *(Half Day)";}
  // print_r($_REQUEST['hd1']);die;
  // date("j-F-Y"); 
	$_SESSION['emp_data']->$leave_name->value=$_SESSION['emp_data']->$leave_name->value-$_REQUEST['leave_days'];
	// $_SESSION['emp_data']->casual_leave_c->value=$_SESSION['emp_data']->$leave_name->value-$_REQUEST['leave_days'];
               require_once 'mailer/class.phpmailer.php'; 
			   //creates object
			   $mail = new PHPMailer(true); 
			   $email      = $_SESSION['email'];
			   $subject    = "leave application from ".$_SESSION['emp_data']->name->value;
			         
			   //$message  = "<h1 style='color:Green'> Hi".$_SESSION['emp_data']->name->value."  applied for ".$_REQUEST['leave_days']." leave from date ".$_REQUEST['date_start']."  to ".$_REQUEST['date_end']. "due to ".$_REQUEST['reason']."   </h1><hr>"; 

$message.="

<table>
  <!--for demo wrap-->
  <h1 
}'> Hi ".$_SESSION['emp_data']->name->value." applied for ".$_REQUEST['leave_days']." leave from date ".$_REQUEST['date_start']." to ".$_REQUEST['date_end']. " due to ".$_REQUEST['reason']."   </h1><hr>
 <table class='tbl-header'>
    <table cellpadding='10' cellspacing='10' border='2' style='background:#3b5998;color:white;border:solid yellow 5px; ' >
  
    <thead>
      <tr class='info' >
        <th colspan='2' style='text-align:center' ><h2>Leave application details</h2></th>
         </tr>
    </thead>
    <tbody>
    <tr class='success'>
        <th>Employee name</th>
        <th>".$_SESSION['emp_data']->name->value."</th>
        
      </tr>
      <tr class='danger'>
        <th>Leave start date </th>
        <th>".$_REQUEST['date_start'].$half_day1."</th>
        
      </tr>      
      <tr class='success'>
        <th>Leave end date</th>
        <th>".$_REQUEST['date_end'].$half_day2. "</th>
                
      </tr>
      <tr class='danger'>
        <th>Reason of leave</th>
        <th>".$_REQUEST['reason']. "</th>
        
              </tr>
      <tr class='info'>
        <th>Leave type</th>
        <th>".$_REQUEST['leave_type']. "</th>
        
      </tr>
      <tr class='danger'>
        <th>Total leave days</th>
        <th>".$_REQUEST['leave_days']. "</th>
        </tr>
       </tbody>
  <td>
  Made with
  <i>♥</i> by
  <a  href=''>outrightsystem</a></table>
  </table>
  
</table>";
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
                   echo $_SESSION['emp_data']->name->value."\n check your Email id a email confirmation has been sent to your email id \n". $_SESSION['email'];


                }
                catch(phpmailerException $ex)
               {
                $msg = "<div class='alert alert-warning'>".$ex->errorMessage()."</div>";

                echo $ex->errorMessage();
                }
 

}



else {

echo "error";
}
?>