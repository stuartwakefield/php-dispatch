<?php

class PhiEvent {
	
	private $name;
	private $args;
	
	function __construct($name, $args) {
		$this -> name = $name;
		$this -> args = $args;
	}
	
	function getName() {
		return $this -> name;
	}
	
	function isArgDefined($name) {
		return isset($this -> args[$name]);
	}
	
	function getArg($name, $default = "") {
		$value = $default;
		if($this -> isArgDefined($name)) {
			$value = $this -> args[$name];
		}
		return $value;
	}
	
	function setArg($name, $value) {
		$this -> args[$name] = $value;
	}
	
	function getArgs() {
		return $this -> args;
	}
	
	function isPost() {
		return $_SERVER["REQUEST_METHOD"] == "POST";
	}
	
}

?>