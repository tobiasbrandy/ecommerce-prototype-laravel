<?php

	require_once("funciones.php");
	/*if (isLogged()) {
		Enviar a la home.
	}*/

 ?>
<html>
<head>
	<title>Mi Home</title>
</head>
<body>
	<h1>Bienvenido</h1>
	<img src='<?php echo getAvatarById(14) ?>'/>
	<ul>
		<?php if (!isLogged()) {?>
		<li>
			<a href="register.php">Registrate</a>
		</li>
		<li>
			<a href="login.php">Log In</a>
		</li>
		<?php } ?>
		<?php if (isLogged()) {?>
		<li>
			<a href="logout.php">Log Out</a>
		</li>
		<?php } ?>
	</ul>
</body>
</html>
