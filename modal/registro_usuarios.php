<?php
  $page_title = 'Agregar grupo';
  require_once('includes/cargar.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
  if(isset($_POST['add'])){

   $req_fields = array('group-name','group-level');
   validate_fields($req_fields);

   if(find_by_groupName($_POST['group-name']) === false ){
     $session->msg('d','<b>Error!</b> El nombre de grupo realmente existe en la base de datos');
     redirect('agregar_grupo.php', false);
   }elseif(find_by_groupLevel($_POST['group-level']) === false) {
     $session->msg('d','<b>Error!</b> El nombre de grupo realmente existe en la base de datos ');
     redirect('agregar_grupo.php', false);
   }
   if(empty($errors)){
           $name = remove_junk($db->escape($_POST['group-name']));
          $level = remove_junk($db->escape($_POST['group-level']));
         $estado = remove_junk($db->escape($_POST['estado']));

        $query  = "INSERT INTO grupo_usuario (";
        $query .="nombre_grupo,nivel_grupo,estado_grupo";
        $query .=") VALUES (";
        $query .=" '{$name}', '{$level}','{$estado}'";
        $query .=")";
        if($db->query($query)){
          //sucess
          $session->msg('s',"Grupo ha sido creado! ");
          redirect('grupo.php', false);
        } else {
          //failed
          $session->msg('d','Lamentablemente no se pudo crear el grupo!');
          redirect('agregar_grupo.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('agregar_grupo.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>
	<!-- Modal -->
	<div class="modal fade" id="agregarRol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar Rol</h4>
		  </div>
		  <div class="modal-body">
		
      <form method="post" action="grupo.php" class="clearfix">
        <div class="form-group">
              <label for="name" class="control-label">Nombre del Rol</label>
              <input type="name" class="form-control" name="group-name" required>
        </div>
        <div class="form-group">
              <label for="level" class="control-label">Nivel del Rol</label>
              <input type="number" class="form-control" name="group-level">
        </div>
        <div class="form-group">
          <label for="estado">Estado</label>
            <select class="form-control" name="estado">
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
        </div>
        <div class="form-group clearfix">
				<button type="submit" name="add" class="btn btn-primary" >Guardar datos</button>   
        </div>
			</div>
    </form>
		  <div class="modal-footer">
			<div class="form-group clearfix">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" name="add" class="btn btn-primary">Guardar datos</button>   
        </div>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	