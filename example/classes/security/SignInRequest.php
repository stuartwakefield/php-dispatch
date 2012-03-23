<?php
class SignInRequest {
			
	private $authentication;
	private $session;
	
	function __construct($authentication, $session) {
		$this -> authentication = $authentication;
		$this -> session = $session;
	}
	
	function signIn($password) {
		$this -> authentication -> authenticate($password);
		$this -> success = $this -> session -> isSignedIn();
	}
	
	function isSuccess() {
		return $this -> success;
	}
	
	function isComplete() {
		return isset($this -> success);
	}
	
}
?>
