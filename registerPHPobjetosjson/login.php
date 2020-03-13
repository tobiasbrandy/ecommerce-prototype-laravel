<?php

require_once("soporte.php");

if ($auth->estaLogueado())
{
	header("location:index.php");exit;
}

if ($_POST) {
	$errores = $validar->validarLogin();

	if (empty($errores)) {

		$usuarioActivo = $repositorio->getUserRepository()->getUsuarioByMail($_POST["mail"]);
		$auth->loguear($usuarioActivo);

		if (isset($_POST["recordame"])) {

			setcookie("logueado", $usuarioActivo->getId(), time() + 60 * 60 * 24 * 5);
		}

		header("location:index.php");exit;  //Enviar a la home.
	}
}


 ?>
<html>
	<head>
		<title>Login</title>
	</head>
	<body>
		<h1>Login!</h1>
		<form action="login.php" method="POST">
			<?php if (!empty($errores)) {?>
				<div>
					<ul>
						<?php foreach ($errores as $error) { ?>
								<li><?php echo $error ?></li>
							<?php } ?>
					</ul>
				</div>
			<?php } ?>
			<div>
				<label for="mail">Mail:</label>
				<input id="mail" type="text" name="mail"></input>
			</div>
			<div>
				<label for="pass">Contrase&ntilde;a:</label>
				<input id="pass" type="password" name="pass"></input>
			</div>
			<div>
				Recordame
				<input type="checkbox" name="recordame"></input>
			</div>
			<div>
				<input id="submit" type="submit" name="submit" value="Enviar"></input>
			</div>
		</form>
	</body>
</html>
