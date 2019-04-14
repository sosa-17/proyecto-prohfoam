<?php
  ob_start();
  require_once('includes/cargar.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>

<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
<div class="limiter">
    <div class="container-login100">
      <div class="login100-more" style="background-image: url('images/bg-01.jpg');"></div>

      <div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50 col-sm-12 col-md-12 col-lg-3 col-xl-3">
        <form class="login100-form validate-form" action="auth.php" method="post">
          <span class="login100-form-title p-b-59">
            Iniciar Sesion
          </span>
                     


          <div class="wrap-input100 validate-input" data-validate="nombre_usuario is required">
            <span class="label-input100">Usuario</span>
            <input class="input100" type="text" name="nombre_usuario" placeholder="nombre_usuario...">
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 validate-input" data-validate = "Password is required">
            <span class="label-input100">clave</span>
            <input class="input100" type="password" name="password" placeholder="Password" required>
            <span class="focus-input100"></span>
          </div>

          <div class="container-login100-form-btn center">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button class="login100-form-btn">
                Iniciar sesion
              </button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
<?php include_once('layouts/footer.php'); ?>
