<?php
class PhiContext {
			
	private $application;
	
	function __construct($application) {
		$this -> application = $application;
	}

	function announceEvent($event, $args = array()) {
		$this -> application -> handle($event, $args, $this);
	}
	
	function redirectEvent($event, $args = array()) {
		$this -> application -> redirectEvent($event, $args);
	}
	
	function buildUrl($event, $args = array()) {
		return $this -> application -> buildUrl($event, $args);
	}

}
?>
