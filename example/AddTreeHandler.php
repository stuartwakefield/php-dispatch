<?php
class AddTreeHandler {
	
	private $registry;
	
	function __construct($registry) {
		$this -> registry = $registry;
	}
	
	function validate($name, $type, $planted, $coordsLat, $coordsLong) {
		if(!strlen($name)) {
			$this -> errors[] = "Please enter the name of the tree";
		}
		if(!strlen($type)) {
			$this -> errors[] = "Please enter the tree type";
		}
		if(!strlen($planted)) {
			$this -> errors[] = "Please enter the date the tree was planted";
		}
		if(!strlen($coordsLat) || !strlen($coordsLong)) {
			$this -> errors[] = "Please enter the coordinates";
		}
		return !count($this -> errors);
	}
	
	function handle($event, $context) {
		
		$name = "";
		$type = "";
		$planted = "";
		$coordsLat = "";
		$coordsLong = "";
		
		if($event -> isPost()) {
			if($this -> validate($name, $type, $planted, $coordsLat, $coordsLong)) {
				$tree = $this -> registry -> add($name, $type, $planted, $coordsLat, $coordsLong);
				if(isset($tree)) {
					$this -> abortAndGoHome();
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
				$errors = $this -> errors;
			}
		}
		
		include "views/addtree.inc";
		
	}
	
}
?>