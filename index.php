<?php

require_once('config.php');

session_start();

function __autoload($class) {

	str_replace(array('.', '/'), '' , $class);

	if (file_exists('app/controllers/'.$class.'.php')) {
		include ('app/controllers/'.$class.'.php');
	} else if (file_exists('app/models/'.$class.'.php')) {
		include ('app/models/'.$class.'.php');
	} else if (file_exists('app/views/'.$class.'.php')) {
		include ('app/views/'.$class.'.php');
	} else if (file_exists('app/lib/'.$class.'.php')) {
		include ('app/lib/'.$class.'.php');
	}

	if(!class_exists($class)) {
		Controller::error(404);
	}
	
}

$url = explode('/', $_SERVER["REQUEST_URI"]);
$controller = (isset($url[2]) && !empty($url[2])) ? $url[2] . 'Controller' : 'inicioController';
$action 	= (isset($url[3]) && !empty($url[3])) ? $url[3] . 'Action' : 'indexAction';
$_GET['id'] = (isset($url[4]) && !empty($url[4])) ? (int)explode('?',$url[4])[0] : '';
$_GET['archived'] = (isset($url[5]) && !empty($url[5])) ? (int)explode('?',$url[5])[0] : '';


if (method_exists($controller, $action)) {
	$load = new $controller();
	$load->$action();
} else {
	Controller::error(404);
}

