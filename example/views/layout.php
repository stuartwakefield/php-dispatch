<!DOCTYPE html>
<html>
	<head>
		<?php echo $this -> getTitle();?>
		<?php echo $this -> getDescription();?>
		<?php echo $this -> getKeywords();?>
		<link rel="stylesheet" type="text/css" href="assets/style.css"/>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<?php echo $this -> getScript();?>
	</head>
	<body>
		<header>
			
		</header>
		<?php echo $this -> getContent();?>
		<footer>
			
		</footer>
	</body>
</html>