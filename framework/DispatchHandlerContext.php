<?php
class DispatchHandlerContext {
			
	private $urlBuilder;
	private $application;
	private $viewManager;
	
	function __construct($urlBuilder, $application, $viewManager) {
		$this->urlBuilder = $urlBuilder;
		$this->application = $application;
		$this->viewManager = $viewManager;
	}

	function announceEvent($event, $args = array()) {
		$this->application->handle($event, $args, $this);
	}
	
	function redirectEvent($event, $args = array()) {
		$this->urlBuilder->redirectEvent($event, $args);
	}
	
	function displayView($view, $args = array()) {
		$this->viewManager->displayView($view, $args);
	}

}
