<?php

$_SESSION["VOTING_islogin"]=0;
$_SESSION["VOTING_utype"]=0;
$_SESSION["VOTING_uid"]=0;
$_SESSION["VOTING_userfullname"]="";
$_SESSION["VOTING_useremail"]="";
$_SESSION['VOTING_mem_page'] = "";
$_SESSION['VOTING_search_cond'] ="";
$_SESSION["VOTING_req_page"] = "";

header("location:login");
?>

