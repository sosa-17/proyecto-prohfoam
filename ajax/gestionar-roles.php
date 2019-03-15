<?php
//JELSYN 3-04-19 10pm
   include ('../class/class-conexion.php');
   include ('../class/class-roles.php');
   $conexion  = new Conexion();
   switch ($_GET["accion"]) {
      case 'agregar_rol':
         Roles::insertarRol($conexion);   
      break;
      /*case "obtenerProductos":
         Productos::obtenerDetalleProductos($conexion,$_POST["id_producto"]);         
      break;*/
   	default:
   		break;
   }
   
?>