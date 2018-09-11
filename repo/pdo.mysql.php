<?php
class ConMySQL{
	private $host 	= "";
	private $user 	= "";
	private $pswd 	= "";
	private $db 	= "";
	private $dbh 	= "";

	public function getHost()	{ return $this->host; 	}
	public function getUser()	{ return $this->user; 	}
	public function getPswd()	{ return $this->pswd; 	}
	public function getDB()		{ return $this->db; 	}
	public function getDBH()	{ return $this->dbh; 	}

	public function setHost ($host)	{ $this->host = $host; 	}
	public function setuser ($user)	{ $this->user = $user; 	}
	public function setPswd ($pswd)	{ $this->pswd = $pswd; 	}
	public function setDB	($db)	{ $this->db = $db; 		}
	public function setDBH  ($dbh)	{ $this->dbh = $dbh; 	}

	public function __construct(){
		$this->setHost($host);
		$this->setUser($user);
		$this->setPswd($pswd);
		$this->setDB($db);
		try{
			$dsn = "host: ".$this->getHost();
			$dbh = new PDO("mysql: ".$dsn,$this->getUser(),$this->getPswd(),$this->getDB());
			$this->setDBH($dbh);
		}catch(Exception $e){
			return "Connection error ". $e->getMessage();
		}
	}

	public function lookup($query){
		$dataset = array();
		$conn = $this->getDBH();
		$result = $conn->query($query);
		while($row = $result->fech_assoc()){
			$dataset[] = $row;
		}
		return $dataset;
	}

	public function exec_sql($query){
		$conn = $this->getDBH();
		if($conn->query($query)){
			return true;
		}else{
			return false;
		}
	}
}
?>
