<?php
include("../db/db.php");

if(isset($_REQUEST['candidate_id'])) {
	$cand_id = $_REQUEST['candidate_id'];
	
	$sql_sel= 'insert into vt_vote (candidate_id) values ("'. $cand_id .'")';
	$GLOBALS['conn']->query($sql_sel);

	$new_udid = mysqli_insert_id($GLOBALS['conn']);
	if($new_udid>0){
		$rv = $new_udid;
	}
	else{
		$rv = 0;
	}	

	// encoding array to json format
	echo json_encode($rv);
}
?>