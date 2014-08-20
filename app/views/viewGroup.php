<section id="view" class="wrapper">

	<h2 class="clear">Grupo PISADO #G<?= $group->id ?>
			<a href="/pisado/">Volver a mis PISADO</a>
		</h2>

	<article id="dpersonales">
		<h3>PISADOs del grupo</h3>

		<ul>
			<li id="subject"> <span>Asunto</span> <?= $group->subject ?> </li><li id="n"> <span>Nº de PISADOs</span> <?= count($group->pisados) ?> </li>
			<li id="titulacion"> <span>Titulacion</span> <?= $group->getNameTitulacion() ?> </li><li id="curso"> <span>Curso</span> <?= $group->curso.'º' ?> </li>
		</ul>

	</article>

	<ul id="pisados">
		<?php
			foreach ($group->pisados as $pisado) {
				?>
					<a href="/pisado/pisado/view/<?= $pisado->id ?>"><li id="pisado">
							<p class="id-titulacion"><span class="id">#<?= $pisado->id ?></span><span class="titulacion"><?= $pisado->getNameTitulacion() ?></span> </p>
							<p class="asignatura"><?= $pisado->asignatura ?></p>
							<p class="curso"> <span>Curso</span> <?= $pisado->curso.'º' ?></p>
							<p class="date"> <span>Fecha</span> <?= date('j/m/y' ,strtotime($pisado->date)) ?></p>
						</li></a>
				<?php
			}
		?>
		</ul>

	<article id="comentarios" <?php if (count($comentarios) == 0) {echo 'class="no-print"';} ?> >
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
					} else if (!empty($comentario->nombre)) {
						$class .= 'delegacion ';
						$autor = $comentario->nombre;
					} else if ($user->isDelegadoEscuela() || $user->isDelegadoTitulacion()) {
						$autor = $comentario->nia;
					} else {
						$autor = 'Alumno #'.array_search($comentario->nia, $group->getOwners());
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

		</ul>

	</article>
</section>
