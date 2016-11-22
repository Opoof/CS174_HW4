<?php

//namespace roomMates\hw4\views;

require_once("View.php");

class GraphView implements View{
	function render($data){
		$type = isset($_GET["arg1"]) ? $_GET["arg1"] : "LineGraph";
		
		?>
			<!DOCTYPE html>
			<html>
				<head>
					<link rel="stylesheet" type="text/css" href="src/styles/style.css">
					<title><?php echo $data["md5"] . " " . $type;?> - PasteChart</title>
				</head>
				<body>
					<h1 class="header"><?php echo $data["md5"] . " " . $type;?> - PasteChart</h1>

					<?php
						if($type == "LineGraph" or 
						   $type == "PointGraph" or 
						   $type == "Histogram"){
								?>
									<div id="graph">
										<p>Chart Drawing</p>
									</div>
								<?php
								$input = "[";
								for($j = 0; $j < $data['y\'s'] /*$j < 1*/; $j++){
									$input = $input . "{";
									for($i = 0; $i < $data['x\'s']; $i++){
										if($i == 0){
											$input = $input . "\"{$data[$i][0]}\":{$data[$i][$j+1]}";
										} else {
											$input = $input . ", " . "\"{$data[$i][0]}\":{$data[$i][$j+1]}";
										}
										
									}
									if($j < ($data['y\'s'] - 1)){
										$input = $input . "}, ";
									} else {
										$input = $input . "}";
									}
									/*
									if($j != $data['y\'s']){
										$input = $input . "}, {";
									} else {
										$input = $input . "}"
									}
									*/
								}
								$input = $input . "]";
								//echo $input;
							?>
							<script type="text/javascript" src="src/chart.js"></script>
							<script>
								graph = new Chart("graph", 
												  <?php echo $input;?>, 
												  {"title":"<?php echo $data["title"]; ?>", "type":"<?php echo $type;?>"}
												);
								graph.draw();
							</script>
					<?php }
					else if($type == "xml"){ 
						$XMLstring = "<?xml version=\"1.0\"?>\r\n<!DOCTYPE chart SYSTEM \"chart.dtd\">\r\n<chart>\r\n    <md5>{$data["md5"]}</md5>\r\n    <title>{$data["title"]}</title>";

						for($i = 0; $i < (count($data) - 4); $i++){
							$XMLstring = $XMLstring . "\r\n    <data>";
							for($j = 0; $j < (count($data[$i])); $j++){
								if($j == 0){
									$XMLstring = $XMLstring . "\r\n        <x>{$data[$i][$j]}</x>";
								} 
								else {
									$XMLstring = $XMLstring . "\r\n        <y>{$data[$i][$j]}</y>";
								}
							}
							$XMLstring = $XMLstring . "\r\n    </data>";
						}
						$XMLstring = $XMLstring . "\r\n</chart>";
						echo "<pre>", htmlentities($XMLstring),"</pre>"; 
					}
					else if($type == "json"){
						$JSONstring = "{\r\n    \"chart\": {\r\n        \"md5\": \"{$data["md5"]}\",\r\n        \"title\": \"{$data["title"]}\",\r\n        \"data\": [";
						for($i = 0; $i < (count($data) - 4); $i++){
							$JSONstring = $JSONstring . "\r\n            {";
							for($j = 0; $j < (count($data[$i])); $j++){
								if($j == 0){
									$JSONstring = $JSONstring . "\r\n                \"x\" : \"{$data[$i][$j]}\",";
								} 
								else if (count($data[$i])>2) {
									if($j == 1){
										$JSONstring = $JSONstring . "\r\n                \"y\" : [";
									}
										$JSONstring = $JSONstring . "\r\n                    \"{$data[$i][$j]}\"";
									if($j != (count($data[$i])- 1 )){
										$JSONstring = $JSONstring . ",";
									}
								}
							}
							if($i != (count($data) - 5)){
								$JSONstring = $JSONstring . "\r\n                ]\r\n            },";
							} else {
								$JSONstring = $JSONstring . "\r\n                ]\r\n            }";
							}
						}
						$JSONstring = $JSONstring . "\r\n        ]\r\n    }\r\n}";
						echo "<pre>", htmlentities($JSONstring),"</pre>"; 
					}
					else if($type == "jsonp"){
						
					}
					?>

					<div>
						<h2>Share your chart and data at the URLs below:</h2>
						
						<?php 
							$c = "chart"; // weird default value from the example/required URL
							$a = "show"; // weird default value from the example/required URL
						
						
							$arg1 = "LineGraph";
							$temp = "http://". $_SERVER['HTTP_HOST'] . 
									"/?c=$c&a=$a&arg1=$arg1&arg2=". $data['md5'];
							echo "<p>As a $arg1:<br>\n".
								 "<a href=\"$temp\">$temp</a></p>\n\n";
								 
							$arg1 = "PointGraph";
							$temp = "http://". $_SERVER['HTTP_HOST'] . 
									"/?c=$c&a=$a&arg1=$arg1&arg2=". $data['md5'];
							echo "<p>As a $arg1:<br>\n".
								 "<a href=\"$temp\">$temp</a></p>\n\n";
								 
							$arg1 = "Histogram";
							$temp = "http://". $_SERVER['HTTP_HOST'] . 
									"/?c=$c&a=$a&arg1=$arg1&arg2=". $data['md5'];
							echo "<p>As a $arg1:<br>\n".
								 "<a href=\"$temp\">$temp</a></p>\n\n";
								 
							$arg1 = "xml";
							$temp = "http://". $_SERVER['HTTP_HOST'] . 
									"/?c=$c&a=$a&arg1=$arg1&arg2=". $data['md5'];
							echo "<p>As $arg1 data:<br>\n".
								 "<a href=\"$temp\">$temp</a></p>\n\n";
								 
							$arg1 = "json";
							$temp = "http://". $_SERVER['HTTP_HOST'] . 
									"/?c=$c&a=$a&arg1=$arg1&arg2=". $data['md5'];
							echo "<p>As $arg1 data:<br>\n".
								 "<a href=\"$temp\">$temp</a></p>\n\n";
								 
							$arg1 = "jsonp";
							$temp = "http://". $_SERVER['HTTP_HOST'] . 
									"/?c=$c&a=$a&arg1=$arg1&arg2=". $data['md5'];
							echo "<p>As $arg1 data:<br>\n".
								 "<a href=\"$temp\">$temp</a></p>\n\n";
						?>

					</div>
				</body>
			</html>
		<?php 
		
	}
}