<?php
	if($_SESSION["VOTING_islogin"] <=0) {
		header("location: login");
	}
?>