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
		$data = array();
		
		$user = $_SESSION['user'];

		if (isset($_POST['pisado']) || isset($_POST['group'])) {
			if ($user->isDelegadoTitulacion() || $user->isDelegadoCentro()) {
				$pisados = isset($_POST['pisado']) ? $_POST['pisado'] : array();
				$groups = isset($_POST['group']) ? $_POST['group'] : array();

				if (count($groups) == 1) { // meter todos a ese grupo
					$group = Group::findById($groups[0]);
					foreach ($pisados as $id_pisado) {
						$pisado = Pisado::findById($id_pisado);
						if ($group->curso == $pisado->curso && $group->id_titulacion == $pisado->id_titulacion) {
							$pisado->id_group = $group->id;
							$pisado->update();
						} else {
							$data['error'] = 'Los PISADOs han de pertenecer al mismo curso y titulación';
						}
					}
				} else if (count($groups) > 1) { // unificar todos y grupos en nuevo con name, borrar otros
					if (isset($_POST['name']) && !empty($_POST['name'])) {
						$group = new Group;
						$group->subject = $_POST['name'];
						$group->save();
						foreach ($pisados as $id_pisado) {
							$pisado = Pisado::findById($id_pisado);
							$pisado->id_group = $group->id;
							$pisado->update();
						}
						foreach ($groups as $id_group) {
							$group_old = Group::findById($id_group);
							$gpisados = $group_old->pisados;
							foreach ($gpisados as $pisado) {
								$pisado->id_group = $group->id;
								$pisado->update();
							}
							$group_old->delete();
						}
					} else {
						$data['error'] = 'El grupo ha de tener un nombre';
					}
				} else { // nuevo con name
					if (isset($_POST['name']) && !empty($_POST['name'])) {
						$group = new Group;
						$group->subject = $_POST['name'];
						$group->save();
						foreach ($pisados as $id_pisado) {
							$pisado = Pisado::findById($id_pisado);
							$pisado->id_group = $group->id;
							$pisado->update();
						}
					} else {
						$data['error'] = 'El grupo ha de tener un nombre';
					}
				}
			} else {
				$data['error'] = 'Solo pueden agrupar PISADOs delegados de titulación o centro';
			}
		}

		$data['pisados'] = array_merge(Pisado::findByNia($user->nia), Group::findByNia($user->nia)); 
		usort( $data['pisados'], function($a, $b) {return strtotime($a->date) - strtotime($b->date);} );
		$data['otros'] = array();
		
		if ($user->isDelegadoCentro()) {
			$data['otros'] = array_merge(Pisado::findByCentro($user->centro), Group::findByCentro($user->centro));
			usort( $data['otros'], function($a, $b) {return strtotime($a->date) - strtotime($b->date);});
		} else if ($user->isDelegadoTitulacion()) {
			$data['otros'] = array_merge(Pisado::findByIdTitulacion($user->id_titulacion), Group::findByIdTitulacion($user->id_titulacion));
			usort( $data['otros'], function($a, $b) {return strtotime($a->date) - strtotime($b->date);} );
			print_r($user);
		} else if ($user->isDelegadoCurso()) {
			$data['otros'] = array_merge(Pisado::findByCurso($user->curso,$user->id_titulacion), Group::findByCurso($user->curso,$user->id_titulacion));
			usort( $data['otros'], function($a, $b) {return strtotime($a->date) - strtotime($b->date);} );
		}

		$this->render('panel', $data);
	}


	
}