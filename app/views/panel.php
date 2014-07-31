<h2>Mis pisados</h2>

<a href="pisado/create">Rellenar un PISADO</a>

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
	echo 'Aun no has rellenado ningún pisado...';
}
?>

</ul>

<?php

if ($user->isDelegado) { ?>

	<h2>Delegación</h2>

	<?php if ($user->isDelegadoCurso()) { echo '<p>Para ver el autor del PISADO has de contactar con el delegado de titulación</p>';} ?>

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
	} else {
		echo 'No controlas ningún PISADO...';
	}
	?>

	</ul>

<?php } else { ?>

	<h2>PISADOS de <?= $user->titulacion ?></h2>

	<p>Puedes suscribirte para recibir información del estado del PISADO</p>

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