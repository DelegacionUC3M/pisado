	<div class="wrapper">
		<h2>Entrar a PISADO</h2>
		<p>Está intentando acceder a un área protegida. </br> Introduzca su usuario y contraseña:</p>

		<!--<p class="error"><?php echo isset($error) ? $error : '' ?></p>-->
		
		<!--<form class="<?php echo isset($error) ? 'error' : '' ?>" action="?<?php if (isset($_GET['url'])) {echo 'url='.$_GET['url'];} ?>" method="post">
			<input type="text" name="nia" id="nia" placeholder="NIA" />
			<input type="password" id="password" name="password" placeholder="Contraseña" />

			<button type="submit" value="Entrar">Entrar</button>
		</form>-->

		<?php if (!empty($error)) { ?>
			<p class="error"> <?php echo $error; ?> </p>
		<?php } ?>
	
		<form class="<?php echo isset ($error) ? 'error' : '' ?>" method="post">
			<input type="text" name="nia" id="nia" placeholder="NIA" />
			<input type="password" id="password" name="password" placeholder="Contraseña" />

			<button type="submit" value="Entrar">Entrar</button>
		</form>

	</div>