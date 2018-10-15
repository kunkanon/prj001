<?php 
session_start();
require_once('../util/inc.php');
new IncSys(array('repo'),"php");
$conn = new ConMySQL(GHOST,GNAME,GPASS,GDB);
$dataset = array();
$data = array();

if($_POST['type'] == 'pj'){
	$sql = 'UPDATE tbl_usuario_catador_coleta SET avaliacao_catador = '.$_POST['field0'].',
			avaliacao_seletivo_catador = '.$_POST['field1'].',avaliacao_tratamento_catador = '.$_POST['field2'].',
			comentario_catador = "'.$_POST['field3'].'" WHERE codigo_coleta = '.$_POST['idcol'].' 
			 AND codigo_catador = '.$_POST['idusr'];
}else if($_POST['type'] =='usr'){
	$sql = 'UPDATE tbl_usuario_catador_coleta SET avaliacao_usu = '.$_POST['field0'].',avaliacao_cap_atend_usu = '.$_POST['field1'].',avaliacao_educacao_usu = '.$_POST['field2'].',avaliacao_conf_usu = '.$_POST['field3'].', comentario_usu = "'.$_POST['field4'].'"  WHERE codigo_usuario = '.$_POST['idusr'].' AND codigo_coleta = '.$_POST['idcol'];
}
$resp = $conn->exec_sql($sql);
if($resp){
	$dataset[0] = 1;
}else{
	$dataset[0] = 0;
	$dataset[1]= $resp;
}
$conn->close($conn->getDBH());
echo json_encode($dataset,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
?>