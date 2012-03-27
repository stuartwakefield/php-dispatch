<?php
class PHUnitCase {
	
	function assertTrue($val) {
		if($val != true)
			throw new PHUnitAssertionException("'$val' is not true");
	} 
	
	function assertFalse($val) {
		if($val != false)
			throw new PHUnitAssertionException("'$val' is not false");
	}
	
	function assertEquals($expected, $actual) {
		if($expected != $actual)
			throw new PHUnitAssertionException("Expected '$expected' but was '$actual'");
	}
	
	function assertNotEquals($expected, $actual) {
		if($expected == $actual)
			throw new PHUnitAssertionException("Should not equal '$expected'");
	}
	
	function assertString($val) {
		if(!is_string($val))
			throw new PHUnitAssertionException("'$val' is not string");
	}
	
	function assertNumeric($val) {
		if(!is_numeric($val))
			throw new PHUnitAssertionException("'$val' is not numeric");
	}
	
	function assertBoolean($val) {
		if(!is_bool($val))
			throw new PHUnitAssertionException("'$val' is not boolean");
	}
	
	function assertNull($val) {
		if(!is_null($val))
			throw new PHUnitAssertionException("'$val' is not null");
	}
	
	function assertNotNull($val) {
		if(is_null($val))
			throw new PHUnitAssertionException("Is null");
	}
	
	function assertArrayEquals($expected, $actual) {
		if(count($expected) != count($actual)) {
			throw new PHUnitAssertionException("Array " . print_r($actual) . " does not match " . print_r($expected));
		}
		for($i = 0; $i < count($expected); ++ $i) {
			try {
				if(is_array($expected[$i])) {
					$this -> assertArrayEquals($expected[$i], $actual[$i]);
				}
				$this -> assertEquals($expected[$i], $actual[$i]);
			} catch(AssertionException $ex) {
				throw new PHUnitAssertionException("Array " . print_r($actual) . " does not match " . print_r($expected));
			}
			
		}
	}
	
	function setUp() {}
	
	function tearDown() {}
	
}
?>