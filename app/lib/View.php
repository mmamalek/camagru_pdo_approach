<?php
class View{
    protected $viewName;

    public function __construct($viewName, $viewData = []){

        $this->viewName = $viewName;
        $this->$viewData = $viewData;
    }

    public function render(){


        include(VIEW . 'header.php');

        if (file_exists(VIEW . $this->viewName . '.php')){
            include(VIEW . $this->viewName . '.php');
        } else {
            echo 'error:: viewfile not found';
        }
        include(VIEW . 'footer.php');

    }
}
?>

