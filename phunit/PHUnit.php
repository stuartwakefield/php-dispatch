<?php

require_once "framework/PHUnitRunner.php";
require_once "framework/PHUnitConsoleLogger.php";
require_once "framework/PHUnitLogger.php";
require_once "framework/PHUnitResultView.php";

class PHUnit {
	
	private $logger;
	private $runner;
	private $basepath = __DIR__;
	
	function __construct($tests) {
		if($this -> isCli()) {
			$this -> logger = new PHUnitConsoleLogger();
		} else {
			$this -> logger = new PHUnitLogger();
		}
		$this -> runner = new PHUnitRunner($this -> logger);
		
		foreach($tests as $test) {
			$this -> runner -> addTest($test);
		}
	}
	
	function run() {
		$this -> runner -> run();
	
		if(!$this -> isCli()) {
			$result = $this -> logger -> getResult();
			$view = new PHUnitResultView(
				$result, 
				$this -> basepath . "/views/main.inc", 
				$this -> basepath . "/views/summary.inc", 
				$this -> basepath . "/views/case_list.inc", 
				$this -> basepath . "/views/results.inc"
			);
			$view -> render();
		}
	}
	
	function isCli() {
		// http://www.codediesel.com/php/quick-way-to-determine-if-php-is-running-at-the-command-line/
		return php_sapi_name() == 'cli' && empty($_SERVER['REMOTE_ADDR']);
	}
	
}
?>