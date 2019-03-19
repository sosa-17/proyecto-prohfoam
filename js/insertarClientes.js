$("#btn-guardar").click(function(){
	var parametros= "txt-usuario_id="+$("#txt-usuario_id").val()+"&"+ 
					"txt-name="+$("#txt-name").val()+"&"+
					"txt-nombre_usuario="+$("#txt-nombre_usuario").val()+"&"+
					"txt-password="+$("#txt-password").val()+"&"+
					"txt-nivel_usuario="+$("#txt-nivel_usuario").val()+"&"+
					"slc-estado="+$("#slc-estado").val()+"&"+
					"txt-ultimo_acceso="+$("#txt-ultimo_acceso").val();
	alert(parametros);
	$.ajax({
		url:"ajax/gestion-clientes.php?accion=guardar",
		data:parametros,
		method:"POST",
		success:function(respuesta){
			$("#").html(respuesta);
		},
		error:function(e){
			alert("Error: " + e);
		}
	});
});