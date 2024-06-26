function valida(formulario) {
	if(formulario.proyecto.value == 0) {
		jAlert('Debe seleccionar un proyecto.', 'Error')
		return false
	}
	if(formulario.jefe.value.length == 0) {
		jAlert('Debe ingresar el nombre del jefe directo del proyecto.', 'Error')
		return false
	}
	if(formulario.fecha_i.value.length == 0) {
		jAlert('Debe seleccionar la fecha de inicio.', 'Error')
		return false
	}
	if(formulario.fecha_t.value.length == 0) {
		jAlert('Debe seleccionar la fecha de t\xE9rmino.', 'Error')
		return false
	}
	if(formulario.horas.value.length == 0) {
		jAlert('Debe ingresar el n\xFAmero de horas a realizar por el alumno.', 'Error')
		return false
	}
	if(formulario.tipo_horas.value == 0) {
		jAlert('Debe seleccionar el tipo horas para el alumno.', 'Error')
		return false
	}
	if(formulario.tipo_servicio.value == 0) {
		jAlert('Debe seleccionar el tipo de servicio brindado por el alumno.', 'Error')
		return false
	}
}