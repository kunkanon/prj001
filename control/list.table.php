<?php
require_once('../util/inc.php');
class Controller extends IncSys{
	private $dbh = "";

	public function setDBH($dbh){ $this->dbh = $dbh; }
	public function getDBH() { return $this->dbh; } 
	public function __construct(){
		$include = new IncSys('repo');
		$this->setDBH(new ConMySQL());
	}

	public function userOAuth($usr,$pswd){
		$handler = $this->getDBH();
		$resultset = $handler->lookup("SELECT COUNT(*),login FROM tbl_users WHERE user = '".$usr."' AND pswd = '".$pswd."'");
		if($resultset[0][0] == 0){
			return 1;
		}else{
			$_SESSION['temp']['user'] = $resultset[0][1];
			return 0;
		}
	}
}
?>
