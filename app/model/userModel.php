<?php

class userModel
{
	protected $dbconnection = NULL;

	public function __construct()
	{
	//	echo "------" . __CLASS__ . " Object created---------<br />";
		$this->connect();
	}

	protected function connect(){
		require(CONFIG . 'database.php');

		try {
			$this->dbconnection = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$this->dbconnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function username($username)
	{
		$sql = "SELECT * FROM users WHERE username = ?";
		try {
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$username]);
			$results = $stmt->fetch(PDO::FETCH_OBJ);

			if ($results)
				return $results;
			else
				return FALSE;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}

	public function get_user($id)
	{
		$sql = "SELECT * FROM `users` WHERE `id` = ?";
		try {
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$id]);
			$results = $stmt->fetch(PDO::FETCH_OBJ);

			if ($results)
				return $results;
			else
				return FALSE;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}


	public function email($email)
	{
		try {
			$sql = "SELECT * FROM users WHERE email = ?";
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$email]);
			$results = $stmt->fetch(PDO::FETCH_OBJ);

			if ($results)
				return $results;
			else
				return FALSE;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}

	public function username_email($username, $email)
	{
		try {
			$sql = "SELECT * FROM users WHERE username = ? && email = ?";
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$username, $email]);
			$results = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($results)
				return $results;
			else
				return FALSE;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}

	public function verification_code($verificationcode)
	{
		try {
			$sql = "SELECT * FROM `users` WHERE `verification_code` = ?";
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$verificationcode]);
			$results = $stmt->fetch(PDO::FETCH_OBJ);

			if ($results)
				return $results;
			else
				return FALSE;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}


	public function username_password($username, $password)
	{
		try {
			$sql = "SELECT * FROM `users` WHERE `username` = ? && `passwd` = ?";
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$username, $password]);
			$results = $stmt->fetch(PDO::FETCH_OBJ);

			if ($results)
				return $results;
			else
				return FALSE;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}
	
	public function user_id_password($id, $password)
	{
		try {
			$sql = "SELECT * FROM `users` WHERE `id` = ? && `passwd` = ?";
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$id, $password]);
			$results = $stmt->fetch(PDO::FETCH_OBJ);

			if ($results)
				return $results;
			else
				return FALSE;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}

	public function email_password($email, $password)
	{
		try {
			$sql = "SELECT * FROM `users` WHERE `email` = ? && `passwd` = ?";
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$email, $password]);
			$results = $stmt->fetch(PDO::FETCH_OBJ);

			if ($results)
				return $results;
			else
				return FALSE;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}

	public function add_user($username, $email, $password, $verification_code)
	{
		try {
			$sql = 'INSERT INTO users (username, passwd, email, verification_code) VALUES (?, ?, ?, ?)';
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$username, $password, $email, $verification_code]);

			return $this->username(($username));
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}

	public function delete_user($id)
	{
		try {

			$sql = "DELETE FROM `users` WHERE `users`.`id` =  ?";

			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$id]);
			return TRUE;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}

	public function verify($code)
	{
		try {
			$sql = "UPDATE `users` SET `verified` = '1' WHERE `verification_code` = ?";
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$code]);

			$sql = "UPDATE `users` SET `verification_code` = '' WHERE `verification_code` = ?";
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$code]);
			return TRUE;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}

	public function is_verified($id)
	{
		try {
			$sql = "SELECT * FROM `users` WHERE `id` = ? AND `verified` = TRUE";
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$id]);
			$results = $stmt->fetch(PDO::FETCH_OBJ);

			if ($results)
				return TRUE;
			else
				return FALSE;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}

	public function addVerificationCodebyEmail($email, $verification_code){
		try {
			$sql = "UPDATE `users` SET `verification_code` = ? WHERE `email` = ?";
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$verification_code, $email]);

			return TRUE;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}

	public function set_password($id, $password){
		try {
			$sql = "UPDATE `users` SET `passwd` = ? WHERE `id` = ?";
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$password, $id]);

			return TRUE;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}

	public function update_user($id, $username, $email, $notifications){
		echo '<br />-----' . __METHOD__ . '----<br />';

		try {
			$sql = "UPDATE `users` SET `username` = ?, `email` = ?, `notifications` = ? WHERE `id` = ?";
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$username, $email, $notifications, $id]);

			return TRUE;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}
}