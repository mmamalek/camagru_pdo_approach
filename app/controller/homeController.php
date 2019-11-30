<?php
include(LIB.'Controller.php');
class homeController extends Controller{
    public function __construct(){
        //echo '<br />--------'.__CLASS__.'--------<br />';

    }
    
    public function index(){
        header("Location: /home/gallery");

        die();
    }
    
    
    public function gallery(){
        $this->view = $this->view("home/gallery");
        $this->view->render();

        die();
    }



    public function __destruct(){
       // echo '<br />--------!'.__CLASS__.'--------<br />';
    }
}
?>