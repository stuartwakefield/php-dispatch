<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once "../../PHUnit.php";

require_once "RectangleTest.php";

require_once "../classes/RectangleFactory.php";
require_once "RectangleFactoryTest.php";

$phunit = new PHUnit(array(
	new RectangleTest(),
	new RectangleFactoryTest(new RectangleFactory())
));
$phunit -> run();
?>