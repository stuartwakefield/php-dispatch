<?php
class LayoutView {
		
	private $viewpath;
	private $view;
	private $title;
	private $description;
	private $keywords;
	private $script;
					
	function __construct($viewpath, $view, $title = "", $description = "", $keywords = "", $script = "") {
		$this -> viewpath = $viewpath;
		$this -> view = $view;
		$this -> title = $title;
		$this -> description = $description;
		$this -> keywords = $keywords;
		$this -> script = $script;
	}
	
	function getContent() {
		ob_start();
		$this -> view -> render();
		return ob_get_clean();
	}
	
	function getTitle() {
		return "<title>{$this -> title}</title>";
	}
	
	function getDescription() {
		return strlen($this -> description) ? '<meta name="description" content="' . $this -> description . '"/>' : "";
	}
	
	function getKeywords() {
		return strlen($this -> keywords) ? '<meta name="keywords" content="' . $this -> keywords . '"/>' : "";
	}
	
	function getScript() {
		return $this -> script;
	}
	
	function render() {
		include $this -> viewpath;
	}
	
}
?>
