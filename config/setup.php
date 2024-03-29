<?php
if (file_exists('./database.php'))
	require_once('./database.php');
else 
	require_once('./config/database.php');
try
{
	$conn = new PDO('mysql:host='.$DB_HOST, $DB_USER, $DB_PASSWORD);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "Connected<br>";
	$sql = "CREATE DATABASE IF NOT EXISTS `$DB_NAME`";
	$conn->exec($sql);
	//echo "Database created<br>";
}
catch (PDOException $e) 
{
	//echo $e->getMessage();
}

$conn = NULL;

try
{
	$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("CREATE TABLE IF NOT EXISTS `camagru`.`users` 
							( `id` INT NOT NULL AUTO_INCREMENT 
							, `username` VARCHAR(50) NOT NULL 
							, `email` VARCHAR(50) NOT NULL 
							, `passwd` VARCHAR(200) NOT NULL 
							, `verified` BOOLEAN NOT NULL DEFAULT FALSE 
							, `notifications` BOOLEAN NOT NULL DEFAULT TRUE 
							, `verification_code` VARCHAR(50) NOT NULL 
							, PRIMARY KEY (`id`)) ENGINE = InnoDB;");
	$stmt->execute();

	$stmt = NULL;
	$stmt = $conn->prepare("CREATE TABLE IF NOT EXISTS `camagru`.`images` 
							(`id` INT NOT NULL AUTO_INCREMENT 
							, `location` TEXT NOT NULL
							, `author` VARCHAR(20) NOT NULL
							, `creation_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
							, `likes` TEXT NOT NULL
							, `comments` TEXT NOT NULL 
							, PRIMARY KEY (`id`)) ENGINE = InnoDB");
	$stmt->execute();
	//echo "Tables Created.<br>";
}
catch (PDOException $e) 
{
	echo $e->getMessage();
}

?>