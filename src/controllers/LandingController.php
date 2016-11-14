<?php
require_once("./src/views/LandingView.php");

class LandingController implements Controller{
	public function processRequest(){
		$data = [];
		$landing = new LandingView();
		$landing->render($data);
	}
}