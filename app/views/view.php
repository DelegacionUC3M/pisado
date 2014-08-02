<section id="view">

	<h2>PISADO#<?= $pisado->id ?></h2>

	<article class="vpisado">
		<h2 class="clear">Revisa un PISADO
			<a href="/pisado/" id="return">Volver a mis PISADO</a>
		</h2>

		<?php if(isset($data['error']))  { ?>
		<article id="aviso">
			<span class="error"> <?php echo $data['error'] ?> </span>
		</article>
		<?php } else {?>
	
		<?php if(($user->nia == $pisado->nia) || ($user->isDelegadoEscuela())) { ?>
		<ul>
			<h1>Datos personales</h1>
			<li><b>NIA</b>: <?php echo $pisado->nia ?></li>
			<li><b>Correo</b>: <?php echo $pisado->email ?></li>
		</ul>
		<p class="info">Estos datos se guardan como metodo de contacto unicamente y no serán accesibles por el profesor
			ni por el destinatario de esta queja, solo por el/los delegados encargados.</p>
		
		<p class="br">-------------------------------------------------------------------------------------------------</p>
		<?php } ?>

		<ul>
			<h1>Informe del alumno</h1>
			<li><span class="titulacion"><b>Titulacion</b>: <?php echo $pisado->getNameTitulacion() ?></span>
				<span class="curso"><b>Curso</b>: <?php echo $pisado->getCourse() ?></span> </br>
			<li><span class="asignatura"><b>Asignatura</b>: <?php echo $pisado->asignatura ?></span>
				<span class="grupo"><b>Grupo</b>: <?php echo $pisado->grupo ?></span></li> </br>
			<li><span class="profesor"><b>Profesor</b>: <?php echo $pisado->profesor ?></span>
				</br>
			El alumno expone:
			<p class="texto"><?php echo $pisado->texto ?></p>
		</ul>

		<p class="br">-------------------------------------------------------------------------------------------------</p>

		<ul>
			<h1>Comentarios</h1>
		</ul>

		<?php } ?>
	</article>
</section>
