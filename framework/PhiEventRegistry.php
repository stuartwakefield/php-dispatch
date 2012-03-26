<?php
class PhiEventRegistry {
		
	private $events;
	
	function __construct() {
		$this -> events = array();
	}
	
	function register($event, $handler) {
		if(isset($this -> events[$event])) {
			throw new Exception("Event '" . htmlspecialchars($event) . "' already defined!");
		}
		$this -> events[$event] = $handler;
	}
	
	function handle($event, $context) {
		if(!isset($this -> events[$event -> getName()])) {
			throw new Exception("Event '" . htmlspecialchars($event -> getName()) . "' does not exist!");
		}
		$this -> events[$event -> getName()] -> handle($event, $context);
	}
	
}
?>
