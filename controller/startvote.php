<?php
include_once("controller/auth.php");

include_once("modal/vt_candidate.mdl.php");
$vt_candidate_mdl = new vt_candidate_mdl();

$vt_candidate_list = $vt_candidate_mdl->list_data("status=1");

$classary=array();
foreach($vt_candidate_list as $vlist) {
	$classary[$vlist["classname"]] = $vlist["classname"];
}



?>