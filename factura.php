<?php
  $page_title = 'Lista de productos';
  require_once('includes/cargar.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
	$products = join_product_table();
	$all_users = find_all_user();
?>


<?php 
			include("modal/buscar_productos.php");
			include("modal/registro_clientes.php");

	?>
	<?php
	$sales = find_all_factura();
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
        $user = "root";
        $password = "";
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
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
				<strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Facturacion</span>
         </strong>
        </div>
        
				<div class="panel-body">
        	<form class="form-horizontal" role="form" id="datos_factura">
				<div class="form-group row">
				  <label for="nombre_cliente" class="col-md-1 control-label">Cliente</label>
				  <div class="col-md-3">
					  <input type="text" class="form-control input-sm" id="nombre_cliente" placeholder="Selecciona un vendedor" required>
					  <input id="id_cliente" type='hidden'>	
				  </div>
				  <label for="tel1" class="col-md-1 control-label">Teléfono</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-sm" id="tel1" placeholder="Teléfono" readonly>
							</div>
					<label for="mail" class="col-md-1 control-label">Email</label>
							<div class="col-md-3">
								<input type="text" class="form-control input-sm" id="mail" placeholder="Email" readonly>
							</div>
				 </div>
						<div class="form-group row">
							<label for="empresa" class="col-md-1 control-label">Vendedor</label>
							<div class="col-md-3">
								<select class="form-control input-sm" id="id_vendedor" disabled>
								<?php  foreach ($all_users as $usuarios): ?>
                      <option value="<?php echo (int)$user['id'] ?>">
                        <?php echo $user['nombre_usuario'] ?></option>
                    <?php endforeach; ?>
								</select>
							</div>
					
							<label for="tel2" class="col-md-1 control-label">Fecha</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-sm" id="fecha" value="<?php echo date("d/m/Y");?>" readonly>
							</div>
							<label for="email" class="col-md-1 control-label">Pago</label>
							<div class="col-md-3">
								<select class='form-control input-sm' id="condiciones">
									<option value="1">Efectivo</option>
									<option value="2">Cheque</option>
									<option value="3">Transferencia bancaria</option>
									<option value="4">Crédito</option>
								</select>
							</div>
					
							</div>
				
				<div class="col-md-12">
					<div class="pull-right">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoCliente">
						 <span class="glyphicon glyphicon-user"></span> Nuevo cliente
						</button>
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#agregarProducto">
						 <span class="glyphicon glyphicon-search"></span> Agregar productos
						</button>
						<button type="submit" class="btn btn-default">
						  <span class="glyphicon glyphicon-print"></span> Imprimir
						</button>
					</div>	
				</div>
			</form>	
			
		<div id="resultados" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->			
		</div>
	</div>		
		  <div class="row-fluid">
			
			<div class="col-md-12">

<div class="row">
  <div class="col-md-6">

  </div>
</div>
</div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Detalle de Factura</span>
          </strong>
          
        </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Nombre del producto </th>
                <th class="text-center" style="width: 15%;"> Cantidad</th>
                <th class="text-center" style="width: 15%;"> Precio </th>
                <th class="text-center" style="width: 15%;"> SUB-TOTAL </th>
                <th class="text-center" style="width: 100px;"> Acciones </th>
             </tr>
            </thead>
           <tbody>
             <?php 
             $total=0;
             foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td><?php echo remove_junk($sale['name']); ?></td>
               <td class="text-center"><?php echo (int)$sale['cant']; ?></td>
               <td class="text-center"><?php echo remove_junk($sale['precio']); ?></td>
               <td class="text-center"><?php echo $sale['total']; ?></td>
               <td class="text-center">
                  <div class="btn-group">
                     <a href="editar_venta.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-primary btn-xs"  title="Edit" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-edit"></span>
                     </a>
                     <a href="eliminar_venta.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span>
                     </a>
                  </div>
               </td>
             </tr>

             <?php
             
            $total+=$sale['total'];

            endforeach;?>
            <?php
            $impto=($total*0.15);
            $total_pagar=($total+$impto);

    

            ?>
           </tbody>
         </table>
         
         <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 80%;"> SUB-TOTAL </th>
                <th class="text-center"> <?php echo $total; ?></th>
             </tr>
             <tr>
                <th class="text-center" style="width: 75%;"> ISV(%) </th>
                <th class="text-center"> <?php echo  $impto; ?></th>
             </tr>
             <tr>
                <th class="text-center" style="width: 75%;">TOTAL-PAGAR </th>
                <th class="text-center"> <?php echo $total_pagar; ?></th>
             </tr>
            </thead>
        
         </table>
         </div>
        </div>
      </div>
    </div>
  </div>
			
	

			
			</div>	
		 </div>
	</div>
	<hr>

	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="js/functions.js"></script>
	<script type="text/javascript" src="js/facturas.js"></script>
	
  </body>
</html>
  </div>
  <?php include_once('layouts/footer.php'); ?>
