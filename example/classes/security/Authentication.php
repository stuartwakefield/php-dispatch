<?php

session_start();

class Authentication {
	
	private $password;
	private $session;
	
	function __construct($password, $session) {
		$this -> password = $password;
		$this -> session = $session;
	}
	
	function authenticate($password) {
		if($this -> password == $password) {
			$this -> session -> signIn();
		}
	}
	
}
?>