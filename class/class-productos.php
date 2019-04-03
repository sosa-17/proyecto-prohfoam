<?php
//JELSYN 3-04-19 10pm

	class Productos{

		private $id;
		private $name;
		private $precio_venta;
		private $file_name;
		private $cantidad;
		private $media_id;
		

		public function __construct($id,
					$name,
					$precio_venta,
					$file_name,
					$cantidad,
					$media_id){
			$this->id = $id;
			$this->name = $name;
			$this->precio_venta = $precio_venta;
			$this->file_name = $file_name;
			$this->cantidad = $cantidad;
			$this->media_id = $media_id;
		}
		public function getId(){
			return $this->id;
		}
		public function setId($id){
			$this->id = $id;
		}
		public function getName(){
			return $this->name;
		}
		public function setName($name){
			$this->name = $name;
		}
		public function getPrecio_venta(){
			return $this->precio_venta;
		}
		public function setPrecio_venta($precio_venta){
			$this->precio_venta = $precio_venta;
		}
		public function getfile_name(){
			return $this->file_name;
		}
		public function setfile_name($file_name){
			$this->file_name = $file_name;
		}
		public function getCantidad(){
			return $this->cantidad;
		}
		public function setCantidad($cantidad){
			$this->cantidad = $cantidad;
		}
		public function getMedia_id(){
			return $this->media_id;
		}
		public function setMedia_id($media_id){
			$this->media_id = $media_id;
		}
		public function __toString(){
			return "Id: " . $this->id . 
				" Name: " . $this->name . 
				" Precio_venta: " . $this->precio_venta . 
				" file_name: " . $this->file_name . 
				" Cantidad: " . $this->cantidad . 
				" Media_id: " . $this->media_id;
		}

		public static function obtenerProductos($conexion){
			$resultado = $conexion->ejecutarConsulta(
				'SELECT a.id,a.name,a.precio_venta,b.file_name,a.cantidad,a.categoria_id,c.name as categoria
				FROM productos a 
				INNER JOIN media b 
				ON (a.media_id = b.id)
				INNER JOIN categorias c
				ON(a.categoria_id=c.id)'
			);

			while (($fila = $conexion->obtenerFila($resultado))){
					

					echo '<div class="col-lg-4 col-md-6 mb-4">
					<div class="card h-100">
					  <a href="#"><img class="img-fluid" src="uploads/products/'.$fila['file_name'].'"  alt=""></a>
					 <div class="card-body">
					   <h4 class="card-title">
						<a href="#">'.$fila["name"].' </a>
					   </h4>
					   <h5>Precio:'.$fila["precio_venta"].'</h5>
					   <p class="card-text">'.$fila["categoria"].'</p>
					 </div>
					 <div class="card-footer">
					   <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
					 </div>
				   </div>
				 </div>';
/*
					$resultado = $conexion->ejecutarConsulta(
				'SELECT a.id, a.name, a.cantidad, 
						a.precio_venta,a.url_img, b.categoria_id						
				FROM productos a
				INNER JOIN categoria_id b 
				ON (a.categoria_id = b.categoria_id)'
			);

					*/
			}
		}

		public static function CategoriaSala($conexion){
			$resultado = $conexion->ejecutarConsulta(
				'SELECT a.id,a.name,a.precio_venta,b.file_name,a.cantidad,a.categoria_id,c.name as cat
				FROM productos a 
				INNER JOIN media b 
				ON (a.media_id = b.id)
				INNER JOIN categorias c
				ON(a.categoria_id=c.id) where c.id="1"'
			);

			while (($fila = $conexion->obtenerFila($resultado))){
					

					echo '<div class="col-lg-4 col-md-6 mb-4">
					<div class="card h-100">
					  <a href="#"><img class="img-fluid" src="uploads/products/'.$fila['file_name'].'"  alt=""></a>
					 <div class="card-body">
					   <h4 class="card-title">
						<a href="#">'.$fila["name"].' </a>
					   </h4>
					   <h5>Precio:'.$fila["precio_venta"].'</h5>
					   <p class="card-text">'.$fila['cat'].'</p>
					 </div>
					 <div class="card-footer">
					   <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
					 </div>
				   </div>
				 </div>';
/*
					$resultado = $conexion->ejecutarConsulta(
				'SELECT a.id, a.name, a.cantidad, 
						a.precio_venta,a.url_img, b.categoria_id						
				FROM productos a
				INNER JOIN categoria_id b 
				ON (a.categoria_id = b.categoria_id)'
			);

					*/
			}
		}

		public static function CategoriaDormitorio($conexion){
			$resultado = $conexion->ejecutarConsulta(
				'SELECT a.id,a.name,a.precio_venta,b.file_name,a.cantidad,a.categoria_id,c.name as cat
				FROM productos a 
				INNER JOIN media b 
				ON (a.media_id = b.id)
				INNER JOIN categorias c
				ON(a.categoria_id=c.id) where c.id="2"'
			);

			while (($fila = $conexion->obtenerFila($resultado))){
					

					echo '<div class="col-lg-4 col-md-6 mb-4">
					<div class="card h-100">
					  <a href="#"><img class="img-fluid" src="uploads/products/'.$fila['file_name'].'"  alt=""></a>
					 <div class="card-body">
					   <h4 class="card-title">
						<a href="#">'.$fila["name"].' </a>
					   </h4>
					   <h5>Precio:'.$fila["precio_venta"].'</h5>
					   <p class="card-text">'.$fila['cat'].'</p>
					 </div>
					 <div class="card-footer">
					   <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
					 </div>
				   </div>
				 </div>';
/*
					$resultado = $conexion->ejecutarConsulta(
				'SELECT a.id, a.name, a.cantidad, 
						a.precio_venta,a.url_img, b.categoria_id						
				FROM productos a
				INNER JOIN categoria_id b 
				ON (a.categoria_id = b.categoria_id)'
			);

					*/
			}
		}

		public static function CategoriaOficina($conexion){
			$resultado = $conexion->ejecutarConsulta(
				'SELECT a.id,a.name,a.precio_venta,b.file_name,a.cantidad,a.categoria_id,c.name as cat
				FROM productos a 
				INNER JOIN media b 
				ON (a.media_id = b.id)
				INNER JOIN categorias c
				ON(a.categoria_id=c.id) where c.id="3"'
			);

			while (($fila = $conexion->obtenerFila($resultado))){
					

					echo '<div class="col-lg-4 col-md-6 mb-4">
					<div class="card h-100">
					  <a href="#"><img class="img-fluid" src="uploads/products/'.$fila['file_name'].'"  alt=""></a>
					 <div class="card-body">
					   <h4 class="card-title">
						<a href="#">'.$fila["name"].' </a>
					   </h4>
					   <h5>Precio:'.$fila["precio_venta"].'</h5>
					   <p class="card-text">'.$fila['cat'].'</p>
					 </div>
					 <div class="card-footer">
					   <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
					 </div>
				   </div>
				 </div>';
/*
					$resultado = $conexion->ejecutarConsulta(
				'SELECT a.id, a.name, a.cantidad, 
						a.precio_venta,a.url_img, b.categoria_id						
				FROM productos a
				INNER JOIN categoria_id b 
				ON (a.categoria_id = b.categoria_id)'
			);

					*/
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