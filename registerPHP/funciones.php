<?php
session_start();

loguearCookie();

function enviarAIndex(){
  header("location:index.php");
  exit;
}

function validarUsuario($miUsuario){

  $errores = [];

  if (trim($miUsuario["nombre"]) == "") {
    $errores[] = "Ingresar un nombre.";
  }

  if (trim($miUsuario["apellido"]) == "") {
    $errores[] = "Ingresar un apellido.";
  }

  if (trim($miUsuario["mail"]) == "") {
    $errores[] = "Ingresar un mail.";
  }

  if (trim($miUsuario["pass"]) == "") {
    $errores[] = "Ingresar una contrasena.";
  }

  if (!isset($miUsuario["sexo"])) {
    $errores[] = "Seleccionar un sexo.";
  }

  if ($miUsuario["pass"] != $miUsuario["cpass"]) {
    $errores[] = "Las contrasenas ingresadas son distintas.";
  }

  if (!filter_var($miUsuario["mail"], FILTER_VALIDATE_EMAIL)) {
    $errores[] = "Ingresar un mail valido.";
  }

  if (existeMail($miUsuario["mail"])) {
    $errores[] = "El mail ingresado ya existe.";
  }

  if (is_uploaded_file($_FILES["avatar"]["tmp_name"])) {
    if ($_FILES["avatar"]["error"] != 0) {
      $errores[] = "Hubo un problema al subir el avatar.";
    }
  }

  return $errores;
}

function validarLogin($miUsuario){
  $errores = [];

  if (trim($miUsuario["mail"]) == "") {
    $errores[] = "Ingresar un mail.";
  } elseif (!existeMail($miUsuario["mail"])) {
    $errores[] = "Mail ingresado no existe";
  } elseif (!validacionPass($miUsuario["mail"], $miUsuario["pass"])) {
    $errores[] = "El usuario y la contrasena no coinciden.";
  }

  if (trim($miUsuario["pass"]) == "") {
    $errores[] = "Ingresar una contrasena.";
  }
  return $errores;
}

function existeMail($mail){

  if (file_exists("usuarios.json") && filesize("usuarios.json") != 0) {

    $arrayUsuarios = obtenerUsuarios();

    foreach ($arrayUsuarios as $value) {

      $usuarios = json_decode($value, true);

      if ($mail == $usuarios["mail"]) {
        return true;
      }
    }
  }
  return false;
}

function obtenerUsuarios(){
  $usuariosJson = file_get_contents("usuarios.json");

  $arrayUsuarios = explode(PHP_EOL, $usuariosJson);

  array_pop($arrayUsuarios);

  return $arrayUsuarios;
}

function guardarUsuario($miUsuario){
  $usuarioJson = json_encode($miUsuario);

  file_put_contents("usuarios.json", $usuarioJson . PHP_EOL, FILE_APPEND);
}

function crearUsuario($miUsuario){
  $usuario = [
    "nombre" => $miUsuario["nombre"],
    "apellido" => $miUsuario["apellido"],
    "mail" => $miUsuario["mail"],
    "pass" => password_hash($miUsuario["pass"], PASSWORD_DEFAULT),
    "sexo" => $miUsuario["sexo"],
    "id" => obtenerIdNuevo()
  ];

  return $usuario;
}

function validacionPass($mail, $pass){
  $usuario = obtenerUsuarioPorMail($mail);

  if (password_verify($pass, $usuario["pass"])) {
    return true;
  }
  return false;
}

function guardarImagen($usuario){

  if (!is_dir(dirname(__FILE__) . "/img/")) {

    mkdir(dirname(__FILE__) . "/img/", 0777);
  }
  $path = dirname(__FILE__) . "/img/" . $usuario["id"] . "/";
  mkdir($path, 0777);

  $ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);

  move_uploaded_file($_FILES["avatar"]["tmp_name"], $path . "avatar." . $ext);

}

function obtenerIdNuevo(){
  if (!file_exists("usuarios.json") || filesize("usuarios.json") == 0) {
    return 1;
  }
  $arrayUsuarios = obtenerUsuarios();
  $arrayUltimoUsuario = json_decode($arrayUsuarios[count($arrayUsuarios) - 1], true);

  return $arrayUltimoUsuario["id"] + 1;
}

function obtenerUsuarioPorMail($mail){
  $arrayUsuarios = obtenerUsuarios();
  foreach ($arrayUsuarios as $usuario) {
    $usuarioDecoded = json_decode($usuario, true);

    if ($usuarioDecoded["mail"] == $mail) {
      return $usuarioDecoded;
    }
  }
  return false;
}

function loguearUsuario($usuarioLogueado){
  unset($usuarioLogueado["pass"]);
  $_SESSION["usuarioLogueado"] = $usuarioLogueado;
}

function loguearCookie(){
  if (!isset($_SESSION["usuarioLogueado"])) {

    if (isset($_COOKIE['logueado'])) {
      $idUsuario = $_COOKIE["logueado"];
      $usuarioLogueado = obtenerUsuarioPorId($idUsuario);
      $_SESSION["usuarioLogueado"] = $usuarioLogueado;
    }
  }
}

function obtenerUsuarioPorId($id){
  $arrayUsuarios = obtenerUsuarios();
  foreach ($arrayUsuarios as $usuario) {
    $usuarioDecoded = json_decode($usuario, true);

    if ($usuarioDecoded["id"] == $id) {
      return $usuarioDecoded;
    }
  }
  return false;
}

function isLogged(){
  return isset($_SESSION["usuarioLogueado"]);
}

function logout(){
  session_destroy();
  unsetCookie("logueado");
}

function unsetCookie($nombreCookie){
  setcookie($nombreCookie, "", time() - 1);
}

function getAvatarById($id){
  $imgPath = glob("img/" . $id . "/" . "avatar.*");
  return $imgPath[0];
}
?>
