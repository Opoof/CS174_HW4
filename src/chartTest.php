<?php 
class chartTest{
	
	function __construct(){
		$this->render();
	}
	
	function render(){	
	echo "it got this far";
		?> 
			<!DOCTYPE html>
			<html lang = "en">
				<head></head>
				<body>
					<div id="graph"></div>
					<div id="test"></div>
					
					<script type="text/javascript" src="src/chart.js"></script>
					<script>
						graph = new Chart("graph", 
										[{"Jan":15, "Feb":10, "Dec":37}, 
											{"Jan":12, "Feb":25, "Dec":10}, 
											{"Jan":2, "Feb":5, "Dec":1}], 
										{"title":"Test Chart - Month v Value", "type":"PointGraph"});
						console.log(graph);
						//test = new Chart("test", [{"Jan":15, "Feb":10, "Dec":37}, {"Jan":12, "Feb":25, "Dec":10}, {"Jan":2, "Feb":5, "Dec":1}], {"title":"Test Chart - Month v Value (Histogram)","type":"Histogram"});
						graph.draw();
						//test.draw();
					</script>
				</body>
			</html>
		<?php
	}
}
