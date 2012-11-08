<?php
class DispatchViewManager {
	
	private $urlBuilder;
	private $views;
	
	function __construct($urlBuilder, $config) {
		$this->urlBuilder = $urlBuilder;
		$this->views = $config;
	}
	
	function displayView($name, $args) {
		$view = $this->views[$name];
		ob_start();
		if(isset($view["view"])) {
			$view["view"]->display($args, $this->urlBuilder);
		} else {
			include $view["path"];
		}
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
				 * passes in args or a scope relating to the current view,
				 * Imagine that you are viewing a user account and you need
				 * the title to include the user name. The layout should not
				 * know anything about the view and should be oblivious to
				 * the fact any calculation or query is being done for it's
				 * title. The view should know what object is being show but
				 * should not know anything about the layout placeholders and
				 * therefore should be unaware of the title slot. */
				foreach($parent["handlerArgs"] as $key => $handler) {
					$parentArgs[$key] = $view["view"]->$handler();
				}
			}
			$parentArgs[$parent["contentArg"]] = $result;
			ob_start();
			$this->displayView($parent["view"], $parentArgs);
			$result = ob_get_clean();
		}
		echo $result;
	}
	
}