<?php
  require_once('includes/cargar.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
  $all_groups = find_all('grupo_usuario');


   $sql="SELECT * FROM proveedores";
  $resultado=find_by_sql($sql);
?>
<?php include_once('layouts/header.php');
?>
<?php 
if(isset($_POST['agregar'])){
  $sql=" INSERT INTO proveedores (nombre,telefono,direccion) VALUES('$_POST[txt_nombre]','$_POST[txt_telefono]','$_POST[txt_direccion]')";


        $consu=$db->query($sql);
        
 }
 ?>


<div class="row">
   <div class="col-md-12">
   </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
    <div class="panel-heading clearfix">
      <strong>
        <span class="glyphicon glyphicon-th"></span>
        <span>Proveedores</span>
     </strong>
      <!-- <button type="button" class="btn btn-info pull-right btn-sm" data-toggle="modal" data-target="#agregarRol">
      <span class="glyphicon glyphicon-plus"></span>AGREGAR NUEVO PROVEEDOR
			 </button>-->
    </div>
     <div class="panel-body">
      <div class="form-group">

     	<form method="post" action="Proveedores.php">
          <div class="col-md-4"> 
	           <input type="text" class="form-control" name="txt_nombre" value="" placeholder="Nombre Proveedor" required >
          </div>
          <div class="col-md-4"> 
	           <input type="text" class="form-control" name="txt_telefono" value="" placeholder="Telefono"  required>
          </div>
          <div class="col-md-4"> 
	           <input type="text" class="form-control" name="txt_direccion" value="" placeholder="Direccion" required> <br>
          </div>
              <button type="submit" class="btn btn-raised btn-primary" name="agregar">Agregar</button>
	    </form>
  

  </br>
</br>

<table class="table table-bordered table-striped">
        <thead>
          <tr>
             <th class="text-center" style="width: 50px;">#</th>
             <th><center>Nombre de la Empresa</center></th>
             <th class="text-center" style="width: 20%;">Telefono</th>
             <th class="text-center" style="width: 15%;">Direccion</th>
             <th class="text-center" style="width: 100px;">Editar/Eiminar</th>';
          </tr>
        </thead>
<?php foreach($resultado as $result): ?>
         <tr>
           <td><center><?php echo $result[0];?></center></td>
           <td><center><?php echo $result[1];?></center></td>
           <td><center><?php echo $result[2];?></center></td>
           <td><center><?php echo $result[3];?></center></td>

           <td class="text-center">
             <div class="btn-group">
                <a href="Proveedores.php?id=<?php echo (int)$result[0];?>" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Editar">
                  <i class="glyphicon glyphicon-pencil"></i>
               </a>
                <a href="eliminar_proveedor.php?id=<?php echo (int)$result[0];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
                  <i class="glyphicon glyphicon-remove"></i>
                </a>
                </div>
           </td>
          </tr>

<?php endforeach;?>
       </tbody>
     </table>
     
 <?php include_once('layouts/footer.php'); ?>



