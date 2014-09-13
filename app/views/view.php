<section id="view" class="wrapper">

	<h2 class="clear">PISADO #<?= $pisado->id ?>
			<?php if ($pisado->id_group != 0) { ?>
				<a href="/pisado/group/view/<?= $pisado->id_group ?>" class="button icon-back">Volver al grupo</a>
			<?php } else { ?>
				<a href="/pisado/" class="button icon-back">Volver a mis PISADO</a>
			<?php } ?>
			<a href="#" id="print" class="button icon-print">Imprimir</a>
		</h2>

	<article id="dpersonales">
		<h3>Datos personales</h3>
	
		<?php if (($user->nia == $pisado->nia) || ($user->isDelegadoEscuela()) || ($user->isDelegadoTitulacion()) ) { ?>
		<ul>
			<li id="nombre" class="w60"> <span>Nombre</span> <?= $pisado->autor ?>  </li><li id="nia" class="w40"><span>NIA</span> <?= $pisado->nia ?></li>
			<li id="email" class="w60"><span>Correo</span> <?= $pisado->email ?></li>
		</ul>
		<p class="info">Estos datos se guardan como metodo de contacto unicamente y no serán accesibles por el profesor
			ni por el destinatario de esta queja, solo por los delegados encargados: <b><?= $delegado['nombre'] ?> (<a href="mailto:<?= $delegado['email'] ?>"><?= $delegado['email'] ?></a>)</b>.</p>
		<?php } else { ?>
			<p class="info">El PISADO es anónimo. Los datos personales solo son accesibles por el delegado encargado como metodo de contacto. Si necesitas más información ponte en contacto con <b><?= $delegado['nombre'] ?> (<a href="mailto:<?= $delegado['email'] ?>"><?= $delegado['email'] ?></a>)</b>. </p>
		<?php } ?>

	</article>

	<article id="informe">
		<h3>Informe del Alumno</h3>

		<ul>
			<li id="titulacion" class="w60"> <span>Titulacion</span> <?= $pisado->getNameTitulacion() ?> </li><li id="curso" class="w40"> <span>Curso</span> <?= $pisado->curso.'º' ?> </li>
			<li id="asignatura" class="w60"> <span>Asignatura</span> <?= $pisado->asignatura ?> </li><li id="grupo" class="w40"> <span>Grupo</span> <?= $pisado->grupo ?> </li>
			<li id="profesor" class="w60"> <span>Profesor</span> <?= $pisado->profesor ?> </li><li id="date" class="w40"> <span>Fecha</span> <?= date('j/m/y' ,strtotime($pisado->date)) ?> </li>

			<li id="texto"> <span>El alumno expone</span> <p><?= $pisado->texto ?></p> </li>
		</ul>
	</article>			

	<article id="comentarios" <?php if (count($comentarios) == 0) {echo 'class="no-print"';} ?> >
		<h3>Comentarios</h3>

		<?php if(isset($data['error']))  { ?>
			<p class="info error">
				<?= $data['error'] ?>
			</p>
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
						$autor = $comentario->nia;
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

				if ($pisado->id_group != 0) { 
			?>

				<p class="info">El PISADO pertenece a un grupo, solo puedes comentar en el grupo.</p>

			<?php } else { ?>
				<form action="?#comentarios" method="post">
					<li class="you compose clear">
						<div>
							<span class="autor">Escribe un comentario</span>
						</div>
						<textarea name="comment" placeholder="Escribe aquí..."></textarea>
						<input type="submit" value="Enviar" />
						
						<?php if ($user->isDelegado) { ?>
							<p class="info no-print">Los comentarios de los delegados NO son anónimos.</p>
						<?php } else { ?>
							<p class="info no-print">El autor del comentario es anónimo. Solo lo verá el delegado encargado.</p>
						<?php } ?>
					</li>
				</form>
			<?php } ?>

		</ul>

	</article>
</section>
