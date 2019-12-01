<?php
include(LIB.'Controller.php');
include(MODEL.'imagesModel.php');
include(MODEL.'userModel.php');

class imagesController extends Controller{

    protected $user;

    public function __construct(){
    //    echo '<br />--------'.__CLASS__.' created--------<br />';

        $this->model = new imagesModel();
        $this->user = new userModel();

    }

    public function index(){
       // echo '<br />--------'.__METHOD__.'--------<br />';

        header('Location: images/upload');
        die();
        

    }

    public function image($imageId){
        if ($imageId){
            $image = $this->model->getImage($imageId);
            $authorName = $this->user->get_user($image->author)->username;

            $this->view = $this->view("images/image", [$image, $authorName]);
            $this->view->render();
            echo "hi";
        }
    }

    public function like(){

        if (!empty($_SESSION["user_id"])){

            $srcURI = explode("/", $_POST["image"]);
            echo ($imageId = $srcURI[count($srcURI) - 1]);
            
            
            $username = $this->user->get_user($_SESSION["user_id"])->username;
            $results = $this->model->like($imageId, $username);
            
            echo $results;
        }
    }


    public function upload(){
       // echo '<br />--------'.__METHOD__.'--------<br />';

        if (empty($_SESSION['user_id'])){
            header('Location: /user/login');
        }
        if (!empty($_POST['submit'])){
            $file = $_FILES["image"];
           
            $fileTmpName = $file ["tmp_name"];
       

            $newname = 'uploads/'.uniqid('img-').'.jpg';
            move_uploaded_file($fileTmpName, $newname);

            $this->model->addImage($newname);
            echo 'success';

        }
        $this->view = $this->view('images/upload');
        $this->view->render();

    }
    public function webcam(){
        //echo '<br />--------'.__METHOD__.'--------<br />';

        if (empty($_SESSION['user_id'])){
            header('Location: /user/login');
        }
        
        $this->view = $this->view('images/webcam');
        $this->view->render();

    }

    public function edit(){
        echo '<br />--------'.__METHOD__.'--------<br />';

        if (empty($_SESSION['loggedinId'])){
            header('Location: unauthorised');
        }

    }

    public function camera(){
    //    echo '<br />--------'.__METHOD__.'--------<br />';

        if (empty($_SESSION['loggedinId'])){
            header('Location: unauthorised');
        }

		$this->view = $this->view('images/webcam');
		$this->view->render();
    }

    public function dcode(){
    //    echo '<br />--------'.__METHOD__.'--------<br />';

    

        $base64img = $_POST["image"];
        $base64img = explode(",", $_POST["image"])[1];
        
        $base64img = str_replace(' ', '+', $base64img);
        
        $imageData = base64_decode($base64img);
     

        $filename = 'uploads/'.uniqid('img-').'.png';
        file_put_contents($filename,$imageData);
 

        $this->model->addImage($filename);
        
        echo $filename;
    }



    public function __destruct(){
        //echo '<br />--------!'.__CLASS__.'--------<br />';
    }
}
?>