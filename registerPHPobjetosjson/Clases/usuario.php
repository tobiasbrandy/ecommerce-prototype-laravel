<?php

class Usuario {

	private $id;
	private $nombre;
	private $apellido;
	private $sexo;
	private $password;
	private $mail;

	public function __construct(Array $miUsuario)
	{
		$this->id = $miUsuario["id"];
		$this->nombre = $miUsuario["nombre"];
		$this->apellido = $miUsuario["apellido"];
		$this->password = $miUsuario["pass"];
		$this->mail = $miUsuario["mail"];
		$this->sexo = $miUsuario["sexo"];
	}

	public function getNombre() {
		return $this->nombre;
	}
	public function getApellido() {
		return $this->apellido;
	}
	public function getId() {
		return $this->id;
	}
	public function getMail() {
		return $this->mail;
	}
	public function getSexo() {
		return $this->sexo;
	}
	public function getPassword() {
		return $this->password;
	}
  public function getAvatar() {
    $imgPath = glob("Clases/img/" . $this->id . "/" . "avatar.*");
    return $imgPath[0];
  }
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}
	public function setApellido($apellido) {
		$this->apellido = $apellido;
  }
	public function setMail($mail) {
		$this->mail = $mail;
	}
	public function setPassword($password) {
		$this->password = password_hash($password, PASSWORD_DEFAULT);
	}
	public function setSexo($sexo) {
		$this->sexo = $sexo;
	}
	public function setId($id) {
		$this->id = $id;
	}

  public function guardarImagen() {

		if ($_FILES["imagen"]["error"] == UPLOAD_ERR_OK) {

			if (!is_dir(dirname(__FILE__) . "/img/")) {

		    mkdir(dirname(__FILE__) . "/img/", 0777);
		  }
			$path = dirname(__FILE__) . "/img/" . $this->getId() . "/";

			if (!is_dir($path)) {
				mkdir($path, 0777);
			}

			$ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);

			move_uploaded_file($_FILES["avatar"]["tmp_name"], $path . "avatar." . $ext);
		}
	}

  public function guardarImagenDefault() {
    if (!is_dir(dirname(__FILE__) . "/img/")) {

      mkdir(dirname(__FILE__) . "/img/", 0777);
    }
    $path = dirname(__FILE__) . "/img/" . $this->getId() . "/";

		if (!is_dir($path)) {
			mkdir($path, 0777);
		}

    copy("avatar.jpg", $path . "avatar.jpg");
  }

}
