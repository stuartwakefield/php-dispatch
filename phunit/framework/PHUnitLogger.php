<?php

require_once "PHUnitMethodResult.php";
require_once "PHUnitCaseResult.php";
require_once "PHUnitResult.php";

class PHUnitLogger {

	private $results = array();

	function logResult($pass, $testCase, $method, $exception = null) {
		
		$name = get_class($testCase);
				
		if(!isset($this -> results[$name])) {
			$this -> results[$name] = array();
		}
		
		$this -> results[$name][] = array(
			"pass" => $pass,
			"testCase" => $testCase,
			"method" => $method,
			"exception" => $exception
		);
		
	}

	function getResult() {
		$tests = array();
		foreach($this -> results as $caseName => $methodResults) {
			$results = array();
			foreach($methodResults as $methodResult) {
				$methodName = $methodResult["method"];
				$methodPass = $methodResult["pass"];
				$methodMessage = !is_null($methodResult["exception"]) ? $methodResult["exception"] -> getMessage() : "Successfully passed";
				$results[] = new PHUnitMethodResult($methodName, $methodPass, $methodMessage);
			}
			$tests[] = new PHUnitCaseResult($caseName, $results);
		}
		return new PHUnitResult($tests);
	}
	
}
?>