<?php
	require('connection.php');

	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['passwd'];
	$password = hash('sha1', $password);

	$exists = FALSE;
	
	try{
		$sql = "SELECT * FROM users WHERE username = ?";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$username]);
		$results = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($results)
		{
			$exists = TRUE;
			echo 'Username already exits';
		}
		else
		{
			echo "account created";
			$verification_code = hash('sha1', $username);
		}

	} catch (PDOException $e){
		echo $e->getMessage();
	} 



	if (!$exists){

		try{
			$sql = 'INSERT INTO users (username, passwd, email, notifications, verification_code) VALUES (?, ?, ?, 0, ?)';
			$stmt = $conn->prepare($sql);
			$stmt->execute([$username, $password, $email, $verification_code]);
			echo 'seccessfull <br />';
			
			$msg= "click the link to verify your account: http://127.0.0.1:8080/redirect_here.php?ver_code=$verification_code";
			$headers = array(
				'From: noreply');

			mail($email, "Verification email", $msg, implode("\r\n",$headers));
			echo "<br />Check your email ";

		} catch (PDOException $e){
			echo $e->getMessage();
		}
	}
?>