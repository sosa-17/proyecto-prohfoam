$('input').on('input', function(){
  
    $('input').each(function() {
      
      var boton      = $('#btn-enviar');
      var esta_vacio = $(this).prop('value') === '';
      
      boton.prop('disabled', esta_vacio);  

    });
});

$('button').on('click', function(){  
  alert('Registro guardado con exito!');
});

