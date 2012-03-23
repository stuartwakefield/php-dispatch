<?php
class SignOutHandler {
					
	private $session;
	private $nextEvent;
			
	function __construct($session, $nextEvent) {
		$this -> session = $session;
		$this -> nextEvent = $nextEvent;
	}
	
	function handle($event, $context) {
		$this -> session -> signOut();
		$context -> redirectEvent($this -> nextEvent);
	}
	
}
