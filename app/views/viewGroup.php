<section id="view" class="wrapper">

	<h2 class="clear">Grupo PISADO #G<?= $group->id ?>
			<a href="/pisado/" class="button icon-back">Volver a mis PISADO</a>
		</h2>

	<article id="dpersonales">
		<ul>
			<li id="subject" class="w60"> <span>Asunto</span> <?= $group->subject ?> </li><li id="n" class="w40"> <span>Nº de PISADOs</span> <?= count($group->pisados) ?> </li>
			<li id="titulacion" class="w60"> <span>Titulacion</span> <?= $group->getNameTitulacion() ?> </li><li id="curso" class="w40"> <span>Curso</span> <?= $group->curso.'º' ?> </li>
		</ul>

	</article>

	<ul id="pisados">
		<?php
			foreach ($group->pisados as $pisado) {
				?>
					<a href="/pisado/pisado/view/<?= $pisado->id ?>"><li id="pisado">	
						<p class="id-asignatura"><span class="id">#<?= $pisado->id ?></span> <?= $pisado->asignatura ?></p>
						<p class="titulacion"><?= $pisado->getNameTitulacion() ?> </p>
						<p class="curso-date"> <span class="curso">Curso <?= $pisado->curso.'º' ?></span> <span class="date icon-clock"> <?= date('j/m/y' ,strtotime($pisado->date)) ?></span> </p>
					</li></a>
				<?php
			}
		?>
		</ul>

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
					} else if (!empty($comentario->nombre)) {
						$class .= 'delegacion ';
						$autor = $comentario->nombre;
					} else if ($user->isDelegadoCentro() || $user->isDelegadoTitulacion()) {
						$autor = $comentario->nia;
					} else {
						$autor = 'Alumno #'.array_search($comentario->nia, $group->getOwners());
					}

				?> <li class="<?= $class ?>">
						<div class="author">
							<span class="autor">
								<?= $autor ?>
							</span><span class="date icon-clock"> <?= date('j/m/y H:i' ,strtotime($comentario->date)) ?></span>
						</div>
						<p><?= $comentario->text ?></p>
					</li>
				<?php }
			?>

			<form action="?#comentarios" method="post">
				<li class="compose clear">
					<textarea name="comment" placeholder="Escribe aquí..."></textarea>

					<div>
						<?php if ($user->isDelegado) { ?>
							<p>Los comentarios de los delegados NO son anónimos.</p>
						<?php } else { ?>
							<p>El autor del comentario es anónimo. Solo lo verá el delegado encargado.</p>
						<?php } ?>
						<button type="submit" class="icon-comment">Comentar</button>
					</div>
				</li>
			</form>

		</ul>

	</article>
</section>
