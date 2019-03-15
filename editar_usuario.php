<?php
  $page_title = 'Editar Usuario';
  require_once('includes/cargar.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
  $e_user = find_by_id('usuarios',(int)$_GET['id']);
  $groups  = find_all('grupo_usuario');
  $dat=datos((int)$_GET['id']);
  if(!$e_user){
    $session->msg("d","Missing user id.");
    redirect('usuarios.php');
  }
?>

<?php
//Update User basic info
  if(isset($_POST['update'])) {
    $req_fields = array('name','nombre_usuario','level');
    validate_fields($req_fields);
    if(empty($errors)){
             $id = (int)$e_user['id'];
           $name = remove_junk($db->escape($_POST['name']));
       $nombre_usuario = remove_junk($db->escape($_POST['nombre_usuario']));
          $level = (int)$db->escape($_POST['level']);
       $estado   = remove_junk($db->escape($_POST['estado']));
            $sql = "UPDATE usuarios SET name ='{$name}', nombre_usuario ='{$nombre_usuario}',nivel_usuario='{$level}',estado='{$estado}' WHERE id='{$db->escape($id)}'";
            $idp=$dat['id'];
            $di=$dat['email'];
            $dire=$dat['direccion'];
            $personales = "UPDATE datospersonales SET email='$_POST[correo]', direccion='$_POST[direc]' WHERE id='$idp'";
            $resultados = $db->query($personales);
         $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Editado con exito ");
            redirect('editar_usuario.php?id='.(int)$e_user['id'], false);
          }
          else {
            if ($di===$dat['email'] || $dire===$dat['direccion']) {
              $session->msg('s',"Editado con exito ");
              redirect('editar_usuario.php?id='.(int)$e_user['id'], false);
            }
             else {
              $session->msg('d',' Lo siento no se actualizó los datos.');
              redirect('editar_usuario.php?id='.(int)$e_user['id'], false);
            }
          }
    } else {
      $session->msg("d", $errors);
      redirect('editar_usuario.php?id='.(int)$e_user['id'],false);
    }
  }
?>
<?php
// Update user password
if(isset($_POST['update-pass'])) {
  $req_fields = array('password');
  validate_fields($req_fields);
  if(empty($errors)){
           $id = (int)$e_user['id'];
     $password = remove_junk($db->escape($_POST['password']));
     $h_pass   = sha1($password);
          $sql = "UPDATE usuarios SET password='{$h_pass}' WHERE id='{$db->escape($id)}'";
       $result = $db->query($sql);
        if($result && $db->affected_rows() === 1){
          $session->msg('s',"Se ha actualizado la contraseña del usuario. ");
          redirect('editar_usuario.php?id='.(int)$e_user['id'], false);
        } else {
          $session->msg('d','No se pudo actualizar la contraseña de usuario..');
          redirect('editar_usuario.php?id='.(int)$e_user['id'], false);
        }
  } else {
    $session->msg("d", $errors);
    redirect('editar_usuario.php?id='.(int)$e_user['id'],false);
  }
}

?>
<?php include_once('layouts/header.php'); ?>
 <div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-6">
     <div class="panel panel-default">
       <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          Actualiza cuenta <?php echo remove_junk(ucwords($e_user['name'])); ?>
        </strong>
       </div>
       <div class="panel-body">
          <form method="post" action="editar_usuario.php?id=<?php echo (int)$e_user['id'];?>" class="clearfix">
            <div class="form-group">
                  <label for="name" class="control-label">Nombres</label>
                  <input type="name" class="form-control" name="name" value="<?php echo remove_junk(ucwords($e_user['name'])); ?>">
            </div>
            <div class="form-group">
                  <label for="nombre_usuario" class="control-label">Usuario</label>
                  <input type="text" class="form-control" name="nombre_usuario" value="<?php echo remove_junk(ucwords($e_user['nombre_usuario'])); ?>">
            </div>
            <div class="form-group">
                <label for="nombre_usuario">Correo</label>
                <input type="email" class="form-control" name="correo" value="<?php echo $dat['email']; ?>" placeholder="ejemplo@gmail.com" required>
            </div>
            <div class="form-group">
                <label for="nombre_usuario">Direccion</label>
                <input type="text" class="form-control" name="direc" value="<?php echo $dat['direccion']; ?>" placeholder="Direccion" required>
            </div>
            <div class="form-group">
              <label for="level">Rol de usuario</label>
                <select class="form-control" name="level">
                  <?php foreach ($groups as $group ):?>
                   <option <?php if($group['nivel_grupo'] === $e_user['nivel_usuario']) echo 'selected="selected"';?> value="<?php echo $group['nivel_grupo'];?>"><?php echo ucwords($group['nombre_grupo']);?></option>
                <?php endforeach;?>
                </select>
            </div>
            <div class="form-group">
              <label for="estado">Estado</label>
                <select class="form-control" name="estado">
                  <option <?php if($e_user['estado'] === '1') echo 'selected="selected"';?>value="1">Activo</option>
                  <option <?php if($e_user['estado'] === '0') echo 'selected="selected"';?> value="0">Inactivo</option>
                </select>
            </div>
            <div class="form-group clearfix">
                    <button type="submit" name="update" class="btn btn-info">Actualizar</button>
            </div>
        </form>
       </div>
     </div>
  </div>
  <!-- Change password form -->
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          Cambiar <?php echo remove_junk(ucwords($e_user['name'])); ?> contraseña
        </strong>
      </div>
      <div class="panel-body">
        <form action="editar_usuario.php?id=<?php echo (int)$e_user['id'];?>" method="post" class="clearfix">
          <div class="form-group">
                <label for="password" class="control-label">Contraseña</label>
                <input type="password" class="form-control" name="password" placeholder="Ingresa la nueva contraseña" required>
          </div>
          <div class="form-group clearfix">
                  <button type="submit" name="update-pass" class="btn btn-danger pull-right">Cambiar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

 </div>
<?php include_once('layouts/footer.php'); ?>
