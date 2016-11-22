<?php

//namespace roomMates\hw4\views;

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
				<script>
					function validateForm() {
						var x = document.forms["inputForm"]["data"].value;
						
						var array = x.split(/\r\n|\r|\n/);
						if(array.length > 50){
							alert("Data has more than 50 lines");
							return false;
						}
						
						
						for(var i = 0; i < array.length; i++){
							if(array[i].length > 80){
								alert("At least one row has more than 80 characters");
								return false;
							}
						}
						
						for (var i = 0; i < array.length; i++){
							array[i] = array[i].split(",");
						}
						
						
						
						var num_args = array[0].length;
						//alert("num args: " + num_args);
						for(var i = 0; i < array.length; i++){
							if( array[i][0] == ""){
								alert("At least one label is null");
								return false;
							}
							if( array[i].length != num_args ){
								alert("Different number of args");
								return false;
							}
							for(var j = 1; j < array[i].length; j++){
								if(isNaN( parseFloat(array[i][j]))){
									alert("There exists at least one non-numeric value: "+array[i][j]);
									return false;
								}
							}
						}

						return true;	
					}
				</script>
			</head>
			<body>
				<h1 class="header">PasteChart</h1>
				<p class="header">Share your data in charts!</p>
				
				<form name="inputForm" id="landing" action="index.php" onsubmit="return validateForm()" method="POST">
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
							case "not_numeric_val": echo "Error: Chart has non-numeric values.";
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