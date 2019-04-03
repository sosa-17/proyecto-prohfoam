<?php
    require_once('includes/sql.php');
    $sql="SELECT name,id FROM Categorias";
    $resultado=find_by_sql($sql);
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
          <?php foreach($resultado as $resu): ?>
            <?php if($resu['id'] === '1'): ?>
              <a class="list-group-item" href="salaCli.php"><?php echo $resu['name']; ?></a>
            <?php endif;?>
            <?php if($resu['id'] === '2'): ?>
              <a class="list-group-item" href="dormitorioCli.php"><?php echo $resu['name']; ?></a>
            <?php endif;?>
            <?php if($resu['id'] === '3'): ?>
              <a class="list-group-item" href="oficinaCli.php"><?php echo $resu['name']; ?></a>
            <?php endif;?>
          <?php endforeach;?>
        </div>
      </div>
   <div class="col-lg-9">
      <br/>
     
    <div class="row" id="div-categoriadormitorio">
          

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