<?php 
  $servername="localhost";
$database="basenueva123";
$username="morazan";
$contra="morazan";
$connn=mysqli_connect($servername,$username,$contra,$database);

 $count=mysqli_query($connn,"SELECT COUNT(*) total FROM pedidos WHERE estado_pedido='0'");
     $fila=mysqli_fetch_assoc($count);
 ?>
<ul>
  <li>
    <a href="admin.php">
      <i class="glyphicon glyphicon-home"></i>
      <span>Panel de control</span>
    </a>
  </li>
  <li>
    <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-user"></i>
      <span>Usuarios y Roles</span>
    </a>
    <ul class="nav submenu">
      <li><a href="grupo.php">Administrar Roles</a> </li>
      <li><a href="usuarios.php">Administrar Usuarios</a> </li>
   </ul>
  </li>
  <li>
    <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-user"></i>
      <span>Clientes</span>
    </a>
    <ul class="nav submenu">
      <li><a href="clientes.php">Administrar Clientes</a> </li>
   </ul>
  </li><li>
    <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-bed"></i>
      <span>Proveedores</span>
    </a>
    <ul class="nav submenu">
      <li><a href="Proveedores.php">Administrar Proveedores</a> </li>
   </ul>
  </li>

  <li>
    <a href="categoria.php" >
      <i class="glyphicon glyphicon-indent-left"></i>
      <span>Categorías</span>
    </a>
  </li>
  <li>
    <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-th-large"></i>
      <span>Productos</span>
    </a>
    <ul class="nav submenu">
       <li><a href="producto.php">Administrar productos</a> </li>
       <li><a href="agregar_producto.php">Agregar productos</a> </li>
   </ul>
  </li>
  <li>
    <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-shopping-cart"></i>
      <span>Facturacion  <?php if ($fila['total']==0) {
      
    }else{  echo "(".$fila['total'].")";} ?></span>
    </a>
    <ul class="nav submenu">
       <li><a href="factura.php">Nueva Factura</a> </li>
      
   </ul>
  </li>
  <li>
    <a href="media.php" >
      <i class="glyphicon glyphicon-picture"></i>
      <span>Media</span>
    </a>
  </li>
  <li>
    <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-th-list"></i>
       <span>Ventas</span>
      </a>
      <ul class="nav submenu">
         <li><a href="venta.php">Administrar ventas</a> </li>
         <li><a href="agregar_venta.php">Agregar venta</a> </li>
     </ul>
  </li>
  <li>
    <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-signal"></i>
       <span>Reporte de ventas</span>
      </a>
      <ul class="nav submenu">
        <li><a href="reporte_ventas.php">Ventas por fecha </a></li>
        <li><a href="ventas_mensuales.php">Ventas mensuales</a></li>
        <li><a href="ventas_diarias.php">Ventas diarias</a> </li>
      </ul>
  </li>
</ul>
