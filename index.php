<?php
require_once("src/controllers/LandingController.php");
require_once("src/controllers/GraphController.php");


if(isset($_REQUEST["submit"])){
	$controller = new GraphController();
}
else /* if(isset($_REQUEST["Landing"])) */{
	$controller = new LandingController();
}
$controller->processRequest();

