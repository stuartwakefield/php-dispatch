<?php
class SignInPresenterFactory {
	
	private $action;
	private $labels = array(
		"username" => "Username",
		"password" => "Password",
		"button" => "Sign in"
	);
	private $values;
	
	function __construct($action, $values) {
		$this -> action = $action;
		$this -> values = $values;
	}

	function create() {
		return new Presenter($args);
	}

	function getAction() {
		return $this -> action;
	}

	function getLabel($name) {
		return $this -> labels[$name];
	}
	
	function getValue($name) {
		return $this -> value[$name];
	}
	
	
}
?>