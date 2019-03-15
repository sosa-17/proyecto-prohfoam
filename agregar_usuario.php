<?php
  $page_title = 'Agregar usuarios';
  require_once('includes/cargar.php');
    page_require_level(1);
  $groups = find_all('grupo_usuario');
  //$idusu=maxid();
?>
<?php
  if(isset($_POST['add_user'])){

   $req_fields = array('full-name','nombre_usuario','password','level' );
   validate_fields($req_fields);

   if(empty($errors)){
           $name   = remove_junk($db->escape($_POST['full-name']));
       $nombre_usuario   = remove_junk($db->escape($_POST['nombre_usuario']));
       $password   = remove_junk($db->escape($_POST['password']));
       $nivel_usuario = (int)$db->escape($_POST['level']);
       $password = sha1($password);
        $query = "INSERT INTO usuarios (";
        $query .="name,nombre_usuario,password,nivel_usuario,estado";
        $query .=") VALUES (";
        $query .=" '{$name}', '{$nombre_usuario}', '{$password}', '{$nivel_usuario}','1'";
        $query .=")";

        $consu=$db->query($query);

          $id = maxid();
          $idu=$id['id'];
          //$id=(int)$id;
        $sql="INSERT INTO datospersonales(email,direccion,usuarios_id) VALUES ('$_POST[email]','$_POST[direccion]','$idu')";

        $db->query($sql);
        if($consu){
          $session->msg('s'," Cuenta de usuario ha sido creada");
          redirect('agregar_usuario.php', false);
        } else {
          //failed
          $session->msg('d',' No se pudo crear la cuenta.');
          redirect('agregar_usuario.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('agregar_usuario.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>
  <?php echo display_msg($msg); ?>
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Agregar usuario</span>
       </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
          <form method="post" action="agregar_usuario.php">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="full-name" placeholder="Nombre completo">
            </div>
            <div class="form-group">
                <label for="nombre_usuario">Usuario</label>
                <input type="text" class="form-control" name="nombre_usuario" placeholder="Nombre de usuario">
            </div>
            <div class="form-group">
                <label for="nombre_usuario">Correo</label>
                <input type="email" class="form-control" name="email" placeholder="ejemplo@gmail.com">
            </div>
            <div class="form-group">
                <label for="nombre_usuario">Direccion</label>
                <input type="text" class="form-control" name="direccion" placeholder="Direccion">
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" name ="password"  placeholder="Contraseña">
            </div>
            <div class="form-group">
              <label for="level">Rol de usuario</label>
                <select class="form-control" name="level">
                  <?php foreach ($groups as $group ):?>
                   <option value="<?php echo $group['nivel_grupo'];?>"><?php echo ucwords($group['nombre_grupo']);?></option>
                <?php endforeach;?>
                </select>
            </div>
            <div class="form-group clearfix">
              <button type="submit" name="add_user" class="btn btn-primary">Guardar</button>
            </div>
        </form>
        </div>

      </div>

    </div>
  </div>
<?php
  /*if(isset($_POST['add_user']))
  {
      function validar_nombre(string $fullname): bool 
      {
          return !(trim($full-name)=='');
      }
       function validar_nombreusuario(string $nombre_usuario): bool 
      {
          return !(trim($nombre_usuario)=='');
      }
       function validar_contrasena(string $password): bool 
      {
          return !(trim($password)=='');
          
      }
  }*/
?>
<?php include_once('layouts/footer.php'); ?>
