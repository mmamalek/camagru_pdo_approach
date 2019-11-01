<?php
class imagesController extends Controller{
	public function __construct(){
		echo '<br />-----'.__METHOD__.'----<br />';

		$this->model = $this->model();
	}
} 