<h1>Gallery</h1>
<?php
$images = $this->Array[0];
?>

<?php
    foreach($images as $image){
        $imageId = $image->id;
        echo "<a href='/images/image/$imageId'>";
        echo "<img src='/$image->location' width='300' />";
       // var_dump($image->location);
        echo "</a>";
        
    }
?>