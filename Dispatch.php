<?php
require_once "framework/DispatchRouteRegistry.php";
require_once "framework/DispatchUrlBuilder.php";
require_once "framework/DispatchViewManager.php";
require_once "framework/DispatchApplication.php";

class Dispatch {
	
	function __construct($config) {
		
		$routeRegistry = new DispatchRouteRegistry($config["routes"]);
		$urlBuilder = new DispatchUrlBuilder($config["baseUrl"], $routeRegistry);
		
		/* The views here need information about the routes and events
		 * to insert the correct URLs into the page */
		$viewManager = new DispatchViewManager($urlBuilder, $config["views"]);
		
		/* The handlers here need to know about the views to display
		 * the correct one */
		$this->application = new DispatchApplication($urlBuilder, $routeRegistry, $viewManager, array(
			"baseUrl" => $config["baseUrl"],
			"defaultEvent" => $config["defaultEvent"],
			"exceptionEvent" => $config["exceptionEvent"],
			"handlers" => $config["handlers"],
			"plugins" => $config["plugins"],
			"events" => $config["events"]
		));
		
	}

	function run() {
		$this->application->run();
	}
	
}