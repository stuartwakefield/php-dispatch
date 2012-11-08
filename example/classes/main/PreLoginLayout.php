<?php
class PreLoginLayout {
	
	private $path;
	private $messageCollection;
	
	function __construct($path, $messageCollection) {
		$this->path = $path;
		$this->messageCollection = $messageCollection;
	}
	
	function display($args, $context) {
		
		$title = $args["title"];
		$stylesheet = $context->buildResourceUrl("assets/style.css");
		$styles = array();
		$scripts = array();
		$content = $args["content"];
		$messages = $this->messageCollection->getMessages();
		
		include $this->path;
	}
	
}