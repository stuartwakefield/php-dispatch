<?php
class SignOutHandler {
					
	private $security;
			
	function __construct($security) {
		$this -> security = $security;
	}
	
	function handle($event, $context) {
		$this -> security -> signOut();
		$context -> redirectEvent("signin");
	}
	
}
