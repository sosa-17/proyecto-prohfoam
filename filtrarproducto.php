<?php

  $page_title = 'Filtrar producto';
  require_once('includes/cargar.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $productos = join_product_table();
  $all_categorias = find_all('categorias');
  $all_photo = find_all('media');
  $all_categoriesid = find_all('id');




  // Checkin What level user has permission to view this page
   page_require_level(2);
  $products = join_product_table();
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         
           <form method="post" action="filtrarproducto.php">
              <div class="col-md-6">
                 <select class="form-control" name="producto-categoria">
                   <option value="">Selecciona una categoría</option>
                 <?php  foreach ($all_categorias as $cat): ?>
                   <option value="<?php echo $cat['name'] ?>">
                     <?php echo $cat['name'] ?></option>
                 <?php endforeach; ?>
                 </select>
               </div>
               <div class="col-md-6">
                 <button type="submit" name="buscar" class="btn btn-primary">Buscar</button> 
               </div>
             </div>
           </form>



        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Imagen</th>
                <th> Descripción </th>
                <th class="text-center" style="width: 10%;"> Categoría </th>
                <th class="text-center" style="width: 10%;"> Stock </th>
                <th class="text-center" style="width: 10%;"> Precio de compra </th>
                <th class="text-center" style="width: 10%;"> Precio de venta </th>
                <th class="text-center" style="width: 10%;"> Agregado </th>
                <th class="text-center" style="width: 100px;"> Acciones </th>
              </tr>
            </thead>
            <tbody>
              <?php if(isset($_POST['buscar'])): ?>
                
              <?php foreach ($productos as $product):?>
                
              <?php if($product['categorie']==$_POST['producto-categoria']): ?>

              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td>
                  <?php if($product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                <?php endif; ?>
                </td>
                <td> <?php echo remove_junk($product['name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['cantidad']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['precio_compra']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['precio_venta']); ?></td>
                <td class="text-center"> <?php echo read_date($product['date']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="editar_producto.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                     <a href="eliminar_producto.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
              <?php endif; ?>
             <?php endforeach; ?>
             <?php endif; ?>
            </tbody>
            
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>