<?php 
	require_once ("../includes/cargar.php");
	
	$idpedido=$_GET['id_factura'];
	echo $idpedido;
	$actaulizarestado=actualizarestado($idpedido);

	header("Location: ../factura.php");
 ?>