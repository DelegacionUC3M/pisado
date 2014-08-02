<?php

class pisadoController extends Controller {
	
	function create() {
		$this->security();
		$data = array();

		$data['titulaciones'] = Pisado::findTitulaciones();
		$pisado = new Pisado;
		$pisado->id_titulacion = $_SESSION['user']->id_titulacion;
		$data['pisado'] = $pisado;

		if (isset($_POST['titulacion']) && isset($_POST['asignatura']) && isset($_POST['curso']) && isset($_POST['grupo'])
			&& isset($_POST['profesor']) && isset($_POST['texto'])) {

			$pisado->nia = $_SESSION['user']->nia;
			$pisado->email = $_SESSION['user']->email;
			$pisado->autor = $_SESSION['user']->name;
			$pisado->id_titulacion = (int) $_POST['titulacion'];
			$pisado->asignatura = $_POST['asignatura'];
			$pisado->curso = $_POST['curso'];
			$pisado->grupo = (int) $_POST['grupo'];
			$pisado->profesor = $_POST['profesor'];
			$pisado->texto = $_POST['texto'];

			if(!empty($_POST['titulacion']) && !empty($_POST['asignatura']) && !empty($_POST['curso'])
				&& !empty($_POST['grupo']) && !empty($_POST['texto'])) {
				if(is_numeric($_POST['grupo'])) {	

					if($pisado->save()) {
					//	$data['verify'] = 'El registro del pisado se ha realizado con exito';
					//	$this->sendmail($pisado->nia);
					//	$destinatarios = User::findDestinatarios($pisado->curso, $pisado->id_titulacion);
					//	$this->sendmailPisado($destinatarios, $pisado);
						header('Location: /pisado/inicio'); die();
					} else {
						$data['error'] = 'Ha ocurrido un error con la base de datos, por favor pongase en contacto con el
						 administrador del sistema.';
					}
				} else {
					$data['error'] = 'El grupo debe ser un numero.';
				}
			} else {
				$data['error'] = 'Debes rellenar todos los campos.';
			}

			$this->render('create', $data);
		} else {
			$this->render('create', $data);
		}
	}

	function view() {
		$this->security();

		$id = (int) $_GET['id'];
		$pisado = Pisado::findById($id);
		$data = array();

		if ($pisado) {
			if (($pisado->nia == $_SESSION['user']->nia) || (($pisado->id_titulacion == $_SESSION['user']->id_titulacion) && $_SESSION['user']->isDelegadoCurso()) || ($_SESSION['user']->isDelegadoEscuela()) ) {//dentro de view hay que controlar que no muestre los datos.
				$comentarios = Comentario::findByIdpisado($id);
				$data['pisado'] = $pisado;
				$data['comments'] = $comentarios;

				$this->render('view', $data);
			} else {
				$this->render_error(401);
			}
		} else {
			$this->render_error(404);
		}
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
