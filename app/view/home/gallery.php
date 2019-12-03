<h1>Gallery</h1>
<?php
$images = $this->Array[0];
?>

<?php
    foreach($images as $image){
        $imageId = $image->id;
        $likes = count(unserialize($image->likes));
        $comments = count(unserialize($image->comments));
        echo "<a href='/images/image/$imageId'>";
        echo "<div>";
        echo "<img src='/$image->location' width='300' />";
        echo "<span>" . $likes . (($likes == 1) ? " like" : " likes") .  "</span>";
        echo "<span>" . $comments . (($comments == 1) ? " comment" : " comments") .  "</span>";
       // var_dump($image->location);
        echo "</div>";
        echo "</a>";
        
    }
?>