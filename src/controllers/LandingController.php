<?php

namespace roomMates\hw4\controllers;

require_once("./src/views/LandingView.php");
require_once("Controller.php");

class LandingController implements Controller{
	public function processRequest(){
		$data = [];
		$landing = new LandingView();
		$landing->render($data);
	}
}