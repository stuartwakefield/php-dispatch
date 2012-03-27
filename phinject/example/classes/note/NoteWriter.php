<?php
class NoteWriter {

	private $storage;

	function __construct($storage) {
		$this -> storage = $storage;
	}

	function write($note) {
		$this -> storage -> store($note);
	}
	
}
?>