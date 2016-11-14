<?php   
require_once("View.php");

class LandingView implements View{
	function render($data){
		$formatDescription = "The data format should be a comma separated list of values, one per line, up to 50 lines of at most 80 ".
			"characters, representing points to be plotted. The first coordinate should represent a text label (can involve numbers but ".
			"can't involve a comma), the remaining coordinates should represent values that correspond to that text label from up to 5 ".
			"sources. For example, the text labels might have months of the year (Jan, Feb, etc) and the values could correspond to the ".
			"rabbit and wolf populations during those months in thousands. In which case, rows of data entered into the textarea might ".
			"look like: \n \nJan,600,5.4 \nFeb,450,5.0 \n... \nOn every row, the first coordinate must be a nonempty string, however, for ".
			"the remaining coordinates if a value is missing, we represent that with the empty string. For example: \nAug,,10.1";
		?>
		<!DOCTYPE html>
		<html>
			<head>
				<link rel="stylesheet" type="text/css" href="src/styles/style.css">
			</head>
			<body>
				<h1 class="header">PasteChart</h1>
				<p class="header">Share your data in charts!</p>
				
				<form method="POST" id="landing" action="index.php">
					<label for="textInput">Chart Title</label><br>
					<textarea name="textInput" rows="14" cols="120" placeholder="<?php echo $formatDescription; ?>"></textarea><br>
					<input name="submit" type="submit">
				</form>
			</body>
		</html>
		<?php
	}
}