<?php

	
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$numero_pedido=intval($_GET['id']);
		$del1="delete from pedidos where numero='".$numero_pedido."'";
		$del2="delete from detalle_pedido where numero_pedido='".$numero_pedido."'";
		if ($delete1=mysqli_query($con,$del1) and $delete2=mysqli_query($con,$del2)){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se puedo eliminar los datos
			</div>
			<?php
			
		}
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		  
          $sTable = "pedidos, usuarios";
		 $clientes = "";
		 $clientes.=" WHERE pedidos.id_usuario=usuarios.id";
		if ( $_GET['q'] != "" )
		{
		$clientes.= " and  (usuarios.name like '%$q%' or pedidos.numero like '%$q%')";
			
		}
		
		$clientes.=" order by pedidos.id_pedido desc";

		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $clientes");
		$obtenerrow= mysqli_fetch_array($count_query);
		$numrows = $obtenerrow['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './factura.php';
		//main query to fetch the data
		$sql2="SELECT * FROM  $sTable $clientes LIMIT $offset,$per_page";
		$query2 = mysqli_query($con, $sql2);




		  $sTable = "pedidos, usuarios";
		 $sWhere = "";
		 $sWhere.=" WHERE pedidos.id_vendedor=usuarios.id";
		if ( $_GET['q'] != "" )
		{
		$sWhere.= " and  (usuarios.name like '%$q%' or pedidos.numero like '%$q%')";
			
		}
		
		$sWhere.=" order by pedidos.id_pedido asc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './factura.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			echo mysqli_error($con);
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="default">
					<th>#</th>
					<th>Fecha</th>
					<th>Cliente</th>
					<th>Vendedor</th>
					<th>Estado</th>
					<th class='text-right'>Total</th>
					<th class='text-right'>Acciones</th>
					
				</tr>
				<?php

				while ($row=mysqli_fetch_array($query)){
					if ($obtenerrow=mysqli_fetch_array($query2)) {
						$nombre_cliente=$row['name'];
							//if ($row['nivel_usuario']=='2') {
							$id_pedido=$row['id_pedido'];
						$numero_pedido=$row['numero'];
						$fecha=date("d/m/Y", strtotime($row['fecha']));
						
						$nombre_vendedor=$obtenerrow['name'];
						$estado_pedido=$row['estado_pedido'];
						if ($estado_pedido==1){$text_estado="Pagada";$label_class='label-primary';}
						else{$text_estado="Pendiente";$label_class='label-danger';}
						$total_venta=$row['total_venta'];	
						//1111111111111}
					}
					
						
					?>
					<tr>
						<td><?php echo $numero_pedido; ?></td>
						<td><?php echo $fecha; ?></td>
						<td><?php echo $nombre_vendedor; ?></td>
						<td><?php echo $nombre_cliente; ?></td>
						<td><span class="label <?php echo $label_class;?>"><?php echo $text_estado; ?></span></td>
						<td class='text-right'><?php echo number_format($total_venta,2); ?></td>					
					<td class="text-right">
						<a href="#" class='btn btn-default' title='imprimir factura' onclick="imprimir_factura('<?php echo $id_pedido;?>');"><i class="glyphicon glyphicon-download"></i></a> 
						<a href="#" class='btn btn-default' title='Aprobar factura' onclick="aprobar_pedido('<?php echo $id_pedido;?>');"><i class="glyphicon glyphicon-edit"></i></a> 
						<a href="#" class='btn btn-default' title='Borrar factura' onclick="eliminar('<?php echo $numero_pedido; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
					</td>
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=7><span class="pull-right"><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>

			<?php
		}
	}
?>