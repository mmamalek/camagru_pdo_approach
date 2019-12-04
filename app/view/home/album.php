<h1>My Album</h1>
<?php
$images = $this->Array[0];
?>
<div class="gallery-container">
<?php
    foreach($images as $image){
        $imageId = $image->id;
        $likes = count(unserialize($image->likes));
        $comments = count(unserialize($image->comments));
        echo "<a  href='/images/image/$imageId'>";
        echo "<div class='gallery-image-block'>";
        echo "<img src='/$image->location' class='gallery-image' />";
        echo "<span class='gallery-image-likes' >" . $likes . (($likes == 1) ? " like" : " likes") .  "</span>";
        echo "<span class='gallery-image-comments' >" . $comments . (($comments == 1) ? " comment" : " comments") .  "</span>";
        
       // var_dump($image->location);
        echo "</div>";
        echo "</a>";
        
        
    }
?>
</div>