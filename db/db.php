<?php
$GLOBALS['conn']= new MySQLi("localhost","root","","voting");

$GLOBALS['conn']->query("SET time_zone='Asia/Kolkata';");
$GLOBALS['conn']->set_charset("utf8");

?>