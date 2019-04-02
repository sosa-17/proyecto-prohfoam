<?php
   include ('../class/class-conexion.php');
   include ('../class/class-proveedor.php');
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
         case 'obtenerProveedores':
            Proveedor::obtenerProveedor($conexion);         
         break;
      	default:
      		# code...
   		break;
   }
   
?>

