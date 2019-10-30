<?php

require('connection.php');
$code = $_GET['ver_code'];

$sql = "SELECT * FROM `camagru`.`users` WHERE `verification_code` = ?";
$stmt = $conn->prepare($sql);

$stmt->execute([$code]);

$results = $stmt->fetch(PDO::FETCH_ASSOC);

if ($results)
{
	echo "Welcome to CamagUru";
	$sql = "UPDATE `users` SET `verified` = '1' WHERE `users`.`verification_code` = ?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$code]);
	$sql = "UPDATE `users` SET `verification_code` = '' WHERE `users`.`verification_code` = ?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$code]);

}


?>