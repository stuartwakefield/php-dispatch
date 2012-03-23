<?php

require_once "Session.php";
require_once "Authentication.php";
require_once "SignInRequest.php";

require_once "/../Notifier.php";

// Output
require_once "/../../base/View.php";
require_once "/../../presenters/SignInPresenter.php";
require_once "/../../presenters/NotificationPresenter.php";
require_once "/../../presenters/ValidationPresenter.php";
require_once "/../../presenters/LayoutPresenter.php";

// Front controller items
require_once "/../../phi/SignInHandler.php";
require_once "/../../phi/SignOutHandler.php";
require_once "/../../phi/AccessPlugin.php";
require_once "/../../phi/SignInValidator.php";

class SecurityModule {
			
	private $signInHandler;
	private $signOutHandler;
	private $accessPlugin;
	private $signInView;
	
	
	function __construct($config) {
		$this -> setupSystem();
		$this -> setupSecurityModule($config["password"]);
		$this -> setUpViews($config["signineventurl"], $config["signinviewpath"], $config["notificationviewpath"], $config["validationviewpath"], $config["layoutpath"], $this -> notifier, $this -> signInValidator);
		$this -> setupHandlersAndPlugins($this -> signInRequest, $this -> signInValidator, $config["homeevent"], $this -> signInView, $this -> notifier, $this -> session, $config["signinevent"]);
	}
	
	function setupSystem() {
		$this -> notifier = new Notifier();
	}
	
	function setupSecurityModule($password) {
		$this -> session = new Session();
		$this -> authentication = new Authentication($config["password"], $session);
		$this -> signInRequest = new SignInRequest($authentication, $session);
		$this -> signInValidator = new SignInValidator();
	}
	
	function setupViews($signInEventUrl, $signInViewPath, $notificationViewPath, $validationViewPath, $layoutPath, $notifier, $validator) {
		// Strongly bound to output (this is sandwiched...)
		$presenter = new SignInPresenter($signInEventUrl);
		$signInView = new View($signInViewPath, $presenter);
		
		$presenter = new NotificationPresenter($notifier);
		$notificationView = new View($notificationViewPath, $presenter);
		
		$presenter = new ValidationPresenter($validator);
		$signInValidationView = new View($validationViewPath, $presenter);
		
		$presenter = new LayoutPresenter($notificationView, $signInValidationView, $signInView);
		$layoutView = new View($layoutPath, $presenter);
		
		$this -> signInView = $layoutView;
	}
	
	function setupHandlersAndPlugins($signInRequest, $validator, $homeEvent, $view, $notifier, $session, $signInEvent) {
		// Front controller items
		$this -> signInHandler = new SignInHandler($signInRequest, $validator, $homeEvent, $view, $notifier);
		$this -> signOutHandler = new SignOutHandler($session, $signInEvent);
		$this -> accessPlugin = new AccessPlugin($session, $signInEvent, $homeEvent, array(
			$signInEvent
		));
	}
	
	function getSignInView() {
		return $this -> signInView;
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