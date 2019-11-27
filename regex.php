<?php
$password = '1aD';
var_dump(preg_match('/[a-z]/',$password));
if (!preg_match('/[a-z]/',$password)){
	echo 'No lowercase char<br />';
}
if (!preg_match('/[A-Z]/',$password)){
	echo 'No caps char<br />';
}
if (!preg_match('/[0-9]/',$password)){
	echo 'No number<br />';
}
if (strlen($password) < 8){
	echo 'too short<br />';
}
?>