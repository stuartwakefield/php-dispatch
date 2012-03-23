<?php
require_once "framework/PhiPluginRegistry.php";
require_once "framework/PhiEventRegistry.php";
require_once "framework/PhiRouteRegistry.php";
require_once "framework/PhiUrlBuilder.php";
require_once "framework/PhiEvent.php";
require_once "framework/PhiContext.php";

class Phi {
		
	private $defaultevent;
	private $plugins;
	private $events;
	private $routes;
	private $urlBuilder;
	
	function __construct($config) {
		
		// Set up routes
		$this -> routes = new PhiRouteRegistry();
		if(isset($config["routes"])) {
			foreach($config["routes"] as $routePattern => $eventName) {
				$this -> routes -> register($routePattern, $eventName);
			}
		}
		
		if(!isset($config["baseurl"])) {
			throw new Exception("Property baseurl has not been set!");
		}
		$this -> urlBuilder = new PhiUrlBuilder($config["baseurl"], $this -> routes);

		if(!isset($config["events"])) {
			throw new Exception("No events have been defined!");
		}
		$this -> events = new PhiEventRegistry();
		foreach($config["events"] as $eventName => $handlerName) {
			$handler = $config["handlers"][$handlerName];
			$this -> events -> register($eventName, $handler);
		}
		
		$this -> plugins = new PhiPluginRegistry();
		if(isset($config["plugins"])) {
			foreach($config["plugins"] as $plugin) {
				$this -> plugins -> register($plugin);
			}
		}
		
		if(!isset($config["defaultevent"])) {
			throw new Exception("Property defaultevent has not been defined!");
		}
		$this -> defaultevent = $config["defaultevent"];
		
		if(!isset($config["exceptionevent"])) {
			throw new Exception("Property exceptionevent has not been defined!");
		}
		$this -> exceptionEvent = $config["exceptionevent"];
		
	}
	
	function handle($name, $args, $context) {
		$event = new PhiEvent($name, $args);
		if($this -> plugins -> preEvent($event, $context)) {
			$this -> events -> handle($event, $context);
		}
		$this -> plugins -> postEvent($event, $context);
	}
	
	function run() {
		$context = new PhiContext($this);
		$this -> plugins -> preProcess($context);
		$event = $this -> defaultevent;
		$args = array_merge($_GET, $_POST);
		if(isset($args["route"])) {
			$match = $this -> routes -> match($args["route"]);
			if(!isset($match)) {
				throw new Exception("Route '" . htmlspecialchars($args["route"]) . "' does not exist!");
			}
			$event = $match["event"];
			$args = array_merge($args, $match["args"]);
		} else if(isset($args["event"])) {
			$event = $args["event"];
		}
		$this -> handle($event, $args, $context);
		$this -> plugins -> postProcess($context);
	}
	
	function redirectEvent($event, $args = array()) {
		$this -> urlBuilder -> redirectEvent($event, $args);
	}
	
	function buildUrl($event, $args = array()) {
		return $this -> urlBuilder -> buildUrl($event, $args);
	}
	
}
?>