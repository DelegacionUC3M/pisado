<section id="view">

	<h2 class="clear">Ver PISADO #<?= $pisado->id ?>
			<a href="/pisado/">Volver a mis PISADO</a>
		</h2>

	<article id="dpersonales">
		<h3>Datos personales</h3>
	
		<?php if (($user->nia == $pisado->nia) || ($user->isDelegadoEscuela()) || ($user->isDelegadoTitulacion()) ) { ?>
		<ul>
			<li><b>NIA</b>: <?php echo $pisado->nia ?></li>
			<li><b>Correo</b>: <?php echo $pisado->email ?></li>
		</ul>
		<p class="info">Estos datos se guardan como metodo de contacto unicamente y no serán accesibles por el profesor
			ni por el destinatario de esta queja, solo por el/los delegados encargados.</p>
		<ul>
		<?php } else { ?>
			<p class="info">El PISADO es anónimo. Los datos personales solo son accesibles por el delegado encargado como metodo de contacto. Si necesitas más información ponte en contacto con <b><?= $user->getDelegado()['nombre'] ?> (<a href="mailto:<?= $user->getDelegado()['email'] ?>"><?= $user->getDelegado()['email'] ?></a>)</b> </p>
		<?php } ?>

	</article>

	<article id="informe">
		<h3>Informe del alumno</h3>

		<ul>
			<li><span class="titulacion"><b>Titulacion</b>: <?php echo $pisado->getNameTitulacion() ?></span>
				<span class="curso"><b>Curso</b>: <?php echo $pisado->getCourse() ?></span> </br>
			<li><span class="asignatura"><b>Asignatura</b>: <?php echo $pisado->asignatura ?></span>
				<span class="grupo"><b>Grupo</b>: <?php echo $pisado->grupo ?></span></li> </br>
			<li><span class="profesor"><b>Profesor</b>: <?php echo $pisado->profesor ?></span>
		</ul>

			El alumno expone:
			<p class="texto"><?php echo $pisado->texto ?></p>
	</article>			

	<article id="comentarios">
		<h3>Comentarios</h3>
	</article>
</section>
