<?php
include(CONTROLLERS.'Controller.php');
include(SHARED.'View.php');


class userController extends Controller{

	protected $username;
	protected $email;
	protected $password;
	protected $verification_code;
	
    public function __construct(){
		echo __CLASS__.' object created<br />';
		$this->model = $this->model();
    }

    public function login(){
        echo '--------'.__METHOD__.' action-----<br />';
        $this->view = new View('user/login');
	}
	
	/*REGISTER*/
    public function register(){
		echo '--------'.__METHOD__.' action-----<br />';
		
        if ($_POST['submit'] != 'Register'){
			$this->view = new View('user/register');
        } else {
			$this->validate_inputs();
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
		echo __METHOD__.'<br />';
		
		if ($this->model->emailExit($this->email)){
			echo 'Email already registered.<br />';
		} else if ($this->model->userExit($this->username)){
			echo 'Username already taken.<br />';
		} else {
			$this->model->addUser($this->username, $this->email, $this->password, $this->verification_code);
			//send email here
			
		}
		
    }
	public function validate_inputs(){
		$username = filter_var($_POST['username'], FILTER_SANITIZE_STRIPPED);
		$email = $_POST['email'];
		$password = $_POST['passwd'];
		$password2 = $_POST['passwd2'];



	}
}
?>