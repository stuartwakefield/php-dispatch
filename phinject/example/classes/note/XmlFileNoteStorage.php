<?php
require_once "NoteStorage.php";

class XmlFileNoteStorage implements NoteStorage {

	function store($note) {
		
		/* Obviously XML escaping the value is a requirement to 
		 * ensure the value does not render the file invalid */
		echo htmlspecialchars("Inserting Xml node: <node>$note</node>");
		
	}

}
?>