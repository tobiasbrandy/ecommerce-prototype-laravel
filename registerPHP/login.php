<?php

require_once("funciones.php");

if (isLogged()) {
	enviarAlIndex(); //Enviar a la home.
}

if ($_POST) {
	$errores = validarLogin($_POST);

	if (empty($errores)) {

		$usuarioActivo = obtenerUsuarioPorMail($_POST["mail"]);
		loguearUsuario($usuarioActivo);

		if (isset($_POST["recordame"])) {

			setcookie("logueado", $usuarioActivo["id"], time() + 60 * 60 * 24 * 5);
		}

		enviarAIndex();  //Enviar a la home.
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
