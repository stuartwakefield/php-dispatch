<?php
require_once "NoteStorage.php";

class SQLNoteStorage implements NoteStorage {

	function store($note) {
	
		/* Obviously escape the value or use PDO binding in a real
		 * situation and NEVER insert values directly into a SQL 
		 * command */
		echo "Executing SQL: INSERT INTO notes (note_text) VALUES ('$note')";

	}

}
?>