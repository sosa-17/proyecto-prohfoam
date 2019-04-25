<?php include_once('includes/cargar.php'); ?>
<?php
$req_fields = array('nombre_usuario','password' );
validate_fields($req_fields);
$nombre_usuario = remove_junk($_POST['nombre_usuario']);
$password = remove_junk($_POST['password']);
$servername="localhost";
$database="basenueva123";
$username="morazan";
$contra="morazan";
$connn=mysqli_connect($servername,$username,$contra,$database);

if(empty($errors)){
  $user_id = authenticate($nombre_usuario, $password);
  if($user_id){
    //create session with id
     $session->login($user_id);
    //Update Sign in time
     updateLastLogIn($user_id);
     $session->msg("s", "Bienvenido a PROH-FOAM");
     
     $nivel_usuario=mysqli_query($connn,"SELECT nivel_usuario total FROM usuarios WHERE id='$user_id'");
     $fila=mysqli_fetch_assoc($nivel_usuario);
     if ($fila['total']==1) {
      redirect('admin.php',false); 
     }else if ($fila['total']==2) {
       redirect('pedido.php',false); 
     }else if ($fila['total']==3) {
        redirect('catalogoCliente.php',false); 
     }
  } else {
    $session->msg("d", "Nombre de usuario y/o contraseña incorrecto.");
    redirect('login.php',false);
  }

} else {
   $session->msg("d", $errors);
   redirect('login.php',false);
}

?>
