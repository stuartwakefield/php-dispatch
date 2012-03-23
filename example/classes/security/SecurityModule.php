<?php

require_once "Session.php";
require_once "Authentication.php";
require_once "signin/SignInValidator.php";
require_once "signin/SignInRequest.php";
require_once "signin/SignInView.php";
require_once "/../../phi/SignInHandler.php";
require_once "/../../phi/SignOutHandler.php";
require_once "/../../phi/AccessPlugin.php";

class SecurityModule {
			
	private $signInHandler;
	private $signOutHandler;
	private $accessPlugin;
	
	function __construct($config) {
		$session = new Session();
		$authentication = new Authentication($config["password"], $session);
		$signInRequest = new SignInRequest($authentication, $session);
		$signInValidator = new SignInValidator();
		$signInView = new SignInView($config["signinviewpath"], $config["signineventurl"], $signInValidator, $signInRequest);
		$this -> signInHandler = new SignInHandler($signInRequest, $signInValidator, $config["homeevent"], $signInView);
		$this -> signOutHandler = new SignOutHandler($session, $config["signinevent"]);
		$this -> accessPlugin = new AccessPlugin($session, $config["signinevent"], $config["homeevent"], array(
			$config["signinevent"]
		));
	}
	
	function getSignInHandler() {
		return $this -> signInHandler;
	}
	
	function getSignOutHandler() {
		return $this -> signOutHandler;
	}
	
	function getAccessPlugin() {
		return $this -> accessPlugin;
	}
	
}
?>