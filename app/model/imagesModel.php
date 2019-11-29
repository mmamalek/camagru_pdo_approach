<?php

class imagesModel
{
	protected $dbconnection = NULL;

	public function __construct()
	{
		echo "------" . __CLASS__ . " Object created---------<br />";
		$this->connect();
	}

	protected function connect()
	{
		echo '<br />-----' . __METHOD__ . '----<br />';

		require(CONFIG . 'database.php');

		try {
			$this->dbconnection = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$this->dbconnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


			echo "database connection Established.<br>";
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	
	public function addImage($imagePath){
		try {
			$sql = "INSERT INTO images (`location`, `author`, `likes`, `comments`) VALUES (?, ?, 0, '')";
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$imagePath, $_SESSION['user_id']]);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
    
}
?>