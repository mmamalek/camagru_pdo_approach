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
            $username = $this->user->get_user($_SESSION["user_id"])->username;
            $liked = $this->model->liked($imageId, $username);

            $this->view = $this->view("images/image", [$image, $authorName, $liked]);
            $this->view->render();
        }
    }

    public function like($imageId = ""){

        if (!empty($_SESSION["user_id"]) ){

            
            $srcURI = explode("/", $_POST["image"]);

            $imageId = $srcURI[count($srcURI) - 1];
            
            
            $username = $this->user->get_user($_SESSION["user_id"])->username;
            $results = $this->model->like($imageId, $username);
            
            echo $results;
        }
    }
    
    public function comment($imageId = ""){

        if (!empty($_SESSION["user_id"]) ){

            
            $srcURI = explode("/", $_POST["image"]);
            $commentText = $_POST["comment"];
            $username = $this->user->get_user($_SESSION["user_id"])->username;
            $imageId = $srcURI[count($srcURI) - 1];

            $commentText = base64_encode($commentText);
            $comment = Array($username=>$commentText);

            
            $results = $this->model->comment($imageId, $comment);
            
            //$results = $this->model->comment($imageId, $comment);
            
            var_dump($results);
        }
    }
    
    public function getComments($imageId = ""){

            $srcURI = explode("/", $_POST["image"]);
            
            $imageId = $srcURI[count($srcURI) - 1];

            $comments = $this->model->getComments($imageId);
            
            $results = "";
        foreach($comments as $comment){
            foreach($comment as $author=>$text){
                $results = $results . "<p><strong>$author</strong>". base64_decode($text) . "</p> \n";
            }
        }
            
        echo $results;
    }
    

    public function liked($imageId = ""){

        if (!empty($_SESSION["user_id"]) ){

            $srcURI = explode("/", $_POST["image"]);

            $imageId = $srcURI[count($srcURI) - 1];
            $username = $this->user->get_user($_SESSION["user_id"])->username;
            $results = $this->model->liked($imageId, $username);

            
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
     

        $filename = 'temp_uploads/'.uniqid('img-').'.png';
        file_put_contents($filename,$imageData);
        
       // $stickerNo = "2";
        //$this->addSticker($filename, $stickerNo);
        
        $stickers = explode(",", $_POST["stickers"]);
        unset($stickers[0]);

        foreach($stickers as $sticker){
            $this->addSticker($filename, $sticker);
           // echo "console.log($sticker)";
        }
        echo $filename;
    }

    public function addSticker($filename, $stickerNo){

        $sticker = "sticker/sticker".$stickerNo.".png";
        $dest = imagecreatefrompng($filename);
        $src = imagecreatefrompng($sticker);

        if ($stickerNo == "0"){
            $dest_x = 0;
            $dest_y = 0;
        }
        else if ($stickerNo == "1"){
            $dest_x = 200;
            $dest_y = 300;
        }
        else if ($stickerNo == "2"){
            $dest_x = 200;
            $dest_y = 0;
        }

        $src_w = imagesx($src);
        $src_h = imagesy($src);
        imagecopyresampled($dest, $src, $dest_x, $dest_y, 0, 0, 100, 100, $src_w, $src_h);
        imagepng($dest, $filename);
    }

    public function save($imageDir, $imageName){

        $src = $imageDir . "/" . $imageName;
        $dest = "uploads/" . $imageName;    
        move_uploaded_file($src, $dest);

        if(file_exists($src)){
            rename($src, $dest);
            echo "moved";
        } else {
            echo "not exist";
        }

     

        echo $src . " -> " . $dest . "\n";
    
 

        $this->model->addImage($dest);
        
    }

    public function delete($imageDir, $imageName){
    //    echo '<br />--------'.__METHOD__.'--------<br >';

     

        $filename = $imageDir . "/" . $imageName;
        unlink($filename);
        echo $filename;
    }



    public function __destruct(){
        //echo '<br />--------!'.__CLASS__.'--------<br />';
    }
}
?>