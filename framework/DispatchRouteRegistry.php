<?php
class DispatchRouteRegistry {
	
	private $routes;
	
	function __construct($routes) {
		$this->routes = array();
		foreach($routes as $pattern => $event) {
			$this->registerRoute($pattern, $event);
		}
	}
	
	function matchRoute($pattern) {
		foreach($this->routes as $route) {
			if(preg_match($route["regexp"], $pattern)) {
				
				// extract the event args from the pattern
				$matches = array();
				preg_match_all($route["regexp"], $pattern, $matches);
				$args = array();
				for($i = 1; $i < count($matches); ++ $i) {
					$args[$route["params"][$i - 1]] = $matches[$i][0];
				}
				
				return array(
					"event" => $route["event"],
					"args" => $args
				);
			}
		}
	}
	
	function buildRoute($event, $args) {
		foreach($this->routes as $route) {
			if($route["event"] == $event) {
				$pattern = $route["pattern"];
				$matches = array();
				$remaining = $args;
				preg_match_all("/\@([^\/]+)/", $pattern, $matches);
				foreach($matches[1] as $match) {
					$pattern = preg_replace("/\@$match/", isset($args[$match]) ? $args[$match] : "", $pattern);
					unset($remaining[$match]);
				}
				return array(
					"pattern" => $pattern,
					"args" => $remaining
				);
			}
		}
	}
	
	private function registerRoute($pattern, $event) {
		// transform pattern wildcards to regexp wildcards
		$pattern = preg_replace("/\*/", ".*", $this->normalizeRoute($pattern));
		
		// extract route parameters & transform parameters into regexp capture groups
		$matches = array();
		preg_match_all("/\@([^\/]+)/", $pattern, $matches);
		$params = $matches[1];
		$regexp = preg_replace("/\@([^\/]+)/", "([^/]+)", $pattern);
		
		// escape slashes and finalize regexp
		$regexp = preg_replace("/\//", "\/", $regexp);
		$regexp = "/^$regexp$/";
		$this->routes[] = array(
			"regexp" => $regexp,
			"pattern" => $pattern,
			"params" => $params,
			"event" => $event
		); 
	}
	
	private function normalizeRoute($route) {
		return preg_replace("/(^\/|\/$)/", "", $route);
	}
	
}