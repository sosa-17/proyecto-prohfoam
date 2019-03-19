

<?php
$servername = "localhost";
$database = "basenueva123";
$username = "josue";
$password = "legolas13";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
 //Archivo verifica que el usario que intenta acceder a la URL esta logueado
  /*Inicia validacion del lado del servidor*/
  if (empty($_POST['full-name'])) {
           $errors[] = "Nombre vacío";
        } else if (!empty($_POST['full-name'])){
    /* Connect To Database*/
   //Contiene funcion que conecta a la base de datos
    // escaping, additionally removing everything that could be (html/javascript-) code
    $name   = $_POST['full-name'];
       $nombre_usuario   = $_POST['nombre_usuario'];
       $password   = $_POST['password'];
       //$nivel_usuario = (int)$db->escape($_POST['level']);
       $password = sha1($password);
        $query = "INSERT INTO usuarios (name,nombre_usuario,password,nivel_usuario,estado) VALUES ('$name','$nombre_usuario','$password',3,1)";
        
        $consu=mysqli_query($conn,$query);
$iddireccion=mysqli_query($conn,"SELECT MAX(id) FROM usuarios");
if ($row = mysqli_fetch_row($iddireccion)) {
$id = trim($row[0]);
}
          
          
          //$id=(int)$id;
        $sqli="INSERT INTO datospersonales(email,direccion,usuarios_id) VALUES ('$_POST[email]','$_POST[direccion]','$id')";

        mysqli_query($conn,$sqli);

      if ($consu){
        
        $s[] = "Cliente ha sido ingresado satisfactoriamente.";
      } else{
        
        $errors[]= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($conn);
      }
    } else {
      
      $errors[]= "Error desconocido.";
    }
    $_POST['full-name']="";
    mysqli_close($conn);
    if (isset($errors)){
      
      ?>
      <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><?php var_dump($errors); ?></strong> <!--PRUEBO CON VAR DUMP QUE ME TIRE QUE HAY DENTRO-->
          <?php
            foreach ($errors as $error) {
                echo $error;
                $enviar=$error;
              }
              header("location: ../factura.php?b=$enviar");
            ?>
      </div>
      <?php
      }
      if (isset($s)){
        
        ?>
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>¡Bien hecho!</strong>
            <?php
              foreach ($s as $message) {
                  echo $message;
                  $enviar=$message;

                }
                 header("location: ../factura.php?a=$enviar");
              ?>
        </div>
        <?php

      }

?>