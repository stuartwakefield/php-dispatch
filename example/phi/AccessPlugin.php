<?php

require_once "/../../framework/PhiPlugin.php";

class AccessPlugin extends PhiPlugin {
	
	private $session;
	private $signInEvent;
	private $homeEvent;
	private $unprotectedEvents;
	
	function __construct($session, $signInEvent, $homeEvent, $unprotectedEvents) {
		$this -> session = $session;
		$this -> signInEvent = $signInEvent;
		$this -> homeEvent = $homeEvent;
		$this -> unprotectedEvents = $unprotectedEvents;
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
		$context -> redirectEvent($this -> signInEvent);
		return false;
	}
	
	private function abortAndGoHome($context) {
		$context -> redirectEvent($this -> homeEvent);
		return false;
	}
	
	private function isProtected($name) {
		foreach($this -> unprotectedEvents as $unprotectedEvent) {
			if($unprotectedEvent == $name) {
				return false;
			}
		}
		return true;
	}
	
}
?>