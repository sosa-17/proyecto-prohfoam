<?php
  $page_title = 'Agregar usuarios';
  require_once('includes/cargar.php');
    page_require_level(2);
    $groups = find_all('grupo_usuario');
?>
<?php
  if(isset($_POST['add_user'])){

		$req_fields = array('nombre','usuario','email','direccion','contraseña');
		validate_fields($req_fields);

   if(empty($errors)){
           $name   = remove_junk($db->escape($_POST['nombre']));
       $nombre_usuario   = remove_junk($db->escape($_POST['usuario']));
			 $email   = remove_junk($db->escape($_POST['email']));
			 $direccion   = remove_junk($db->escape($_POST['direccion']));
			 $password   = remove_junk($db->escape($_POST['contraseña']));
       
       $password = sha1($password);
        $query = "INSERT INTO usuarios (";
        $query .="name,nombre_usuario,password,nivel_usuario,estado";
        $query .=") VALUES (";
        $query .=" '{$name}', '{$nombre_usuario}', '{$password}', '3','1'";
        $query .=")";

        $consu=$db->query($query);

        //--------------------------------------------------se abre conexion-----------------------------------------------------

        $servername = "localhost";
        $database = "basenueva123";
        $user = "josue";
        $password = "legolas13";
        // Create connection
        $conn = mysqli_connect($servername, $user, $password, $database);

         $idDireccion=mysqli_query($conn,"SELECT MAX(id) FROM usuarios ");
         if ($row = mysqli_fetch_row($idDireccion)) {
            $id = trim($row[0]);
         }
         //echo $id;

          mysqli_close($conn);

//-------------------------------------------------------------------------------------------------------------------------------------
        $sql="INSERT INTO datospersonales(email,direccion,usuarios_id) VALUES ('$_POST[email]','$_POST[direccion]',$id)";

        $db->query($sql);
        if($consu){
          $session->msg('s'," Cuenta de usuario ha sido creada");
          redirect('factura.php', false);
        } else {
          //failed
          $session->msg('d',' No se pudo crear la cuenta.');
          redirect('factura.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('factura.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>
	<div class="modal fade" id="nuevoCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo cliente</h4>
		  </div>
		  <div class="modal-body">
			<form method="post" action="usuarios.php" class="clearfix">
	
        <div class="form-group">
              <label for="name" class="control-label">Nombre</label>
              <input type="name" class="form-control" name="nombre" placeholder="Nombre completo" required>
				</div>
				<div class="form-group">
              <label for="name" class="control-label">Usuario</label>
              <input type="name" class="form-control" name="usuario" required>
				</div>
				<div class="form-group">
              <label for="name" class="control-label">Correo</label>
              <input type="email" class="form-control" name="email" required>
				</div>
				<div class="form-group">
              <label for="name" class="control-label">Direccion</label>
              <input type="name" class="form-control" name="direccion" required>
				</div>
				<div class="form-group">
              <label for="name" class="control-label">Contraseña</label>
              <input type="password" class="form-control" name="contraseña" required>
				</div>
				
			 
			 
			 
			
		  </div>
		  <div class="modal-footer">
			<div class="form-group clearfix">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>				
			<button type="submit" name="add_user" class="btn btn-primary">Guardar</button>
            </div>
		
		  </div>
		  </form>
		</div>
	  </div>
	</div>
