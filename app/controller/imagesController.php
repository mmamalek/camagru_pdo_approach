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
      

        header('Location: images/upload');
        die();
        

    }

    public function image($imageId){
        if ($imageId){
            $image = $this->model->getImage($imageId);
            if ($image){
                $authorName = $this->user->get_user($image->author)->username;
                $username = $this->user->get_user($_SESSION["user_id"])->username;
                $liked = $this->model->liked($imageId, $username);
    
                $this->view = $this->view("images/image", [$image, $authorName, $liked]);
            } else{
                $this->view = $this->view("images/imagenotfound");
                
            }
            $this->view->render();
        }
    }

    public function like($imageId = ""){

        if (!empty($_SESSION["user_id"]) ){

            
            $srcURI = explode("/", $_POST["image"]);

            $imageId = $srcURI[count($srcURI) - 1];
            
            $image = $this->model->getImage($imageId);
            $imageAuthor = $this->user->get_user($image->author);
            $username = $this->user->get_user($_SESSION["user_id"])->username;
            $results = $this->model->like($imageId, $username);
            
            if ($imageAuthor->notifications){

                if($this->model->liked($imageId, $username)){
                    $this->sendLikeNotification($imageAuthor->email , $username);
                } else{
                    $this->sendUnlikeNotification($imageAuthor->email , $username);
                }
            }
                
            echo $results;
        }
    }
    
    public function comment($imageId = ""){

        if (!empty($_SESSION["user_id"]) ){

            
            $srcURI = explode("/", $_POST["image"]);
            $commentText = filter_var($_POST['comment'], FILTER_SANITIZE_STRIPPED);
            $username = $this->user->get_user($_SESSION["user_id"])->username;
            $imageId = $srcURI[count($srcURI) - 1];

            $encodedcommentText = base64_encode($commentText);
            $comment = Array($username=>$encodedcommentText);

            
        
                $results = $this->model->comment($imageId, $comment);
        }

            $image = $this->model->getImage($imageId);
            $imageAuthor = $this->user->get_user($image->author);
            $username = $this->user->get_user($_SESSION["user_id"])->username;

            if ($imageAuthor->notifications){
                $this->sendCommentNotification($imageAuthor->email, $username, $commentText);
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

            if(empty($imageId)){
                $srcURI = explode("/", $_POST["image"]);
                $imageId = $srcURI[count($srcURI) - 1];
            }

            $username = $this->user->get_user($_SESSION["user_id"])->username;
            $results = $this->model->liked($imageId, $username);

            
            echo $results;
        }
    }


    public function upload(){


     
       $img = explode("/", $_POST["image"]);
       $imageName = $img[count($img) - 2] . "/" . $img[count($img) - 1];

       $filename = 'temp_uploads/'.uniqid('img-').'.png';
       copy($imageName, $filename);
       
       
       $stickers = explode(",", $_POST["stickers"]);
       unset($stickers[0]);

       foreach($stickers as $sticker){
           $this->addSticker($filename, $sticker);
    
       }
       echo $filename;

    }

    public function webcam(){
   

        if (empty($_SESSION['user_id'])){
            header('Location: /user/login');
        }
        
        $this->view = $this->view('images/webcam');
        $this->view->render();

    }

    public function camera(){


        if (empty($_SESSION['loggedinId'])){
            header('Location: unauthorised');
        }

		$this->view = $this->view('images/webcam');
		$this->view->render();
    }

    public function dcodeUploads(){


        $fileTmpName = $_FILES["file"]["tmp_name"];
 
        $filename = 'temp_uploads/'.uniqid('img-').'.png';
    
        
        if ($_FILES["file"]["type"] == "image/png" ){
            move_uploaded_file($fileTmpName, $filename);
        } else {
            $imageString = file_get_contents($fileTmpName);
            $imageData = imagecreatefromstring($imageString);
            imagepng($imageData, $filename);

        }

        echo $filename;
    }

    public function dcode(){

        $base64img = $_POST["image"];
        $base64img = explode(",", $_POST["image"])[1];
        
        $base64img = str_replace(' ', '+', $base64img);
        
        $imageData = base64_decode($base64img);
     

        $filename = 'temp_uploads/'.uniqid('img-').'.png';
        file_put_contents($filename,$imageData);
        

        $stickers = explode(",", $_POST["stickers"]);
        unset($stickers[0]);

        foreach($stickers as $sticker){
            $this->addSticker($filename, $sticker);
        
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
        imagedestroy($dest);
        imagedestroy($src);
    }

    public function save($imageDir, $imageName){

        $src = $imageDir . "/" . $imageName;
        $dest = "uploads/" . $imageName;    
        move_uploaded_file($src, $dest);

        if(file_exists($src)){
            rename($src, $dest);
 
        } else {
//
        }

        $this->model->addImage($dest);
        
    }

    public function deletePost($imageId = ''){
 
        if(!empty($imageId)){

            $image = $this->model->getImage($imageId);
            if ($image->author == $_SESSION["user_id"]){
                unlink($image->location);
                $this->model->deletePost($imageId);
            }
        }
    }

    public function delete($imageDir, $imageName){

        $filename = $imageDir . "/" . $imageName;
        unlink($filename);

    }

    public function sendLikeNotification($imageAuthorEmail, $likerUserName){

        $message = "$likerUserName liked your image";
        $headers = array(
            'From: noreply'
        );
        
        mail($imageAuthorEmail, "Like Notification", $message, implode("\r\n", $headers));
       
    }

    public function sendUnlikeNotification($imageAuthorEmail, $likerUserName){
 

        $message = "<strong>$likerUserName</strong> decided to take back his / her like. Sorry.";
        $headers = array(
            'From: noreply', "To: $imageAuthorEmail"
        );
        
        mail($imageAuthorEmail, "Like Notification", $message, implode("\r\n", $headers));
       
    }
    
    public function sendCommentNotification($imageAuthorEmail, $commenterUserName, $comment){

        $message = "$commenterUserName commented on your image. comment: \"$comment\"";
        $headers = array(
            'From: noreply'
        );
        
        mail($imageAuthorEmail, "Comment Notification", $message, implode("\r\n", $headers)); 
    }
    
    public function generate_code(){

    $this->verification_code = uniqid();
    $this->model->addVerificationCodebyEmail($this->email, $this->verification_code);
    }

    public function __destruct(){
        //echo '<br />--------!'.__CLASS__.'--------<br />';
    }
}
?>