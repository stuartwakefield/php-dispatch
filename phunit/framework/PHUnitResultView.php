<?php
class PHUnitResultView {
	
	private $result;
	private $viewPath;
	private $summaryViewPath;
	private $caseListViewPath;
	private $resultsViewPath;
	
	function __construct($result, $viewPath, $summaryViewPath, $caseListViewPath, $resultsViewPath) {
		$this -> result = $result;
		$this -> viewPath = $viewPath;
		$this -> summaryViewPath = $summaryViewPath;
		$this -> caseListViewPath = $caseListViewPath;
		$this -> resultsViewPath = $resultsViewPath;
	}
	
	function renderSummary() {
		include $this -> summaryViewPath;
	}
	
	function renderCases() {
		include $this -> caseListViewPath;
	}
	
	function renderResults() {
		include $this -> resultsViewPath;
	}
	
	function render() {
		include $this -> viewPath;
	}
	
}
?>