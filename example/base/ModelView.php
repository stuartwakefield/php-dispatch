<?php
class ModelView {
	
	private $subject;
	
	function setSubject($subject) {
		$this -> subject = $subject;
	}
	
	function render() {
		// Extend me
	}
	
}
