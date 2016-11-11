<?php   
require_once("View.php");

class Landing implements View{
	function render($data){
		?>
		<!DOCTYPE html>
		<html>
			<head>
				<link rel="stylesheet" type="text/css" href="../styles/style.css">
			</head>
			<body>
				<p>hello there</p>
			</body>
		</html>
		<?php
	}
}

$land = new Landing();
$land->render(null);