<?php

require_once('config.php');

function __autoload($class) {

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
		errorController::index();
	}
	
}

new MainController;
