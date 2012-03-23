<?php
class LayoutPresenter {
	
	private $notifications;
	private $validations;
	private $view;
	
	function __construct($notifications, $validations, $view) {
		$this -> notifications = $notifications;
		$this -> validations = $validations;
		$this -> view = $view;
	}
	
	function getNotifications() {
		
		ob_start();
		$this -> notifications -> render();
		return ob_get_clean();
		
	}
	
	function getValidations() {
		ob_start();
		$this -> validations -> render();
		return ob_get_clean();
	}
	
	function getView() {
		ob_start();
		$this -> view -> render();
		return ob_get_clean();
	}
	
}
?>