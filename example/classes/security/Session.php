<?php
class Session {
			
	function signIn() {
		$_SESSION["SIGNED_IN"] = true;
	}
	
	function signOut() {
		unset($_SESSION["SIGNED_IN"]);
	}
	
	function isSignedIn() {
		return isset($_SESSION["SIGNED_IN"]);
	}
	
}
?>