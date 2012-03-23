<?php
class ScriptValidationResultView extends ValidationResultView {
	
	private $filepath;
	
	function __construct($filepath) {
		$this -> filepath;
	}
	
	function render() {
		include $this -> filepath;
	}
	
}
?>