<?php
class Controller{
    protected $view;
    protected $model;

    protected function view($viewName, $viewData = []){

        include(LIB.'View.php');
        $this->view = new View($viewName, $viewData);

        return $this->view;
    }
}
?>