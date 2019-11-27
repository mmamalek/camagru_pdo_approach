<?php
include(LIB.'Controller.php');
class errorController extends Controller{
    public function __construct(){
        echo '<br />--------'.__CLASS__.'--------<br />';

    }

	public function index(){
        echo '<br />--------'.__METHOD__.'--------<br />';
		header('Location: notfound');
	}
	
	public function notfound(){
        echo '<br />--------'.__METHOD__.'--------<br />';
		$this->view = $this->view('error/pagenotfound');
		$this->view->render();
    }

    public function __destruct(){
        echo '<br />--------!'.__CLASS__.'--------<br />';
    }
}
?>