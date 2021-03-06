<?php
class ConMySQL{
	private $host;
	private $user;
	private $pswd;
	private $db;
	protected $dbh;

	public function getHost()	{ return $this->host; 	}
	public function getUser()	{ return $this->user; 	}
	public function getPswd()	{ return $this->pswd; 	}
	public function getDB()		{ return $this->db; 	}
	public function getDBH()	{ return $this->dbh; 	}

	public function setHost ($host)	{ $this->host = $host; 	}
	public function setuser ($user)	{ $this->user = $user; 	}
	public function setPswd ($pswd)	{ $this->pswd = $pswd; 	}
	public function setDB	($db)	{ $this->db = $db; 		}
	public function setDBH  ( $dbh)	{ $this->dbh = $dbh;}

	public function __construct($host,$user,$pswd,$db){
		$this->setHost($host);
		$this->setUser($user);
		$this->setPswd($pswd);
		$this->setDB($db);
		try{
			$dbh = new PDO("mysql:host=".$this->getHost().";dbname=".$this->getDB().";port=3306",$this->getUser(),$this->getPswd());
			$this->setDBH($dbh);
		}catch(PDOException $e){
			return "Connection error ". $e->getMessage();
		}
	}

	public function lookup($sql){
		try{
			$conn = $this->getDBH();
			$result = $conn->query($sql);	
			$dataset = $result->fetchAll();
			return $dataset;
		}catch(PDOException $e){
			return $e->getMessage();
		}
	}
	public function close($dbh){
		$this->setDBH(null);
	}
	public function exec_sql($sql){
		try{
			$conn = $this->getDBH();
			$conn->exec($sql);
			$ret = $conn->errorInfo();
			if(!empty($ret[2])){
				return $ret[2];
			}else{
				return true;
			}
		}catch(PDOException $e){
			return $e->getMessage();
		}
	}

	public function addLog($query){
		$conn = $this->getDBH();
		if($conn->exec($query)){
			return true;
		}else{
			return false;
		}
	}
}
?>
