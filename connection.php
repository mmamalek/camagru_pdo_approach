<?php
	require('config/database.php');
try
{
	$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
	echo "connected.<br>";
}
catch (PDOException $e) 
{
	echo $e->getMessage();
}
?>