<?php
include_once("controller/auth.php");
    
$error_msg="";

 include_once("modal/vt_candidate.mdl.php");
 $vt_candidate_mdl = new vt_candidate_mdl();
 
 
 $candidate_list = $vt_candidate_mdl->list_data();

 
 ?>