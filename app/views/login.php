<section id="login">
	<h2>Entrar a PISADO</h2>
	<p>Está intentando acceder a un área protegida. Introduzca su usuario y contraseña y pulse Entrar.</p>
	<form action="?<?php if (isset($_GET['url'])) {echo 'url='.$_GET['url'];} ?>" method="post">
		
		<p><label for="nia">Usuario:</label>
				<input type="text" name="nia" id="nia" placeholder="Usuario" /></p>
		
		<p><label for="password">Contraseña:</label>
				<input type="password" id="password" name="password" placeholder="Contraseña" /></p>

		<p><?php echo isset($error) ? $error : '' ?></p>

		<input type="submit" value="Entrar" />
	</form>

</section>