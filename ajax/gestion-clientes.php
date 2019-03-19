<?php 

	include("../class/class-conexion.php");
	$conexion = new Conexion();
	switch ($_GET["accion"]) {
	 	case "guardar":
	 		include("../class/class-clientes.php");
	 		$clientes = new Clientes(
	 				$_POST["txt-name"],
					$_POST["txt-nombre_usuario"],
					$_POST["txt-password"],
					$_POST["txt-nivel_usuario"],
					null,
					$_POST["slc-estado"],
					$_POST["txt-ultimo_acceso"],
					$_POST["txt-usuario_id"]
					

			$clientes->insertarRegistro($conexion);

	 	break;
	 	default:
	 		echo "Accion invalida";
	 		break;
 ?>