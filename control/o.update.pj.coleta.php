<?php 
session_start();
require_once('../util/inc.php');
new IncSys(array('repo'),"php");
$conn = new ConMySQL(GHOST,GNAME,GPASS,GDB);
$dataset = array();
$data=array();
$data[] = $_POST['type'];
$data[] = str_replace("pj_","",$_POST['idcoleta']);
$data[] = $_POST['iduserpj'];

if($data[0]== "activecoletapj"){
	$sql = "INSERT INTO tbl_usuario_tipo_coleta (codigo_usuario,codigo_coleta,coleta_ativa) VALUES ('".$data[2]."','".$data[1]."','S')";
}else if($data[0]== "disablecoletapj"){
	$sql = "UPDATE tbl_usuario_tipo_coleta SET coleta_ativa = 'N' WHERE codigo_usuario = '".$data[2]."' AND codigo_coleta = '".$data[1]."'";
}else if($data[0] == "enablecoletapj"){
	$sql = "UPDATE tbl_usuario_tipo_coleta SET coleta_ativa = 'S' WHERE codigo_usuario = '".$data[2]."' AND codigo_coleta = '".$data[1]."'";
}
$result = $conn->exec_sql($sql);
if($result){
	$dataset[0] = "1";
	$usrsession = $_SESSION['main']['user'];
	$dtini = $_SESSION['main']['dt'];


$sql = "SELECT nome,descricao,codigo FROM tbl_categoria_coleta";
$rs = $conn->lookup($sql);
	$_SESSION['main']['table']['default'][$dtini][$usrsession] = "
<div class='row'>
	<div class='col-lg-12 mx-auto text-center'>
		<table class='table table-bordered'>
			<thead>
				<tr>
					<th>TIPOS DE COLETA</th>
				</tr>
			</thead>
		</table>
		<table class='table table-striped'>
			<thead>
				<tr>
				<th>NOME</th>
				<th>DESCRIÇÃO</th>
				<th></th>
				</tr>
			</thead>
		<tbody>
";
foreach($rs as $values){
	$sql = "SELECT coleta_ativa FROM tbl_usuario_tipo_coleta WHERE codigo_usuario = '".$data[2]."' AND codigo_coleta = '".$values[2]."'";
	$ds = $conn->lookup($sql);	
	if(!isset($ds[0][0]) || empty($ds[0][0])){
		$coleta  = "btn-success btnpjcoleta";
		$label = "ATIVAR";
	}elseif($ds[0][0]=='S'){
		$coleta = "btn-danger disablecoletapj";
		$label = "DESATIVAR";
	}elseif($ds[0][0]=='N'){
		$coleta = "btn-success enablecoletapj";
		$label = "ATIVAR";
	}

		$_SESSION['main']['table']['default'][$dtini][$usrsession] .= "<tr>";
		$_SESSION['main']['table']['default'][$dtini][$usrsession] .= "<td>".$values[0]."</td>";
		$_SESSION['main']['table']['default'][$dtini][$usrsession] .= "<td>".$values[1]."</td>";
		$_SESSION['main']['table']['default'][$dtini][$usrsession] .= "<td><button id='pj_".$values[2]."' name='pj_".$values[2]."' type='button' class='btn  ".$coleta."' >".$label."</button></td>";
		$_SESSION['main']['table']['default'][$dtini][$usrsession] .= "</tr>";
	}
	$_SESSION['main']['table']['default'][$dtini][$usrsession] .= "</tbody></table></div></div>";

}
$conn->close($conn->getDBH());
echo json_encode($dataset,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );