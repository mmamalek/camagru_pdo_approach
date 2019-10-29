<?php
class indexController{

	public function __construct(){
		echo "----- object of class ".__CLASS__." created <br/>";
	}
	public function __destruct(){}
	public function home(){
		echo "<br />----- class: ".__CLASS__.', action: '.__METHOD__.'<br/>';
	}
}
?>