<?php
include(CONTROLLERS.'Controller.php');
include(SHARED.'View.php');


class userController extends Controller{
    public function __construct(){
        echo __CLASS__.' object created<br />';
    }

    public function login(){
        echo '--------'.__METHOD__.' action-----<br />';
        $this->view = new View('user/login');
    }
    public function register(){
        echo '--------'.__METHOD__.' action-----<br />';
        if (empty($_POST)){
            $this->view = new View('user/register');
        } else {
            $this->authenticate();
        }
        var_dump($_POST);

    }
    public function profile(){
        echo '--------'.__METHOD__.' action-----<br />';
        $this->view = new View('user/profile');

    }
    public function edit(){
        $this->view = new View('user/edit');

    }
    public function authenticate(){

    }
}
?>