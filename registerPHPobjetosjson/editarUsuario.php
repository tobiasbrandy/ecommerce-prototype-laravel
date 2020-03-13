<?php

require_once("soporte.php");

if (!$auth->estaLogueado()) {
	header("location:index.php");exit;
}

$usuarioActivo = $auth->getUsuarioLogueado();

$nombre = $usuarioActivo->getNombre();
$apellido = $usuarioActivo->getApellido();
$mail = $usuarioActivo->getMail();
$sexo = $usuarioActivo->getSexo();


if ($_POST) {
	//Validar
	$errores = $validar->validarEditarUsuario($_POST, $usuarioActivo);

	if (empty($errores)) {

		$usuarioActivo->setNombre($_POST["nombre"]);
		$usuarioActivo->setApellido($_POST["apellido"]);
		$usuarioActivo->setSexo($_POST["sexo"]);

		if (!$_POST["pass"] == "") {
			$usuarioEditado->setPassword($_POST["pass"]);
		}

		$repositorio->getUserRepository()->actualizarUsuario($usuarioActivo);


		if (is_uploaded_file($_FILES["avatar"]["tmp_name"])) {
			$usuarioActivo->guardarImagen();
		}

		header("location:editarUsuario.php");exit;
	}
}
?>


<html>
	<head>
		<title>EditarUsuario</title>
	</head>
	<body>

    <a href="index.php">Volver a Index</a>

    <h1>Perfil</h1>
    <ul>
      <li>
        Nombre: <?php echo $nombre; ?>
      </li>
      <li>
        Apellido: <?php echo $apellido; ?>
      </li>
      <li>
        Mail: <?php echo $mail; ?>
      </li>
      <li>
        Sexo: <?php echo $sexo == 'm' ? "Masculino" : 'Femenino' ?>
      </li>
    </ul>
    <img src="<?php echo $usuarioActivo->getAvatar() ?>" />


		<h1>Edicion de Usuario</h1>
		<form action="editarUsuario.php" method="POST" enctype="multipart/form-data">
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
				<label for="nombre">Nombre:</label>
				<input id="nombre" type="text" name="nombre" value="<?php echo $nombre ?>"></input>
			</div>
			<div>
				<label for="apellido">Apellido:</label>
				<input id="apellido" type="text" name="apellido" value="<?php echo $apellido ?>"></input>
			</div>
			<div>
				<label for="mail">Mail:</label>
				<input id="mail" type="text" name="mail" placeholder="No Editable" value="<?php echo $mail ?>"></input>
			</div>
      <div>
        <label for="oldpass">Antigua Contrase&ntilde;a:</label>
        <input id="oldpass" type="password" name="oldpass"></input>
      </div>
			<div>
				<label for="pass">Nueva Contrase&ntilde;a:</label>
				<input id="pass" type="password" name="pass" placeholder="No es obligatorio"></input>
			</div>
			<div>
				<label for="cpass">Confirmar Contrase&ntilde;a:</label>
				<input id="cpass" type="password" name="cpass" placeholder="No es obligatorio"></input>
			</div>
			<div>
				<label for="masculino">Masculino:</label>
				<input type="radio" name="sexo" value="m" id="masculino" <?php echo $sexo == 'm' ? "checked='checked'" : '' ?> />
				<label for="femenino">Femenino:</label>
				<input type="radio" name="sexo" value="f" id="femenino" <?php echo $sexo == 'f' ? "checked='checked'" : '' ?> />
			</div>
			<div>
				<label for="avatar">Subir Avatar:</label>
				<input id="avatar" type="file" name="avatar" value=""></input>
			</div>
			<div>
				<input id="submit" type="submit" name="submit" value="Enviar"></input>
			</div>
		</form>
	</body>
</html>
