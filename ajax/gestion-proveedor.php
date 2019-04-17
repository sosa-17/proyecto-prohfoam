<?php
   include ('../class/class-conexion.php');
   include ('../class/class-proveedor.php');
   $conexion  = new Conexion();
   switch ($_GET["accion"]) {
   	case 'insertar_proveedor':
            Proveedor::insertarProveedor($conexion);
   		break;
         case 'obtenerProveedores':
            Proveedor::obtenerProveedor($conexion);         
         break;
      	default:
      		# code...
   		break;
   }
   
   
?>

