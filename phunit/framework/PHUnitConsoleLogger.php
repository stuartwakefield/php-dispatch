<?php
class PHUnitConsoleLogger {
	
	function logResult($pass, $testCase, $method, $exception = null) {
		
		$name = get_class($testCase);
		
		if($pass) {
			echo("PASS: $name -> $method\r\n");
		} else {
			echo("FAIL: {$exception -> getMessage()} - $name -> $method\r\n");
		}
		
	}
	
}
?>