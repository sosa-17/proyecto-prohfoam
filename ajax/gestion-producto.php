<?php
//JELSYN 3-04-19 10pm
   include ('../class/class-conexion.php');
   include ('../class/class-productos.php');
   $conexion  = new Conexion();
   switch ($_GET["accion"]) {
      case 'obtenerImgProducto':
         Productos::obtenerProductos($conexion);   
      break;
      case 'CategoriaSala':
         Productos::CategoriaSala($conexion);         
      break;
      case 'CategoriaDormitorio':
         Productos::CategoriaDormitorio($conexion);         
      break;
      case 'CategoriaOficina':
         Productos::CategoriaOficina($conexion);         
      break;
   	default:
   		break;
   }
   
?>