<?php include_once('includes/cargar.php'); ?>
<?php
$req_fields = array('nombre_usuario','password' );
validate_fields($req_fields);
$nombre_usuario = remove_junk($_POST['nombre_usuario']);
$password = remove_junk($_POST['password']);

if(empty($errors)){
  $user_id = authenticate($nombre_usuario, $password);
  if($user_id){
    //create session with id
     $session->login($user_id);
    //Update Sign in time
     updateLastLogIn($user_id);
     $session->msg("s", "Bienvenido a PROH-FOAM");
     redirect('home.php',false);

  } else {
    $session->msg("d", "Nombre de usuario y/o contraseña incorrecto.");
    redirect('login.php',false);
  }

} else {
   $session->msg("d", $errors);
   redirect('login.php',false);
}

?>
