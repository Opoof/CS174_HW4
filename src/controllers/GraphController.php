<?php
require_once("./src/views/GraphView.php");

class GraphController{
	private $tuple;
	
	public function processRequest(){
		if($this->validate()){
			$model = new Model();
			$model->insert($tuple["md5"], $tuple["title"], $tuple["data"]);
		}
		else{
			throw new Exception("Data validation failed"); /*Except don't really, just cancel the operation and give the user a message*/
		}
	}
	
	public function validate(){
		$data = $_REQUEST["data"];
		
		// ...
		
		$tuple["md5"] = hash('md5', $data);
		$tuple["title"] = $_REQUEST["title"];
		$tuple["data"] = $data;
		return true;
	}
}
