<?php
class SignInHandler {
	
	private $security;
	private $messageCollection;
	private $errors;
	
	function __construct($security, $messageCollection) {
		$this -> security = $security;
		$this -> messageCollection = $messageCollection;
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
					$this -> messageCollection -> addMessage("fail", "Could not sign you in, please check your details are correct...");
				}
			} else {
				$this -> messageCollection -> addMessage("fail", "Could not sign you in due to errors...");
				$errors = $this -> errors;
			}
		}
		
		$context -> displayView("/signin", array(
			"errors" => $this -> errors,
			"username" => $username
		));
		
	}
	
	private function abortAndGoHome($context) {
		$context -> redirectEvent("home");
	}
	
}
?>