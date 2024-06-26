function valida(formulario) {
	if(formulario.id.value == 0) {
		jAlert('Debe seleccionar un alumno.', 'Error')
		return false
	}
	if(formulario.f_date1.value.length == 0) {
		jAlert('Debe seleccionar la fecha de inicio.', 'Error')
		return false
	}
	if(formulario.f_date2.value.length == 0) {
		jAlert('Debe seleccionar la fecha t\xE9rmino.', 'Error')
		return false
	}
}