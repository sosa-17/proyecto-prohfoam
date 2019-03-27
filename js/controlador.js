
$(function() {
  $("#nombre_cliente").autocomplete({
    source: "ajax/autocompletar.php",
    minLength: 2,
    select: function(event, ui) {
      event.preventDefault();
      $('#id_cliente').val(ui.item.id_cliente);
      $('#nombre_cliente').val(ui.item.nombre_cliente);
      $('#tel1').val(ui.item.telefono_cliente);
      $('#mail').val(ui.item.email_cliente);
                      
      
     }
  });
   
  
});

$("#nombre_cliente" ).on( "keydown", function( event ) {
  if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
  {
    $("#id_cliente" ).val("");
    $("#tel1" ).val("");
    $("#mail" ).val("");
            
  }
  if (event.keyCode==$.ui.keyCode.DELETE){
    $("#nombre_cliente" ).val("");
    $("#id_cliente" ).val("");
    $("#tel1" ).val("");
    $("#mail" ).val("");
  }
});	;


