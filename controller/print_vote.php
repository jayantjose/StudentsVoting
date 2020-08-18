<?php
include_once("controller/auth.php");

include_once("modal/vt_vote.mdl.php");
$vt_vote_mdl = new vt_vote_mdl();

$class_name = "";
if(isset($_REQUEST['classname'])){
	$class_name = $_REQUEST['classname'];
}


$vt_vote_list = $vt_vote_mdl->list_vote('vt_candidate.status=1 and vt_candidate.classname = "'. $class_name  .'"' );

?>