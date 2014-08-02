<section id="create">
	<article class="cpisado">
		<h2 class="clear">Crea un PISADO
			<a href="/pisado/" id="return">Volver a mis PISADO</a>
		</h2>

		<?php if(isset($data['error']) || isset($data['verify']))  { ?>
		<article id="aviso">
			<?php if(isset($data['error'])) { ?>
				<span class="error"> <?php echo $data['error']; ?> </span>
			<?php } ?>
			<?php if(isset($data['verify'])) { ?>
				<span class="verify"> <?php echo $data['verify']; ?> </span>
			<?php } ?>
		</article>
		<?php } ?>
	

		<ul>
			<h1>Datos personales</h1>
			<li><b>NIA</b>: <?php echo $_SESSION['user']->nia ?></li>
			<li><b>Correo</b>: <?php echo $_SESSION['user']->email ?></li>
		</ul>
		<p class="info">Estos datos se guardan como metodo de contacto unicamente y no serán accesibles por el profesor
			ni por el destinatario de esta queja, solo por el/los delegados encargados.</p>
		
		<p class="br">-------------------------------------------------------------------------------------------------</p>
		
		<form action="/pisado/pisado/create" method="POST">
			<ul>
				<h1>Informe del alumno</h1>
				<li><span class="titulacion"><b>Titulacion</b>: 
						<select name="titulacion">
							<option value="1">Grado en Ingenieria Informatica</option>
							<option value="1">Grado en Ingenieria Biomedica</option>
						</select>
					</span>
					<span class="curso"><b>Curso</b>: 
						<select name="curso">
							<option value="1">1º</option>
							<option value="2">2º</option>
							<option value="3">3º</option>
							<option value="4">4º</option>
						</select></li>
					</span> </br>
				<li><span class="asignatura"><b>Asignatura</b>: </span><input name="asignatura" type="text" maxlength="40">
					<span class="grupo"><b>Grupo</b>: </span><input name="grupo" type="text" maxlength="2"></li> </br>
				<li><span class="profesor"><b>Profesor</b>: </span><input name="profesor" type="text" maxlength="40"></li>
					</br>
				El alumno expone:
				<textarea name="texto" rows="10" cols="100"></textarea>

				<input id="submit" type="submit">
			</ul>
		</form>
	</article>
</section>