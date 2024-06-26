function valida(formulario) {
	if(formulario.colegio.value.length == 0) {
		jAlert('Debe ingresar el nombre de la instituci\xF3n.', 'Error')
		return false
	}
}