<?php
class NotificationPresenter {
	
	private $notifier;
	
	function __construct($notifier) {
		$this -> notifier = $notifier;
	}
	
	function hasNotifications() {
		return $this -> notifier -> hasNotifications();
	}
	
	function getNotifications() {
		return $this -> notifier -> getNotifications();
	}
	
}
?>