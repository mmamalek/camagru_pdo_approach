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
			$sql = "INSERT INTO images (`location`, `author`, `likes`, `comments`) VALUES (?, ?, 'a:0:{}', 'a:0:{}')";
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

	function liked($imageId, $username){
		$image = $this->getImage($imageId);

		$likers = unserialize($image->likes);

		foreach($likers as  $i=>$liker){
			if ($liker == $username){
				return (TRUE);
			}
		}
		return (FALSE);
	}

	function unlike($imageId, $username){
	
		$image = $this->getImage($imageId);
		$likers = unserialize($image->likes);

		foreach($likers as  $i=>$liker){
			if ($liker == $username){
				unset($likers[$i]);
			}
		}

		$likers = array_values($likers);
		$likes = count($likers);
		$new = serialize($likers);
		try {
			$sql = "UPDATE `images` SET `likes` = ? WHERE `id` = ?";
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$new, $imageId]);
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
		return $likes;
	}

	function like($imageId, $username){
		
		if (!$this->liked($imageId, $username)){

			$image = $this->getImage($imageId);
			$likers = unserialize($image->likes);
			$likers[] = $username;
			$likes = count($likers);
			$new = serialize($likers);
			
			try {
				$sql = "UPDATE `images` SET `likes` = ? WHERE `id` = ?";
				$stmt = $this->dbconnection->prepare($sql);
				$stmt->execute([$new, $imageId]);
			} catch (PDOException $e) {
				echo $e->getMessage();
				return FALSE;
			}
			return $likes;
		}
		return $this->unlike($imageId, $username);
	}
	
	function comment($imageId, $comment){
		
		$image = $this->getImage($imageId);
		$comments = unserialize($image->comments);
		$comments[] = $comment;
		$commentsCount = count($comments);
		$new = serialize($comments);
		
		try {
			$sql = "UPDATE `images` SET `comments` = ? WHERE `id` = ?";
			$stmt = $this->dbconnection->prepare($sql);
			$stmt->execute([$new, $imageId]);
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
		return $commentsCount;

	}
	
	function getComments($imageId){
		
		$image = $this->getImage($imageId);
		$comments = unserialize($image->comments);
		return $comments;
	}
	
	function getCommentsCount($imageId){
		
		$image = $this->getImage($imageId);
		$comments = unserialize($image->comments);
		return count($comments);
	}


    
}
?>