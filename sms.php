<?php
	session_start();
	$to = $_REQUEST['to'];
	$sms = $_POST['sms'];
	
	$msg = urlencode($sms);
	
	include_once "tfs.sms.class.php";
	$sms=new tfsSMS();
	
	$uname = $_SESSION['uname'];
	$pass = $_SESSION['pass'];
	
	$result=$sms->login($uname,$pass);
	
	$result=$sms->send($to,$msg);
		
			if($result==true)
			{
				echo "Message sent !";
			}
			else
			{	
				echo $error;
			}
?>