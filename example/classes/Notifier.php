<?php

require_once "Notification.php";

class Notifier {
	
	private $notifications;
	
	function __construct() {
		$this -> notifications = array();
	}
	
	function notify($type, $message) {
		$this -> notifications[] = new Notification($type, $message);
	}
	
	function hasNotifications() {
		return count($this -> notifications);
	}
	
	function getNotifications() {
		return $this -> notifications;
	}
	
}
?>