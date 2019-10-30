<?php
include(CONTROLLERS.'Controller.php');
include(SHARED.'View.php');


class userController extends Controller{

	protected $login;
	protected $username;
	protected $email;
	protected $password;
	protected $password2;
	protected $verification_code;
	
    public function __construct(){
		echo '<br />-----'.__METHOD__.'----<br />';

		$this->model = $this->model();
    }

    public function login(){
		echo '<br />-----'.__METHOD__.'----<br />';
	
		if ($_POST['submit'] != 'Login'){
			$this->view = new View('user/login');
        } else {
			$this->filter_inputs();
			$this->authenticate();
		//	header('Location: /user/login');
        }
		var_dump($_POST);
		echo '<br />'.$this->password.'<br />';
	}
	
	/*REGISTER*/
    public function register(){
		echo '<br />-----'.__METHOD__.'----<br />';
		
		
        if ($_POST['submit'] != 'Register'){
			$this->view = new View('user/register');
        } else {
			$this->filter_inputs();
			$this->validate_inputs();
			$this->authenticate();
	//		header('Location: /user/register');
        }
        var_dump($_POST);
		
	}
	
	
	
    public function profile(){
		echo '<br />-----'.__METHOD__.'----<br />';
		
		$this->view = new View('user/profile');
		
    }
    public function edit(){
		$this->view = new View('user/edit');
		
    }
    public function authenticate(){
		echo '<br />-----'.__METHOD__.'----<br />';

		if ($_POST['submit'] == 'Register'){
			if ($this->model->emailExist($this->email)){
				echo 'Email already registered.<br />';
			} else if ($this->model->userExist($this->username)){
				echo 'Username already taken.<br />';
			} else {
				$this->verification_code = hash('sha1', time());
				$this->model->addUser($this->username, $this->email, $this->password, $this->verification_code);
				//send email here
				echo 'probaply registered';
				
			}
		}			
		
		if ($_POST['submit'] == 'Login'){
			if ($this->model->username_password($this->login, $this->password)){
				echo 'Loged in using username and password.<br />';
				
			} else if ($this->model->email_password($this->login, $this->password)){
				echo 'Loged in using email and password.<br />';
			} else {
				echo "Login failed<br />";
			}
			} else if ($this->model->username_email_Exist($this->login, $this->email)){
				echo 'Loged in using username and email.<br />';
			} else {
		}
		
    }
	public function validate_inputs(){
		echo '<br />-----'.__METHOD__.'----<br />';
		
		
		if (!empty($this->username)){
			echo 'Username: '.$this->username.' is acceptable<br />';
		} else {
			echo 'Username: '.$this->username.' is not a valid username<br />';
		}
		
		if (!empty($email) && filter_var($this->email, FILTER_VALIDATE_EMAIL)){
			echo 'Email: '.$this->email.' is acceptable<br />';
		} else {
			echo 'Email: '.$this->email.' is not a valid email<br />';
		}
		
		if (empty($this->password) || empty($this->password2)){
			echo 'Empty passwords<br />';
		} else {
			if ($this->password == $this->password2){
				echo 'Passwords match<br />';
			} else {
				echo 'Passwords does not match<br />';
			}
		}
	}
	
	public function filter_inputs(){
		echo '<br />-----'.__METHOD__.'----<br />';


		if ($_POST['submit'] == 'Login'){
			$this->login = filter_var($_POST['username'], FILTER_SANITIZE_STRIPPED);
			$this->password = hash('whirlpool', filter_var($_POST['passwd'], FILTER_SANITIZE_STRIPPED));
			//unset($_POST['submit']);
		}
		if ($_POST['submit'] == 'Register'){
		echo	$this->username = filter_var($_POST['username'], FILTER_SANITIZE_STRIPPED);
		echo	$this->email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		echo	$this->password = hash('whirlpool', $_POST['passwd']);
		echo	$this->password2 = hash('whirlpool', $_POST['passwd2']);
			//unset($_POST['submit']);
		}
	}
}
?>