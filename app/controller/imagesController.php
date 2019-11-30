<?php
include(LIB.'Controller.php');
include(MODEL.'imagesModel.php');

class imagesController extends Controller{

    

    public function __construct(){
    //    echo '<br />--------'.__CLASS__.' created--------<br />';

        $this->model = new imagesModel();

    }

    public function index(){
       // echo '<br />--------'.__METHOD__.'--------<br />';

        header('Location: images/upload');
        die();
        

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
        var_dump($base64img);
        $imageData = base64_decode($base64img);
        //$image = imagecreatefromstring($imageData);

        $filename = 'uploads/'.uniqid('img-').'.png';
        file_put_contents($filename,$imageData);
        //move_uploaded_file($image, $filename);

        $this->model->addImage($filename);
        
        echo "hi yoh";
    }
    
    public function dcode2(){
    //    echo '<br />--------'.__METHOD__.'--------<br />';

        var_dump($_POST);

        $data = explode(",", $_POST["image"]);

        $image = base64_decode($data[1]);

        $filename = 'uploads/'.uniqid('img-').'.png';
        file_put_contents($filename, $image);
        echo "hi";

        $sticker = explode("/", $_POST["sticker"]);
        $sticker = $sticker[count($sticker) - 1];
        echo $sticker;

        $src = imagecreatefrompng("/sticker/".$sticker);
        $dst = imagecreatefrompng($filename);

        $width = 150;
        $height = 150;

        $position1 = 10;
        $position2 = 10;

        imagecopyresampled($dst, $src, $position2, $position1, 0, 0, $width, $height, $width, $height);
    }


    public function __destruct(){
        //echo '<br />--------!'.__CLASS__.'--------<br />';
    }
}
?>