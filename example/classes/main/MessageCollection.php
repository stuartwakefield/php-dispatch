<?php
class MessageCollection {
	
	private $messages;
	
	function __construct() {
		$this->messages = array();
	}
	
	function addMessage($type, $text) {
		$this->messages[] = array(
			"type" => $type,
			"text" => $text
		);
	}
	
	function getMessages() {
		return $this->messages;
	}
	
}