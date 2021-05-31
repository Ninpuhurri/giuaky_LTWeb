<?php 
function loadClass($className)
{
    if (is_file("Model/$className.php"))
        include "Model/$className.php";
    else if (is_file("Controller/$className.php"))
            include "Controller/$className.php";
        else {
            echo "Err";exit;
        }
}
include 'config.php';
include 'function.php';
$c = getIndex('admin');
if($c == "log"){
	$c = "C_Admin";
	spl_autoload_register('loadClass');
	$obj = new $c();
}else{
	spl_autoload_register('loadClass');
	$c = getIndex('controller','C_Home');
	$obj = new $c();
}