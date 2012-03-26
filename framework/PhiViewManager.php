<?php
class PhiViewManager {
	
	private $urlBuilder;
	private $views;
	
	function __construct($urlBuilder, $config) {
		$this -> urlBuilder = $urlBuilder;
		$this -> views = $config;
	}
	
	function displayView($name, $args) {
		$view = $this -> views[$name];
		ob_start();
		$view["view"] -> display($args, $this -> urlBuilder);
		$result = ob_get_clean();
		if(isset($view["parent"])) {
			$parent = $view["parent"];
			if(isset($parent["args"])) {
				$parentArgs = $parent["args"];
			} else {
				$parentArgs = array();
			}
			if(isset($parent["handlerArgs"])) {
				/* This needs revising as the scope is lost. The handler
				 * passes in args or a scope relating to the current view
				 */
				foreach($parent["handlerArgs"] as $key => $handler) {
					$parentArgs[$key] = $view["view"] -> $handler();
				}
			}
			$parentArgs[$parent["contentArg"]] = $result;
			ob_start();
			$this -> displayView($parent["view"], $parentArgs);
			$result = ob_get_clean();
		}
		echo $result;
	}
	
}
?>