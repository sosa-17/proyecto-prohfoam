<?php
  require_once('includes/cargar.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $d_sale = find_by_id('ventas',(int)$_GET['id']);
  if(!$d_sale){
    $session->msg("d","ID vacío.");
    redirect('factura.php');
  }
?>
<?php
  $delete_id = delete_by_id('ventas',(int)$d_sale['id']);
  if($delete_id){
      $session->msg("s","Venta eliminada.");
      redirect('factura.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('factura.php');
  }
?>
