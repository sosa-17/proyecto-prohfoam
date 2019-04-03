<?php
  require_once('includes/cargar.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $product = find_by_id('productos',(int)$_GET['id']);
  if(!$product){
    $session->msg("d","ID vacío");
    redirect('producto.php');
  }
?>
<?php
  $delete_id = delete_by_id('productos',(int)$product['id']);
  if($delete_id){
      $session->msg("s","Producto eliminado");
      redirect('producto.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('producto.php');
  }
?>
