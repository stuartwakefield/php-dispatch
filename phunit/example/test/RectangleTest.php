<?php

require_once "../../framework/PHUnitCase.php";
require_once "../classes/Rectangle.php";

class RectangleTest extends PHUnitCase {
	
	function testGetWidth() {
		$rectangle = new Rectangle(10, 20);
		$this -> assertEquals(10, $rectangle -> getWidth());
	}
	
	function testGetHeight() {
		$rectangle = new Rectangle(10, 20);
		$this -> assertEquals(20, $rectangle -> getHeight());
	}
	
	function testGetArea() {
		$rectangle = new Rectangle(10, 20);
		$this -> assertEquals(200, $rectangle -> getArea());
	}
	
	function testGetPerimeter() {
		$rectangle = new Rectangle(10, 20);
		$this -> assertEquals(60, $rectangle -> getPerimeter());
	}
	
	function testGetDiagonal() {
		$rectangle = new Rectangle(3, 4);
		$this -> assertEquals(5, $rectangle -> getDiagonal());
	}
	
}
?>
