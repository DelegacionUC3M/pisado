<?php

class pisadoController extends Controller {
	
	function create() {
		$this->security();

		if(isset($_POST['titulacion']) && isset($_POST['asignatura']) && isset($_POST['curso']) && isset($_POST['grupo'])
			&& isset($_POST['profesor']) && isset($_POST['texto'])) {
			$data = array();
			if(!empty($_POST['titulacion']) && !empty($_POST['asignatura']) && !empty($_POST['curso'])
				&& !empty($_POST['grupo']) && !empty($_POST['profesor']) && !empty($_POST['texto'])) {
				$pisado = new Pisado;

				$pisado->nia = $_SESSION['user']->nia;
				$pisado->email = $_SESSION['user']->email;
				$pisado->id_titulacion = $_POST['titulacion'];
				$pisado->asignatura = $_POST['asignatura'];
				$pisado->curso = $_POST['curso'];
				$pisado->grupo = $_POST['grupo'];
				$pisado->profesor = $_POST['profesor'];
				$pisado->texto = $_POST['texto'];

				if($pisado->save()) {
					$data['verify'] = 'El registro del pisado se ha realizado con exito.';
					$this->sendmail($pisado->nia);
					$destinatarios = User::findDestinatarios($pisado->curso, $pisado->id_titulacion);
					$this->sendmailPisado($destinatarios, $pisado);
				} else {
					$data['error'] = 'Ha ocurrido un error con la base de datos, por favor pongase en contacto con el
					 administrador del sistema.';
				}

			} else {
				$data['error'] = 'Debes rellenar todos los campos.';
			}

			$this->render('create', $data);
		} else {
			$this->render('create');
		}
	}

	function view() {
		$this->security();
		// $id = $_GET['id'];
	
	}

	function comment() {
		$this->security();

		if(isset($_POST['id_pisado']) && isset($_POST['text'])) {
			$data = array();
			if(empty($_POST['text'])) {
				$data['error'] = 'Debes introducir texto en tu comentario';
			} else {
				$comentario = new Comentario;

				$comentario->id_pisado = $_POST['id_pisado'];
				$comentario->nia = $_SESSION['user']->nia;
				$comentario->text = $_POST['text'];
				if($user->isDelegado == true) {
					$comentario->nombre = $_SESSION['user']->name;
				}

				if($comentario->save()) {
					$data['verify'] = 'Su comentario ha sido guardado con exito.';
				} else {
					$data['error'] = 'Ha ocurrido un error con la base de datos. Por favor, pongase en contacto con el
									 administrador de la aplicacion.';
				}
			}

			$this->render('view', $data);
		} else {
			$this->render('view');
		}
		// send mail 
	}

}
