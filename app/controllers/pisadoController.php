<?php

class pisadoController extends Controller {
	
	function create() {
		$this->security();

		if(isset($_POST['titulacion']) && isset($_POST['asignatura']) && isset($_POST['curso']) && isset($_POST['grupo'])
			&& isset($_POST['profesor']) && isset($_POST['texto'])) {
			$data = array();
			if(!empty($_POST['titulacion']) && !empty($_POST['asignatura']) && !empty($_POST['curso'])
				&& !empty($_POST['grupo']) && !empty($_POST['profesor']) && !empty($_POST['texto'])) {
				if(is_numeric($_POST['grupo'])) {	
					$pisado = new Pisado;

					$pisado->nia = $_SESSION['user']->nia;
					$pisado->email = $_SESSION['user']->email;
					$pisado->id_titulacion = $_POST['titulacion'];
					$pisado->asignatura = $_POST['asignatura'];
					$pisado->curso = $_POST['curso'];
					$pisado->grupo = $_POST['grupo'];
					$pisado->profesor = $_POST['profesor'];
					$pisado->texto = $_POST['texto'];

					$pisado->save(); //Lo comentado no se pone porque hay un problema al capturar la excepcion en DB
					//if($pisado->save()) {
						$data['verify'] = 'El registro del pisado se ha realizado con exito.';
						$this->sendmail($pisado->nia);
						$destinatarios = User::findDestinatarios($pisado->curso, $pisado->id_titulacion);
						$this->sendmailPisado($destinatarios, $pisado);
					/*} else {
						$data['error'] = 'Ha ocurrido un error con la base de datos, por favor pongase en contacto con el
						 administrador del sistema.';
					}*/
				} else {
					$data['error'] = 'El grupo debe ser un numero.';
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
		$id = (int) $_GET['id'];
		$pisado = Pisado::findById($id);
		$data = array();
		if(($pisado->nia == $_SESSION['user']->nia) || (($pisado['id_titulacion'] == $_SESSION['id_titulacion']) 
				&& $_SESSION['user']->isDelegadoCurso())) {//dentro de view hay que controlar que no muestre los datos.
			$comentario = Comentario::findByIdpisado($id);
			$data['pisado'] = $pisado;
			$data['comment'] = $comentario;
		} else {
			$data['error'] = 'No tienes permiso para ver esto';
		}

		$this->render('view', $data);
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
