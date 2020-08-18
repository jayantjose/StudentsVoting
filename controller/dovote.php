<?php
include_once("controller/auth.php");

include_once("class/vt_vote.class.php");
$vt_vote_obj = new vt_vote();
    
include_once("modal/vt_vote.mdl.php");
$vt_vote_mdl = new vt_vote_mdl();

include_once("modal/vt_candidate.mdl.php");
$vt_candidate_mdl = new vt_candidate_mdl();

if(isset($_REQUEST["classname"])) {
	$classid =  $_REQUEST["classname"];
}
else {
	$classid =  "xx";
}


$vt_candidate_list = $vt_candidate_mdl->list_data('vt_candidate.status=1 and vt_candidate.classname="' .$classid . '"');


?>