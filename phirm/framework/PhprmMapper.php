<?php
class PhprmMapper {
	
	private $db;
	private $config;
	private $index;
	
	/* Many to many joins? Using views? */
	
	function __construct($db, $config) {
		$this -> db = $db;
		$this -> config = $config;
		$this -> index = array();
		foreach($this -> config as &$entity) {
			$this -> index[$entity["name"]] = &$entity;
		}
	}
	
	function fetch($list) {
		$records = $this -> getRecords($list);
		$entityList = $this -> getEntityList($list);
		$index = array();
		$root = array();

		foreach($records as $row) {
			foreach($entityList as $entity) {
				$name = $entity["name"];
				if(!isset($index[$name])) {
					$index[$name] = array();					
				}
				$definition = $this -> get($name);
				$identity = $definition["identity"];
				$properties = $definition["properties"];
				if(isset($row[$identity])) {
					if(!isset($index[$name][$row[$identity]])) {
						$data = array();
						
						// Read in properties
						foreach($properties as $propertyName => $columnName) {
							$data[$propertyName] = $row[$columnName];
						}
						
						// Assign to collection
						$index[$name][$row[$identity]] = $data;
						
						if($entity["root"]) {
							$root[] = &$index[$name][$row[$identity]];
						} else if($entity["child"]) {
							$parent = &$index[$definition["parent"]["name"]][$row[$definition["parent"]["identity"]]];
							if(!isset($parent[$definition["parent"]["collection"]])) {
								$parent[$definition["parent"]["collection"]] = array();
							}
							$parent[$definition["parent"]["collection"]][] = &$index[$name][$row[$identity]];
						}
					}
					if(!$entity["root"] && !$entity["child"]) {
						$previous[$previousDefinition["parent"]["property"]] = &$index[$name][$row[$identity]];
					}
					unset($previous);
				}
				$previous = &$index[$name][$row[$identity]];
				$previousDefinition = $definition;
			}
		}
		return $root;
	}
	
	private function getRecords($list) {
		return $this -> getRecordsForEntityList($this -> getEntityList($list));
	}
	
	/* The following produces a join statement which would be semi redundant for a view */
	/* You need some way of triggering view logic */
	
	private function getRecordsForEntityList($list) {
		$sql = "SELECT ";
		$from = "FROM ";
		$join = false;
		$delimit = false;
		
		/* This is tightly bound to MySQL */
		
		for($i = 0; $i < count($list); ++$i) {
			$entity = $list[$i];
			$definition = $this -> get($entity["name"]);
			foreach($definition["properties"] as $propertyName => $columnName) {
				if($delimit) {
					$sql .= ", ";
				}
				$sql .= "`" . $definition["table"] . "`.`" . $columnName . "`";
				$delimit = true;
			}
			if(isset($definition["parent"])) {
				if($delimit) {
					$sql .= ", ";
				}
				$sql .= "`" . $definition["table"] . "`.`" . $definition["parent"]["identity"] . "`";
				$delimit = true;
			}
			
			if($join) {
				if($entity["child"]) {
					$from .= "LEFT ";
				} else {
					$from .= "RIGHT ";
				}
				$from .= "JOIN ";
			}
			$from .= "`" . $definition["table"] . "` ";
			if($join) {
				$from .= "ON ";
				if($entity["child"]) {
					$parent = $this -> getParentOf($entity["name"]);
					$from .= "`" . $parent["table"] . "`.`" . $parent["identity"] . "` = ";
					$from .= "`" . $definition["table"] . "`.`" . $definition["parent"]["identity"] . "` ";	
				} else {
					$previous = $this -> get($list[$i - 1]["name"]);
					$from .= "`" . $previous["table"] . "`.`" . $previous["parent"]["identity"] . "` = ";
					$from .= "`" . $definition["table"] . "`.`" . $definition["identity"] . "` ";
				}
			}
			$join = true;
		}

		/* This is bound to PDO */

		$stmt = $this -> db -> prepare($sql . " ". $from);
		$stmt -> execute();
		return $stmt -> fetchAll(PDO::FETCH_ASSOC);
	}

	function getEntityList($list) {
		$entities = array();
		foreach($list as $key) {
			$definition = $this -> get($key);
			// PROCESS
			$data = array(
				"name" => $key,
				"root" => false,
				"child" => true
			);
			if(!count($entities)) {
				$data["root"] = true;
				$data["child"] = false;
			} else if(!isset($definition["parent"])) {
				$data["root"] = false;
				$data["child"] = false;
			}
			$entities[] = $data;
		}
		return $entities;
	}
	
	function getParentOf($name) {
		$entity = $this -> index[$name];
		$parent = null;
		if($entity["parent"]) {
			return $this -> index[$entity["parent"]["name"]];
		}
	}
	
	function getRootOf($name) {
		$current = $this -> index[$name];
		while($current = $this -> getParentOf($current["name"]));
		return $current;
	}
	
	function get($name) {
		return $this -> index[$name];
	}
	
}
?>