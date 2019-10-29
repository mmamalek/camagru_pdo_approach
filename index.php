<?php
define(ROOT, __DIR__.'/');
define(APP, ROOT.'app/');
define(CONTROLLERS, APP.'controllers/');
define(MODELS, APP.'models/');
define(VIEWS, APP.'views/');
define(SHARED, APP.'shared/'); ?>

<?php include(VIEWS.'header.html'); ?>

<?php
echo "what's up man?<br />";
echo ROOT."<br />";
echo CONTROLLERS."<br />";
echo MODELS."<br />";
echo VIEWS."<br />";
echo SHARED."<br />";
var_dump($_SERVER["REQUEST_URI"]);


$modules = [ROOT, APP, CONTROLLERS, MODELS, VIEWS, SHARED];
echo "<br />";
echo "<br />";
echo "<br />";
var_dump(get_include_path());
echo "<br />";
var_dump($modules);

$my_include_path = implode(':', $modules);
echo "<br />";
echo "<br />";
echo $my_include_path;


set_include_path(get_include_path().':'.$my_include_path);
echo "<br />";
echo "<br />";
var_dump(get_include_path());


spl_autoload_register('spl_autoload', false);


?>

<?php

$app = new Application();
?>











<?php include(VIEWS.'footer.html'); ?>