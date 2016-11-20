<?php
require_once("src/controllers/LandingController.php");
require_once("src/controllers/GraphController.php");
require_once("src/models/Model.php");


if(isset($_REQUEST["submit"]) or isset($_REQUEST["arg2"])){
	$controller = new GraphController();
}
else /* if(isset($_REQUEST["Landing"])) */{
	$controller = new LandingController();
}
$controller->processRequest();

