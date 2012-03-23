<?php
class Notification {
	
	private $type;
	private $message;
	
	function __construct($type, $message) {
		$this -> type = $type;
		$this -> message = $message;
	}
	
	function getType() {
		return $this -> type;
	}
	
	function getMessage() {
		return $this -> message;
	}
	
}
