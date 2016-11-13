<?php
require_once("./src/views/Landing.php");

$land = new Landing();
$land->render(array("primary" => true));