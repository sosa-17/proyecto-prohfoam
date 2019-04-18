<?php
$page_title = 'Mis pedidos';
  require_once('includes/cargar.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
  $id=$_SESSION['id'];
  $id=(int)$id;
   $pedidos=pedidosC($id);

   $horaI=" 00:00:00";
   $horaF=" 23:59:59";

   if (isset($_POST['submit'])) {
     $inicio=$_POST['inicio'].$horaI;
     $final=$_POST['final'].$horaF;
     $resultado=pedidosFecha($inicio,$final,$id);
   }
?>


<?php include_once('layouts/header.php'); ?>

<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="panel">
      <div class="panel-heading">

      </div>
      <div class="panel-body">
          <form class="clearfix" method="post" action="pedidosCliente.php">
            <div class="form-group">
              <label class="form-label">Filtrar pedidos por fecha</label>
                <div class="input-group">
                  <input type="text" class="datepicker form-control" name="inicio" placeholder="From">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-menu-right"></i></span>
                  <input type="text" class="datepicker form-control" name="final" placeholder="To">
                </div>
                <br>
            <center>
              <div class="form-group">
                   <button type="submit" name="submit" class="btn btn-primary">Filtrar</button>
              </div>
            </center>
          </form>
      </div>

    </div>
  </div>

</div>
<br>

<?php if(isset($resultado)): ?>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Historial de pedidos</span>
       </strong>
      </div>
     <div class="panel-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th><center>Fecha</center></th>
            <th><center>comentarios</center></th>
            <th><center>Vendedor</center></th>
            <th><center>total</center></th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($resultado AS $pedi): ?>
          
          <tr>
           <td class="text-center"><?php echo $pedi[0];?></td>
           <td><center><?php echo $pedi[1];?></center></td>
           <td><center><?php echo $pedi[2];?></center></td>
           <td><center><?php echo $pedi[4];?></center></td>
           <td><center><?php echo $pedi[3];?></center></td>
           
          </tr>
        <?php endforeach;?>
       </tbody>
     </table>
     </div>
    </div>
  </div>
</div>

<?php else: ?> 
  <div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Historial de pedidos</span>
       </strong>
      </div>
     <div class="panel-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th><center>Fecha</center></th>
            <th><center>comentarios</center></th>
            <th><center>Vendedor</center></th>
            <th><center>total</center></th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($pedidos AS $pedi): ?>
          
          <tr>
           <td class="text-center"><?php echo $pedi[0];?></td>
           <td><center><?php echo $pedi[1];?></center></td>
           <td><center><?php echo $pedi[2];?></center></td>
           <td><center><?php echo $pedi[4];?></center></td>
           <td><center><?php echo $pedi[3];?></center></td>
           
          </tr>
        <?php endforeach;?>
       </tbody>
     </table>
     </div>
    </div>
  </div>
</div>
<?php endif;?>
<?php include_once('layouts/footer.php'); ?>