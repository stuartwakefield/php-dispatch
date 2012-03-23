<?php
class SignInValidator {
		
	private $errors;

	function validate($password) {
		if(!strlen($password)) {
			$this -> errors[] = array(
				"field" => "password", 
				"check" => "required"
			);
		}
		return !count($this -> errors);
	}
	
	function getErrors() {
		return $this -> errors;
	}
	
}
?>