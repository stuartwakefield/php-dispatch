<?php
require_once "classes/RectangleFactory.php";
/* See ./test for usage of the test framework */
$factory = new RectangleFactory();
$rectangle = $factory -> create(array(
	"diagonal" => 400,
	"width" => 300
));
?>
<!DOCTYPE html>
<html>
	<head>
		<style type="text/css">
			#rectangle {
				border: 1px solid #000;
			}
		</style>
	</head>
	<body>
		<h2>My rectangle</h2>
		<div id="rectangle" style="width: <?php echo $rectangle -> getWidth();?>px; height: <?php echo $rectangle -> getHeight();?>px;"></div>
		<dl>
			<dt>Width</dt>
			<dd><?php echo $rectangle -> getWidth();?>px</dd>
		</dl>
		<dl>
			<dt>Height</dt>
			<dd><?php echo $rectangle -> getHeight();?>px</dd>
		</dl>
		<dl>
			<dt>Diagonal</dt>
			<dd><?php echo $rectangle -> getDiagonal();?>px</dd>
		</dl>
		<dl>
			<dt>Area</dt>
			<dd><?php echo $rectangle -> getArea();?>px</dd>
		</dl>
		<dl>
			<dt>Perimeter</dt>
			<dd><?php echo $rectangle -> getPerimeter();?>px</dd>
		</dl>	
	</body>
</html>
