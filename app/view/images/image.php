<?php
$image = $this->Array[0];
$author = $this->Array[1];
$liked = $this->Array[2];
$comments = unserialize($image->comments);
$likes = unserialize($image->likes);

?>
<h1>image</h1>
<?php
echo "<p>uploaded by <strong>$author</strong></p>";
echo "<img src='/$image->location' />";
echo "<span>Likes: <span id='likes-count'>" . count($likes) . "</span></span>";
?>
<?php
    if(!empty($_SESSION["user_id"])){
        echo "<button id='like-button'>";
        echo ($liked ? "unlike": "like");
        echo "</button>";
    }
?>
<div id="comments">
<div id="comments-block">
    <?php
        foreach($comments as $comment){
            foreach($comment as $author=>$text){
                echo "<p><strong>$author</strong>" .base64_decode($text) . "</p>";
            }
        }
    ?>
</div>
    <?php
        if(!empty($_SESSION["user_id"])){
            echo "<textarea id='comment-text'></textarea>";
            echo "<button id='send-comment'>comment</button>";
            echo "<script src='/public/js/image.js'></script>";
        }
    ?>
    <?php
        if($image->author == $_SESSION["user_id"]){
            echo "<button id='delete-post'>delete-post</button>";
        }
    ?>

</div>