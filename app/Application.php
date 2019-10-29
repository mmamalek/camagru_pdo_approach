<?php
class Application{
	protected $controller = 'indexController';
	protected $action = 'home';
	protected $parameters = [];

	public function __construct(){
		echo "<br />Application constructor<br />";
		$this->readURI();
		$this->prints();
		$this->callController();
		
	}
	
	function readURI(){
		$uri = trim($_SERVER["REQUEST_URI"], "/");
		
		if (!empty($uri)){
			$uri = explode('/', $uri);
			
			if (!empty($uri[0])){
				
				$cnt = $uri[0].'Controller';
				$this->controller = $cnt;
				echo 'test: cnt = '.$cnt;
			} else{
				$this->controller = 'indexController';
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
		if (file_exists(CONTROLLERS.$this->controller.'.php')){
			echo CONTROLLERS.$this->controller.'.php exits <br />';
			$controller = new $this->controller;
			
			if (method_exists($controller, $this->action)){
				echo "Action available<br />";

				call_user_func_array([]);
			} else {
				echo "invalid Action<br />";
			}
		} else {
			echo CONTROLLERS.$this->controller.'.php does not exits <br />';
		}
	}
	
	
	function prints(){
		echo '<br /> ------params------<br />';
		echo 'Controller: '.$this->controller.'<br />';
		echo 'Action: '.$this->action.'<br />';
		echo 'Parameters: ';
		print_r($this->parameters);		
	}
}
?>