<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title;?> | Plant-a-tree-a-thon</title>
		<link rel="stylesheet" type="text/css" href="assets/style.css"/>
		<?php foreach($styles as $style):?>
			<link rel="stylesheet" type="text/css" href="<?php echo $style["href"];?>"<?php if(isset($style["media"])):?> media="<?php echo $style["media"];?>"<?php endif;?>/>
		<?php endforeach;?>
		<?php /*
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
		*/ ?>
		<?php foreach($scripts as $script):?>
			<script type="text/javascript" src="<?php echo $script;?>"></script>
		<?php endforeach;?>
	</head>
	<body>
		<header>
			<img src="assets/logo.png"/>
		</header>
		<?php if(isset($messages) && count($messages)):?>
			<ul id="messages">
				<?php foreach($messages as $message):?>
					<li class="message-<?php echo $message["type"];?>"><?php echo $message["text"];?></li>
				<?php endforeach;?>
			</ul>
		<?php endif;?>
		<?php echo $content;?>	
		<footer>
			
		</footer>
	</body>
</html>