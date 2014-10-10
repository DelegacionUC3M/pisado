<?php

class groupController extends Controller {
	
	function create() {
		
	}

	function view() {
		$this->security();

		$id = (int) $_GET['id'];
		$group = Group::findById($id);
		$data = array();

		if ($group) {
			if (in_array($_SESSION['user']->nia, $group->getOwners()) || (($group->id_titulacion == $_SESSION['user']->id_titulacion) && $_SESSION['user']->isDelegadoCurso()) || ($_SESSION['user']->isDelegadoEscuela()) ) { //dentro de view hay que controlar que no muestre los datos.

				if (isset($_POST['comment'])) {
					if (empty($_POST['comment'])) {
						$data['error'] = 'Debes introducir texto en tu comentario';
					} else {
						$comentario = new ComentarioGroup;

						$comentario->id_group = $group->id;
						$comentario->nia = $_SESSION['user']->nia;
						$comentario->text = htmlspecialchars($_POST['comment']);
						if ($_SESSION['user']->isDelegado) {
							if ($_SESSION['user']->isDelegadoCurso()) {
								$cargo = 'Delegado de Curso';
							} else if ($_SESSION['user']->isDelegadoTitulacion()) {
								$cargo = 'Delegado de Titulación';
							} else {
								$cargo = 'Delegado de Escuela';
							}
							$comentario->nombre = $_SESSION['user']->name.' ('.$cargo.')';
						} else {
							$comentario->nombre = '';
						}

						if (!$comentario->save()) {
							$data['error'] = 'Ha ocurrido un error al guardar el comentario. Inténtelo de nuevo.';
						} else {
							// $cuerpo = $this->render_email('Comentario',array('pisado' => "pisado"));
							// $destinatarios = array();
							// $destinatarios[] = $group->nia;
							// $this->send('¡Tienes un nuevo comentario en un PISADO!',$destinatarios,$cuerpo);
						}
					}
				}

				$comentarios = ComentarioGroup::findByIdGroup($group->id);
				$data['group'] = $group;
				$data['comentarios'] = $comentarios;

				$this->render('viewGroup', $data);
			} else {
				$this->render_error(401);
			}
		} else {
			$this->render_error(404);
		}
	}
}
