<form action="?<?php if (isset($_GET['url'])) {echo 'url='.$_GET['url'];} ?>" method="post">
	<input type="text" name="nia" placeholder="Nia" />
	<input type="password" name="password" placeholder="Contraseña" />

	<p><?php echo isset($error) ? $error : '' ?></p>

	<input type="submit" />
</form>