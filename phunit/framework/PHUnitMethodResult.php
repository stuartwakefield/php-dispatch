<?php
class PHUnitMethodResult {
	
	private $name;
	private $pass;
	private $message;
	
	function __construct($name, $pass, $message) {
		$this -> name = $name;
		$this -> pass = $pass;
		$this -> message = $message;
	}
	
	function getName() {
		return $this -> name;
	}
	
	function isPass() {
		return $this -> pass;
	}
	
	function getMessage() {
		return $this -> message;
	}
	
}
?>