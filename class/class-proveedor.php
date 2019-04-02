<?php

	class Proveedor{

		private $proveedores_id;
		private $nombre;
		private $telefono;
		private $direccion;

		public function __construct($proveedores_id,
					$nombre,
					$telefono,
					$direccion){
			$this->proveedores_id = $proveedores_id;
			$this->nombre = $nombre;
			$this->telefono = $telefono;
			$this->direccion = $direccion;
		}
		public function getProveedores_id(){
			return $this->proveedores_id;
		}
		public function setProveedores_id($proveedores_id){
			$this->proveedores_id = $proveedores_id;
		}
		public function getNombre(){
			return $this->nombre;
		}
		public function setNombre($nombre){
			$this->nombre = $nombre;
		}
		public function getTelefono(){
			return $this->telefono;
		}
		public function setTelefono($telefono){
			$this->telefono = $telefono;
		}
		public function getDireccion(){
			return $this->direccion;
		}
		public function setDireccion($direccion){
			$this->direccion = $direccion;
		}
		public function __toString(){
			return "Proveedores_id: " . $this->proveedores_id . 
				" Nombre: " . $this->nombre . 
				" Telefono: " . $this->telefono . 
				" Direccion: " . $this->direccion;
		}


		
		public static function obtenerProveedor($conexion){
			$resultado = $conexion->ejecutarConsulta(
				'SELECT proveedores_id, nombre, telefono, direccion
				 FROM proveedores'
			);
			echo '<table class="table table-bordered">
						<thead>
						    <tr>
						        <th class="text-center" style="width: 50px;">#</th>
						        <th>Nombre de la Empresa</th>
						        <th class="text-center" style="width: 20%;">Telefono</th>
						        <th class="text-center" style="width: 15%;">Direccion</th>
						        <th class="text-center" style="width: 100px;">Editar/Eiminar</th>';
			while (($fila = $conexion->obtenerFila($resultado))){
					

					 
					 echo '</tr>
					        </thead>
					        <tbody>
          				   <tr>
          				   <td class="text-center">'.$fila['proveedores_id'].'</td>
				           <td class="text-center">'.$fila['nombre'].'</td>
				           <td class="text-center">'.$fila['telefono'].'</td>
				           <td class="text-center">'.$fila['direccion'].'</td>

				           <td class="text-center">
				            <div class="btn-group">
				                <a href="" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Editar">
				                  <i class="glyphicon glyphicon-pencil"></i>
				                </a>
				                <a href="" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
				                  <i class="glyphicon glyphicon-remove"></i>
				                </a>
				            </div>
				           </td>
				           </tr>
       					   </tbody>';
       					   
		}
		echo '</table>';
		}
	}
?>