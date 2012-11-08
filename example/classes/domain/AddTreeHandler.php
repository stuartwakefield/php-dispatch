<?php
class AddTreeHandler {
	
	private $treeRegistry;
	
	function __construct($treeRegistry) {
		$this->treeRegistry = $treeRegistry;
	}
	
	function validate($name, $type, $planted, $coordsLat, $coordsLong) {
		if(!strlen($name)) {
			$this->errors[] = "Please enter the name of the tree";
		}
		if(!strlen($type)) {
			$this->errors[] = "Please enter the tree type";
		}
		if(!strlen($planted)) {
			$this->errors[] = "Please enter the date the tree was planted";
		}
		if(!strlen($coordsLat) || !strlen($coordsLong)) {
			$this->errors[] = "Please enter the coordinates";
		}
		return !count($this->errors);
	}
	
	function handle($event, $context) {
		
		$name = "";
		$type = "";
		$planted = "";
		$lat = "";
		$long = "";
		
		if($event->isPost()) {
			if($this->validate($name, $type, $planted, $lat, $long)) {
				$tree = $this->treeRegistry->add($name, $type, $planted, $lat, $long);
				if(isset($tree)) {
					$this->abortAndGoHome();
				} else {
					$messages[] = array(
						"type" => "fail",
						"text" => "Tree could not be added, something went wrong..."
					);
				}
			} else {
				$messages[] = array(
					"type" => "fail",
					"text" => "Could not add tree due to errors..."
				);
				$errors = $this->errors;
			}
		}
		
		$context->displayView("/tree/add", array(
			"name" => $name,
			"type" => $type,
			"planted" => $planted,
			"lat" => $lat,
			"long" => $long 
		));
		
	}
	
}