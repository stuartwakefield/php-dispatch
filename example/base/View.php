<?php
class View {
	
	private $path;
	private $args;
	
	function __construct($path, $args) {
		$this -> path = $path;
		$this -> args = $args;
	}
	
	function render() {
		$args = $this -> args;
		include $this -> path;
	}
	
}
?>