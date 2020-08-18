<?php

$application_path="E:/Jayant/xampp/htdocs/voting/";
$application_url="http://localhost/voting/";


function init(){
	session_start();
	ob_start();
	date_default_timezone_set("Asia/Kolkata");
	
	if(!isset($_SESSION["VOTING_islogin"])) {
		$_SESSION["VOTING_islogin"]=0;
	}
	if(!isset($_SESSION["VOTING_uid"])) {
		$_SESSION["VOTING_uid"]=0;
	}
	if(!isset($_SESSION["VOTING_userfullname"])) {
		$_SESSION["VOTING_userfullname"]="";
	}
	if(!isset($_SESSION["VOTING_useremail"])) {
		$_SESSION["VOTING_useremail"]="";
	}
	if(!isset($_SESSION["VOTING_utype"])) {
		$_SESSION["VOTING_utype"]=0;
	}
	if(!isset($_SESSION["VOTING_proj"])) {
		$_SESSION["VOTING_proj"]="Voting";
	}
	if(!isset($_SESSION["VOTING_req_page"])) {
		$_SESSION["VOTING_req_page"]="";
	}
	if(!isset($_SESSION["VOTING_adminemail"])) {
		$_SESSION["VOTING_adminemail"]="jayant.jose@reontel.com";
	}
}
?>