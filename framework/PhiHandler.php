<?php
/* The application dispatches events to handlers. A
 * handler implements a single method handle which is
 * passed an PhiEvent instance containing the event name
 * and arguments and a PhiHandlerContext instance which 
 * encapsulates flow control */
interface PhiHandler {
	function handle($event, $context);
}
?>