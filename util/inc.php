<?php
class IncSys {
	public function __construct($strs = array(),$type){
		$data = parse_ini_file(".env");
		define("GHOST",$data['HOST']);
		define("GNAME",$data['NAME']);
		define("GUSER",$data['USER']);
		define("GPASS",$data['PASS']);
		define("GDB",$data['DB']);
		$data = array();
		foreach($strs as $str){
			$data = array_diff(scandir(str_replace('util/inc.php',$str,__FILE__)),array('..','.'));
			foreach($data as $val){
				if(pathinfo($val,PATHINFO_EXTENSION) == $type){
					
					require_once(str_replace('util/inc.php',$str.DIRECTORY_SEPARATOR,__FILE__).$val);
				}
			}
		}
	}
}
?>

