<?php
  require_once('includes/cargar.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $categorie = find_by_id('categorias',(int)$_GET['id']);
  if(!$categorie){
    $session->msg("d","ID de la categoría falta.");
    redirect('categoria.php');
  }
?>
<?php
  $delete_id = delete_by_id('categorias',(int)$categorie['id']);
  if($delete_id){
      $session->msg("s","Categoría eliminada");
      redirect('categoria.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('categoria.php');
  }
?>
