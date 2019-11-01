<?php
class Controller{
    protected $view;
    protected $model;

    public function view($viewfile, $viewdata){
        $this->view = new View($viewfile, $viewdata);
        return $this->view;
	}
	public function model(){
		echo __CLASS__;
			//$this->model = new userModel();
			//return $this->model;
	}
}
?>