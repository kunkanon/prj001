<?php  
session_start();
require_once('../util/inc.php');
new IncSys(array('repo'),"php");
$conn = new ConMySQL(GHOST,GNAME,GPASS,GDB);
$dataset = array();
$data = array();
$data[] = $_POST['iduser'];
$data[] = str_replace("auth_","",$_POST['codeColeta']);
if($_POST['type']=='updateAuthuser'){
	$sql = "UPDATE tbl_usuario_catador_coleta SET coleta_ativa = 'S' WHERE codigo_usuario = '".$data[0]."' AND codigo_coleta = '".$data[1]."'";
	$resp = $conn->exec_sql($sql);
	if($resp){
		$dataset[0] = 1;
	}else{
		$dataset[0] = 0;
		$dataset[1] = $resp;
	}
}
$conn->close($conn);
echo json_encode($dataset,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
?>