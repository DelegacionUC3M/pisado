<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        
        <link rel="stylesheet" href="/pisado/assets/css/main.css">
    </head>
	<body>
		<p class="first">Tienes un comentario sin leer en uno de tus grupos de PISADOs. Revisa cuando puedas la aplicacion
		 para ver de que se trata. Los datos del grupo en el cual se ha comentado se muestran a continuacion:</p>

		<h>PISADO</h>
		<ul>
			<li><b>Titulacion</b> <?php echo $group->getNameTitulacion() ?></li>
			<li><b>Asignatura</b> <?php echo $group->subject ?></li>
  			<li><b>Curso</b> <?php echo $group->curso ?>º</li>
  			<li><b>Nº de PISADOs</b> <?php count($group->pisados) ?></li>
		</ul>

		<p>Si desea ver el pisado ahora mismo est&aacute; disponible en
		 <a href="https://delegacion.uc3m.es/pisado/group/view/<?php echo $group->id ?>">PISADOs</a>.
		</p>
		
		<p>Este correo se ha generado automaticamente, por favor no lo respondas. Si deseas ponerte en contacto con 
		nosotros no dudes en mandar un correo a <a href="mailto:delegest@gmail.com" target="_blank">delegest@gmail.com</a>.
		</p>
   	</body>
</html>