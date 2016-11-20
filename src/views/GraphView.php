<?php

namespace roomMates\hw4\views;

require_once("View.php");

class GraphView implements View{
	function render($data){
		?>
			<!DOCTYPE html>
			<html>
				<head>
					<link rel="stylesheet" type="text/css" href="src/styles/style.css">
				</head>
				<body>
					<h1 class="header">hello there</h1>
					<p><?php print_r($data); ?></p>	
				</body>
			</html>
		<?php
	}
}