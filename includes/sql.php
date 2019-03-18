<?php
  require_once('cargar.php');

/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/*--------------------------------------------------------------*/
function find_all($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table));
   }
}

/*-------------------------------------------------------------------*/
/*funcion para actualizar los campos de datospersonales cuando se edita un usuario*/
/*-------------------------------------------------------------------*/

function datos($id) {
   global $db;
   $idu = (int)$id;
   $sql = $db->query("SELECT id,email,direccion FROM datospersonales WHERE usuarios_id=$idu LIMIT 1");
   if($result = $db->fetch_assoc($sql))
   {
     return $result;
   }
   else 
     return null;

}

/*-------------------------------------------------------------------*/
/*funcion para optener el maximo id de usuarios*/
/*-------------------------------------------------------------------*/

function maxid() {
   global $db;
   $sql = $db->query("SELECT MAX(id) AS id FROM usuarios");
   if($result = $db->fetch_assoc($sql))
   {
     return $result;
   }
}


/*--------------------------------------------------------------*/
/* Function for Perform queries
/*--------------------------------------------------------------*/
function find_by_sql($sql)
{
  global $db;
  $result = $db->query($sql);
  $result_set = $db->while_loop($result);
 return $result_set;
}
/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_id($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}
/*--------------------------------------------------------------*/
/* Function for Delete data from table by id
/*--------------------------------------------------------------*/
function delete_by_id($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE id=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}
/*--------------------------------------------------------------*/
/* Function for Count id  By table name
/*--------------------------------------------------------------*/

function count_by_id($table){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table);
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}
/*--------------------------------------------------------------*/
/* Determine if database table exists
/*--------------------------------------------------------------*/
function tableExists($table){
  global $db;
  $table_exit = $db->query('SHOW TABLES FROM '.DB_NAME.' LIKE "'.$db->escape($table).'"');
      if($table_exit) {
        if($db->num_rows($table_exit) > 0)
              return true;
         else
              return false;
      }
  }
 /*--------------------------------------------------------------*/
 /* Login with the data provided in $_POST,
 /* coming from the login form.
/*--------------------------------------------------------------*/
  function authenticate($nombre_usuario='', $password='') {
    global $db;
    $nombre_usuario = $db->escape($nombre_usuario);
    $password = $db->escape($password);
    $sql  = sprintf("SELECT id,nombre_usuario,password,nivel_usuario FROM usuarios WHERE nombre_usuario ='%s' LIMIT 1", $nombre_usuario);
    $result = $db->query($sql);
    if($db->num_rows($result)){
      $user = $db->fetch_assoc($result);
      $password_request = sha1($password);
      if($password_request === $user['password'] ){
        return $user['id'];
      }
    }
   return false;
  }
  /*--------------------------------------------------------------*/
  /* Login with the data provided in $_POST,
  /* coming from the login_v2.php form.
  /* If you used this method then remove authenticate function.
 /*--------------------------------------------------------------*/
   function authenticate_v2($nombre_usuario='', $password='') {
     global $db;
     $nombre_usuario = $db->escape($nombre_usuario);
     $password = $db->escape($password);
     $sql  = sprintf("SELECT id,nombre_usuario,password,nivel_usuario FROM usuarios WHERE nombre_usuario ='%s' LIMIT 1", $nombre_usuario);
     $result = $db->query($sql);
     if($db->num_rows($result)){
       $user = $db->fetch_assoc($result);
       $password_request = sha1($password);
       if($password_request === $user['password'] ){
         return $user;
       }
     }
    return false;
   }


  /*--------------------------------------------------------------*/
  /* Find current log in user by session id
  /*--------------------------------------------------------------*/
  function current_user(){
      static $current_user;
      global $db;
      if(!$current_user){
         if(isset($_SESSION['id'])):
             $user_id = intval($_SESSION['id']);
             $current_user = find_by_id('usuarios',$user_id);
        endif;
      }
    return $current_user;
  }
  /*--------------------------------------------------------------*/
  /* Find all user by
  /* Joining usuarios table and user gropus table
  /*--------------------------------------------------------------*/
  function find_all_user(){
      global $db;
      $results = array();
      $sql = "SELECT u.id,u.name,u.nombre_usuario,u.nivel_usuario,u.estado,u.ultimo_acceso,";
      $sql .="g.nombre_grupo ";
      $sql .="FROM usuarios u ";
      $sql .="LEFT JOIN grupo_usuario g ";
      $sql .="ON g.nivel_grupo=u.nivel_usuario ORDER BY u.name ASC";
      $result = find_by_sql($sql);
      return $result;
  }

  function find_all_users(){
      global $db;
      $results = array();
      $sql = "SELECT u.id,u.name,u.nombre_usuario,u.nivel_usuario,u.estado,u.ultimo_acceso,";
      $sql .="g.nombre_grupo, ";
      $sql .="d.email, d.direccion ";
      $sql .="FROM usuarios u ";
      $sql .="LEFT JOIN grupo_usuario g ";
      $sql .="ON g.nivel_grupo=u.nivel_usuario ";
      $sql .="LEFT JOIN datospersonales d ";
      $sql .="ON u.id=d.usuarios_id ORDER BY u.name ASC";
      $result = find_by_sql($sql);
      return $result;
  }
  /*--------------------------------------------------------------*/
  /* Function to update the last log in of a user
  /*--------------------------------------------------------------*/

 function updateLastLogIn($user_id)
	{
		global $db;
    $date = make_date();
    $sql = "UPDATE usuarios SET ultimo_acceso='{$date}' WHERE id ='{$user_id}' LIMIT 1";
    $result = $db->query($sql);
    return ($result && $db->affected_rows() === 1 ? true : false);
	}

  /*--------------------------------------------------------------*/
  /* Find all Group name
  /*--------------------------------------------------------------*/
  function find_by_groupName($val)
  {
    global $db;
    $sql = "SELECT nombre_grupo FROM grupo_usuario WHERE nombre_grupo = '{$db->escape($val)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Find group level
  /*--------------------------------------------------------------*/
  function find_by_groupLevel($level)
  {
    global $db;
    $sql = "SELECT nivel_grupo FROM grupo_usuario WHERE nivel_grupo = '{$db->escape($level)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Function for cheaking which user level has access to page
  /*--------------------------------------------------------------*/
   function page_require_level($require_level){
     global $session;
     $current_user = current_user();
     $login_level = find_by_groupLevel($current_user['nivel_usuario']);
     //if user not login
     if (!$session->isUserLoggedIn(true)):
            $session->msg('d','Por favor Iniciar sesión...');
            redirect('login.php', false);
      //if Group estado Deactive
     elseif($login_level['estado_grupo'] === '0'):
           $session->msg('d','Este nivel de usaurio esta inactivo!');
           redirect('home.php',false);
      //cheackin log in User level and Require level is Less than or equal to
     elseif($current_user['nivel_usuario'] <= (int)$require_level):
              return true;
      else:
            $session->msg("d", "¡Lo siento!  no tienes permiso para ver la página.");
            redirect('home.php', false);
        endif;

     }
   /*--------------------------------------------------------------*/
   /* Function for Finding all product name
   /* JOIN with categorie  and media database table
   /*--------------------------------------------------------------*/
  function join_product_table(){
     global $db;
     $sql  =" SELECT p.id,p.name,p.cantidad,p.precio_compra,p.precio_venta,p.media_id,p.date,c.name";
    $sql  .=" AS categorie,m.file_name AS image";
    $sql  .=" FROM productos p";
    $sql  .=" LEFT JOIN categorias c ON c.id = p.categoria_id";
    $sql  .=" LEFT JOIN media m ON m.id = p.media_id";
    $sql  .=" ORDER BY p.id ASC";
    return find_by_sql($sql);

   }
  /*--------------------------------------------------------------*/
  /* Function for Finding all product name
  /* Request coming from ajax.php for auto suggest
  /*--------------------------------------------------------------*/

   function find_product_by_title($product_name){
     global $db;
     $p_name = remove_junk($db->escape($product_name));
     $sql = "SELECT name FROM productos WHERE name like '%$p_name%' LIMIT 5";
     $result = find_by_sql($sql);
     return $result;
   }

  /*--------------------------------------------------------------*/
  /* Function for Finding all product info by product title
  /* Request coming from ajax.php
  /*--------------------------------------------------------------*/
  function find_all_product_info_by_title($title){
    global $db;
    $sql  = "SELECT * FROM productos ";
    $sql .= " WHERE name ='{$title}'";
    $sql .=" LIMIT 1";
    return find_by_sql($sql);
  }

  /*--------------------------------------------------------------*/
  /* Function for Update product cantidad
  /*--------------------------------------------------------------*/
  function update_product_cant($cant,$p_id){
    global $db;
    $cant = (int) $cant;
    $id  = (int)$p_id;
    $sql = "UPDATE productos SET cantidad=cantidad -'{$cant}' WHERE id = '{$id}'";
    $result = $db->query($sql);
    return($db->affected_rows() === 1 ? true : false);

  }
  /*--------------------------------------------------------------*/
  /* Function for Display Recent product Added
  /*--------------------------------------------------------------*/
 function find_recent_product_added($limit){
   global $db;
   $sql   = " SELECT p.id,p.name,p.precio_venta,p.media_id,c.name AS categorie,";
   $sql  .= "m.file_name AS image FROM productos p";
   $sql  .= " LEFT JOIN categorias c ON c.id = p.categoria_id";
   $sql  .= " LEFT JOIN media m ON m.id = p.media_id";
   $sql  .= " ORDER BY p.id DESC LIMIT ".$db->escape((int)$limit);
   return find_by_sql($sql);
 }
 /*--------------------------------------------------------------*/
 /* Function for Find Highest saleing Product
 /*--------------------------------------------------------------*/
 function find_higest_saleing_product($limit){
   global $db;
   $sql  = "SELECT p.name, COUNT(s.producto_id) AS totalSold, SUM(s.cant) AS totalcant";
   $sql .= " FROM ventas s";
   $sql .= " LEFT JOIN productos p ON p.id = s.producto_id ";
   $sql .= " GROUP BY s.producto_id";
   $sql .= " ORDER BY SUM(s.cant) DESC LIMIT ".$db->escape((int)$limit);
   return $db->query($sql);
 }
 /*--------------------------------------------------------------*/
 /* Function for find all ventas
 /*--------------------------------------------------------------*/
 function find_all_sale(){
   global $db;
   $sql  = "SELECT s.id,s.cant,s.precio,s.date,p.name";
   $sql .= " FROM ventas s";
   $sql .= " LEFT JOIN productos p ON s.producto_id = p.id";
   $sql .= " ORDER BY s.date DESC";
   return find_by_sql($sql);
 }
 /*--------------------------------------------------------------*/
 /* Function for Display Recent sale
 /*--------------------------------------------------------------*/
function find_recent_sale_added($limit){
  global $db;
  $sql  = "SELECT s.id,s.cant,s.precio,s.date,p.name";
  $sql .= " FROM ventas s";
  $sql .= " LEFT JOIN productos p ON s.producto_id = p.id";
  $sql .= " ORDER BY s.date DESC LIMIT ".$db->escape((int)$limit);
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate ventas report by two dates
/*--------------------------------------------------------------*/
function find_sale_by_dates($start_date,$end_date){
  global $db;
  $start_date  = date("Y-m-d", strtotime($start_date));
  $end_date    = date("Y-m-d", strtotime($end_date));
  $sql  = "SELECT s.date, p.name,p.precio_venta,p.precio_compra,";
  $sql .= "COUNT(s.producto_id) AS total_records,";
  $sql .= "SUM(s.cant) AS total_ventas,";
  $sql .= "SUM(p.precio_venta * s.cant) AS total_saleing_precio,";
  $sql .= "SUM(p.precio_compra * s.cant) AS total_buying_precio ";
  $sql .= "FROM ventas s ";
  $sql .= "LEFT JOIN productos p ON s.producto_id = p.id";
  $sql .= " WHERE s.date BETWEEN '{$start_date}' AND '{$end_date}'";
  $sql .= " GROUP BY DATE(s.date),p.name";
  $sql .= " ORDER BY DATE(s.date) DESC";
  return $db->query($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Daily ventas report
/*--------------------------------------------------------------*/
function  dailyventas($year,$month){
  global $db;
  $sql  = "SELECT s.cant,";
  $sql .= " DATE_FORMAT(s.date, '%Y-%m-%e') AS date,p.name,";
  $sql .= "SUM(p.precio_venta * s.cant) AS total_saleing_precio";
  $sql .= " FROM ventas s";
  $sql .= " LEFT JOIN productos p ON s.producto_id = p.id";
  $sql .= " WHERE DATE_FORMAT(s.date, '%Y-%m' ) = '{$year}-{$month}'";
  $sql .= " GROUP BY DATE_FORMAT( s.date,  '%e' ),s.producto_id";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Monthly ventas report
/*--------------------------------------------------------------*/
function  monthlyventas($year){
  global $db;
  $sql  = "SELECT s.cant,";
  $sql .= " DATE_FORMAT(s.date, '%Y-%m-%e') AS date,p.name,";
  $sql .= "SUM(p.precio_venta * s.cant) AS total_saleing_precio";
  $sql .= " FROM ventas s";
  $sql .= " LEFT JOIN productos p ON s.producto_id = p.id";
  $sql .= " WHERE DATE_FORMAT(s.date, '%Y' ) = '{$year}'";
  $sql .= " GROUP BY DATE_FORMAT( s.date,  '%c' ),s.producto_id";
  $sql .= " ORDER BY date_format(s.date, '%c' ) ASC";
  return find_by_sql($sql);
}

?>
