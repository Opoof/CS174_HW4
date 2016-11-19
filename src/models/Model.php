<?php

namespace roomMates\hw4\models;
use Mysqli;

require_once("./src/configs/Config.php");

class Model{
	private $mysqli;
	private $select;
	private $insert;
	private $md5;
	private $title;
	private $data;
	private $result;
	
	function __construct(){
		$mysqli = new mysqli($servername, $username, $password);
		if ($mysqli->connect_error) {
		   throw new Exception("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error .
						"<br>You may have forgotten to create the DB. Try running CreateDB.php from the cmd");
		} 
		if($mysqli->query("use ".$database) !== TRUE){
			throw new Exception("Error: " . $mysqli->error);
		}
		
		if($select = $mysqli->prepare("SELECT * FROM Charts WHERE md5 = ?") and
		$insert = $mysqli->prepare("INSERT INTO Charts VALUES(?,?,?)")){
			$select->bind_param("s", $md5);
			$select->bind_result($result["md5"], $result["title"], $result["data"]);
			$insert->bind_param("sss", $md5, $title, $data);
		}
		else{
			throw new Exception("Failure to prepare SQL statements");
		}
		
	}
	
	public function insert($hash, $chartTitle, $chartData){
		$md5 = $hash;
		$title = $chartTitle;
		$data = $chartData;
		$insert->execute();
	}
	
	public function select($hash){
		$md5 = $hash;
		$select->execute();
		$select->fetch();
		return result;
	}
	
	public function closeConn(){
		$mysqli->close();
	}
}
