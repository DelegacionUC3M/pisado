<section id="view">

	<h2 class="clear">PISADO #<?= $pisado->id ?>
			<a href="/pisado/">Volver a mis PISADO</a>
			<a href="#" id="print">Imprimir</a>
		</h2>

	<article id="dpersonales">
		<h3>Datos personales</h3>
	
		<?php if (($user->nia == $pisado->nia) || ($user->isDelegadoEscuela()) || ($user->isDelegadoTitulacion()) ) { ?>
		<ul>
			<li id="nombre"> <span>Nombre</span> <?= $pisado->autor ?>  </li><li id="nia"><span>NIA</span> <?= $pisado->nia ?></li>
			<li id="email"><span>Correo</span> <?= $pisado->email ?></li>
		</ul>
		<p class="info no-print">Estos datos se guardan como metodo de contacto unicamente y no serán accesibles por el profesor
			ni por el destinatario de esta queja, solo por el/los delegados encargados: <b><?= $user->getDelegado()['nombre'] ?> (<a href="mailto:<?= $user->getDelegado()['email'] ?>"><?= $user->getDelegado()['email'] ?></a>)</b>.</p>
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

		<?php if(isset($data['error']))  { ?>
			<article id="aviso">
				<span class="error"> <?= $data['error'] ?> </span>
			</article>
		<?php } ?>

		<ul id="comentarios">
			<?php

				foreach ($comentarios as $comentario) { 
					$class = '';
					if ($comentario->nia == $user->nia) {
						$class .= 'you ';
						$autor = 'Yo';
					} else if ($comentario->nia == $pisado->nia) {
						$class .= 'author ';
						$autor = 'Autor del PISADO';
					} else if (!empty($comentario->nombre)) {
						$class .= 'delegacion ';
						$autor = $comentario->nombre;
					} else if ($user->isDelegadoEscuela() || $user->isDelegadoTitulacion()) {
						$autor = $pisado->nia;
					} else {
						$autor = 'Alumno';
					}

				?> <li class="<?= $class ?>">
						<div>
							<span class="autor">
								<?= $autor ?>
							</span><span class="date"><?= date('j/m/y H:i' ,strtotime($comentario->date)) ?></span>
						</div>
						<p><?= $comentario->text ?></p>
					</li>
				<?php }
			?>

			<form action="?#comentarios" method="post">
				<li class="you compose clear">
					<div>
						<span class="author">Escribe un comentario</span>
					</div>
					<textarea name="comment" placeholder="Escribe aquí..."></textarea>
					<input type="submit" value="Enviar" />
				</li>
			</form>
		</ul>

	</article>
</section>
