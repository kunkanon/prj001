<?php
session_start();
require_once('../util/inc.php');
new IncSys(array('repo'),"php");
$conn = new ConMySQL(GHOST,GNAME,GPASS,GDB);
$dataset = array();
$data=array();
if(isset($_POST['cpf']) && isset($_POST['email']) && isset($_POST['pswd'])){
	if(!empty($_POST['cpf']) && !empty($_POST['email']) && !empty($_POST['pswd'])){
		$sql = "SELECT COUNT(*) FROM tbl_usuarios WHERE cfp_cpnj = '".$_POST['cpf']."'";
		$rs = $conn->lookup($sql);
		if($rs[0][0]==0){
			$data[] = "'".$_POST['name']."'";
			$data[] = "'".$_POST['email']."'";
			$data[] = $_POST['cpf'];
			$data[] = (empty($_POST['rg']) ? 'null' : $_POST['rg'] );
			$data[] = "'".$_POST['address']."'";
			$data[] = (empty($_POST['number']) ? 'null' : $_POST['number'] );
			$data[] = (empty($_POST['cep']) ? 'null' : $_POST['cep'] );
			$data[] = "'".$_POST['bairro']."'";
			$data[] = "'".$_POST['cidade']."'";
			$data[] = "'".$_POST['estado']."'";
			$data[] = (empty($_POST['litro']) ? 'null' : $_POST['litro'] );
			$data[] = (empty($_POST['phone']) ? 'null' : $_POST['phone'] );
			$data[] = "'".$_POST['pswd']."'";
			$data[] = $_POST['pj'];
			$table = "tbl_usuarios";
			$colum_litro = (!empty($_POST['pj']) ? "catador_cap_coleta" : "qtd_lt_padrao");
			$value = implode(",",$data);
			$sql = "INSERT INTO tbl_usuarios ";
			$sql .= "(nome,email,cfp_cpnj,rg,endereco,numero,cep,bairro,cidade,estado,".$colum_litro.",telefone,pswd,categoria)";
			$sql .= " VALUES (".$value.")";
			$resp = $conn->exec_sql($sql);
			if($resp){
				$dataset[0] = "1";
				$sql = "SELECT LAST_INSERT_ID()";
				$rs = $conn->lookup($sql);
				$dataset[1] = $rs[0][0];
				if($colum_litro=='catador_cap_coleta'){
					$_SESSION['main']['empresa'] = true;
				}
				$_SESSION['main']['user'] = $dataset[1];
				$_SESSION['main']['dt'] = date('YmdHis');
				
			}else{
				$dataset[0] = "0";
				$dataset[1] = $resp;
			}
		}else{
			$dataset[0] = "0";
			$dataset[1] = "Cadastro com cpf/cnpj ja existente";
		}
	}else{
		$dataset[0] = "0";
		$dateset[1] = "Dados inválidos";
	}
}else{
	$dataset[0] = "0";
	$dateset[1] = "Dados inválidos";
}
$conn->close($conn->getDBH());
echo json_encode($dataset,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
?>