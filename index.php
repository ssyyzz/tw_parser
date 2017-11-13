<?php

$devmode = true;

if($devmode)
{
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	ini_set('max_execution_time', 20);
}

define( "ROOT" , dirname(__FILE__) . '/' );
define( "SYSTEM" , ROOT . 'system/' );

require_once( SYSTEM . 'config.php' );
require_once( SYSTEM . 'libs/smarty/Smarty.class.php' );

spl_autoload_register(function ($class_name) {
	$line_exp = explode("_" , $class_name);
	$file = SYSTEM . $line_exp[0] . '/class_' . $line_exp[1] . '.php';

	if(!file_exists($file))
	{
		if($line_exp[0] == 'controller')	exit("404");
		else exit("Неизвестный класс - \"{$class_name}\"");
	}
	else 
	{
		require $file;
	}
});

$function_name = 'main';
$controller_short = 'main';

$line = explode( "/", $_GET['mode']);

if(isset($line[0]) && $line[0] != '') $controller_short = $line[0];

if(isset($line[1]) && $line[1] != '') $function_name = $line[1];

if(isset($line[2]) && $line[2] != '') $function_id = $line[2];

$controller_short = ucfirst(strtolower($controller_short));
$function_name = ucfirst(strtolower($function_name));

$controller_name = "controller_" . $controller_short;

$controller = new $controller_name();

if(!method_exists($controller, $function_name))	exit("404");
else
{
	if (isset($function_id)) $controller->$function_name($function_id);
	else $controller->$function_name($function_id);
}
