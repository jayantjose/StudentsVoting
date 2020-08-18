<?php
include_once("controller/auth.php");

$error_msg = "";

include_once("class/vt_user.class.php");
$vt_user_obj = new vt_user();
include_once("modal/vt_user.mdl.php");
$vt_user = new vt_user_mdl();
include_once("controller/form_controlls.php");
$form_controls = new Form_Controls();

$message='';
$password = '';
$newpassword = '';

$vt_user->fetch_user($vt_user_obj, $_SESSION['VOTING_uid']);

if(isset($_REQUEST['submit'])) {
    $vt_user_obj->set_user_uid($_REQUEST['txt_user_uid']);
    $vt_user_obj->set_user_fname($_REQUEST['txt_user_fname']);
    $vt_user_obj->set_user_lname($_REQUEST['txt_user_lname']);
    $vt_user_obj->set_user_email($_REQUEST['txt_user_email']);
    $vt_user_obj->set_user_password($vt_user_obj->get_user_password());

    if($vt_user->update_data($vt_user_obj)){
        $message = '<span style="color: green">Account Details Changed Successfully</span>';
    }

    if (strlen($_REQUEST['password'])>0 && $_REQUEST['new_password'] >0) {
        $password = $_REQUEST['password'];
        $newpassword = $_REQUEST['new_password'];
        if ($vt_user->recover_pass($_SESSION["VOTING_useremail"], $newpassword, $password)) {
            $message = '<span style="color: green">Password changed successfully</span>';
        } else {
            $message = '<span style="color: red">Password Not Found</span>';
        }
    }
}
$form_controls->data_obj = $vt_user_obj;
?>