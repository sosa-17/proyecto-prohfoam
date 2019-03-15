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
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="login.php">Iniciar Sesión</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.html">Inicio
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Sobre Nosotros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Servicios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" button onclick="location.href='contacto.html'">Contacto</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link js-scroll-trigger" button onclick="location.href='catalogo.php'">Catalogo</a>
			</head>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <h1 class="my-4">Catalogo</h1>
        <div class="list-group">
          <?php foreach($resultado as $resu): ?>
            <?php if($resu['id'] === '1'): ?>
              <a class="list-group-item" href="mueblesala.php"><?php echo $resu['name']; ?></a>
            <?php endif;?>
            <?php if($resu['id'] === '2'): ?>
              <a class="list-group-item" href="muebleoficina.php"><?php echo $resu['name']; ?></a>
            <?php endif;?>
            <?php if($resu['id'] === '3'): ?>
              <a class="list-group-item" href="muebledormitorio.php"><?php echo $resu['name']; ?></a>
            <?php endif;?>
          <?php endforeach;?>
        </div>
      </div>
   <div class="col-lg-9">
      <br/>
      
	  <div class="row" id="div-categoriaoficina">
          
          </div>
        </div>
	</div>
</div>	
 </div>
 <br/>
<br/>
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Ingeniera en Sistemas UNAH 2019</p>
    </div>
  </footer>
 </body>
 <script src="vendor/jquery/jquery.min.js"></script>
 <script src="css/bootstrap.bundle.min.js"></script>
 <script src="js/imagenes.js"></script>
</html>