<?php
class View{
    protected $viewName;

    public function __construct($viewName, $viewData = []){

        $this->viewName = $viewName;
        $this->$viewData = $viewData;
    }

    public function render(){


        include(__DIR__."/".'app/view/header.php');

        if (file_exists(__DIR__."/".'app/view/' . $this->viewName . '.php')){
            include(__DIR__."/".'app/view/' . $this->viewName . '.php');
        } else {
            include(__DIR__."/".'app/view/header.php');
            include(__DIR__."/".'app/view/error/pagenotfound.php');
            include(__DIR__."/".'app/view/footer.php');
        }
        include(__DIR__."/".'app/view/' . 'footer.php');

    }
}
?>

