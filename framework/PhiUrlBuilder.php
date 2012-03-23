<?php
class PhiUrlBuilder {
			
	private $routes;
	private $baseurl;
	
	function __construct($baseurl, $routes) {
		$this -> baseurl = $baseurl;
		$this -> routes = $routes;
	}
	
	function buildUrl($event, $args) {
		$result = $this -> routes -> build($event, $args);
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
		return $this -> baseurl . $url;
	}
	
	function redirectEvent($event, $args) {
		header("Location: " . $this -> buildUrl($event, $args));
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
