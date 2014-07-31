<?php

class Controller {
	
	public function security($redirect = true) {

		if (isset($_SESSION['user']) && isset($_SESSION['user']->nia) && !empty($_SESSION['user']->nia)) {
			return true;
		}

		if ($redirect) {
			header('Location: /pisado/inicio/login?url='.urlencode($_SERVER['REQUEST_URI']));
		}

		return false;
	}

	public function render($view, $data = array()) {
		if(!empty($data)) {
			extract($data);
		}

		$title = isset($title) ? $title : 'PISADO - Delegación UC3M';
		$user = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;

		include ABSPATH . 'app/views/header.php';
		include ABSPATH . 'app/views/' . $view . '.php';
		include ABSPATH . 'app/views/footer.php';
	}

	public function sendmail($destinatario) {
		$titulo = 'Confirmacion de envio de P.I.S.A.D.O.';
		$cuerpo = '<html><body>
		<p style="font-size: 1.5em;">Su solicitud de P.I.S.A.D.O. se ha realizado con &eacute;xito</p>

		<p>Si desea ver su pisado de nuevo est&aacute; disponible desde la aplicacion de P.I.S.A.D.O. en
		 <a href="https://delegacion.uc3m.es/pisado/">https://delegacion.uc3m.es/pisado/</a>, en el apartado "Mis pisados".
		</p>
		
		<p>Este correo se ha generado automaticamente, por favor no lo respondas. Si deseas ponerte en contacto con 
		nosotros no dudes en mandar un correo a <a href="mailto:delegest@gmail.com" target="_blank">delegest@gmail.com</a>.
		</p>
	   	</body>
	    </html>';
	    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
	    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	    $cabeceras .= 'From: delegest@gmail.com' . "\r\n" . 
	      	'Reply-To: delegest@gmail.com' . "\r\n";

		mail($destinatario, $titulo, $cuerpo, $cabeceras);
	}

	public function sendmailComentario($destinatarios, $pisado) {
		$titulo = '¡Tienes un nuevo comentario en un P.I.S.A.D.O.';
		$cuerpo = '<html><body>
		<p style="font-size: 1.5em;">Tienes un comentario sin leer en uno de tus pisados. Revisa cuando puedas la aplicacion
		 para ver de que se trata. Los datos del pisado en el cual se ha comentado se muestran a continuacion:</p>

		<h>P.I.S.A.D.O.</h>
		<ol>
			<li><b>Titulacion</b>: '.$pisado->getNameTitulacion().'</li>
			<li><b>Asignatura</b>: '.$pisado->asignatura.'</li>
  			<li><b>Curso</b>: '.$pisado->curso.'</li>
  			<li><b>Grupo</b>: '.$pisado->grupo.'</li>
		</ol>

		<p>Si desea ver el pisado ahora mismo est&aacute; disponible en
		 <a href="https://delegacion.uc3m.es/pisado/pisado/view/'.$pisado->id.'">P.I.S.A.D.O.</a>
		, en el apartado "Mis pisados".
		</p>
		
		<p>Este correo se ha generado automaticamente, por favor no lo respondas. Si deseas ponerte en contacto con 
		nosotros no dudes en mandar un correo a <a href="mailto:delegest@gmail.com" target="_blank">delegest@gmail.com</a>.
		</p>
	   	</body>
	    </html>';
	    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
	    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	    $cabeceras .= 'From: delegest@gmail.com' . "\r\n" . 
	      	'Reply-To: delegest@gmail.com' . "\r\n";
	    $destinatario = '';
	    foreach ($destinatarios as $mail) {
	    	if($mail==end($destinatarios)) {
	    		$destinatario .= $mail;
	    	} else {
	    		$destinatario .= $mail.', ';
	    	}
	    }

		mail($destinatario, $titulo, $cuerpo, $cabeceras);
	}

	public function sendmailPisado($destinatarios, $pisado) {
		$titulo = '¡Hay un nuevo P.I.S.A.D.O. para ti';
		$cuerpo = '<html><body>
		<p style="font-size: 1.5em;">Tienes un P.I.S.A.D.O. sin leer. Revisa cuando puedas la aplicacion para ver de que se
		 trata. Los datos previos del pisado se muestran a continuacion:</p>

		<h>P.I.S.A.D.O.</h>
		<ol>
			<li><b>Titulacion</b>: '.$pisado->getNameTitulacion().'</li>
			<li><b>Asignatura</b>: '.$pisado->asignatura.'</li>
  			<li><b>Curso</b>: '.$pisado->curso.'</li>
  			<li><b>Grupo</b>: '.$pisado->grupo.'</li>
		</ol>

		<p>Si desea ver el pisado ahora mismo est&aacute; disponible en
		 <a href="https://delegacion.uc3m.es/pisado/pisado/view/'.$pisado->id.'">P.I.S.A.D.O.</a>
		, en el apartado "Mis pisados".
		</p>
		
		<p>Este correo se ha generado automaticamente, por favor no lo respondas. Si deseas ponerte en contacto con 
		nosotros no dudes en mandar un correo a <a href="mailto:delegest@gmail.com" target="_blank">delegest@gmail.com</a>.
		</p>
	   	</body>
	    </html>';
	    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
	    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	    $cabeceras .= 'From: delegest@gmail.com' . "\r\n" . 
	      	'Reply-To: delegest@gmail.com' . "\r\n";
	    $destinatario = '';
	    foreach ($destinatarios as $mail) {
	    	if($mail==end($destinatarios)) {
	    		$destinatario .= $mail;
	    	} else {
	    		$destinatario .= $mail.', ';
	    	}
	    }

		mail($destinatario, $titulo, $cuerpo, $cabeceras);
	}

}
