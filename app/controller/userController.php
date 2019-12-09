<?php
include(LIB.'Controller.php');
include(MODEL.'userModel.php');

class userController extends Controller{

    protected $login;
	protected $username;
	protected $email;
	protected $password;
	protected $password2;
	protected $verification_code;
	protected $notifications;
    

    public function __construct(){

        $this->model = new userModel();
    }

    public function index(){

        header('Location: user/profile');
    }


    public function register(){

        if (!empty($_SESSION['user_id'])){
            header('Location: profile');
            die();
        }

        if ($_POST['submit']){
            $this->filter_inputs();
            $this->validate_inputs();
            $this->addUser();
            unset($_POST['submit']);
            die();
        }

        $this->view = $this->view('user/register');
        $this->view->render();
    }

    public function login(){

        if (!empty($_SESSION['user_id'])){
            header('Location: profile');
            die();
        }
        if ($_POST['submit']){
            $this->filter_inputs();
            $this->validate_inputs();
            $this->authenticate();
            unset($_POST['submit']);
            header('Location: profile');
            die();
        }
        
        $this->view = $this->view('user/login');
        $this->view->render();
    }


    public function profile(){

        if (empty($_SESSION['user_id'])){
            header('Location: login');
            die();
        }

        $user = $this->model->get_user($_SESSION['user_id']);

        if (!$user->verified){
            $this->view = $this->view('user/notverified');
            $_SESSION['user_id'] = '';
            $this->view->render();
            die();
        }

        $this->view = $this->view('user/profile', [$user]);
        $this->view->render();
    }



    public function logout(){

        $_SESSION['user_id'] = NULL;
        header('Location: login');
        die();
    }


    public function delete(){

        if (empty($_SESSION['user_id'])){
            header('Location: login');
            die();
        }

        $this->model->delete_user($_SESSION['user_id']);
        header('Location: register');
        die();
    }


    public function verify($code = ''){

        $user = $this->model->verification_code($code);
        if ($user)
        {
            $this->model->verify($code);
            $this->view = $this->view('user/verified');
            $this->view->render();
            die();
        }
        else{
            $this->view = $this->view('user/wrong-code');
            $this->view->render();
            die();
        }
    }


    public function reset(){

        $this->view = $this->view('user/profile');
      
        $this->view->render();
    }


    public function edit(){

		if (empty($_SESSION['user_id'])){
            header('Location: login');
            die();
        }

		$user = $this->model->get_user($_SESSION['user_id']);
		if ($_POST['submit']){
            $this->filter_inputs();
			
			if ($this->email != $user->email){
				if ($this->model->email($this->email)){
				
					$_SESSION['edit_error_email'] = 'Email already registered';
					unset($_POST['submit']);
				    header('Location: edit');
				    die();
                }
			}
			if ($this->username != $user->username){
				if ($this->model->username($this->username)){
						$_SESSION['edit_error_username'] = 'Username already taken';
						unset($_POST['submit']);
						header('Location: edit');
						die();
				}
			}
			$this->model->update_user($user->id, $this->username, $this->email, $this->notifications);
            header('Location: profile');
            die();
        }

        $this->view = $this->view('user/editprofile', [$user]);
        $this->view->render();
    }

    public function forgot($code = ''){

        if (!empty($_SESSION['user_id']))
        header('location: profile');
    
        if (!empty($code)){
            $user = $this->model->verification_code($code);
            if ($user){
                $_SESSION['forgot_user_id'] = $user->id;
                $this->view = $this->view('user/newpassword');
                $this->view->render();
                die();
            }
        }

        if (!empty($_POST['submit'])){
            $this->filter_inputs();
            
            if ($this->model->email($this->email)){
                echo 'email exists';
            } else {
                echo 'email does not exists';

            }
            $this->generate_code();
            $this->send_reset_email();
        }
        
        $this->view = $this->view('user/forgotpassword');
      
        $this->view->render();
    }
    
    public function changepassword(){

        if (empty($_SESSION['user_id']))
        header('location: user');

        if (!empty($_POST['submit'])){
            if(!$this->model->user_id_password($_SESSION['user_id'], hash('whirlpool', $_POST['passwd']))){
                $_POST = [];
                header("Location: /user/changepassword");
                die();
            }

            $this->model->set_password($_SESSION['user_id'], hash('whirlpool', $_POST['passwdnew']));
            header("Location: /user/profile");
            die();
        }
        
        $this->view = $this->view('user/resetpassword');
      
        $this->view->render();
    }

    public function __destruct(){
    //    echo '<br />--------!'.__CLASS__.'--------<br />';
    }

    public function setNewPassword(){
        if ($_POST["passwd"] == $_POST["passwd2"]){
            $this->model->set_password($_SESSION["forgot_user_id"], hash('whirlpool', $_POST['passwd']));
            header("Location: /user/login");
        }
    }
    
    public function filter_inputs(){

        if ($_POST['submit'] == 'Login'){
            $this->login = filter_var($_POST['username'], FILTER_SANITIZE_STRIPPED);
            $this->password = hash('whirlpool', $_POST['passwd']);
           
        }
        if ($_POST['submit'] == 'Register'){
            $this->username = filter_var($_POST['username'], FILTER_SANITIZE_STRIPPED);
            $this->email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $this->password = hash('whirlpool', $_POST['passwd']);
            $this->password2 = hash('whirlpool', $_POST['passwd2']);
            
        }
        if ($_POST['submit'] == 'Verify'){
            $this->email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        }
        if ($_POST['submit'] == 'Reset'){
            $this->username = $_SESSION['forgotuser'];
            unset($_SESSION['forgotuser']);
            $this->password = hash('whirlpool', $_POST['passwd']);
            $this->password2 = hash('whirlpool', $_POST['passwd2']);
        }
        if ($_POST['submit'] == 'Update'){		
            $this->username = filter_var($_POST['username'], FILTER_SANITIZE_STRIPPED);
            $this->email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
			$this->notifications = ($_POST['notifications'] == 1 ? 1 : 0);
        }
    }
    
    public function validate_inputs(){
		
		if (empty($this->username)){
            echo 'username can not be empty<br />';
		}
		
		if (empty($email)){
            echo 'email can not be empty<br />';
        }
    }
    
    public function authenticate(){

        if ($this->model->username_password($this->login, $this->password)){
            $_SESSION['user_id'] = $this->model->username($this->login)->id;
            
        } else if ($this->model->email_password($this->login, $this->password)){
            $_SESSION['user_id'] = $this->model->email($this->login)->id;
        } else {
            $_SESSION['login_error'] = "login/password does not match";
            header("Location: login");
            die();
        }

    }

    public function addUser(){

        $this->verification_code = uniqid();
        if ($this->model->email($this->email)){
            $_SESSION['error_register_email'] = 'email already taken';
        } 
        else if ($this->model->username($this->username)){
            $_SESSION['error_register_username'] = 'username already exist';
        } else {
            $this->model->add_user($this->username, $this->email, $this->password, $this->verification_code);
            $this->send_verification_email();
        }
    }
    public function send_verification_email(){


        $msg = "click the link to verify your account: http://127.0.0.1:8080/user/verify/$this->verification_code";
        $headers = array('From: noreply');

        mail($this->email, "Verification email", $msg, implode("\r\n", $headers));
        header('Location: mailsent');
    }

    public function send_reset_email(){
        
        $msg = "click the link to reset your password: http://127.0.0.1:8080/user/forgot/$this->verification_code";
            $headers = array(
                'From: noreply'
            );
            
            mail($this->email, "Reset Password", $msg, implode("\r\n", $headers));
            header('Location: passwordmailsent');       
        }
        
        public function generate_code(){

        $this->verification_code = uniqid();
        $this->model->addVerificationCodebyEmail($this->email, $this->verification_code);
    }

    public function mailsent(){

            $this->view = $this->view('user/mailsent');
            $this->view->render();
    }

    public function passwordmailsent(){

            $this->view = $this->view('user/passwordmailsent');
            $this->view->render();
    }

    public function resetpassword(){

        $this->filter_inputs();
        if ($_POST['passwd'] != $_POST['passwd2']){
            $_SESSION['error_reset_passwor'] = 'passwords dont match';
            header('Location: forgot');
        }
        $this->model->setPassword($this->username, $this->password);
    }
}
?>