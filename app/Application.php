<?php
class Application{
	protected $controller = 'userController';
	protected $action = 'home';
	protected $parameters = [];

	public function __construct(){
		echo '<br />-----'.__METHOD__.'----<br />';

		$this->readURI();
		$this->prints();
		$this->callController();
		
	}
	
	function readURI(){
		echo '<br />-----'.__METHOD__.'----<br />';
		
		$uri = trim($_SERVER["REQUEST_URI"], "/");
		if (!empty($uri)){
			$uri = explode('/', $uri);
			
			if (!empty($uri[0])){
				$this->controller = $uri[0].'Controller';
			} else{
				$this->controller = 'userController';
			}
			unset($uri[0]);
			
			if (isset($uri[1]) && !empty($uri[1])){
				$this->action = $uri[1];
			} else {
				$this->action = 'home';
			}
			unset($uri[1]);
			
			if (!empty($uri)){
				$this->parameters = array_values($uri);
			}
		}
	}
	
	function callController(){
		echo '<br />-----'.__METHOD__.'----<br />';
		
		if (file_exists(CONTROLLERS.$this->controller.'.php')){
			echo $this->controller.'.php exits <br />';

			include(CONTROLLERS.$this->controller.'.php');
			$controller = new $this->controller;
			
			if (method_exists($controller, $this->action)){
				echo "Action available<br />";

				call_user_func_array([$controller, $this->action], $this->parameters);
			} else {
				echo "invalid Action<br />";
			}
		} else {
			echo $this->controller.'.php does not exits <br />';
		}
	}
	
	
	function prints(){
		echo '<br />-----'.__METHOD__.'----<br />';

		echo 'Controller: '.$this->controller.'<br />';
		echo 'Action: '.$this->action.'<br />';
		echo 'Parameters: ';
		print_r($this->parameters);
		echo '<br />';		
	}
}
?>