<?php
require_once("src/controllers/LandingController.php");
require_once("src/controllers/GraphController.php");
require_once("src/models/Model.php");
require_once("src/chartTest.php");


if(isset($_REQUEST["submit"]) or (isset($_REQUEST["arg2"]) and isset($_GET["arg2"]))){
	$controller = new GraphController();
	$controller->processRequest();
}
else{
	$controller = new LandingController();
	$controller->processRequest();
}

// $model = new Model();
// $model->insert("myHash", "myTitle", "hello,hi,grettings\ngoodbye,bye,go away");
