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
			header('Location: /pisado/inicio');
		} else {

			if (isset($_POST['nia']) && isset($_POST['password'])) {
				try {
					$ldap = LDAP_Gateway::login($_POST['nia'], $_POST['password']);

					if ($ldap) {
						$user = new User($ldap->getUserId(),$ldap->getUserNameFormatted(),$ldap->getUserMail(),$ldap->getDn());
						$_SESSION['user'] = $user;

						if (isset($_GET['url'])) {
							header('Location: '.$_GET['url']);
						} else {
							header('Location: /pisado/inicio');
						}
					} else {
						$error = 'Usuario o contraseña incorrecto';
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
		header('Location: /pisado/inicio');
	}

	function panel() {
		$this->security();
		
		$user = $_SESSION['user'];
		$pisados = Pisado::findByNia($user->nia);
		$otros = array();
		
		if ($user->isDelegadoEscuela()) {
			$otros = Pisado::findAll();
		} else if ($user->isDelegadoTitulacion()) {
			$otros = Pisado::findByIdTitulacion($user->id_titulacion);
		} else if ($user->isDelegadoCurso()) {
			$otros = Pisado::findByCurso($user->curso,$user->id_titulacion);
		}

		$this->render('panel', array('pisados'=>$pisados,'otros'=>$otros));
	}
	
}