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
					<title><?php echo $data[md5];?> LineGraph - PasteChart</title>
				</head>
				<body>
					<?php ?> 
					<h1 class="header"><?php echo $data[md5];?> LineGraph - PasteChart</h1>
					<p><?php print_r($data); ?></p>
					<div id="graph">
						<p>Chart Drawing</p>
					</div>

					<?php
						$data = array(
							"md5" => 1,
							"title" => "my title",
							"x's" => 2,
							"y's" => 2,
							0 => array(
								0 => "x1",
								1 => 200,
								2 => 400,
								),
							1 => array(
								0 => "x2",
								1 => 150,
								2 => 300,
								),
						);
						
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
								$input = $input . "},";
							} else {
								$input = $input . "}";
							}
							// if($j != $data['y\'s']){
							// 	$input = $input . "}, {";
							// } else {
							// 	$input = $input . "}"
							// }
						}
						$input = $input . "]";
						echo $input;
					?>
					<script type="text/javascript" src="chart.js"></script>
					<script>
						graph = new Chart("graph", <?php echo "{$input}"?> , {"title":{$data["title"]}});
						graph.draw();
					</script>
				</body>
			</html>
		<?php
	}
}