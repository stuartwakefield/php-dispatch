<?php

require_once "../../framework/PHUnitCase.php";

class RectangleFactoryTest extends PHUnitCase {
	
	private $factory;
	
	function __construct($factory) {
		$this -> factory = $factory;
	}
	
	function testCreateRectangleFromWidthAndHeight() {
		$rectangle = $this -> factory -> create(array(
			"width" => 10,
			"height" => 20
		));
		$this -> assertEquals(10, $rectangle -> getWidth());
		$this -> assertEquals(20, $rectangle -> getHeight());
	}
	
	function testCreateRectangleFromAreaAndRatio() {
		$rectangle = $this -> factory -> create(array(
			"area" => 200,
			"ratio" => 2
		));
		$this -> assertEquals(10, $rectangle -> getWidth());
		$this -> assertEquals(20, $rectangle -> getHeight());
	}
	
	function testCreateRectangleFromWidthAndDiagonal() {
		$rectangle = $this -> factory -> create(array(
			"width" => 3,
			"diagonal" => 5
		));
		$this -> assertEquals(3, '');
		$this -> assertEquals(4, '');
	}
	
}
?>