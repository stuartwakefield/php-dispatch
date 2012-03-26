<?php
class PhiUrlBuilder {
			
	private $baseUrl;
	private $routeRegistry;
	
	function __construct($baseUrl, $routeRegistry) {
		$this -> baseUrl = $baseUrl;
		$this -> routeRegistry = $routeRegistry;
	}
	
	function buildEventUrl($event, $args) {
		$result = $this -> routeRegistry -> buildRoute($event, $args);
		if(isset($result)) {
			$url = $result["pattern"];
			$args = $result["args"];
		} else {
			$url = "?event=$event";
		}
		$params = $this -> buildQueryString($args);
		if($params) {
			$url .= "&$params";
		} 
		return $this -> baseUrl . $url;
	}
	
	function buildResourceUrl($resource) {
		return $this -> baseUrl . $resource; 
	}
	
	function redirectEvent($event, $args) {
		header("Location: " . $this -> buildEventUrl($event, $args));
	}
	
	private function buildQueryString($params) {
		$arr = array();
		foreach($params as $key => $value) {
			$arr[] = urlencode($key) . "=" . urlencode((string)$value);
		}
		return implode("&", $arr);
	}
	
}
?>
