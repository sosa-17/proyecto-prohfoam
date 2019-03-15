//JELSYN 3-04-19 10pm 
$(document).ready(function(){
  $.ajax({
    url:"ajax/gestion-producto.php?accion=obtenerProductoCategoria",
    data:" ",
    method:"POST",
    success:function(respuesta){
      //alert(respuesta);
      $("#div-imagenes1").html(respuesta);
    },
    error:function(e){
      alert("Error "+e);
    }
  });
});




//MOSTRAR DATOS
/*function seleccionarProducto(id_producto){
  alert("Selecciono la aplicacion , "+ id_producto +" hay que obtener la informacion del servidor");
  $.ajax({
    url:"ajax/gestion-producto.php?accion=obtenerProductos",
    data:"id_producto="+id_producto,
    method:"POST",
    dataType:"json",
    success:function(respuesta){
      //alert(respuesta);
      console.log(respuesta);
      //$("#txt-id_producto").val(respuesta.id_producto);
      //$("#txt-name").val(respuesta.name);
      $("#txt-cantidad").val(respuesta.cantidad);
      //$("#txt-precio_compra").val(respuesta.precio_compra);
      //$("#txt-precio_venta").val(respuesta.precio_venta);
      //$("#txt-fecha").val(respuesta.fecha);
      //$("#slc-url-img").val(respuesta.url_img);
     // $("#slc-empresa").val(respuesta.codigo_empresa);
      //$("#slc-tipos-contenidos").val(respuesta.codigo_tipo_contenido);
      //$("#slc-tipos-calificaciones").val(respuesta.codigo_tipo_calificacion);
      

      //Almacenar en un arreglo temporal los valores de la categoria, no
      //se puede utilizar el arreglo directo del JSON porque cada elemento es un objeto.
      //var categorias=[];
      //for (var i =0;i<respuesta.categorias.length;i++){
       // categorias[i]=respuesta.categorias[i].codigo_categoria;
      //}


      //Buscar todos los elementos html en el cual el nombre sea categorias[] y para cada 
      //elemento verificar si el valor esta dentro de la lista retornada por el json
      //en caso de si estar agregar el atributo checked="checked"
      //$("input[name='categorias[]']").map(function(){
        //var indice = categorias.indexOf($(this).val());
        //if (indice>=0){
          //$(this).attr("checked","checked");

        //}
      //});
      //$("#btn-guardar").hide();
      //$("#btn-actualizar").show();
    },
    error:function(err){
      alert("Error: " + err);
      console.log(err);
    }
  });
}*/
