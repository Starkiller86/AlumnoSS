function valida(formulario) {
	if(formulario.nombre_proyecto.value.length == 0) {
		jAlert('Debe ingresar el nombre del proyecto.', 'Error')
		return false
	}
	if(formulario.area.value == 0) {
		jAlert('Debe elegir el area donde se realizar\xE1 el proyecto.', 'Error')
		return false
	}
	if(formulario.lugares.value.length == 0) {
		jAlert('Debe ingresar cu\xE1ntos alumnos son requeridos para el proyecto.', 'Error')
		return false
	}
}