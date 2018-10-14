<?php  
session_start();
require_once('../util/inc.php');
new IncSys(array('repo'),"php");
$conn = new ConMySQL(GHOST,GNAME,GPASS,GDB);
$dataset = array();
$tipo = $_POST['type'];
$data = array();
$data[] = $_SESSION['main']['user'];
$data[] = (empty($_POST['idcol']) ? 'null' : $_POST['idcol'] );
$data[] = (empty($_POST['active']) ? 'null' : $_POST['active'] );
$data[] = (empty($_POST['trashfull']) ? 'null' : $_POST['trashfull'] );
$data[] = (empty($_POST['diacol']) ? 'null' : $_POST['diacol'] );

if($_POST['type']=='updatecolregister'){
	$sql = "UPDATE tbl_usuario_tipo_coleta SET coleta_ativa = '".$data[2]."', lixo_cheio = '".$data[3]."', dia_padrao = '".$data[4]."' WHERE codigo = '".$data[1]."'";
	$result = $conn->exec_sql($sql);
	if($result){
		$dataset[0] = "1";
		$dateset[1] = "Atualização realizada com sucesso!";
	}else{
		$dataset[0] = "0";
		$dateset[1] = "Dados inválidos";
	}
}else{
	$values = "'".implode("','",$data)."'";
	$sql = "INSERT INTO tbl_usuario_tipo_coleta (";
	$sql .= "codigo_usuario,codigo_coleta,coleta_ativa,lixo_cheio,dia_padrao ) VALUES ( ";
	$sql .= $values." )";
	$result = $conn->exec_sql($sql);
	if($result){
		$dataset[0] = "1";
		$dateset[1] = "Cadastro realizada com sucesso!";
	}else{
		$dataset[0] = "0";
		$dateset[1] = "Dados inválidos";
	}
}
$conn->close($conn->getDBH());
echo json_encode($dataset,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
?>