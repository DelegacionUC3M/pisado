<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        
        <link rel="stylesheet" href="/pisado/assets/css/main.css">
    </head>
	<body>
		<p class="first">Tienes un comentario sin leer en uno de tus pisados. Revisa cuando puedas la aplicacion
		 para ver de que se trata. Los datos del pisado en el cual se ha comentado se muestran a continuacion:</p>

		<h>P.I.S.A.D.O.</h>
		<ul>
			<li><b>Titulacion</b>: <?php echo $pisado->getNameTitulacion() ?></li>
			<li><b>Asignatura</b>: <?php echo $pisado->asignatura ?></li>
  			<li><b>Curso</b>: <?php echo $pisado->curso ?>º</li>
  			<li><b>Grupo</b>: <?php echo $pisado->grupo ?></li>
		</ul>

		<p>Si desea ver el pisado ahora mismo est&aacute; disponible en
		 <a href="https://delegacion.uc3m.es/pisado/pisado/view/<?php echo $pisado->id ?>">P.I.S.A.D.O.</a>
		, en el apartado "Mis pisados".
		</p>
		
		<p>Este correo se ha generado automaticamente, por favor no lo respondas. Si deseas ponerte en contacto con 
		nosotros no dudes en mandar un correo a <a href="mailto:delegest@gmail.com" target="_blank">delegest@gmail.com</a>.
		</p>
   	</body>
</html>