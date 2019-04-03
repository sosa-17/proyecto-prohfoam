<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	 ob_start();
	session_start();
	/* Connect To Database*/
	include("../../config/db.php");
	include("../../config/conexion.php");
	$session_id= session_id();
	$sql_count=mysqli_query($con,"select * from tmp where session_id='".$session_id."'");
	$count=mysqli_num_rows($sql_count);
	if ($count==0)
	{
	echo "<script>alert('No hay productos agregados a la cotizacion')</script>";
	echo "<script>window.close();</script>";
	exit;
	}

	require_once(dirname(__FILE__).'/../html2pdf.class.php');
		
	//Variables por GET
	$proveedor=intval($_GET['proveedor']);
	$vendedor=intval($_GET['vendedor']);
	$condiciones=mysqli_real_escape_string($con,(strip_tags($_REQUEST['condiciones'], ENT_QUOTES)));
	$comentarios=mysqli_real_escape_string($con,(strip_tags($_REQUEST['comentarios'], ENT_QUOTES)));
	//Fin de variables por GET
	$sql=mysqli_query($con, "select LAST_INSERT_ID(numero) as last from pedidos order by id_pedido desc limit 0,1 ");
	$rw=mysqli_fetch_array($sql);
	$numero_pedido=$rw['last']+1;	
	$perfil=mysqli_query($con,"select * from usuarios u inner join datospersonales d on u.id=d.usuarios_id
                                     where u.id='$vendedor' limit 0,1");//Obtengo los datos de la emprea
	$rw_perfil=mysqli_fetch_array($perfil);
	
	$sql_vendedor=mysqli_query($con,"select * from usuarios u inner join datospersonales d on u.id=d.usuarios_id
                                     where u.id='$proveedor' limit 0,1");//Obtengo los datos del proveedor
	$rw_vendedor=mysqli_fetch_array($sql_vendedor);
    // get the HTML
    
     include(dirname('__FILE__').'/res/pedido_html.php');
    $content = ob_get_clean();

    try
    {
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output('Cotizacion.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
    
