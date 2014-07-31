<section id="panel">

	<article class="pisados">
		<h2 class="clear">Mis PISADOS
			<a href="pisado/create" id="rellenar">Rellenar un PISADO</a>
		</h2>


		<ul>
		<?php

		if (count($pisados) > 0) {
			foreach ($pisados as $pisado) {
				?>
					<li>
						<p><?= $pisado->getNameTitulacion() ?></p>
						<p><?= $pisado->asignatura ?></p>
						<p><?= $pisado->curso ?></p><p><?= $pisado->grupo ?></p>
						<p><?= $pisado->date ?></p>
					</li>
				<?php
			}
		} else {
			echo '<p class="info">Aun no has rellenado ningún pisado...</p>';
		}
		?>

		</ul>
	</article>

	<article class="pisados">
		<?php

		if ($user->isDelegado) { ?>

			<h2>Delegación</h2>

			<?php if ($user->isDelegadoCurso()) { echo '<p class="info">Para ver el autor del PISADO has de contactar con el delegado de titulación</p>';} ?>

			<ul>
			<?php

			if (count($otros) > 0) {
				foreach ($otros as $pisado) {
					?>
						<li>
							<p><?= $pisado->getNameTitulacion() ?></p>
							<p><?= $pisado->asignatura ?></p>
							<p><?= $pisado->curso ?></p><p><?= $pisado->grupo ?></p>
							<p><?= $pisado->date ?></p>
						</li>
					<?php
				}
			}
			?>

			</ul>

		<?php } else { ?>

			<h2>PISADOS de <?= $user->titulacion ?></h2>

			<p class="info">Puedes suscribirte a un PISADO para recibir información</p>

			<ul>
			<?php

			if (count($otros) > 0) {
				foreach ($otros as $pisado) {
					?>
						<li>
							<p><?= $pisado->getNameTitulacion() ?></p>
							<p><?= $pisado->asignatura ?></p>
							<p><?= $pisado->curso ?></p><p><?= $pisado->grupo ?></p>
							<p><?= $pisado->date ?></p>
						</li>
					<?php
				}
			}
			?>

			</ul>

		<?php } ?>
	</article>

</section>