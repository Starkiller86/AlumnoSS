function valida(formulario) {
	if(formulario.nuevo.value.length == 0) {
		jAlert('Debe ingresar un comentario.', 'Error')
		return false
	}
}