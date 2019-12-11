<?php
define(ROOT, __DIR__.'/');
__DIR__."/"."app/"


__DIR__."/".'app/model/'





include_once("config/setup.php");
session_start();

if(!file_exists("uploads")){
    mkdir("uploads");
}
if(!file_exists("temp_uploads")){
    mkdir("temp_uploads");
}

if (!isset($_SESSION['user_id'])){
    $_SESSION['user_id'] = NULL;
}
include(__DIR__."/".'app/Application.php');
$app = new Application();
?>