<?php
require_once("./src/configs/Config.php");

class Model{
	private $mysqli;
	private $select;
	private $insert;
	private $md5;
	private $title;
	private $data;
	private $result;
	
	function __construct(){ // Singleton
		$this->mysqli = new mysqli(SERVERNAME, USERNAME, PASSWORD);
		if ($this->mysqli->connect_error) {
		   throw new Exception("Failed to connect to MySQL: (" . $this->mysqli->connect_errno . ") " . 
						$this->mysqli->connect_error .	"<br>You may have forgotten to create the DB. ".
						"Try running CreateDB.php from the cmd");
		} 
		if($this->mysqli->query("use ". DB) !== TRUE){
			throw new Exception("Error: " . $this->mysqli->error);
		}
		
		if($this->select = $this->mysqli->prepare("SELECT * FROM Charts WHERE md5 = ?")){
			$this->select->bind_param("s", $this->md5);
			$this->select->bind_result($this->result["md5"], $this->result["title"], $this->result["data"]);
		}
		else{
			throw new Exception("Failure to prepare SELECT statement");
		}
		
		
		if($this->insert = $this->mysqli->prepare("INSERT INTO Charts VALUES(?,?,?)") ){
			$this->insert->bind_param("sss", $this->md5, $this->title, $this->data);
		}
		else{
			throw new Exception("Failure to prepare INSERT statement");
		}
		
	}
	
	public function insert($md5, $title, $data){
		$this->md5 = $md5;
		$this->title = $title;
		$this->data = $data;
		$this->insert->execute();
	}
	
	public function select($md5){
		$this->md5 = $md5;
		$this->select->execute();
		$this->select->fetch(); 
		return $this->result;
	}
	
	public function select2D($md5){
		$result = $this->select($md5);
		$data = $result["data"];
		unset($result["data"]);
		
		$array = preg_split("/\\r\\n|\\r|\\n/", $data); 
		foreach($array as &$value) $value = explode(',', $value);
		
		$result["x's"] = count($array);
		$result["y's"] = count($array[0])-1;
		
		return array_merge($result, $array);
	}
	
	public function closeConn(){
		$this->mysqli->close();
	}
	
}
/*
$output[0]["title"] = "myTitle"




*/