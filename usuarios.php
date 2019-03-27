<?php
  $page_title = 'Lista de usuarios';
  require_once('includes/cargar.php');
?>
<?php
// Checkin What level user has permission to view this page
 page_require_level(2);
//pull out all user form database
 $all_usuarios = find_all_user();

?>
<?php 
      include("modal/registro_clientes.php");
?>
<?php
  if(isset($_POST['add_user'])){

		$req_fields = array('nombre','usuario','email','direccion','contraseña','estado' );
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

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Usuarios</span>
       </strong>
         <a href="agregar_usuario.php" class="btn btn-info pull-right">Agregar usuario</a>
      </div>
     <div class="panel-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th>Nombre </th>
            <th>Usuario</th>
            <th class="text-center" style="width: 15%;">Rol de usuario</th>
            <th class="text-center" style="width: 10%;">Estado</th>
            <th style="width: 20%;">Último login</th>
            <th class="text-center" style="width: 100px;">Acciones</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($all_usuarios as $a_user): ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td><?php echo remove_junk(ucwords($a_user['name']))?></td>
           <td><?php echo remove_junk(ucwords($a_user['nombre_usuario']))?></td>
           <td class="text-center"><?php echo remove_junk(ucwords($a_user['nombre_grupo']))?></td>
           <td class="text-center">
           <?php if($a_user['estado'] === '1'): ?>
            <span class="label label-primary"><?php echo "Activo"; ?></span>
          <?php else: ?>
            <span class="label label-danger"><?php echo "Inactivo"; ?></span>
          <?php endif;?>
           </td>
           <td><?php echo read_date($a_user['ultimo_acceso'])?></td>
           <td class="text-center">
             <div class="btn-group">
                <a href="editar_usuario.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Editar">
                  <i class="glyphicon glyphicon-pencil"></i>
               </a>
                <a href="eliminar_usuario.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
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
