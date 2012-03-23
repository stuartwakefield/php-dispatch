<?php
class SignInView {
	
	private $viewpath;
	private $action;
	private $validator;
	
	private $map = array(
		"password" => array(
			"required" => "Please enter your password"
		)
	);
	
	function __construct($viewpath, $action, $validator, $request) {
		$this -> viewpath = $viewpath;
		$this -> action = $action;
		$this -> validator = $validator;
		$this -> request = $request;
	}
	
	function hasValidationErrors() {
		return !!count($this -> validator -> getErrors());
	}
	
	function getValidationErrors() {
		$errors = array();
		foreach($this -> validator -> getErrors() as $error) {
			if(isset($this -> map[$error["field"]]) && isset($this -> map[$error["field"]][$error["check"]])) {
				$errors[] = $this -> map[$error["field"]][$error["check"]];
			}
		}
		return $errors;
	}
	
	function failed() {
		return $this -> request -> isComplete() && !$this -> request -> isSuccess();
	}
	
	function getAction() {
		return $this -> action;
	}
	
	function render() {
		include $this -> viewpath;
	}
	
}
?>