<?php
include(LIB.'Controller.php');
include(MODEL.'imagesModel.php');

class homeController extends Controller{
    public function __construct(){
        //echo '<br />--------'.__CLASS__.'--------<br />';

        $this->model = new imagesModel();
    }
    
    public function index(){
        header("Location: /home/gallery");

        die();
    }
    
    
    public function gallery(){
        $images = $this->model->getImages();
        
        $this->view = $this->view("home/gallery", [$images]);
        $this->view->render();

        die();
    }
    
    public function myalbum(){
        $images = $this->model->getUserImages($_SESSION["user_id"]);
        
        $this->view = $this->view("home/album", [$images]);
        $this->view->render();

        die();
    }



    public function __destruct(){
       // echo '<br />--------!'.__CLASS__.'--------<br />';
    }
}
?>