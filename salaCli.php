<?php
  $page_title = 'Home Page';
  require_once('includes/cargar.php');
  if (!$session->isUserLoggedIn(true)) { redirect('login.php', false);}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Catalogo PROHFOAM</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/shop-homepage.css" rel="stylesheet">
</head>
<body>
  <?php include_once('layouts/header.php'); ?>
<div class="container">
    <div class="row">
      <div class="col-lg-3">
        <h1 class="my-4">Catalogo</h1>
        <div class="list-group">
          <a class="list-group-item" href="salaCli.php">Mueble Dormitorio</a>
          <a class="list-group-item" href="oficinaCli.php">Mueble Sala</a>
          <a class="list-group-item" href="dormitorioCli.php">Mueble Ofocina</a>
        </div>
      </div>
      
   <div class="col-lg-9">
   </br>
    <div class="row" id="div-categoriasala">
          
            
          
           
          
          </div>
        </div>
  </div>
</div>  
</div>
<br/>
<br/>

 </body>
 <script src="vendor/jquery/jquery.min.js"></script>
 <script src="css/bootstrap.bundle.min.js"></script>
 <script src="js/imagenes.js"></script>
   
</html>
<?php include_once('layouts/footer.php'); ?>