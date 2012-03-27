<?php

require_once "PHUnitAssertionException.php";

class PHUnitRunner {
	
	private $tests = array();
	private $logger;
	
	function __construct($logger) {
		$this -> logger = $logger;
	}
	
	function addTest($test) {
		$this -> tests[] = $test;
	}
	
	function run() {
		foreach($this -> tests as $test) {
			$methods = get_class_methods($test);
			foreach($methods as $method) {
				if(substr($method, 0, 4) == "test") {
					try {
						$test -> setUp();
						$test -> $method();
						$this -> logger -> logResult(true, $test, $method);
					} catch(Exception $ex) {
						$this -> logger -> logResult(false, $test, $method, $ex);
					}
					$test -> tearDown();
				}
			}
		}
	}
	
}
?>