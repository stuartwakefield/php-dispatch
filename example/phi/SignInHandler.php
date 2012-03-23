<?php
class SignInHandler {
	
	private $service;
	private $validator;
	private $homeEvent;
	private $view;
	
	function __construct($request, $validator, $homeEvent, $view) {
		$this -> request = $request;
		$this -> validator = $validator;
		$this -> homeEvent = $homeEvent;
		$this -> view = $view;
	}
	
	function handle($event, $context) {
		if($event -> isPost()) {
			$password = $event -> getArg("password");
			if($this -> validator -> validate($password)) {
				$this -> request -> signIn($password);
				if($this -> request -> isSuccess()) {
					$this -> abortAndGoHome($context);
				}
			}
		}
		$this -> view -> render();
	}
	
	private function abortAndGoHome($context) {
		$context -> redirectEvent($this -> homeEvent);
	}
	
}
?>