<?php
   include ('../class/class-conexion.php');
   $conexion  = new Conexion();
   switch ($_GET["accion"]) {
   	case 'insertar_proveedor':
         $nombre=$_POST['txt-nombre'];
         $telefono=$_POST['txt-telefono'];
         $direccion=$_POST['txt-direccion'];
         
         $sql="CALL ingresarProveedor('$nombre','$telefono','$direccion')";
         $resultado = $conexion->ejecutarConsulta($sql);
            if ($resultado) {
            # code...
            echo "listo";
            }
   		break;
   	default:
   		# code...
   		break;
   }
   /*CREATE PROCEDURE `ingresarProveedor` (IN `nombre` varchar(100), `telefono` varchar(250), `direccion` varchar(250) ) INSERT INTO proveedores (nombre, telefono, direccion) VALUES (`nombre`,`telefono`, `direccion`)*/
   
?>

