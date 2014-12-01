<?php

class Controller {
	
	protected function security($redirect = true) {

		if (isset($_SESSION['user']) && isset($_SESSION['user']->nia) && !empty($_SESSION['user']->nia)) {
			return true;
		}

		if ($redirect) {
			header('Location: /pisado/inicio/login?url='.urlencode($_SERVER['REQUEST_URI']));
			die();
		}

		return false;
	}

	protected function render($view, $data = array()) {
		if(!empty($data)) {
			extract($data);
		}

		$title = isset($title) ? $title : 'PISADO - Delegación UC3M';
		$user = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;

		if ($view == 'inicio' || $view == 'login') {
			$section = $view;
		}

		include ABSPATH . 'app/views/header.php';
		include ABSPATH . 'app/views/' . $view . '.php';
		include ABSPATH . 'app/views/footer.php';
	}

	protected function render_error($code = 404) {
		self::error($code);
	}

	public static function error($code = 404) {
		if ($code == 404) {
			header("HTTP/1.0 404 Not Found");
			$error = 'La página solicitada no existe :(';
		} else if ($code == 401) {
			header('HTTP/1.0 401 Unauthorized');
			$error = 'No tienes permiso para acceder aquí :(';
		}

		$title = isset($title) ? $title : 'PISADO - Delegación UC3M | Error';
		$user = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;

		include ABSPATH . 'app/views/header.php';
		include ABSPATH . 'app/views/error.php';
		include ABSPATH . 'app/views/footer.php';
	}

	protected function render_email($view, $data) {
		if(!empty($data)) {
			extract($data);
		}

		$title = isset($title) ? $title : 'PISADO - Delegacion UC3M';
		$user = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;

		ob_start();
		include ABSPATH . 'app/views/mail' . $view . '.php';
		return ob_get_clean();
	}

	protected function send($titulo,$destinatarios,$cuerpo) {
	    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
	    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	    $cabeceras .= 'From: delegest@gmail.com' . "\r\n" . 
	      	'Reply-To: delegest@gmail.com' . "\r\n";
	    $cabeceras .= 'BCC: ';
	    foreach ($destinatarios as $destinatario) {
	    	$cabeceras .= $destinatario['nia'] . "@alumnos.uc3m.es" . "," . "\r\n";
	    }

		mail(NULL , $titulo, $cuerpo, $cabeceras);
	}

}
