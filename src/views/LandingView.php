<?php

namespace roomMates\hw4\views;

require_once("View.php");

class LandingView implements View{
	function render($data){
		$formatDescription = "The data format should be a comma separated list of values, one per line, up to 50 lines of at most 80 ".
			"characters, representing points to be plotted. The first coordinate should represent a text label (can involve numbers but ".
			"can't involve a comma), the remaining coordinates should represent values that correspond to that text label from up to 5 ".
			"sources. For example, the text labels might have months of the year (Jan, Feb, etc) and the values could correspond to the ".
			"rabbit and wolf populations during those months in thousands. In which case, rows of data entered into the textarea might ".
			"look like: \n \nJan,600,5.4 \nFeb,450,5.0 \n... \nOn every row, the first coordinate must be a nonempty string, however, for ".
			"the remaining coordinates if a value is missing, we represent that with the empty string. For example: \n\nAug,,10.1";
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
					<label>Chart Title:</label>
					<input name="title" type="text" required><br><br>
					<textarea name="data" rows="15" cols="120" required
						placeholder="<?php echo $formatDescription; ?>"></textarea><br>
					<input name="submit" type="submit" value="Share">
				</form>
				<?php 
					if( isset($data["rc"]) ){
						echo "<p>";
						switch($data["rc"]){
							case "null_label":
								echo "Error: Chart has a null label";
								break;
							case "too_many_lines":
								echo "Error: Data has more than 50 lines";
								break;
							case "too_many_chars":
								echo "Error: Data has at least one line with more than 80 characters in it.";
								break;
							case "diff_num_of_args":
								echo "Error: Chart has differing number of arguments per label.";
								break;
							default: ;
						}
						echo "</p>";
					}
				?>
			</body>
		</html>
		<?php
	}
}