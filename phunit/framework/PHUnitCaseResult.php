<?php
class PHUnitCaseResult {
	
	private $name;
	private $methodResults;
	
	function __construct($name, $methodResults) {
		$this -> name = $name;
		$this -> methodResults = $methodResults;
	}
	
	function getName() {
		return $this -> name;
	}
	
	function getMethodResults() {
		return $this -> methodResults;
	}
	
	function countAll() {
		return count($this -> methodResults);
	}
	
	function countPasses() {
		$count = 0;
		foreach($this -> methodResults as $methodResult) {
			if($methodResult -> isPass())
				$count ++;
		}
		return $count;
	}
	
	function countFails() {
		$count = 0;
		foreach($this -> methodResults as $methodResult) {
			if(!$methodResult -> isPass())
				$count ++;
		}
		return $count;
	}
	
	function isPass() {
		return $this -> countFails() == 0;
	}
	
}
?>