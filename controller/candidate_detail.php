<?php 

include_once("controller/auth.php"); 

$error_msg="";

include_once("class/vt_candidate.class.php");
$vt_candidate_obj = new vt_candidate();
include_once("modal/vt_candidate.mdl.php");
$vt_candidate_mdl = new vt_candidate_mdl();
include_once("controller/form_controlls.php");
$form_controls = new Form_Controls();


if(isset($_REQUEST['id'])) {
	$sel_id	= $_REQUEST['id'];
	$vt_candidate_mdl->fetch_by_id($sel_id,$vt_candidate_obj);
}

if(isset($_REQUEST['activate'])) {
	$sel_id	= $_REQUEST['activate'];
	$vt_candidate_mdl->status_update($sel_id,1);
	header("location:candidate");
}
if(isset($_REQUEST['deactivate'])) {
	$sel_id	= $_REQUEST['deactivate'];
	$vt_candidate_mdl->status_update($sel_id,9);
	header("location:candidate");
}


if(isset($_REQUEST['submit'])) {
 	$vt_candidate_obj->set_cname($_REQUEST['txt_cname']);
	$vt_candidate_obj->set_classname($_REQUEST['txt_classname']);

 	if($_REQUEST['txt_id'] >0) {


        if($vt_candidate_mdl->update_data($vt_candidate_obj)) {
            header("location:candidate");
        }
        else {
            $error_msg="Error in updating record";
        }
    }
 	else {
	        $new_member_id =$vt_candidate_mdl->insert_data($vt_candidate_obj);
        if($new_member_id >0) {

            header("location:candidate");
        }
        else {
            $error_msg="Error in adding new record";
        }
    }
}

$form_controls->data_obj = $vt_candidate_obj;

?>