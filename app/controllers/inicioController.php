<?php

class inicioController extends Controller {

	function index() {
		if ($this->security(false)) {
			$this->panel();
		} else {
			$this->render('inicio');
		}
	}

	function login() {
		if ($this->security(false)) {
			$this->panel();
		} else {

			if (isset($_POST['nia']) && isset($_POST['password'])) {
				try {
					$ldap = LDAP_Gateway::login($user_name, $user_password);

					if ($ldap) {
						$user = new User($ldap->getUserId(),$ldap->getUserNameFormatted(),$ldap->getUserMail(),$ldap->getDn());
						$_SESSION['user'] = $user;

						$this->panel();
					} else {
						$error = 'Usuario o contraseña incorrecto.';
						$this->render('login', array('error'=>$error));
					}

				} catch (Exception $e) {
					$error = 'Ha habido un problema con la autenticación. Inténtelo de nuevo.';
					$this->render('login', array('error'=>$error));
				}
			} else {
				$this->render('login');
			}

		}
	}

	function logout() {
		session_start();
		session_destroy();
   		session_regenerate_id(true);
		header('Location: inicio');
	}

	function panel() {
		if ($this->security()) {
			$user = $_SESSION['user'];
			$pisados = Pisado::findByNia($user->nia);
			$delegacion = array();
			
			if ($user->isDelegado) {

				if ($user->isDelegadoEscuela) {
					$delegacion = Pisado::findAll();
				} else if ($user->isDelegadoTitulacion) {
					$delegacion = Pisado::findByTitulacion($user->id_titulacion);
				} else {
					$delegacion = Pisado::findByCurso($user->curso,$user->id_titulacion);
				}

			}

			$this->render('panel', array($pisados,$delegacion));
		}
	}
	
}