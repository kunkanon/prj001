<?php  
session_start();
require_once('../util/inc.php');
new IncSys(array('repo'),"php");
$conn = new ConMySQL(GHOST,GNAME,GPASS,GDB);
$dataset = array();
if(!isset($_POST['usrLogin']) || !isset($_POST['usrPswd'])){
	$dataset['error'] = "Usuario ou senha não informados";
	if(!isset($_POST['usrLogin'])){
		$dataset['login'] = "Login não definido";
	}
	if(!isset($_POST['usrPswd'])){
		$dataset['password'] = "Senha não informada";
	}
}else{
	if(empty($_POST['usrLogin']) || empty($_POST['usrPswd'])){
		$dataset['login'] = "Login não definido";
		$dataset['password'] = "Senha não informada";	
	}else{
		$sql = "SELECT COUNT(*),codigo,categoria FROM tbl_usuarios WHERE email = '".$_POST['usrLogin']."' AND pswd = '".$_POST['usrPswd']."'";
		$rs = $conn->lookup($sql);
		$dataset['count'] = $rs[0][0];
		$dataset['user'] = $rs[0][1];
		$_SESSION['main']['user']=$dataset['user'];
    	$_SESSION['main']['dt']=date('YmdHis');
    	if($rs[0][2]=='2'){
    		$_SESSION['main']['empresa'] = true;
    	}
	}
}
$conn->close($conn->getDBH());
echo json_encode($dataset,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
?>