<section id="create" class="wrapper">

	<h2 class="clear">Crear un PISADO
		<a href="/pisado/" class="button icon-back">Volver a mis PISADO</a>
	</h2>

	<?php if(isset($data['error']))  { ?>
		<p class="info error">
			<?= $data['error'] ?>
		</p>
	<?php } ?>

	<article id="dpersonales">
		<h3>Datos personales</h3>
	
		<ul>
			<li id="nombre" class="w60"> <span>Nombre</span> <input type="text" value="<?= $user->name ?>" disabled/>  </li><li id="nia" class="w40"><span>NIA</span> <input type="text" value="<?= $user->nia ?>" disabled/> </li>
			<li id="email"><span>Correo</span> <input type="text" value="<?= $user->email ?>" disabled/> </li>
		</ul>
		<p class="info">Estos datos se guardan como metodo de contacto unicamente y no serán accesibles por el profesor
			ni por el destinatario de esta queja, solo por los delegados encargados.</p>

	</article>

	<article id="informe">
		<h3>Informe del Alumno</h3>

		<form action="/pisado/pisado/create" method="POST">
			<ul>
				<li id="titulacion" class="w60"> <span>Titulacion</span> <select name="titulacion" >
					<?php
						foreach ($titulaciones as $titulacion) {
                            $selected = '';

                            if ($pisado->id_titulacion == $titulacion['id_study']) {
                                $selected = 'selected';
                            }

                            $option = '<option ' . $selected . ' value="' . $titulacion['id_study'] . '">' . $titulacion['name'];
                            
                            if ($titulacion['id_study'] == INF_LEGA_ID) {
                                $option .= ' (Leganes)';
                            } else if ($titulacion['id_study'] == INF_COLME_ID) {
                                $option .= ' (Colmenarejo)';
                            }

                            $option .= '</option>';

                            echo $option;
                        }
					?></select></li><li id="curso" class="w40"> <span>Curso</span>
						<select name="curso">
							<option <?php if ($pisado->curso == '1') {echo 'selected';}?> value="1">1º</option>
							<option <?php if ($pisado->curso == '2') {echo 'selected';}?> value="2">2º</option>
							<option <?php if ($pisado->curso == '3') {echo 'selected';}?> value="3">3º</option>
							<option <?php if ($pisado->curso == '4') {echo 'selected';}?> value="4">4º</option>
						</select>
					 </li>
				<li id="asignatura" class="w60"> <span>Asignatura</span> <input name="asignatura" value="<?= $pisado->asignatura ?>" type="text" maxlength="40"> </li><li id="grupo" class="w40"> <span>Grupo</span> <input name="grupo" type="text" value="<?= $pisado->grupo ?>" maxlength="2"> </li>
				<li id="profesor" class="w60"> <span>Profesor</span> <input name="profesor" value="<?= $pisado->profesor ?>" type="text" maxlength="40"> </li>

				<li id="texto" class="w60"> <span>El alumno expone</span> <textarea name="texto" rows="10"><?= $pisado->texto ?></textarea> </li>
			</ul>

			<button type="submit" class="icon-fill">Enviar PISADO</button>
		</form>
	</article>		

</section>
