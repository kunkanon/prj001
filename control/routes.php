<?php 
require_once('../util/inc.php');
new IncSys(array('repo'),"php");
$conn = new ConMySQL(GHOST,GNAME,GPASS,GDB);
switch ($_POST['type']) {
	case 'mainview':
		$sql = "SELECT * FROM tbl_data WHERE fk_usr = '".$_POST['code']."' AND category = '".$_POST['category']."'";
		$redirect = "main";
	break;
	default:
		$sql = "";
		$redirect = "";
	break;
}
$rs = $conn->lookup($sql);
$dataset = array();
$dataset[0] = $rs;
$dataset[1] = $redirect;
echo json_encode($dataset);
?>