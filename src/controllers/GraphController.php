<?php
require_once("./src/views/GraphView.php");

class GraphController{
	private $data;
	
	public function processRequest(){
		if($this->validate()){
			$model = new Model();
			$model->insert($data["md5"], $data["title"], $data["data"]);
		}
		else{
			throw new Exception("Data validation failed"); /*Except don't really, just cancel the operation and give the user a message*/
		}
	}
	
	public function validate(){
		$text = $_REQUEST["textInput"];
		
		// ...
		
		$data["md5"] = hash('md5', $text);
		$data["title"] = /*"*/null/*"*/;
		$data["data"] = /*"*/null/*"*/;
	}
}
