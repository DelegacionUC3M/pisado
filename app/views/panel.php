<section id="panel">

	<article class="pisados">
		<h2 class="clear">Mis PISADOS
			<a href="pisado/create">Rellenar un PISADO</a>
		</h2>


		<ul id="pisados">
		<?php

		if (count($pisados) > 0) {
			foreach ($pisados as $pisado) {
				?>
					<a href="/pisado/pisado/view/<?= $pisado->id ?>"><li>
							<p class="id-titulacion"><span class="id">#<?= $pisado->id ?></span><span class="titulacion"><?= $pisado->getNameTitulacion() ?></span> </p>
							<p class="asignatura"><?= $pisado->asignatura ?></p>
							<p class="curso"> <span>Curso</span> <?= $pisado->curso.'º' ?></p>
							<p class="date"> <span>Fecha</span> <?= date('j/m/y' ,strtotime($pisado->date)) ?></p>
						</li></a>
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
			
			<ul id="pisados">
			<?php

			if (count($otros) > 0) {
				foreach ($otros as $pisado) {
					?>
						<a href="/pisado/pisado/view/<?= $pisado->id ?>"><li>
							<p class="id-titulacion"><span class="id">#<?= $pisado->id ?></span><span class="titulacion"><?= $pisado->getNameTitulacion() ?></span> </p>
							<p class="asignatura"><?= $pisado->asignatura ?></p>
							<p class="curso"> <span>Curso</span> <?= $pisado->curso.'º' ?></p>
							<p class="date"> <span>Fecha</span> <?= date('j/m/y' ,strtotime($pisado->date)) ?></p>
						</li></a>
					<?php
				}
			}
			?>

			</ul>

		<?php } ?>

	</article>

</section>