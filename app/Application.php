<?php
class Application{

    protected $controller;
    protected $action;
    protected $args;

    public function __construct(){
    //    echo '<br />--------'.__CLASS__.'--------<br />';

        $this->processInputs();
        //$this->printInputs();
        $this->createController();
        $this->callMethod();
    }

    protected function processInputs(){
    //    echo '<br /> >>'.__METHOD__.':<br />';

        $input = trim($_SERVER["REQUEST_URI"], '/');
        $input = explode('/', $input);
        
        if(!empty($input[0])){
            $this->controller = $input[0].'Controller';
        } else {
            $this->controller = 'homeController';
        }

        if(isset($input[1]) && !empty($input[1])){
            $this->action = $input[1];
        } else {
            $this->action = 'index';
        }

        unset($input[0], $input[1]);

        if (!empty($input)){
            $this->args = array_values($input);
        } else {
            $this->args = [];
        }
    }

    protected function printInputs(){
    //    echo '<br /> >>'.__METHOD__.':<br />';

        echo 'Controler : '.$this->controller.'<br />';
        echo 'Action    : '.$this->action.'<br />';
        echo 'Args      : ';
        print_r($this->args);
        echo '<br />';

        
    }
    protected function createController(){
    //    echo '<br /> >>'.__METHOD__.':<br />';

        if (file_exists(CONTROLLER.$this->controller.'.php')){
            include(CONTROLLER.$this->controller.'.php');
            $controller = new $this->controller();
            $this->controller = $controller;

        } else {
            echo 'error:: Controller not found. <br />';
        }
    }

    protected function callMethod(){
    //    echo '<br /> >>'.__METHOD__.':<br />';

        if (method_exists($this->controller, $this->action)){
            call_user_func_array([$this->controller,$this->action], $this->args);
        } else {
            echo 'error:: Method not found:<br />';
        }
    }

    public function __destruct(){
    //    echo '<br />--------!'.__CLASS__.'--------<br />';
    }
}
?>