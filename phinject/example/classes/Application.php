<?php
class Application {
	
	private $writer;
	private $writeFormViewPath;
	
	function __construct($writer, $writeFormViewPath) {
		$this -> writer = $writer;
		$this -> writeFormViewPath = $writeFormViewPath;
	}
	
	function run() {
		
		$args = array_merge($_GET, $_POST);
		$do = "";
		if(isset($args["do"])) {
			$do = $args["do"];
		}
		
		switch($do) {
			
			case "write":
				$this -> writer -> write($args["note"]);
				echo '<p><a href="index.php">Back</a></p>';
			break;
			
			default:
				include $this -> writeFormViewPath;
			break;
			
		}
		
	}
	
}
?>