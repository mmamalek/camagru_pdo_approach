<?php
var_dump($this->Array[0]);
$image = $this->Array[0];
$author = $this->Array[1];
$comments = unserialize($image->comments);
$likes = unserialize($image->likes);

?>
<h1>image</h1>
<?php
echo "<p>uploaded by <strong>$author</strong></p>";
echo "<img src='/$image->location' />";
echo "<span>Likes: " . count($likes) . "</span>";
?>
<?php
    if(!empty($_SESSION["user_id"])){
        echo "<input type='checkbox' id='like-cb' />";
        echo "<label for='like-cb'>text<button id='like'>like</button></label>";
    }
?>
<div class="comments">
    <?php
        foreach($comments as $comment){
            foreach($comment as $author=>$text){
                echo "<p><strong>$author</strong>$text</p>";
            }
        }
    ?>
    <?php
        if(!empty($_SESSION["user_id"])){
            echo "<textarea id='comment-text'></textarea>";
            echo "<button id='send-comment'>comment</button>";
            echo "<script src='/public/js/image.js'></script>";
        }
    ?>
</div>