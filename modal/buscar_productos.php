<?php
  $page_title = 'Agregar venta';
  require_once('includes/cargar.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php

  if(isset($_POST['add-sale'])){
    $req_fields = array('s_id','cantidad','precio','total', 'date' );
    validate_fields($req_fields);
        if(empty($errors)){
          $p_id      = $db->escape((int)$_POST['s_id']);
          $s_cant     = $db->escape((int)$_POST['cantidad']);
          $s_total   = $db->escape($_POST['total']);
          $date      = $db->escape($_POST['date']);
          $s_date    = make_date();

          $sql  = "INSERT INTO ventas (";
          $sql .= " producto_id,cant,precio,date";
          $sql .= ") VALUES (";
          $sql .= "'{$p_id}','{$s_cant}','{$s_total}','{$s_date}'";
          $sql .= ")";

                if($db->query($sql)){
                  update_product_cant($s_cant,$p_id);
                  $session->msg('s',"Venta agregada ");
                  redirect('factura.php', false);
                } else {
                  $session->msg('d','Lo siento, registro falló.');
                  redirect('factura.php', false);
                }
        } else {
           $session->msg("d", $errors);
           redirect('factura.php',false);
        }
  }

?>
<?php include_once('layouts/header.php'); ?>
			<div class="modal fade bs-example-modal-lg" id="agregarProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Buscar productos</h4>
				  </div>
				  <div class="modal-body">
					<form class="form-horizontal">
						<div class="col-sm-6">
			
    <form method="post" action="ajax_producto.php" autocomplete="off" id="sug-form">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="button" id="buscar" class="btn btn-primary">Búsqueda</button>
            </span>
            <input type="text" id="sug_input" class="form-control" name="title"  placeholder="Buscar por el nombre del producto">
         </div>
         <div id="result" class="list-group"></div>
        </div>
    </form>
  </div>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Detalle del Producto</span>
       </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="factura.php">
         <table class="table table-bordered">
           <thead>
            <th> Producto </th>
            <th> Precio </th>
            <th> Cantidad </th>
            <th> Total </th>
            <th> Agregado</th>
            <th> Acciones</th>
           </thead>
             <tbody  id="product_info"> </tbody>
         </table>
			 </form>
			 
      </div>
    </div>
  </div>

</div>
<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		  </div>
					
				  </div>
				</div>
			  </div>
			</div>
	