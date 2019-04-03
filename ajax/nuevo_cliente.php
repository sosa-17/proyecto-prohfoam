
<?php
	require_once ("../includes/login.php");//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
    if (empty($_POST['nombre'])) {
           $errors[] = "Nombre vacío";
        } else if (!empty($_POST['nombre'])){
		/* Connect To Database*/
        
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
       // page_require_level(2);
		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
        $nombreusuario=mysqli_real_escape_string($con,(strip_tags($_POST["usuario"],ENT_QUOTES)));
		$email=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
		$direccion=mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));
		$estado=intval($_POST['estado']);
        $password = $_POST['password'];
        $password = sha1($password);
        $sql = "INSERT INTO usuarios (";
        $sql .="name,nombre_usuario,password,nivel_usuario,estado";
        $sql .=") VALUES (";
        $sql .=" '{$nombre}', '{$nombreusuario}', '{$password}', '3','$estado'";
        $sql .=")";
        
        $query_new_insert = mysqli_query($con,$sql);
        
         $idDireccion=mysqli_query($con,"SELECT MAX(id) FROM usuarios ");
         if ($row = mysqli_fetch_row($idDireccion)) {
            $id = trim($row[0]);
         }

         $sql="INSERT INTO datospersonales(";
         $sql.="email,direccion,usuarios_id";
         $sql.=") VALUES (";
         $sql.="'{$email}','{$direccion}','$id')";
         
        $query_new_insert = mysqli_query($con,$sql);
        
			if ($query_new_insert){
				$messages[] = "Cliente ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
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