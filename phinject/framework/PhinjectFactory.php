<?php

require_once "PhinjectException.php";
require_once "PhinjectConfigurationException.php";
/* Only tested on PHP 5.2.7 and 5.3.6 */
class PhinjectFactory {
		
	private $config;
	private $instances;
	
	function __construct($config) {
		$this -> config = $config;
		$this -> instances = array();
	}
	
	function getInstance($class) {
		$instance = $this -> findInstance($class);
		if(isset($instance)) {
			return $instance;
		}
		$config = $this -> findConfig($class);
		if(isset($config)) {
			try {
				return $this -> createInstance($config);
			} catch(PhinjectConfigurationException $ex) {
				throw new PhinjectException("Bean '" . htmlspecialchars($id) . "' is not correctly defined! " . $ex -> getMessage(), NULL, $ex);
			}
		}
		throw new PhinjectException("Bean '" . htmlspecialchars($id) . "' is not defined!");
	}
	
	private function findInstance($class) {
		$classname = $this -> loadClass($class);
		foreach($this -> instances as $instance) {
			if($instance instanceof $classname) {
				return $instance;
			}
		}
	}
	
	private function findConfig($class) {
		$targetname = $this -> loadClass($class);
		$target = $this -> getReflection($class);
		for($i = count($this -> config); $i > 0; $i --) {
			$item = $this -> config[$i - 1];
			$match = false;
			$classname = $this -> loadClass($item["class"]);
			if($classname == $targetname) {
				$match = true;
			} else {
				$reflection = $this -> getReflection($item["class"]);
				if($target -> isInterface()) {
					$match = $reflection -> implementsInterface($target);
				} else {
					$match = $reflection -> isSubclassOf($target);
				}
			}
			if($match) {
				return $item;
			}
		}
	}
	
	private function loadClass($class) {
		$classname = preg_replace("/.+\./", "", $class);
		if(!class_exists($classname)) {
			$path = preg_replace("/\./", "/", $class) . ".php";
			require_once $path;
		}
		return $classname;
	}
	
	private function getReflection($class) {
		$classname = $this -> loadClass($class);
		return new ReflectionClass($classname);
	}
	
	private function createInstance($config) {
		
		// Get file and class
		if(!isset($config["class"])) {
			throw new PhinjectConfigurationException("Configuration is missing the class attribute!");
		}
		
		// Set up constructor args
		$args = array();
		if(isset($config["args"])) {
			if(!is_array($config["args"])) {
				throw new PhinjectConfigurationException("The configuration args attribute should be an array!");
			}
			foreach($config["args"] as $arg) {
				if(!is_array($arg)) {
					throw new PhinjectConfigurationException("The constructor arg definition should be an array of type => value!");
				}
				if(isset($arg["class"])) {
					if(is_object($arg["class"])) {
						$args[] = $this -> createInstance($arg["class"]);
					} else {
						$args[] = $this -> getInstance($arg["class"]);
					}
				} else if(isset($arg["value"])) {
					$args[] = $arg["value"];
				} else {
					throw new PhinjectConfigurationException("Invalid constructor arg definition! Type should be either bean or value!");
				}
			}
		}
		
		$className = $this -> loadClass($config["class"]);
		
		// Construct
		if(count($args)) {
			$reflection = new ReflectionClass($className);
			$instance = $reflection -> newInstanceArgs($args);
		} else {
			$instance = new $className();
		}
		if(isset($config["singleton"]) && $config["singleton"]) {
			$this -> instances[$id] = $instance;
		}
		return $instance;
	}
	
	
	
}
?>
