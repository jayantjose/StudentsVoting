<?php
include_once("config/config.php");
include_once("db/db.php");

init();

if($_SESSION["VOTING_islogin"]==0) {
	$page="login";
	if(isset($_GET["page"])){
		if($_GET["page"] != "login") {
			$_SESSION["VOTING_req_page"]=$_GET["page"];
		}
	}
}
else {
	if(isset($_GET["page"])){
		$page=$_GET["page"];	
	}
	else{
		$page="home";
	}
}

$page_ctrl=$application_path . "controller/" . $page . ".php";
$page_view=$application_path."view/". $page .".tpl.php";
 
if(!file_exists($page_ctrl)){
    $page="error";
    $page_ctrl=$application_path . "controller/" . $page . ".php";
    $page_view=$application_path."view/". $page .".tpl.php";
}
if(!file_exists($page_view)){
    $page="error";
    $page_ctrl=$application_path . "controller/" . $page . ".php";
    $page_view=$application_path."view/". $page .".tpl.php";
}

require_once($page_ctrl);
require_once($page_view);
ob_end_flush();
	
?>