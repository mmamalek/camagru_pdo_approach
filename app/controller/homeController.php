<?php
include(LIB.'Controller.php');
class homeController extends Controller{
    public function __construct(){
        echo '<br />--------'.__CLASS__.'--------<br />';

    }

    public function __destruct(){
        echo '<br />--------!'.__CLASS__.'--------<br />';
    }
}
?>