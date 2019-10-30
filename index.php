<?php
define(ROOT, __DIR__.'/');
define(CONFIG, ROOT.'config/');
define(APP, ROOT.'app/');
define(CONTROLLERS, APP.'controllers/');
define(MODELS, APP.'models/');
define(VIEWS, APP.'views/');
define(SHARED, APP.'shared/'); ?>

<?php include(VIEWS.'header.php'); ?>
<?php


//echo 'request uri: '.$_SERVER["REQUEST_URI"].'<br />';

$modules = [ROOT, APP, CONTROLLERS, MODELS, VIEWS, SHARED];

$my_include_path = implode(':', $modules);

set_include_path(get_include_path().':'.$my_include_path);
//echo "<br />";
//var_dump(get_include_path());


spl_autoload_register('spl_autoload', false);

?>
<?php

include(APP.'Application.php');
$app = new Application();
?>











<?php include(VIEWS.'footer.html'); ?>