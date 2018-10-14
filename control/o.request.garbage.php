<?php  
session_start();
require_once('../util/inc.php');
new IncSys(array('repo'),"php");
$conn = new ConMySQL(GHOST,GNAME,GPASS,GDB);
$dataset = array();
$data = array();
$data[] = $_POST['iduserpj'];
$data[] = str_replace("req_","",$_POST['idcoleta']);
$sql = "SELECT codigo_usuario FROM tbl_usuario_tipo_coleta WHERE codigo = ".$data[1];
$rs = $conn->lookup($sql);
$data[] = $rs[0][0];
if($_POST['type']=='requestgarbage'){
	$sql = "INSERT INTO tbl_usuario_catador_coleta (";
	$sql .= "codigo_usuario,codigo_coleta,codigo_catador,data_coleta_criada,coleta_ativa,coleta_feita";
	$sql .= ") VALUES (";
	$sql .= "'".$data[2]."','".$data[1]."','".$data[0]."','".date("Ymd")."','P','N')";
	$response = $conn->exec_sql($sql);
}elseif($_POST['type']=='finalizacoleta'){
	$sql = "UPDATE tbl_usuario_catador_coleta SET coleta_feita='S', data_coleta_efetivada = '".date("Ymd")."' WHERE 
			codigo_usuario = ".$data[2]." AND codigo_coleta = ".$data[1]." AND codigo_catador = ".$data[0];
	$response = $conn->exec_sql($sql);
}
if($response){
	$dataset[0]=1;
}else{
	$dataset[0] = 0;
	$dataset[1] = $response;
}
$conn->close($conn);
echo json_encode($dataset,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
?>