<?php 
session_start();
$crmurl = 'http://crm.outrightcrm.com/service/v4/rest.php';
// $crmurl = 'http://localhost/crm_registration/crm_registration1/service/v4/rest.php';
function call_curl($method,$param,$is_upload=0) {
	global $user_name,$crmurl;	
	$curl = curl_init($crmurl);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$json = json_encode($param);
	$postArgs = array(
	    'method' => $method,
	    'input_type' => 'JSON',
	    'response_type' => 'JSON',
	    'rest_data' => $json,
	    );
	if($is_upload){
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		'Content-Type: multipart/form-data', 
 		"Cache-Control: no-cache", 
 //“OAuth-Token: $token”
	));
	}
	curl_setopt($curl, CURLOPT_POSTFIELDS, $postArgs);
	$response = curl_exec($curl);
	$result = json_decode($response);
	if ( !isset($result) ) {
	   // die("Error: {$result->name} - {$result->description}\n.");
	}	
	return $result;
 }
function crm_login($username,$password) {
		global $user_name,$crmurl;	

			$login_parameters = array(
				 "user_auth"  => array(
					  "user_name" => $username,
					  "password"  => md5($password),
					  "version"   => "1"
				 ),
				 "application_name" => "RestTest",
				 "name_value_list"  => array(),
			);
			
			$login_result = call_curl("login", $login_parameters, $crmurl);
			  if(isset($login_result->id)){					
					   return $session_id = $login_result->id;
				   } else {					 
				    return false;
				   }
		}
		    
    if(!$_SESSION['session_id']){
    $crmuname = "Interview_admin_19";
    $crmpswd =  "Rock@Outright2019";
    $_SESSION['session_id'] = crm_login($crmuname,$crmpswd,$crmurl);
 //echo 'I am new session  ID '.$_SESSION['session_id'];
// 	echo '<hr/>';	
    }
//if(!$_SESSION['record_id']){echo "<script>alert('record id Session not found');</script>";} 
?>
