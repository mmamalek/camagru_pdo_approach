<h1>My Photos</h1>
<?php
$images = $this->Array[0];
$offset = $this->Array[1];
if ($offset == "zero") $offset = 0;
$offset++;
$max = ($offset + 4);
$total = $this->Array[2];
$pageNo = $this->Array[3];
$next = $pageNo + 1;
$prev = $pageNo - 1;
if ($max > $total) $max = $total;
?>
<p class="page-image-range">   
    <?php
        echo "showing images <strong>$offset</strong> to <strong>$max</strong> of <strong>$total</strong>";    
    ?>
</p>
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
        echo "</div>";
        echo "</a>";
    }
?>
</div>
<div class="pager">
<?php
    if ($offset != 1){
        echo "<a href='/home/gallery/$prev' class='paging-button prev'>Previous Page</a>";
    }
    if($max != $total){
        echo "<a href='/home/gallery/$next' class='paging-button next'>Next Page</a>";    
    }    
?>
</div>