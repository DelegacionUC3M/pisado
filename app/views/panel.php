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

	<h2>PISADOS que controlas</h2>

	<?php if ($user->isDelegadoCurso()) { echo '<p>Para ver el autor del PISADO has de contactar con el delegado de titulación</p>';} ?>

	<ul>
	<?php

	if (count($delegacion) > 0) {
		foreach ($delegacion as $pisado) {
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

<?php } ?>