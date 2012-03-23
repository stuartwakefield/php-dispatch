<?php
class PhiPluginRegistry {
			
	private $plugins = array();
	
	function register($plugin) {
		$this -> plugins[] = $plugin;
		
	}
	
	function preProcess($context) {
		$halt = false;
		foreach($this -> plugins as $plugin) {
			$cont = $plugin -> preProcess($context);
			if(isset($cont) && !$cont) {
				$halt = true;
			}
		}
		return !$halt;
	}
	
	function preEvent($event, $context) {
		$halt = false;
		foreach($this -> plugins as $plugin) {
			$cont = $plugin -> preEvent($event, $context);
			if(isset($cont) && !$cont) {
				$halt = true;
			}
		}
		return !$halt;
	}
	
	function postEvent($event, $context) {
		foreach($this -> plugins as $plugin) {
			$plugin -> postEvent($event, $context);
		}
	}
	
	function postProcess($context) {
		foreach($this -> plugins as $plugin) {
			$plugin -> postProcess($context);
		}
	}
	
}
?>
