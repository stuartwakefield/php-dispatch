<?php
class Presenter {
	
	private $vals;
	
	function __construct($vals) {
		$this -> vals = $vals;
	}
	
	function has($name) {
		return isset($this -> vals[$name]);
	}
	
	function get($name, $default) {
		$val = $default;
		if($this -> has($name)) {
			$val = $this -> vals[$name];
		}
		return $this -> vals[$name];
	}
	
}
?>