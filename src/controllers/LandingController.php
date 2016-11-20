<?php
require_once("./src/views/LandingView.php");
require_once("Controller.php");

class LandingController implements Controller{
	public function processRequest(){
		$landing = new LandingView();
		$landing->render(null);
	}
}