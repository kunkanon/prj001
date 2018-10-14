<?php  
session_start();
require_once('../util/inc.php');
new IncSys(array('repo'),"php");
$conn = new ConMySQL(GHOST,GNAME,GPASS,GDB);
$dataset = array();
$data = array();

$data[] = $_POST['dataini'];
$data[] = $_POST['datafin'];
$data[] = $_POST['code'];

$sql = "SELECT * FROM tbl_usuario_catador_coleta WHERE data_coleta_criada BETWEEN ".$data[0]." AND ".$data[1];
$rs = $conn->lookup($sql);
$_SESSION['main']['report'] = "";
if(isset($rs[0][0])){
	$sql = "SHOW COLUMNS FROM tbl_usuario_catador_coleta";
	$ds = $conn->lookup($sql);
	$dataset[0] = 1;
	$_SESSION['main']['report'] .= "<thead>";
	
	foreach($ds as $values){
		$_SESSION['main']['report'] .= "<tr>";
		foreach($values as $value){
			$_SESSION['main']['report'] .= "<th>".strtoupper($value)."</th>";
		}
		$_SESSION['main']['report'] .= "</tr>";
	}
	$_SESSION['main']['report'] .= "</thead>";
	$_SESSION['main']['report'] .= "<tbody>";
	foreach($rs as $values){
		$_SESSION['main']['report'] .= "<tr>";
		foreach ($rs as $value) {
			$_SESSION['main']['report'] .= "<td>".strtoupper($value)."</td>";	
		}
		$_SESSION['main']['report'] .= "</tr>";
	}
	$_SESSION['main']['report'] .= "</tbody>";
	$dataset[1] = $_SESSION['main']['report'];
}else{
	$dataset[0] = 0;
}

$conn->close($conn->getDBH());
echo json_encode($dataset,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
?>