<?php
class SignInHandler {
	
	private $security;
	private $errors;
	
	function __construct($security) {
		$this -> security = $security;
		$this -> errors = array();
	}
	
	function validate($username, $password) {
		if(!strlen($password)) {
			$this -> errors[] = "Please enter your username";
		}
		if(!strlen($password)) {
			$this -> errors[] = "Please enter your password";
		}
		return !count($this -> errors);
	}
	
	function handle($event, $context) {
		
		$messages = array();
		$username = "";
		
		if($event -> isPost()) {
			
			$username = $event -> getArg("username");
			$password = $event -> getArg("password");
			
			if($this -> validate($username, $password)) {
				$this -> security -> signIn($username, $password);
				if($this -> security -> isSignedIn()) {
					$this -> abortAndGoHome($context);
				} else {
					$messages[] = array(
						"type" => "fail",
						"text" => "Could not sign you in, please check your details are correct..."
					);
				}
			} else {
				$messages[] = array(
					"type" => "fail",
					"text" => "Could not sign you in due to errors..."
				);
				$errors = $this -> errors;
			}
		}
		
		$script = '<script type="text/javascript" src="assets/signin.js"></script>';
		
		include "views/signin.inc";
	}
	
	private function abortAndGoHome($context) {
		$context -> redirectEvent("home");
	}
	
}
?>