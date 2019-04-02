$(document).ready(function(){
  $.ajax({
    url:"ajax/gestion-proveedor.php?accion=obtenerProveedores",
    data:" ",
    method:"POST",
    success:function(respuesta){
      //alert(respuesta);
      $("#div-proveedores").html(respuesta);
    },
    error:function(e){
      //alert("Error "+e);
    }
  });
});
