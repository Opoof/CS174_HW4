<?php   

class Landing implements View{
	static function render($data){
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

Landing->render(null);