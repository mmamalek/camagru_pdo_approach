<?php
include(LIB.'Controller.php');
class adminController extends Controller{
    public function __construct(){
        echo '<br />--------'.__CLASS__.'--------<br />';

    }

    public function __destruct(){
        echo '<br />--------!'.__CLASS__.'--------<br />';
    }
}
?>