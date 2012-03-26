<?php

require_once "framework/PhiRouteRegistry.php";
require_once "framework/PhiUrlBuilder.php";
require_once "framework/PhiViewManager.php";
require_once "framework/PhiApplication.php";

class Phi {
	
	function __construct($config) {
		
		$routeRegistry = new PhiRouteRegistry($config["routes"]);
		$urlBuilder = new PhiUrlBuilder($config["baseUrl"], $routeRegistry);
		
		/* The views here need information about the routes and events
		 * to insert the correct URLs into the page */
		$viewManager = new PhiViewManager($urlBuilder, $config["views"]);
		
		/* The handlers here need to know about the views to display
		 * the correct one */
		$this -> application = new PhiApplication($urlBuilder, $routeRegistry, $viewManager, array(
			"baseUrl" => $config["baseUrl"],
			"defaultEvent" => $config["defaultEvent"],
			"exceptionEvent" => $config["exceptionEvent"],
			"handlers" => $config["handlers"],
			"plugins" => $config["plugins"],
			"events" => $config["events"]
		));
		
	}

	function run() {
		$this -> application -> run();
	}
	
}
?>