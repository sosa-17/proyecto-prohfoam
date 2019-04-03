<?php
if (isset($_GET['term'])){
include("../../config/db.php");
include("../../config/conexion.php");
$return_arr = array();
/* If connection to database, run sql statement. */
if ($con)
{
	
	$fetch = mysqli_query($con,"SELECT * FROM pedido p inner join usuarios u on p.id_usuario=u.id
                                 inner join datospersonales d on d.usuarios_id=u.id where  like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' LIMIT 0 ,50"); 
	
	/* Retrieve and store in array the results of the query.*/
	while ($row = mysqli_fetch_array($fetch)) {
		$id_cliente=$row['id'];
		$row_array['value'] = $row['name'];
		$row_array['id']=$id_cliente;
		$row_array['name']=$row['name'];
		$row_array['telefono']=$row['telefono'];
		$row_array['emai']=$row['email'];
		array_push($return_arr,$row_array);
    }
	
}

/* Free connection resources. */
mysqli_close($con);

/* Toss back results as json encoded array. */
echo json_encode($return_arr);

}
?>