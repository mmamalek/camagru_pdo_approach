<?php
class Model{
	protected $dbconnection = NULL;

	public function __construct(){
		echo "------".__CLASS__." Object created---------<br />";
		$this->connect();
	}

	protected function connect(){
		echo '<br />-----'.__METHOD__.'----<br />';

		require(CONFIG.'database.php');

		try
		{
			$this->dbconnection = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$this->dbconnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
			
			echo "database connection Established.<br>";
		}
		catch (PDOException $e) 
		{
			echo $e->getMessage();
		}
	}

	public function userExist($username){
		echo '<br />-----'.__METHOD__.'----<br />';
		
		try{
			$sql = "SELECT * FROM users WHERE username = ?";
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$username]);
			$results = $stmt->fetch(PDO::FETCH_ASSOC);
	
			if ($results)
				return TRUE;
			else
				return FALSE;
	
		} catch (PDOException $e){
			echo $e->getMessage();
			return FALSE;
		} 
	}

	public function emailExist($email){
		echo '<br />-----'.__METHOD__.'----<br />';
	
		try{
			$sql = "SELECT * FROM users WHERE email = ?";
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$email]);
			$results = $stmt->fetch(PDO::FETCH_ASSOC);
	
			if ($results)
				return TRUE;
			else
				return FALSE;
	
		} catch (PDOException $e){
			echo $e->getMessage();
			return FALSE;
		} 
	}

	public function username_email_Exist($username, $email){
		echo '<br />-----'.__METHOD__.'----<br />';

		try{
			$sql = "SELECT * FROM users WHERE username = ? && email = ?";
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$username, $email]);
			$results = $stmt->fetch(PDO::FETCH_ASSOC);
	
			if ($results)
				return TRUE;
			else
				return FALSE;
	
		} catch (PDOException $e){
			echo $e->getMessage();
			return FALSE;
		} 
	}
	
	
	public function username_password($username, $password){
		echo '<br />-----'.__METHOD__.'----<br />';

		try{
			$sql = "SELECT * FROM users WHERE username = ? && passwd = ?";
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$username, $password]);
			$results = $stmt->fetch(PDO::FETCH_ASSOC);
	
			if ($results)
				return TRUE;
			else
				return FALSE;
	
		} catch (PDOException $e){
			echo $e->getMessage();
			return FALSE;
		} 
	}

	public function email_password($email, $password){
		echo '<br />-----'.__METHOD__.'----<br />';

		try{
			$sql = "SELECT * FROM users WHERE username = ? && passwd = ?";
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$email, $password]);
			$results = $stmt->fetch(PDO::FETCH_ASSOC);
	
			if ($results)
				return TRUE;
			else
				return FALSE;
	
		} catch (PDOException $e){
			echo $e->getMessage();
			return FALSE;
		} 
	}
	
	public function addUser($username, $email, $password, $verification_code){
		echo '<br />-----'.__METHOD__.'----<br />';
		
		try{
			$sql = 'INSERT INTO users (username, passwd, email, notifications, verification_code) VALUES (?, ?, ?, 0, ?)';
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$username, $password, $email, $verification_code]);
			echo 'seccessfull <br />';
			
			$msg= "click the link to verify your account: http://127.0.0.1:8080/redirect_here.php?ver_code=$verification_code";
			$headers = array(
				'From: noreply');

			mail($email, "Verification email", $msg, implode("\r\n",$headers));
			echo "<br />Check your email ";

			return TRUE;
		} catch (PDOException $e){
			echo $e->getMessage();
			return FALSE;
		}
	}
}
?>





















