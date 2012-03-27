<?php
class Rectangle {
	
	private $w;
	private $h;
	
	function __construct($w, $h) {
		$this -> w = $w;
		$this -> h = $h;
	}
	
	function getWidth() {
		return $this -> w;
	}
	
	function getHeight() {
		return $this -> h;
	}
	
	function getArea() {
		return $this -> w * $this -> h;
	}
	
	function getPerimeter() {
		return 2 * $this -> w + 2 * $this -> h;
	}
	
	function getDiagonal() {
		return sqrt(pow($this -> w, 2) + pow($this -> h, 2));
	}
	
}
?>