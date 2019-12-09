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
    
    
    public function gallery($pageNo = 1){
        $limit = 5;
        $offset = ($pageNo - 1 ) * $limit;
        $total = count($this->model->getImages());

        if($offset == 0){$offset = "zero";}

        
        $images = $this->model->getImages($limit, $offset);
        if($images){
            $this->view = $this->view("home/gallery", [$images, $offset, $total, $pageNo]);
        }
        else if ($pageNo = 1){
            $this->view = $this->view("error/emptygallery");
        }
        else{
            $this->view = $this->view("error/pagenotfound");
        }

        
        $this->view->render();

        die();
    }
    
    public function myalbum($pageNo = 1){

        if(empty($_SESSION["user_id"])){
            header("Location: /user/login");
            die();
        }
        $limit = 5;
        $offset = ($pageNo - 1 ) * $limit;
        $total = count($this->model->getUserImages($_SESSION["user_id"]));

        if($offset == 0){$offset = "zero";}

        
        $images = $this->model->getUserImages($_SESSION["user_id"],$limit, $offset);
        if($images){
            $this->view = $this->view("home/gallery", [$images, $offset, $total, $pageNo]);
        }
        else{
            $this->view = $this->view("error/pagenotfound");
        }

        
        $this->view->render();

        die();
    }



    public function __destruct(){
       // echo '<br />--------!'.__CLASS__.'--------<br />';
    }
}
?>