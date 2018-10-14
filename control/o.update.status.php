<?php 
session_start();
require_once('../util/inc.php');
new IncSys(array('repo'),"php");
$conn = new ConMySQL(GHOST,GNAME,GPASS,GDB);
$dataset = array();
$data=array();
$data[] = $_POST['type'];
$data[] = $_POST['code'];
if($data[0] == "disable"){
	$sql = "UPDATE tbl_usuario_tipo_coleta SET coleta_ativa = 'N' WHERE codigo = '".$data[1]."'";
	$temp = "<button type='button' id='".$data[1]."' name='".$data[1]."' class='btn btn-danger btn-disable' >DESATIVAR</button>";
	$temp2 = "<button type='button' name='".$data[1]."' id='".$data[1]."' class='btn btn-success btn-enable' >ATIVAR</button>";

}elseif($data[0]=="enable"){
	$sql = "UPDATE tbl_usuario_tipo_coleta SET coleta_ativa = 'S' WHERE codigo = '".$_POST['code']."'";
	$temp = "<button type='button' name='".$data[1]."' id='".$data[1]."' class='btn btn-success btn-enable' >ATIVAR</button>";
	$temp2 = "<button type='button' id='".$data[1]."' name='".$data[1]."' class='btn btn-danger btn-disable' >DESATIVAR</button>";
}
$result = $conn->exec_sql($sql);
if($result){
	$dataset[0] = "1";
	$usrsession = $_SESSION['main']['user'];
	$dtini = $_SESSION['main']['dt'];
	$_SESSION['main']['table'][$dtini][$usrsession] = str_replace($temp,$temp2,$_SESSION['main']['table'][$dtini][$usrsession]);
}else{
	$dataset[0] = false;
}
$conn->close($conn->getDBH());
echo json_encode($dataset,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
?>