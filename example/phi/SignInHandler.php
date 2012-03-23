<?php
class SignInHandler {
	
	private $service;
	private $validator;
	private $homeEvent;
	private $view;
	private $notifier;
	
	function __construct($request, $validator, $homeEvent, $view, $notifier) {
		$this -> request = $request;
		$this -> validator = $validator;
		$this -> homeEvent = $homeEvent;
		$this -> view = $view;
		$this -> notifier = $notifier;
	}
	
	function handle($event, $context) {
		if($event -> isPost()) {
			$password = $event -> getArg("password");
			if($this -> validator -> validate($password)) {
				$this -> request -> signIn($password);
				if($this -> request -> isSuccess()) {
					$this -> abortAndGoHome($context);
				} else {
					$this -> notifier -> notify("fail", "Could not sign you in, please check your password");
				}
			} else {
				$this -> notifier -> notify("fail", "Could not sign you in due to errors...");
			}
		}
		$this -> view -> render();
	}
	
	private function abortAndGoHome($context) {
		$context -> redirectEvent($this -> homeEvent);
	}
	
}
?>