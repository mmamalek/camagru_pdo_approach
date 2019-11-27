<?php
class Controller{
    protected $view;
    protected $model;

    protected function view($viewName, $viewData = []){
    //    echo '<br /> >>'.__METHOD__.':<br />';

        include(LIB.'View.php');
        $this->view = new View($viewName, $viewData);

        return $this->view;
    }
}
?>