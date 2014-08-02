<section id="view">

	<h2 class="clear">Ver PISADO #<?= $pisado->id ?>
			<a href="/pisado/">Volver a mis PISADO</a>
			<a href="#" onclick="window.print()">Imprimir</a>
		</h2>

	<article id="dpersonales">
		<h3>Datos personales</h3>
	
		<?php if (($user->nia == $pisado->nia) || ($user->isDelegadoEscuela()) || ($user->isDelegadoTitulacion()) ) { ?>
		<ul>
			<li id="nombre"> <span>Nombre</span> <?= $pisado->autor ?>  </li><li id="nia"><span>NIA</span> <?= $pisado->nia ?></li>
			<li id="email"><span>Correo</span> <?= $pisado->email ?></li>
		</ul>
		<p class="info no-print">Estos datos se guardan como metodo de contacto unicamente y no serán accesibles por el profesor
			ni por el destinatario de esta queja, solo por el/los delegados encargados.</p>
		<?php } else { ?>
			<p class="info">El PISADO es anónimo. Los datos personales solo son accesibles por el delegado encargado como metodo de contacto. Si necesitas más información ponte en contacto con <b><?= $user->getDelegado()['nombre'] ?> (<a href="mailto:<?= $user->getDelegado()['email'] ?>"><?= $user->getDelegado()['email'] ?></a>)</b>. </p>
		<?php } ?>

	</article>

	<article id="informe">
		<h3>Informe del Alumno</h3>

		<ul>
			<li id="titulacion"> <span>Titulacion</span> <?= $pisado->getNameTitulacion() ?> </li><li id="curso"> <span>Curso</span> <?= $pisado->curso.'º' ?> </li>
			<li id="asignatura"> <span>Asignatura</span> <?= $pisado->asignatura ?> </li><li id="grupo"> <span>Grupo</span> <?= $pisado->grupo ?> </li>
			<li id="profesor"> <span>Profesor</span> <?= $pisado->profesor ?> </li><li id="date"> <span>Fecha</span> <?= date('j/m/y' ,strtotime($pisado->date)) ?> </li>

			<li id="texto"> <span>El alumno expone</span> <p><?= $pisado->texto ?></p> </li>
		</ul>
	</article>			

	<article id="comentarios">
		<h3>Comentarios</h3>


	</article>
</section>
