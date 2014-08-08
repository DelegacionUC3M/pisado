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
		$pisados = array_merge(Pisado::findByNia($user->nia), Group::findByNia($user->nia)); 
		usort( $pisados, function($a, $b) {return strtotime($a->date) - strtotime($b->date);} );
		$otros = array();
		
		if ($user->isDelegadoEscuela()) {
			$otros = array_merge(Pisado::findAll(), Group::findAll());
			usort( $otros, function($a, $b) {return strtotime($a['date']) - strtotime($b['date']);});
		} else if ($user->isDelegadoTitulacion()) {
			$otros = array_merge(Pisado::findByIdTitulacion($user->id_titulacion), Group::findByIdTitulacion($user->id_titulacion));
			usort( $otros, function($a, $b) {return strtotime($a->date) - strtotime($b->date);} );
		} else if ($user->isDelegadoCurso()) {
			$otros = array_merge(Pisado::findByCurso($user->curso,$user->id_titulacion), Group::findByCurso($user->curso,$user->id_titulacion));
			usort( $otros, function($a, $b) {return strtotime($a->date) - strtotime($b->date);} );
		}

		$this->render('panel', array('pisados'=>$pisados,'otros'=>$otros));
	}
	
}