<?php
require_once "Rectangle.php";

class RectangleFactory {
	
	function create($spec) {
		$rectangle = NULL;
		
		// Ratio is x in 1:x
		if(isset($spec["area"]) && isset($spec["ratio"])) {
			$h = sqrt($spec["ratio"] * $spec["area"]);
			$w = $spec["area"] / $h;
			return new Rectangle($w, $h);
			
		} elseif(isset($spec["diagonal"]) && isset($spec["width"])) {
			$h = sqrt(pow($spec["diagonal"], 2) - pow($spec["width"], 2));
			return new Rectangle($spec["width"], $h);
			
		} else {
			$rectangle = new Rectangle($spec["width"], $spec["height"]);
		}
		
		return $rectangle;
	}
	
}
?>