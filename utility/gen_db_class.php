<?php
$GLOBALS['conn']= new MySQLi("localhost","root","","voting");
$GLOBALS['conn']->query("SET time_zone='Asia/Kolkata';");
$GLOBALS['conn']->set_charset("utf8");


if(isset($_GET['table'])) {
	$param_table = $_GET['table'];

	$sql = "SHOW COLUMNS FROM " . $param_table;
	$rslt = $GLOBALS['conn']->query($sql);

	$ob_String = "";

	
	$ob_String .= "<?php";
	$ob_String .= "\n";
	$ob_String .= "// Class for Table - " .	$param_table;
	$ob_String .= "\n";
	$ob_String .= "\n";
	
	$ob_String .= "class ". $param_table . "{\n";
	
	while($row = $rslt->fetch_row()) {
		$ob_String .= "\t private \$" . $row[0] .";";
		$ob_String .= "\n";	
	}	
	$ob_String .= "\n";	
	$ob_String .= "\n";	
	
	mysqli_data_seek($rslt, 0);
	while($row = $rslt->fetch_row()) {

		$ob_String .= "\tpublic function get_". $row[0] ."() {";
		$ob_String .= "\n";
		$ob_String .= "\t\t	return \$this->".$row[0] .";"; 
		$ob_String .= "\n";
		$ob_String .=  "\t}";
		$ob_String .= "\n";


		$ob_String .= "\tpublic function set_". $row[0] ."(\$p_value) {";
		$ob_String .= "\n";
		$ob_String .= "\t\t	\$this->".$row[0] ." = \$p_value;"; 
		$ob_String .= "\n";
		$ob_String .=  "\t}";
		$ob_String .= "\n";
			
	}	
	$ob_String .= "\n";
	$ob_String .= "\n";
	$ob_String .= "}\n";
	$ob_String .= "?>";

	echo 	$ob_String;
	
}
else {
	echo "No Tables requested";	
}

?>