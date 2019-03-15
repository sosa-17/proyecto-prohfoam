<?php
  $page_title = 'Editar Grupo';
  require_once('includes/cargar.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
  $e_group = find_by_id('grupo_usuario',(int)$_GET['id']);
  if(!$e_group){
    $session->msg("d","Missing Group id.");
    redirect('grupo.php');
  }
?>
<?php
  if(isset($_POST['update'])){

   $req_fields = array('group-name','group-level');
   validate_fields($req_fields);
   if(empty($errors)){
           $name = remove_junk($db->escape($_POST['group-name']));
          $level = remove_junk($db->escape($_POST['group-level']));
         $estado = remove_junk($db->escape($_POST['estado']));

        $query  = "UPDATE grupo_usuario SET ";
        $query .= "nombre_grupo='{$name}',nivel_grupo='{$level}',estado_grupo='{$estado}'";
        $query .= "WHERE ID='{$db->escape($e_group['id'])}'";
        $result = $db->query($query);
         if($result && $db->affected_rows() === 1){
          //sucess
          $session->msg('s',"Grupo se ha actualizado! ");
          redirect('editar_grupo.php?id='.(int)$e_group['id'], false);
        } else {
          //failed
          $session->msg('d','Lamentablemente no se ha actualizado el grupo!');
          redirect('editar_grupo.php?id='.(int)$e_group['id'], false);
        }
   } else {
     $session->msg("d", $errors);
    redirect('editar_grupo.php?id='.(int)$e_group['id'], false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>
<div class="login-page">
    <div class="text-center">
       <h3>Editar Grupo</h3>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="editar_grupo.php?id=<?php echo (int)$e_group['id'];?>" class="clearfix">
        <div class="form-group">
              <label for="name" class="control-label">Nombre del grupo</label>
              <input type="name" class="form-control" name="group-name" value="<?php echo remove_junk(ucwords($e_group['nombre_grupo'])); ?>">
        </div>
        <div class="form-group">
              <label for="level" class="control-label">Nivel del grupo</label>
              <input type="number" class="form-control" name="group-level" value="<?php echo (int)$e_group['nivel_grupo']; ?>">
        </div>
        <div class="form-group">
          <label for="estado">Estado</label>
              <select class="form-control" name="estado">
                <option <?php if($e_group['estado_grupo'] === '1') echo 'selected="selected"';?> value="1"> Activo </option>
                <option <?php if($e_group['estado_grupo'] === '0') echo 'selected="selected"';?> value="0">Inactivo</option>
                <option <?php if($e_group['estado_grupo'] === '0') echo 'selected="selected"';?> value="0">Inactivo</option>
              </select>
        </div>
        <div class="form-group clearfix">
                <button type="submit" name="update" class="btn btn-info">Actualizar</button>
        </div>
    </form>
</div>

<?php include_once('layouts/footer.php'); ?>
