<html>
	<body>
		<p class="first">Tienes un P.I.S.A.D.O. sin leer. Revisa cuando puedas la aplicacion para ver de que se
		 trata. Los datos previos del pisado se muestran a continuacion:</p>

		<h>P.I.S.A.D.O.</h>
		<ol>
			<li><b>Titulacion</b>: '.$pisado->getNameTitulacion().'</li>
			<li><b>Asignatura</b>: '.$pisado->asignatura.'</li>
  			<li><b>Curso</b>: '.$pisado->curso.'</li>
  			<li><b>Grupo</b>: '.$pisado->grupo.'</li>
		</ol>

		<p>Si desea ver el pisado ahora mismo est&aacute; disponible en
		 <a href="https://delegacion.uc3m.es/pisado/pisado/view/<?php echo $pisado->id ?>">P.I.S.A.D.O.</a>
		, en el apartado "Mis pisados".
		</p>
		
		<p>Este correo se ha generado automaticamente, por favor no lo respondas. Si deseas ponerte en contacto con 
		nosotros no dudes en mandar un correo a <a href="mailto:delegest@gmail.com" target="_blank">delegest@gmail.com</a>.
		</p>
   	</body>
</html>