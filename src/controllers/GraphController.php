<?php

//namespace roomMates\hw4\controllers;

require_once("./src/views/GraphView.php");
require_once("Controller.php");

class GraphController implements Controller{
	
	public function processRequest(){
		if(isset($_GET["arg1"]) and isset($_GET["arg2"])){
			$model = new Model();
			$result = $model->select2D($_GET["arg2"]);							
			$model->closeConn();
			
			$graph = new GraphView();
			$graph->render($result);
		}
		else{
			$rc = $this->validate();
			if($rc == "valid"){
				$model = new Model();
				$hash = hash('md5', $_REQUEST["data"]);
				$model->insert($hash, $_REQUEST["title"], $_REQUEST["data"]);
				
				$result = $model->select2D($hash);			
				
				$model->closeConn();
				
				$graph = new GraphView();
				$graph->render($result);
			}
			else{
				$landing = new LandingView();
				$landing->render(array("rc" => $rc));
			}
		}
	}
	
	public function validate(){
		$_REQUEST["data"] = ltrim(rtrim($_REQUEST["data"], "\x00..\x1F"),"\x00..\x1F");
		
		$array = preg_split("/\\r\\n|\\r|\\n/", $_REQUEST["data"]); 
		if(count($array) > 50) return "too_many_lines";
		
		for($i = 0; $i < count($array); $i++){
			if(strlen($array[$i]) > 80) return "too_many_chars";
		}
		
		foreach($array as &$value) $value = explode(',', $value);
		
		$num_args = count($array[0]);
		for($i = 1; $i < count($array); $i++){
			if(is_null($array[$i][0])) return "null_label";
			if(count($array[$i]) != $num_args) return "diff_num_of_args";
			for($j = 1; $j < count($array[$i]); $j++){
				if(!is_numeric($array[$i][$j])) return "not_numeric_val";
			}
		}

		return "valid";
	}
}
