<?php

require_once "/../framework/PhiPlugin.php";

class AccessPlugin extends PhiPlugin {
	
	private $session;
	
	function __construct($session) {
		$this -> session = $session;
	}
	
	function preEvent($event, $context) {
		$name = $event -> getName();
		if($this -> isProtected($name) && !$this -> session -> isSignedIn()) {
			return $this -> abortAndSignIn($context);
		} elseif(!$this -> isProtected($name) && $this -> session -> isSignedIn()) {
			return $this -> abortAndGoHome($context);
		}
		return true;
	}
	
	private function abortAndSignIn($context) {
		$context -> redirectEvent("signin");
		return false;
	}
	
	private function abortAndGoHome($context) {
		$context -> redirectEvent("home");
		return false;
	}
	
	private function isProtected($name) {
		return $name != "signin";
	}
	
}
?>