<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="assets/style.css"/>
		<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>-->
		<?php if(isset($script)) echo $script;?>
	</head>
	<body>
		<header>
			<img src="assets/logo.png"/>
			<?php if(isset($_SESSION["SIGNED_IN"])):?>
				<a href="<?php echo $context -> buildUrl("addtree");?>">Add tree</a>
				<a href="<?php echo $context -> buildUrl("signout");?>">Sign out</a>
			<?php endif;?>
		</header>
		<?php include "messages.inc";?>