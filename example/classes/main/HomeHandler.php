<?php
class HomeHandler {
		
	function handle($event, $context) {
		$context->displayView("/home");
	}
	
}
