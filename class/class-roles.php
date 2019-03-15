<?php
//JELSYN 3-04-19 10pm
	class Productos{

		private $id;
		private $nombre_grupo;
		private $nivel_grupo;
		private $estado_grupo;

		public function __construct($id,
					$nombre_grupo;
					$nivel_grupo,
					$estado_grupo){
			$this->id = $id;
			$this->nombre_grupo = $nombre_grupo;
			$this->nivel_grupo = $nivel_grupo;
			$this->estado_grupo = $estado_grupo;
			
		}
		public function getId(){
			return $this->id;
		}
		public function setId($id){
			$this->id = $id;
		}
		public function getnombre_grupo(){
			return $this->nombre_grupo;
		}
		public function setnombre_grupo($nombre_grupo){
			$this->nombre_grupo = $nombre_grupo;
		}
		public function getnivel_grupo(){
			return $this->nivel_grupo;
		}
		public function setnivel_grupo($nivel_grupo){
			$this->nivel_grupo = $nivel_grupo;
		}
		public function getestado_grupo(){
			return $this->estado_grupo;
		}
		public function setestado_grupo($estado_grupo){
			$this->estado_grupo = $estado_grupo;
		}
		
		public function __toString(){
			return "id: " . $this->id . 
				" nombre_grupo: " . $this->nombre_grupo . 
				" nivel_grupo: " . $this->nivel_grupo . 
				" estado_grupo: " . $this->estado_grupo; 

		}

		public function obtenerRoles($conexion){
			$resultado = $conexion->ejecutarConsulta(
				"INSERT INTO grupo_usuario (id,nombre_grupo, nivel_grupo, estado_grupo) 
				VALUES (%s,'%s', %s, %s)"
			);

			
			}
		}

		
		/*public static function obtenerDetalleProductos($conexion,$id_producto){
			$resultado = $conexion->ejecutarConsulta(
				sprintf(
					'SELECT a.id_producto, a.name, a.precio_venta, a.url_img, a.cantidad
						FROM productos a 
						INNER JOIN categorias b 
						ON(a.categoria_id = b.categoria_id)',
					$conexion->antiInyeccion($id_producto)
				)
			);

			$fila = $conexion->obtenerFila($resultado);
			

			/*$resultado = $conexion->ejecutarConsulta(
				sprintf(
					'SELECT categoria_id
					FROM categorias 
					WHERE id_producto = %s',
					$conexion->antiInyeccion($id_producto)
				)
			);

			$categorias = array();
			while(($filaCategoria = $conexion->obtenerFila($resultado))){
			$categorias[]=$filaCategoria;
			}

			$fila["categorias"] = $categorias;
			echo json_encode($fila);
		}*/
	}
?>