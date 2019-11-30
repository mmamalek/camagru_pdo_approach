<?php
class View{
    protected $viewName;

    public function __construct($viewName, $viewData = []){
    //    echo '<br />--------'.__CLASS__.'--------<br />';

        $this->viewName = $viewName;
        $this->$viewData = $viewData;
    }

    public function render(){
    //    echo '<br />--------'.__METHOD__.'--------<br />';

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

