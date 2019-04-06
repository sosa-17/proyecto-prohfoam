//BOTON GUARDAR
$(document).ready(function(){
  $('#btn-enviar').click(function(){
    datos=$('#frmAgregar').serialize();
    //alert(datos);
        $.ajax({
          type:"POST",
          data:datos,
          url:"ajax/gestion-proveedor.php?accion=insertar_proveedor",
          success:function(respuesta){
            //alert(datos);
            //alert("Datos registrados");
            location.href="proveedores.php";
          },error:function(e){      
            alert("Hay un problema");
          }
        });
  });
});
