<?php
  $page_title = 'Edit sale';
  require_once('includes/cargar.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
$sale = find_by_id('ventas',(int)$_GET['id']);
if(!$sale){
  $session->msg("d","Missing product id.");
  redirect('ventas.php');
}
?>
<?php $product = find_by_id('productos',$sale['producto_id']); ?>
<?php

  if(isset($_POST['update_sale'])){
    $req_fields = array('title','cantidad','precio','total', 'date' );
    validate_fields($req_fields);
        if(empty($errors)){
          $p_id      = $db->escape((int)$product['id']);
          $s_cant     = $db->escape((int)$_POST['cantidad']);
          $s_total   = $db->escape($_POST['total']);
          $date      = $db->escape($_POST['date']);
          $s_date    = date("Y-m-d", strtotime($date));

          $sql  = "UPDATE ventas SET";
          $sql .= " producto_id= '{$p_id}',cant={$s_cant},precio='{$s_total}',date='{$s_date}'";
          $sql .= " WHERE id ='{$sale['id']}'";
          $result = $db->query($sql);
          if( $result && $db->affected_rows() === 1){
                    update_product_cant($s_cant,$p_id);
                    $session->msg('s',"Sale updated.");
                    redirect('agregar_venta.php?id='.$sale['id'], false);
                  } else {
                    $session->msg('d',' Sorry failed to updated!');
                    redirect('ventas.php', false);
                  }
        } else {
           $session->msg("d", $errors);
           redirect('agregar_venta.php?id='.(int)$sale['id'],false);
        }
  }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">

  <div class="col-md-12">
  <div class="panel">
    <div class="panel-heading clearfix">
      <strong>
        <span class="glyphicon glyphicon-th"></span>
        <span>All ventas</span>
     </strong>
     <div class="pull-right">
       <a href="ventas.php" class="btn btn-primary">Show all ventas</a>
     </div>
    </div>
    <div class="panel-body">
       <table class="table table-bordered">
         <thead>
          <th> Product title </th>
          <th> cant </th>
          <th> precio </th>
          <th> Total </th>
          <th> Date</th>
          <th> Action</th>
         </thead>
           <tbody  id="product_info">
              <tr>
              <form method="post" action="editar_venta.php?id=<?php echo (int)$sale['id']; ?>">
                <td id="s_name">
                  <input type="text" class="form-control" id="sug_input" name="title" value="<?php echo remove_junk($product['name']); ?>">
                  <div id="result" class="list-group"></div>
                </td>
                <td id="s_cant">
                  <input type="text" class="form-control" name="cantidad" value="<?php echo (int)$sale['cant']; ?>">
                </td>
                <td id="s_precio">
                  <input type="text" class="form-control" name="precio" value="<?php echo remove_junk($product['precio_venta']); ?>" >
                </td>
                <td>
                  <input type="text" class="form-control" name="total" value="<?php echo remove_junk($sale['precio']); ?>">
                </td>
                <td id="s_date">
                  <input type="date" class="form-control datepicker" name="date" data-date-format="" value="<?php echo remove_junk($sale['date']); ?>">
                </td>
                <td>
                  <button type="submit" name="update_sale" class="btn btn-primary">Update sale</button>
                </td>
              </form>
              </tr>
           </tbody>
       </table>

    </div>
  </div>
  </div>

</div>

<?php include_once('layouts/footer.php'); ?>
