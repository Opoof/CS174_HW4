<?php
require_once("./src/configs/Config.php");

class Model{
	public $mysqli;
	public $select;
	public $insert;
	
	function __construct(){
		$mysqli = new mysqli($servername, $username, $password);
		if ($mysqli->connect_error) {
		   $message = "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error .
						"<br>You may have forgotten to create the DB. Try running CreateDB.php from the cmd";
		} 
		if($mysqli->query("use ".$database) !== TRUE){
			$message = "Error: " . $mysqli->error;
		}
	}
	
	public function insertInto(){
		
	}
	
	public function selectFrom(){
		$result = [];
		
	}
}