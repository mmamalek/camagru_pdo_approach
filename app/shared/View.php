<?php
class View{
    protected $viewfile;
    protected $viewdata;

    public function __construct($viewfile, $viewdata=[]){
        echo "view construtor<br />";
        if (file_exists(VIEWS.$viewfile.'.php')){
            echo 'View file '.$viewfile.'.php exist';
            include(VIEWS.$viewfile.'.php');
        }
        else {
            echo 'View file '.VIEWS.$viewfile.'.php does not exist';
        }
    }
}
?>