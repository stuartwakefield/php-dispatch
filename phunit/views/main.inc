<!DOCTYPE html>
<html>
	<head>
		<!-- map phunit directory to phunit on your server -->
		<link rel="stylesheet" type="text/css" href="/phunit/assets/style.css"/>
	</head>
	<body>
		<?php $this -> renderSummary();?>
		<?php $this -> renderCases();?>
		<?php $this -> renderResults();?>
	</body>
</html>