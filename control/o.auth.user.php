<?php  
require_once('../util/inc.php');
new IncSys(array('repo'),"php");
$conn = new ConMySQL(GHOST,GNAME,GPASS,GDB);
$rs = $conn->lookup("SELECT COUNT(*),login,category FROM tbl_users WHERE login = '".$_POST['usrLogin']."' AND pswd = '".$_POST['usrPswd']."'");
$dataset = array();
$dataset['count'] = $rs[0][0];
$dataset['user'] = $rs[0][1];
$dataset['category'] = $rs[0][2];
echo json_encode($dataset);
?>