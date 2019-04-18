


<?php
$page_title = 'Reporte de ventas';
$results = '';
  require_once('includes/cargar.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
   $start_date   = remove_junk($db->escape($_SESSION['i']));
      $end_date     = remove_junk($db->escape($_SESSION['f']));
      $results      = find_sale_by_dates($start_date,$end_date);
?>





<?php

$punt="..a..";

use Dompdf\Adapter\CPDF;
use Dompdf\Dompdf;
use Dompdf\Exception;



require_once 'dompdf/autoload.inc.php';


$car='<html><head><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/></head>
       <body>
       <div class="col-sm-6">
    <div class="page-break">
    <div class="sale-head pull-left">
      <img class="img-responsive" src="img/logofactura.png" width=180px heigth=100px>
      <h1>Reporte de Ventas</h1>
      </div>
       <div class="sale-head pull-right col-sm-6">
           <h1>Fecha:</h1> 
           <strong>';
$car.=$_SESSION['i'].$punt.$_SESSION['f']. '</strong>';
$car.='</div>
        <table class="table table-border">
         <thead>
          <tr>
              <th><center>Fecha</center></th>
              <th><center>Descripción</center></th>
              <th><center>Precio de compra</center></th>
              <th><center>Precio de venta</center></th>
              <th><center>Cantidad total</center></th>
              <th><center>TOTAL</center></th>
          </tr>
        </thead>
        <tbody>';
        foreach($results as $result):
             $car.='<tr>';
             $car.='<td class="">';
             $car.=$result['fecha'];
             $car.='</td>';

             $car.='<td class="desc">
             <h6>';
             $car.=$result['name'];
             $car.='</h6>
             </td>';

             $car.='<td class="text-right">';
             $car.=$result['precio_compra'];
             $car.='</td>';

             $car.='<td class="text-right">';
             $car.=$result['precio_venta'];
             $car.='</td>';

             $car.='<td class="text-right">';
             $car.=$result['total_ventas'];
             $car.='</td>';

             $car.='<td class="text-right"><center>';
             $car.=$result['total_saleing_precio'];
             $car.='</td>';

        endforeach;

        $car.='</tbody>
        <tfoot>
         <tr class="text-right">
           <td colspan="4"></td>
           <td colspan="1"> Total </td>
           <td> $';
        $car.=number_format(@total_precio($results)[0], 2);

        $car.='</td>
         </tr>
         <tr class="text-right">
           <td colspan="4"></td>
           <td colspan="1">Utilidad</td>';

        $car.=number_format(@total_precio($results)[1], 2);
        $car.='</td>
         </tr>
        </tfoot>
      </table>
    </div>';  

$car.='</body></html>';

        $dompdf = new Dompdf();
        $dompdf->load_html($car);//body -> html content which needs to be converted as pdf..
        $dompdf->render();
        $dompdf->stream("reporteVentas.pdf"); //To popup pdf as download
?>