<section id="create">

	<h2 class="clear">Crear un PISADO
		<a href="/pisado/">Volver a mis PISADO</a>
	</h2>

	<?php if(isset($data['error']) || isset($data['verify']))  { ?>
	<article id="aviso">
		<?php if(isset($data['error'])) { ?>
			<span class="error"> <?php echo $data['error'] ?> </span>
		<?php } ?>
		<?php if(isset($data['verify'])) { ?>
			<span class="verify"> <?php echo $data['verify'] ?> </span>
		<?php } ?>
	</article>
	<?php } ?>

	<article id="dpersonales">
		<h3>Datos personales</h3>
	
		<ul>
			<li id="nombre"> <span>Nombre</span> <input type="text" value="<?= $user->name ?>" disabled/>  </li><li id="nia"><span>NIA</span> <input type="text" value="<?= $user->nia ?>" disabled/> </li>
			<li id="email"><span>Correo</span> <input type="text" value="<?= $user->email ?>" disabled/> </li>
		</ul>
		<p class="info">Estos datos se guardan como metodo de contacto unicamente y no serán accesibles por el profesor
			ni por el destinatario de esta queja, solo por el/los delegados encargados.</p>

	</article>

	<article id="informe">
		<h3>Informe del Alumno</h3>

		<form action="/pisado/pisado/create" method="POST">
			<ul>
				<li id="titulacion"> <span>Titulacion</span> <select name="titulacion" >
					<?php
						foreach ($titulaciones as $titulacion) {$selected = ''; if ($pisado->id_titulacion == $titulacion['id_titulacion']) {$selected = 'selected';} echo '<option '.$selected.' value="'.$titulacion['id_titulacion'].'">'.$titulacion['nombre'].'</option>';}
					?></select></li><li id="curso"> <span>Curso</span>
						<select name="curso">
							<option <?php if ($pisado->curso == '1') {echo 'selected';}?> value="1">1º</option>
							<option <?php if ($pisado->curso == '2') {echo 'selected';}?> value="2">2º</option>
							<option <?php if ($pisado->curso == '3') {echo 'selected';}?> value="3">3º</option>
							<option <?php if ($pisado->curso == '4') {echo 'selected';}?> value="4">4º</option>
						</select>
					 </li>
				<li id="asignatura"> <span>Asignatura</span> <input name="asignatura" value="<?= $pisado->asignatura ?>" type="text" maxlength="40"> </li><li id="grupo"> <span>Grupo</span> <input name="grupo" type="text" value="<?= $pisado->grupo ?>" maxlength="2"> </li>
				<li id="profesor"> <span>Profesor</span> <input name="profesor" value="<?= $pisado->profesor ?>" type="text" maxlength="40"> </li>

				<li id="texto"> <span>El alumno expone</span> <textarea name="texto" rows="10"><?= $pisado->texto ?></textarea> </li>
			</ul>

			<input type="submit" value="Enviar" />
		</form>
	</article>		

</section>