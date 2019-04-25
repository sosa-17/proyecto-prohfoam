<?php
  require_once('includes/cargar.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
  $delete_id = delete_by_ids('proveedores',(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Proveedor eliminado");
      redirect('Proveedores.php');
  } else {
      $session->msg("d","Se ha producido un error en la eliminación del proveedor");
      redirect('Proveedores.php');
  }
?>