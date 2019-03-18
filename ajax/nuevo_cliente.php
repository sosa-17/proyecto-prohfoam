<?php 
  require_once('../includes/cargar.php');
 ?>

<?php
 //Archivo verifica que el usario que intenta acceder a la URL esta logueado
  /*Inicia validacion del lado del servidor*/
  if (empty($_POST['full-name'])) {
           $errors[] = "Nombre vacío";
        } else if (!empty($_POST['full-name'])){
    /* Connect To Database*/
   //Contiene funcion que conecta a la base de datos
    // escaping, additionally removing everything that could be (html/javascript-) code
    $name   = remove_junk($db->escape($_POST['full-name']));
       $nombre_usuario   = remove_junk($db->escape($_POST['nombre_usuario']));
       $password   = remove_junk($db->escape($_POST['password']));
       //$nivel_usuario = (int)$db->escape($_POST['level']);
       $password = sha1($password);
        $query = "INSERT INTO usuarios (";
        $query .="name,nombre_usuario,password,nivel_usuario,estado";
        $query .=") VALUES (";
        $query .=" '{$name}', '{$nombre_usuario}', '{$password}', '3','1'";
        $query .=")";
        
        $consu=$db->query($query);

          $id = maxid();
          $idu=$id['id'];
          //$id=(int)$id;
        $sql="INSERT INTO datospersonales(email,direccion,usuarios_id) VALUES ('$_POST[email]','$_POST[direccion]','$idu')";

        $db->query($sql);
      if ($consu){
        
        $messages[] = "Cliente ha sido ingresado satisfactoriamente.";
      } else{
        
        $errors[]= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
      }
    } else {
      
      $errors[]= "Error desconocido.";
    }
    
    if (isset($errors)){
      
      ?>
      <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><?php var_dump($errors); ?></strong> <!--PRUEBO CON VAR DUMP QUE ME TIRE QUE HAY DENTRO-->
          <?php
            foreach ($errors as $error) {
                echo $error;
              }
            ?>
      </div>
      <?php
      }
      if (isset($messages)){
        
        ?>
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>¡Bien hecho!</strong>
            <?php
              foreach ($messages as $message) {
                  echo $message;
                }
              ?>
        </div>
        <?php
      }

?>