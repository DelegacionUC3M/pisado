<?php

class groupController extends Controller {

	function create() {

	}

	function close() {
		$this->security();

		$id = (isset($_GET['id'])) ? (int) $_GET['id'] : false;
		$group = Group::findById($id);
		$data = array();

		if ($group) {
			if (in_array($_SESSION['user']->nia, $group->getOwners()) || (($group->id_titulacion == $_SESSION['user']->id_titulacion) && $_SESSION['user']->isDelegadoCurso()) || ($_SESSION['user']->isDelegadoCentro()) ) {
				foreach ($group->pisados as $pisado) {
					$archive = new Archive;
					$archive->pisado = $pisado;
					if(!$archive->save()) {
						$data['archive_error'] = 'No se ha podido archivar un pisado';
						$this->render('viewGroup', $data);
					}
				}
				if (isset($data['archive_error'])) {
					$this->render('viewGroup', $data);
				} else {
					header('Location: /pisado/inicio/');
				}
			} else {
				$this->render_error(401);
			}
		} else {
			$this->render_error(404);
		}
	}

	function open() {
		$this->security();

		$id = (isset($_GET['id'])) ? (int) $_GET['id'] : false;
		$group = Group::findById($id,true);
		$data = array();

		if ($group) {
			if (in_array($_SESSION['user']->nia, $group->getOwners()) || (($group->id_titulacion == $_SESSION['user']->id_titulacion) && $_SESSION['user']->isDelegadoCurso()) || ($_SESSION['user']->isDelegadoCentro()) ) {
				foreach ($group->pisados as $pisado) {
					$archive = Archive::findByPisado($pisado->id);
					if(!isset($archive) || !$archive->delete()) {
						$data['archive_error'] = 'No se ha podido archivar un pisado';
					}
				}
				if (isset($data['archive_error'])) {
					$this->render('viewGroup', $data);
				} else {
					header('Location: /pisado/inicio/');
				}
			} else {
				$this->render_error(401);
			}
		} else {
			$this->render_error(404);
		}
	}

	function view() {
		$this->security();

		$id = (int) $_GET['id'];
		$group = Group::findById($id);
		$data = array();

		if ($group) {
			if (in_array($_SESSION['user']->nia, $group->getOwners()) || (($group->id_titulacion == $_SESSION['user']->id_titulacion) && $_SESSION['user']->isDelegadoCurso()) || ($_SESSION['user']->isDelegadoCentro()) ) { //dentro de view hay que controlar que no muestre los datos.

				if (isset($_POST['comment'])) {
					if (empty($_POST['comment'])) {
						$data['error'] = 'Debes introducir texto en tu comentario';
					} else {
						$comentario = new ComentarioGroup;

						$comentario->id_group = $group->id;
						$comentario->nia = $_SESSION['user']->nia;
						$comentario->text = htmlspecialchars($_POST['comment']);
						if ($_SESSION['user']->isDelegado) {
							if ($_SESSION['user']->isDelegadoCentro()) {
								$cargo = 'Delegado de Centro';
							} else if ($_SESSION['user']->isDelegadoTitulacion()) {
								$cargo = 'Delegado de Titulación';
							} else {
								$cargo = 'Delegado de Curso';
							}
							$comentario->nombre = $_SESSION['user']->name.' ('.$cargo.')';
						} else {
							$comentario->nombre = '';
						}

						if (!$comentario->save()) {
							$data['error'] = 'Ha ocurrido un error al guardar el comentario. Inténtelo de nuevo.';
						} else {
							/*$cuerpo = $this->render_email('ComentarioGroup',array('group' => $group));
							$destinatarios = DBDelegados::findDelegadosCurso($pisado->id_titulacion,$pisado->curso);
							$delegadosTit = DBDelegados::findDelegadosTitulacion($pisado->id_titulacion);
							foreach ($delegadosTit as $delegado) {
								$destinatarios[] = $delegado;
							}
							$destinatarios[] = array('nia' => $pisado->nia);
							$this->send('¡Tienes un nuevo comentario en un grupo de PISADOs!',$destinatarios,$cuerpo);*/
						}
					}
				}

				$comentarios = ComentarioGroup::findByIdGroup($group->id);
				$data['group'] = $group;
				$data['comentarios'] = $comentarios;
				$data['archive'] = Group::isClose($group->id);

				$this->render('viewGroup', $data);
			} else {
				$this->render_error(401);
			}
		} else {
			$this->render_error(404);
		}
	}
}
