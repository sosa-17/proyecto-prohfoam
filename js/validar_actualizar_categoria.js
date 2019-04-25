$('input').on('input', function(){
  
    $('input').each(function() {
      
      var boton      = $('#add_cat');
      var esta_vacio = $(this).prop('value') === '';
      
      boton.prop('disabled', esta_vacio);  

    });
});

$('button').on('click', function(){  
  alert('Registro guardado con exito!');
});

