<?php
class TreeRegistry {
	
	function __construct() {
		if(isset($_SESSION["TREES"])) {
			$_SESSION["TREES"] = array();
		}
	}
	
	function add($name, $type, $planted, $lat, $long) {
		$tree = array(
			"name" => $name,
			"type" => $type,
			"planted" => $planted,
			"coords" => array($lat, $long)
		);
		$_SESSION["TREES"][] = $tree;
		return $tree;
	}
	
}