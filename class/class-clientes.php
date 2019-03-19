<?php

	class Clientes{

		private $name;
		private $nombre_usuario;
		private $password;
		private $nivel_usuario;
		private $image;
		private $estado;
		private $ultimo_acceso;
		private $email;
		private $direccion;
		private $usuario_id;

		public function __construct($name,
					$nombre_usuario,
					$password,
					$nivel_usuario,
					$image,
					$estado,
					$ultimo_acceso,
					$email,
					$direccion,
					$usuario_id){
			$this->name = $name;
			$this->nombre_usuario = $nombre_usuario;
			$this->password = $password;
			$this->nivel_usuario = $nivel_usuario;
			$this->image = $image;
			$this->estado = $estado;
			$this->ultimo_acceso = $ultimo_acceso;
			$this->email = $email;
			$this->direccion = $direccion;
			$this->usuario_id = $usuario_id;
		}
		public function getName(){
			return $this->name;
		}
		public function setName($name){
			$this->name = $name;
		}
		public function getNombre_usuario(){
			return $this->nombre_usuario;
		}
		public function setNombre_usuario($nombre_usuario){
			$this->nombre_usuario = $nombre_usuario;
		}
		public function getPassword(){
			return $this->password;
		}
		public function setPassword($password){
			$this->password = $password;
		}
		public function getNivel_usuario(){
			return $this->nivel_usuario;
		}
		public function setNivel_usuario($nivel_usuario){
			$this->nivel_usuario = $nivel_usuario;
		}
		public function getImage(){
			return $this->image;
		}
		public function setImage($image){
			$this->image = $image;
		}
		public function getEstado(){
			return $this->estado;
		}
		public function setEstado($estado){
			$this->estado = $estado;
		}
		public function getUltimo_acceso(){
			return $this->ultimo_acceso;
		}
		public function setUltimo_acceso($ultimo_acceso){
			$this->ultimo_acceso = $ultimo_acceso;
		}
		public function getEmail(){
			return $this->email;
		}
		public function setEmail($email){
			$this->email = $email;
		}
		public function getDireccion(){
			return $this->direccion;
		}
		public function setDireccion($direccion){
			$this->direccion = $direccion;
		}
		public function getUsuario_id(){
			return $this->usuario_id;
		}
		public function setUsuario_id($usuario_id){
			$this->usuario_id = $usuario_id;
		}
		public function __toString(){
			return "Name: " . $this->name . 
				" Nombre_usuario: " . $this->nombre_usuario . 
				" Password: " . $this->password . 
				" Nivel_usuario: " . $this->nivel_usuario . 
				" Image: " . $this->image . 
				" Estado: " . $this->estado . 
				" Ultimo_acceso: " . $this->ultimo_acceso . 
				" Email: " . $this->email . 
				" Direccion: " . $this->direccion . 
				" Usuario_id: " . $this->usuario_id;
		}

		public function insertarRegistro($conexion){
			$sql = sprintf(
					"INSERT INTO usuarios(name, nombre_usuario, password, nivel_usuario, image, estado,ultimo_acceso) 
					 VALUES ('%s','%s','%s',%s,'%s',%s,'%s')",
					$conexion->antiInyeccion($this->name),
					$conexion->antiInyeccion($this->nombre_usuario),
					$conexion->antiInyeccion($this->password),
					3,
					$conexion->antiInyeccion($this->image),
					1,			
					$conexion->antiInyeccion($this->ultimo_acceso)
			);
			
			$resultado = $conexion->ejecutarConsulta($sql);
			$id = $conexion->ultimoId();

			for ($i=0;$i<sizeof($this->usuario_id);$i++){
				$sql=sprintf(
					"INSERT INTO datospersonales(email, direccion) VALUES ('%s','%s')",
					$conexion->antiInyeccion($id),
					$conexion->antiInyeccion($this->usuario_id[$i])
				); 
				$conexion->ejecutarConsulta($sql);
			}
			echo "<b>Registro almacenado con exito</b>";
		}
	}
?>