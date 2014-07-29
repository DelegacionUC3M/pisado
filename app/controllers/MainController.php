<?php

class MainController {
	
	function __construct() {
		$controller = (isset($_GET['c']) && !empty($_GET['c'])) ? $_GET['c'].'Controller' : 'inicioController';
		$action = (isset($_GET['a']) && !empty($_GET['a'])) ? $_GET['a'] : 'index';

		$load = new $controller();
		$load->$action();
	}

}
