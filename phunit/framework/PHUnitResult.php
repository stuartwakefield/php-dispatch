<?php
class PHUnitResult {
	
	private $caseResults;
	
	function __construct($caseResults) {
		$this -> caseResults = $caseResults;
	}
	
	function getCaseResults() {
		return $this -> caseResults;
	}
	
	function countAll() {
		$count = 0;
		foreach($this -> caseResults as $caseResult) {
			$count += $caseResult -> countAll();
		}
		return $count;
	}
	
	function countPasses() {
		$count = 0;
		foreach($this -> caseResults as $caseResult) {
			$count += $caseResult -> countPasses();
		}
		return $count;
	}
	
	function countFails() {
		$count = 0;
		foreach($this -> caseResults as $caseResult) {
			$count += $caseResult -> countFails();
		}
		return $count;
	}
	
	function isPass() {
		return $this -> countFails() == 0;
	}
	
}
?>
