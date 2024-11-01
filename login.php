<?php
session_start();
	$to = $_REQUEST['uname'];
	$pass = $_REQUEST['pwd'];
	$sms = "You are now logged into Way2SMS.";

	include_once "tfs.sms.class.php";
	
	$sms=new tfsSMS();
	$result=$sms->login($to,$pass);
//	$result=tfssms($to,$sms);
		
			if($result==true)
			{
				$_SESSION['uname'] = $to;
				$_SESSION['pass'] = $pass;

				echo "Logged in successfully!";
			}
			else
			{	
				session_destroy();
				echo "Unable to Login, Please Try Again!";
			}
?>