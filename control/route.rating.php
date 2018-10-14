<?php 
session_start();
require_once('../util/inc.php');
new IncSys(array('repo'),"php");
$conn = new ConMySQL(GHOST,GNAME,GPASS,GDB);
$dataset = array();
$data = array();
$data[] = $_POST['type'];
$data[] = str_replace("rating_","",$_POST['idcoleta']);
$data[] = $_POST['iduserpj'];
if($_POST['type']=="routeAvaliacao"){
	if(isset($_SESSION['main']['empresa']) && $_SESSION['main']['empresa']==true){
		$_SESSION['main']['rating']['columnames'] = array("avaliacao_catador","avaliacao_seletivo_catador","avaliacao_tratamento_catador","comentario_catador","anexo_foto_doc_catador");
		$colum = implode(",",$_SESSION['main']['rating']['columnames']);
		$sql = "SELECT codigo,".$colum." FROM tbl_usuario_catador_coleta WHERE codigo_catador = ".$data[2]. " 
				AND codigo_coleta = ".$data[1];
		$_SESSION['main']['rating']['placeholder'] = array("MORADOR","SELETIVIDADE","TRATAMENTO","COMENTÁRIO","ENVIAR DOCUMENTO");
	}else{
		$_SESSION['main']['rating']['columnames'] = array("avaliacao_usu","avaliacao_cap_atend_usu","avaliacao_educacao_usu","avaliacao_conf_usu","comentario_usu","anexo_foto_doc_usu");
		$colum = implode(",",$_SESSION['main']['rating']['columnames']);
		$sql = "SELECT codigo,".$colum." FROM tbl_usuario_catador_coleta WHERE codigo_usuario = ".$data[2]. " 
				AND codigo_coleta = ".$data[1];
		$_SESSION['main']['rating']['placeholder'] = array("CATADOR","ATENDIMENTO","EDUCAÇÃO","CONFIANÇA","COMENTÁRIO","ENVIAR DOCUMENTO");
	}
	$rs = $conn->lookup($sql);
	foreach($_SESSION['main']['rating']['columnames'] as $key => $values){
		$index = $key+1;
		if(isset($rs[0][$index])){
			$_SESSION['main']['rating']['values'][$key] = $rs[0][$index];
		}
	}
	$_SESSION['main']['rating']['userid'] = $data[2];
	$_SESSION['main']['rating']['colid'] = $data[1];
$dataset[0] = 1;
$dataset[1] = "avaliacao";
}
$conn->close($conn->getDBH());
echo json_encode($dataset,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
?>
