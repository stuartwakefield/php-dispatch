<?php
class PostLoginLayout {
	
	private $path;
	
	function __construct($path) {
		$this->path = $path;
	}
	
	function display($args, $context) {
		
		/* These are all of the variables available
		 * to the php view, the ones to which we 
		 * assign a value from the args array are
		 * required variables and will show up as a
		 * notice or warning if they are ommitted. 
		 * The others are either calculated here or 
		 * optional. */
		$title = $args["title"];
		$stylesheet = $context->buildResourceUrl("assets/style.css");
		$styles = array();
		$scripts = array();
	//	$addTreeUrl = $args["addTreeUrl"];
	//	$signOutUrl = $args["signOutUrl"];
		$addTreeUrl = $context->buildEventUrl("tree.add", array());
		$signOutUrl = $context->buildEventUrl("signout", array());
		$messages = array();
		$content = $args["content"];
		$copyrightRange = 2012;
		
		// Add in the optional args
		if(isset($args["styles"])) {
			$styles = $args["styles"];
		}
		if(isset($args["scripts"])) {
			$scripts = $args["scripts"];
		}
		if(isset($args["messages"])) {
			$messages = $args["messages"];
		}
		
		// Include the page
		include $this->path;
		
	}
	
}