<?php
  $page_title = 'Lista de grupos';
  require_once('includes/cargar.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
  $all_groups = find_all('grupo_usuario');
?>
<?php include_once('layouts/header.php');
      include("modal/registro_usuarios.php");
?>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
    <div class="panel-heading clearfix">
      <strong>
        <span class="glyphicon glyphicon-th"></span>
        <span>Roles de Usuario..</span>
     </strong>
       <button type="button" class="btn btn-info pull-right btn-sm" data-toggle="modal" data-target="#agregarRol">
      
						 <span class="glyphicon glyphicon-plus"></span>AGREGAR ROL
			 </button>
    </div>
     <div class="panel-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th>Nombre del grupo</th>
            <th class="text-center" style="width: 20%;">Nivel del grupo</th>
            <th class="text-center" style="width: 15%;">Estado</th>
            <th class="text-center" style="width: 100px;">Acciones</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($all_groups as $a_group): ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td><?php echo remove_junk(ucwords($a_group['nombre_grupo']))?></td>
           <td class="text-center">
             <?php echo remove_junk(ucwords($a_group['nivel_grupo']))?>
           </td>
           <td class="text-center">
           <?php if($a_group['estado_grupo'] === '1'): ?>
            <span class="label label-primary"><?php echo "Activo"; ?></span>
          <?php else: ?>
            <span class="label label-danger"><?php echo "Inactivo"; ?></span>
          <?php endif;?>
           </td>
           <td class="text-center">
             <div class="btn-group">
                <a href="editar_grupo.php?id=<?php echo (int)$a_group['id'];?>" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Editar">
                  <i class="glyphicon glyphicon-pencil"></i>
               </a>
                <a href="eliminar_grupo.php?id=<?php echo (int)$a_group['id'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
                  <i class="glyphicon glyphicon-remove"></i>
                </a>
                </div>
           </td>
          </tr>
        <?php endforeach;?>
       </tbody>
     </table>
     </div>
    </div>
  </div>
</div>
  <?php include_once('layouts/footer.php'); ?>
