<?php
define(ROOT, __DIR__.'/');
define(CONFIG, ROOT.'config/');
define(DOC, ROOT.'public/');
define(APP, ROOT.'app/');
define(CONTROLLER, APP.'controller/');
define(MODEL, APP.'model/');
define(VIEW, APP.'view/');
define(LIB, APP.'lib/');

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
include(APP.'Application.php');
$app = new Application();
?>