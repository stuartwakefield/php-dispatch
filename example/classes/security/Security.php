<?php
class Security {
	
	private $username;
	private $password;
	
	function __construct($username, $password) {
		session_start();
		$this->username = $username;
		$this->password = $password;
	}
	
	function signIn($username, $password) {
		if($this->username == $username && $this->password == $password) {
			$_SESSION["SIGNED_IN"] = true;
		}
	}
	
	function signOut() {
		unset($_SESSION["SIGNED_IN"]);
	}
	
	function isSignedIn() {
		return isset($_SESSION["SIGNED_IN"]);
	}
	
}