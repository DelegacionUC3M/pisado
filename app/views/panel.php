<section id="panel" class="wrapper">

	<article class="pisados">
		<h2 class="clear">Mis PISADOS
			<a class="button icon-fill" href="pisado/create">Rellenar un PISADO</a>
		</h2>

		<ul id="pisados">
		<?php

		if (count($pisados) > 0) {
			foreach ($pisados as $pisado) {
				if (is_a($pisado,'Pisado')) {
					?>
						<a href="/pisado/pisado/view/<?= $pisado->id ?>"><li id="pisado">
								<p class="id-asignatura"><span class="id">#<?= $pisado->id ?></span> <?= $pisado->asignatura ?></p>
								<p class="titulacion"><?= $pisado->getNameTitulacion() ?> </p>
								<p class="curso-date"> <span class="curso">Curso <?= $pisado->curso.'º' ?></span> <span class="date icon-clock"> <?= date('j/m/y' ,strtotime($pisado->date)) ?></span> </p>
						</li></a>
					<?php
				} else {
					var_dump($pisado);
					die();
					?>
						<a href="/pisado/group/view/<?= $pisado->id ?>"><li id="group">
								<p class="id-asignatura"><span class="id">#G<?= $pisado->id ?></span> <?= $pisado->subject ?></p>
								<p class="titulacion"><?= $pisado->getNameTitulacion() ?> </p>
								<p class="curso-date"> <span class="curso">Curso <?= $pisado->curso.'º' ?></span> <span class="date icon-clock"> <?= date('j/m/y' ,strtotime($pisado->date)) ?></span> </p>
							</li></a>
					<?php
				}
			}
		} else {
			echo '<p class="info">Aun no has rellenado ningún pisado...</p>';
		}
		?>

		</ul>
	</article>

	<?php
	if ($user->isDelegado) { ?>

	<article class="pisados delegacion" id="delegacion">
			<h2 class="clear">Delegación
				<?php if ($user->isDelegadoTitulacion() || $user->isDelegadoCentro()) { ?>
					<a class="button icon-agroup" href="?" id="agrupar" data-active="false">Agrupar PISADOS</a>
					<a class="button icon-drawer" href="/pisado/inicio/archivo">Ver archivados</a>
				<?php } ?>
			</h2>

		<!--	<article id="filtros">
				<select name="titulacion" <?php echo $user->isDelegadoCentro() ? '' : 'disabled' ?> >
					<option value="0">Titulación</option>
					<?php
							foreach (DBDelegados::getTitulaciones() as $titulacion) {
								$selected = '';
								if (!$user->isDelegadoCentro() && $user->id_titulacion == $titulacion['id_titulacion']) {
									$selected = 'selected';
								}
								echo '<option '.$selected.' value="'.$titulacion['id_titulacion'].'">'.$titulacion['nombre'].'</option>';
							}
					?>
				</select><select name="curso" <?php echo ($user->isDelegadoCentro() && $user->isDelegadoTitulacion()) ? '' : 'disabled' ?>>
					<option>Curso</option>
					<option <?php if (!$user->isDelegadoCentro() && !$user->isDelegadoTitulacion() && $user->curso == '1') {echo 'selected';}?> value="1">1º</option>
					<option <?php if (!$user->isDelegadoCentro() && !$user->isDelegadoTitulacion() && $user->curso == '2') {echo 'selected';}?> value="2">2º</option>
					<option <?php if (!$user->isDelegadoCentro() && !$user->isDelegadoTitulacion() && $user->curso == '3') {echo 'selected';}?> value="3">3º</option>
					<option <?php if (!$user->isDelegadoCentro() && !$user->isDelegadoTitulacion() && $user->curso == '4') {echo 'selected';}?> value="4">4º</option>
				</select>
			</article> -->

			<?php if(isset($data['error']))  { ?>
				<p class="info error">
					<?= $data['error'] ?>
				</p>
			<?php } ?>

			<p class="info error hide">Has de seleccionar al menos dos PISADOS y solo se pueden agrupar PISADOs del mismo curso y titulación.</p>

			<ul id="pisados">
			<?php

			if (count($otros) > 0) {
				foreach ($otros as $pisado) {
					if (is_a($pisado,'Pisado')) {
						?>
							<a href="/pisado/pisado/view/<?= $pisado->id ?>"><li id="pisado" data-titulacion="<?= $pisado->id_titulacion ?>" data-curso="<?= $pisado->curso ?>" data-id="<?= $pisado->id ?>">
									<p class="id-asignatura"><span class="id">#<?= $pisado->id ?></span> <?= $pisado->asignatura ?></p>
									<p class="titulacion"><?= $pisado->getNameTitulacion() ?> </p>
									<p class="curso-date"> <span class="curso">Curso <?= $pisado->curso.'º' ?></span> <span class="date icon-clock"> <?= date('j/m/y' ,strtotime($pisado->date)) ?></span> </p>
							</li></a>
						<?php
					} else {
						?>
							<a href="/pisado/group/view/<?= $pisado->id ?>"><li id="group" data-titulacion="<?= $pisado->id_titulacion ?>" data-curso="<?= $pisado->curso ?>" data-id="<?= $pisado->id ?>">
									<p class="id-asignatura"><span class="id">#G<?= $pisado->id ?></span> <?= $pisado->subject ?></p>
									<p class="titulacion"><?= $pisado->getNameTitulacion() ?> </p>
									<p class="curso-date"> <span class="curso">Curso <?= $pisado->curso.'º' ?></span> <span class="date icon-clock"> <?= date('j/m/y' ,strtotime($pisado->date)) ?></span> </p>
							</li></a>
						<?php
					}
				}
			} else {
				echo '<p class="info">Aun no se ha rellenado ningún pisado...</p>';
			}
			?>

			</ul>
	</article>

	<?php } ?>

</section>
