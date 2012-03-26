<?php
class SignInView {
	
	private $path;
	private $actionEvent;
	
	function __construct($path, $actionEvent) {
		$this -> path = $path;
		$this -> actionEvent = $actionEvent;
	}
	
	function display($args, $context) {
		$actionUrl = $context -> buildEventUrl($this -> actionEvent, array());
		$errors = $args["errors"];
		$username = $args["username"];
		include $this -> path;
	}
	
}
?>