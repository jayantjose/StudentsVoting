<?php
include_once("controller/auth.php");
    
$error_msg="";

include_once("modal/vt_vote.mdl.php");
$vt_vote_mdl = new vt_vote_mdl();

include_once("modal/vt_candidate.mdl.php");
$vt_candidate_mdl = new vt_candidate_mdl();

$vt_candidate_list = $vt_candidate_mdl->list_data("status=1");

$classary=array();
foreach($vt_candidate_list as $vlist) {
	$classary[$vlist["classname"]] = $vlist["classname"];
}

$class_name = "";
if(isset($_REQUEST['class_name'])){
	$class_name = $_REQUEST['class_name'];
}

$vt_vote_list = $vt_vote_mdl->list_vote('vt_candidate.status=1 and vt_candidate.classname = "'. $class_name  .'"' );
?>