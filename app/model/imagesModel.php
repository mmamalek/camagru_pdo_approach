<?php

class imagesModel
{
	protected $dbconnection = NULL;

	public function __construct()
	{
		//echo "------" . __CLASS__ . " Object created---------<br />";
		$this->connect();
	}

	protected function connect()
	{
		//echo '<br />-----' . __METHOD__ . '----<br />';

		require(CONFIG . 'database.php');

		try {
			$this->dbconnection = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$this->dbconnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


			//echo "database connection Established.<br>";
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

	
	public function getImage($imageId){

		$sql = "SELECT * FROM `images` WHERE `id` = ?";
		try {
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$imageId]);
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

	
	public function getImages(){

		$sql = "SELECT * FROM `images` ORDER BY `creation_date` DESC";
		try {
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute();
			$results = $stmt->fetchAll(PDO::FETCH_OBJ);

			if ($results)
				return $results;
			else
				return FALSE;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
	}


    
}
?>