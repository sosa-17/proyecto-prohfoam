<?php
if (isset($_GET['term'])){
	include ('../class/class-conexion.php');
	$conexion  = new Conexion();
$return_arr = array();
/* If connection to database, run sql statement. */
if ($conexion)
{
	
	$fetch = mysqli_query($conexion,"SELECT * FROM usuarios where nombre_usuario like '%" . mysqli_real_escape_string($conexion,($_GET['term'])) . "%' LIMIT 0 ,50"); 
	
	/* Retrieve and store in array the results of the query.*/
	while ($row = mysqli_fetch_array($fetch)) {
		$id_cliente=$row['id_cliente'];
		$row_array['value'] = $row['nombre_cliente'];
		$row_array['id_cliente']=$id_cliente;
		$row_array['nombre_cliente']=$row['nombre_cliente'];
		$row_array['telefono_cliente']=$row['telefono_cliente'];
		$row_array['email_cliente']=$row['email_cliente'];
		array_push($return_arr,$row_array);
    }
	
}

/* Free connection resources. */
mysqli_close($conexion);

/* Toss back results as json encoded array. */
echo json_encode($return_arr);

}
?>