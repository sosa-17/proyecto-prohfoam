<?php
  $page_title = 'Home Page';
  require_once('includes/cargar.php');
  if (!$session->isUserLoggedIn(true)) { redirect('login.php', false);}
?>
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
  
  <script src="js/jquery.min.js"></script>
  <script src="vendor/jquery/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="img/catalogo/thumbnails/1.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="img/catalogo/thumbnails/2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="img/catalogo/thumbnails/3.jpg" alt="Third slide">
            </div>
			<div class="carousel-item">
              <img class="d-block img-fluid" src="img/catalogo/thumbnails/4.jpg" alt="fourth slide">
            </div>
			<div class="carousel-item">
              <img class="d-block img-fluid" src="img/catalogo/thumbnails/5.jpg" alt="fifth slide">
            </div>
			<div class="carousel-item">
              <img class="d-block img-fluid" src="img/catalogo/thumbnails/6.jpg" alt="sixth slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        
        <div class="row" id=div-imagenes>
          
           
          </div> <!-- JELSYN... EN ESTE DIV SE IMPRIMEN LAS IMAGENES. IR A LAS CARPETA js/imagenes.js 3-04-19 10pm-->
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
<br>
<br>
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Ingeniera en Sistemas UNAH 2019</p>
    </div>
  </footer>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="css/bootstrap.bundle.min.js"></script>
  <script src="js/imagenes.js"></script>


</body>

</html>
<?php include_once('layouts/footer.php'); ?>