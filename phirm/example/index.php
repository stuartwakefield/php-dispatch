<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

$dbname = "zestystore";
$host = "localhost";
$username = "zesty";
$password = "YUM!3m0nad3";

$db = new PDO("mysql:dbname=$dbname;host=$host", $username, $password);

/* This needs to work from views */
require_once "/../framework/PhprmMapper.php";

$start = time();

$mapper = new PhprmMapper($db, array(
	array(
		"name" => "/product",
		"table" => "products",
		"identity" => "product_id",
		"properties" => array(
			"id" => "product_id",
			"name" => "product_name",
			"description" => "product_description",
			"price" => "product_price"
		)
	),
	array(
		"name" => "/product/option",
		"table" => "product_options",
		"identity" => "product_option_id",
		"properties" => array(
			"id" => "product_option_id",
			"name" => "product_option_name",
			"multiple" => "product_option_multiple"
		),
		"parent" => array(
			"name" => "/product",
			"identity" => "product",
			"property" => "product",
			"collection" => "options"
		)
	),
	array(
		"name" => "/product/option/value",
		"table" => "product_option_values",
		"identity" => "product_option_value_id",
		"properties" => array(
			"id" => "product_option_value_id",
			"name" => "product_option_value_name",
			"price" => "product_option_value_price"
		),
		"parent" => array(
			"name" => "/product/option",
			"identity" => "product_option",
			"property" => "option",
			"collection" => "values"
		)
	),
	array(
		"name" => "/product/picture",
		"table" => "product_pictures",
		"identity" => "product_picture_id",
		"properties" => array(
			"id" => "product_picture_id",
			"caption" => "product_picture_caption",
			"alt" => "product_picture_alt"
		),
		"parent" => array(
			"name" => "/product",
			"identity" => "product",
			"property" => "product",
			"collection" => "pictures"
		)
	)
));

$pictures = $mapper -> fetch(array(
	"/product/picture",
	"/product"
));

$products = $mapper -> fetch(array(
	"/product",
	"/product/option",
	"/product/option/value",
	"/product/picture"
)); 

echo (time() - $start) . "ms";

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
	</head>
	<body>
		<ul class="pictures">
			<?php foreach($pictures as $picture):?>
				<li class="picture">
					<img src="<?php echo "img/product/" . $picture["product"]["id"] . "/" . $picture["id"] . ".jpg";?>" alt="<?php echo $picture["alt"];?>"/>
					<p><?php echo $picture["caption"];?></p>
				</li>
			<?php endforeach;?>
		</ul>
		
		<ul class="products">
			<?php foreach($products as $product):?>
				<li class="product">
					<h3 class="product-name"><?php echo $product["name"];?></h3>
					<ul class="product-pictures">
						<?php foreach($product["pictures"] as $picture):?>
							<li class="product-picture">
								<img src="<?php echo "img/product/" . $product["id"] . "/" . $picture["id"] . ".jpg";?>" alt="<?php echo $picture["alt"];?>"/>
								<p><?php echo $picture["caption"];?></p>
							</li>
						<?php endforeach;?>		
					</ul>
					
					<dl class="product-price">
						<dt>Price</dt>
						<dd><?php echo $product["price"];?></dd>
					</dl>
					<?php foreach($product["options"] as $option):?>
						<dl class="product-option">
							<dt><?php echo $option["name"];?></dt>
							<dd>
								<ul>
									<?php foreach($option["values"] as $value):?>
										<li>
											<?php $id = "option-" . $option["id"] . "-" . $value["id"];?>
											<input name="<?php echo "option-" . $option["id"];?>" id="<?php echo $id;?>" type="<?php echo $option["multiple"] ? "checkbox" : "radio";?>" value="<?php echo $value["id"];?>"/>
											<label for="<?php echo $id;?>"><?php echo $value["name"];?> (+<?php echo $value["price"];?>)</label>
										</li>
									<?php endforeach;?>
								</ul>
							</dd>
						</dl>
					<?php endforeach;?>
					<div class="product-description"><?php echo $product["description"];?></div>
				</li>
			<?php endforeach;?>
		</ul>
	</body>
</html>