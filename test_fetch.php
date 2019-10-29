<?php
	require('connection.php');

	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['passwd'];
	$password = hash('sha1', $password);

	//check if user exist
	try{
		$sql = 'SELECT * FROM users';
		$stmt = $conn->prepare($stmt);
		$stmt->execute($username);
	//	$results = $stmt->setFetchMode(PDO::FETCH_ASSOC);

		$results = $stmt->fetch(PDO::FETCH_OBJ);
		echo $results->username;

		if ($result)
		{
			$exists = TRUE;
			$errors['username'] = 'Username already exits';
		}
		else
		{
			echo "account created";
		}

	} catch (PDOException $e){
		echo $e->getMessage();
	} 

?>