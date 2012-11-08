<?php
/* The application dispatches events to handlers. A
 * handler implements a single method handle which is
 * passed an DispatchEvent instance containing the event name
 * and arguments and a DispatchHandlerContext instance which 
 * encapsulates flow control */
interface DispatchHandler {
	function handle($event, $context);
}