<?php
include(LIB.'Controller.php');
include(MODEL.'imagesModel.php');

class imagesController extends Controller{

    

    public function __construct(){
    //    echo '<br />--------'.__CLASS__.' created--------<br />';

        $this->model = new imagesModel();

    }

    public function index(){
        echo '<br />--------'.__METHOD__.'--------<br />';

        header('Location: images/upload');
        die();
        

    }
    public function upload(){
        echo '<br />--------'.__METHOD__.'--------<br />';

        if (empty($_SESSION['user_id'])){
            header('Location: /user/login');
        }
        if (!empty($_POST['submit'])){
            $file = $_FILES["image"];
            $fileName = $file["name"];
            $fileType = $file ["type"];
            $fileTmpName = $file ["tmp_name"];
            $fileError = $file["error"];
            $fileSize = $file["size"];

            $newname = 'uploads/'.uniqid('img-').'.jpg';
            move_uploaded_file($fileTmpName, $newname);

            $this->model->addImage($newname);
            echo 'success';

        }
        $this->view = $this->view('images/upload');
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


    public function __destruct(){
        echo '<br />--------!'.__CLASS__.'--------<br />';
    }
}
?>