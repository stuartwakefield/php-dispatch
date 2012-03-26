<?php
require_once "PhiPluginRegistry.php";
require_once "PhiEventRegistry.php";
require_once "PhiEvent.php";
require_once "PhiHandlerContext.php";

class PhiApplication {
		
	private $defaultEvent;
	private $exceptionEvent;
	private $pluginRegistry;
	private $eventRegistry;
	private $urlBuilder;
	private $routeRegistry;
	
	function __construct($urlBuilder, $routeRegistry, $viewManager, $config) {
		
		$this -> urlBuilder = $urlBuilder;
		$this -> routeRegistry = $routeRegistry;
		$this -> viewManager = $viewManager;
		
		if(!isset($config["events"])) {
			throw new Exception("No events have been defined!");
		}
		$this -> eventRegistry = new PhiEventRegistry();
		foreach($config["events"] as $eventName => $handlerName) {
			$handler = $config["handlers"][$handlerName];
			$this -> eventRegistry -> register($eventName, $handler);
		}
		$this -> pluginRegistry = new PhiPluginRegistry();
		if(isset($config["plugins"])) {
			foreach($config["plugins"] as $plugin) {
				$this -> pluginRegistry -> register($plugin);
			}
		}
		if(!isset($config["defaultEvent"])) {
			throw new Exception("Property defaultEvent has not been defined!");
		}
		$this -> defaultEvent = $config["defaultEvent"];
		
		if(!isset($config["exceptionEvent"])) {
			throw new Exception("Property exceptionEvent has not been defined!");
		}
		$this -> exceptionEvent = $config["exceptionEvent"];
		
	}

	function run() {
		$context = new PhiHandlerContext($this -> urlBuilder, $this, $this -> viewManager);
		$this -> pluginRegistry -> preProcess($context);
		$event = $this -> defaultEvent;
		$args = array_merge($_GET, $_POST);
		
		if(isset($args["route"])) {
			$match = $this -> routeRegistry -> matchRoute($args["route"]);
			if(!isset($match)) {
				throw new Exception("Route '" . htmlspecialchars($args["route"]) . "' does not exist!");
			}
			$event = $match["event"];
			$args = array_merge($args, $match["args"]);
		} else if(isset($args["event"])) {
			$event = $args["event"];
		}
		$this -> handle($event, $args, $context);
		$this -> pluginRegistry -> postProcess($context);
	}
	
	function handle($name, $args, $context) {
		$event = new PhiEvent($name, $args);
		if($this -> pluginRegistry -> preEvent($event, $context)) {
			$this -> eventRegistry -> handle($event, $context);
		}
		$this -> pluginRegistry -> postEvent($event, $context);
	}
	
}
?>