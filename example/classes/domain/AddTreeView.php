<?php
class AddTreeView {
	
	private $path;
	private $actionEvent;
	private $cancelEvent;
	
	function __construct($path, $actionEvent, $cancelEvent) {
		$this->path = $path;
		$this->actionEvent = $actionEvent;
		$this->cancelEvent = $cancelEvent;
	}
	
	function display($args, $context) {
		
		$name = "";
		$type = "";
		$planted = "";
		$lat = "";
		$long = "";
		
		$actionUrl = $context->buildEventUrl($this->actionEvent, array());
		$cancelUrl = $context->buildEventUrl($this->cancelEvent, array());
		
		include $this->path;
		
	}
	
	function getTitle() {
		return "Add tree";
	}
	
	private function getActionUrl() {
		return $this->actionEvent;
	}
	
	private function getCancelUrl() {
		return $this->cancelEvent;
	}
	
}
