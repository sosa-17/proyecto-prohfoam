<?php
  require_once('includes/cargar.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
  $all_groups = find_all('grupo_usuario');
?>
<?php include_once('layouts/header.php');
      include("modal/registro_usuarios.php");
?>
<script src="js/jquery.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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
     	<form id="frmAgregar">
          <div class="col-md-4"> 
	<input type="text" class="form-control" name="txt_nombre" id="txt-nombre"name="Nombre" value="" placeholder="Nombre Proveedor" required >
   </div>
     <div class="col-md-4"> 
	<input type="text" class="form-control" name="txt_telefono" id="txt-telefono" name="Telefono" value="" placeholder="Telefono"  required>
  </div>
    <div class="col-md-4"> 
	<input type="text" class="form-control" name="txt_direccion" name="Direccion" value="" placeholder="Direccion" required> <br>
  </div>
	</form>
  
    <button type="button" class="btn btn-raised btn-primary" id="btn-enviar" disabled>Agregar</button>
  </br>
</br>
      <!--<table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th>Nombre de la Empresa</th>
            <th class="text-center" style="width: 20%;">Telefono</th>
            <th class="text-center" style="width: 15%;">Direccion</th>
            <th class="text-center" style="width: 100px;">Editar/Eiminar</th>
          </tr>
        </thead>-->
        <!--<tbody>
          <tr>-->
          	<div id="div-proveedores"></div>
           <!--<td class="text-center"></td>
           <td class="text-center"></td>
           <td class="text-center"></td>
           <td class="text-center"></td>

           <td class="text-center">
            <div class="btn-group">
                <a href="" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Editar">
                  <i class="glyphicon glyphicon-pencil"></i>
                </a>
                <a href="" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
                  <i class="glyphicon glyphicon-remove"></i>
                </a>
            </div>
           </td>-->
          <!--	</tr>
       </tbody>
     </table>-->
     </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="js/proveedor.js"></script>
<script type="text/javascript" src="js/lista_proveedores.js"></script>
<script type="text/javascript" src="js/validar.js"></script>



