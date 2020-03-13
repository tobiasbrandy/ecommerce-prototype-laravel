<?php

require_once("soporte.php");

if ($auth->estaLogueado())
{
	$user = $auth->getUsuarioLogueado();

	$avatarPath = $user->getAvatar();
}

 ?>
<html>
<head>
	<title>Mi Home</title>
</head>
<body>
	<h1>Bienvenido</h1>
	<ul>
		<?php if (!$auth->estaLogueado()) {?>
		<li>
			<a href="register.php">Registrate</a>
		</li>
		<li>
			<a href="login.php">Log In</a>
		</li>
		<?php } ?>
		<?php if ($auth->estaLogueado()) {?>
		<img src="<?php echo $avatarPath ?>"/>
		<li>
			<a href="editarUsuario.php">Editar Usuario</a>
		</li>
		<li>
			<a href="logout.php">Log Out</a>
		</li>
		<?php } ?>
	</ul>
</body>
</html>
