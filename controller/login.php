<?php
$error_msg="";
include_once("class/vt_user.class.php");
$VOTING_obj=new vt_user();
include_once("modal/vt_user.mdl.php");
$VOTING_user=new vt_user_mdl();

if(isset($_REQUEST['txt_Email'])){//post back
	if($VOTING_user->user_login($_REQUEST['txt_Email'],$_REQUEST['txt_Pass'])){
		$user_page = "home";
		if(strlen(trim($_SESSION["VOTING_req_page"])) >0) {
			$user_page = $_SESSION["VOTING_req_page"];
			$_SESSION["VOTING_req_page"]="";
		}
		header('location:' . $user_page);
	}
	else{
		$error_msg="Login Failed...!";
	}
}


?>