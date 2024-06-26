function valida(formulario) {
	if(formulario.lunes.checked) {
		if(formulario.lunes_e.value.length == 0) {
			jAlert('Debe ingresar la hora de entrada del d\xEDa lunes.', 'Error')
			return false
		}
		if(formulario.lunes_s.value.length == 0) {
			jAlert('Debe ingresar la hora de salida del d\xEDa lunes.', 'Error')
			return false
		}
	}
	if(formulario.martes.checked) {
		if(formulario.martes_e.value.length == 0) {
			jAlert('Debe ingresar la hora de entrada del d\xEDa martes.', 'Error')
			return false
		}
		if(formulario.martes_s.value.length == 0) {
			jAlert('Debe ingresar la hora de salida del d\xEDa martes.', 'Error')
			return false
		}
	}
	if(formulario.miercoles.checked) {
		if(formulario.miercoles_e.value.length == 0) {
			jAlert('Debe ingresar la hora de entrada del d\xEDa mi\xE9rcoles.', 'Error')
			return false
		}
		if(formulario.miercoles_s.value.length == 0) {
			jAlert('Debe ingresar la hora de salida del d\xEDa mi\xE9rcoles.', 'Error')
			return false
		}
	}
	if(formulario.jueves.checked) {
		if(formulario.jueves_e.value.length == 0) {
			jAlert('Debe ingresar la hora de entrada del d\xEDa jueves.', 'Error')
			return false
		}
		if(formulario.jueves_s.value.length == 0) {
			jAlert('Debe ingresar la hora de salida del d\xEDa jueves.', 'Error')
			return false
		}
	}
	if(formulario.viernes.checked) {
		if(formulario.viernes_e.value.length == 0) {
			jAlert('Debe ingresar la hora de entrada del d\xEDa viernes.', 'Error')
			return false
		}
		if(formulario.viernes_s.value.length == 0) {
			jAlert('Debe ingresar la hora de salida del d\xEDa viernes.', 'Error')
			return false
		}
	}
	if(formulario.sabado.checked) {
		if(formulario.sabado_e.value.length == 0) {
			jAlert('Debe ingresar la hora de entrada del d\xEDa s\xE1bado.', 'Error')
			return false
		}
		if(formulario.sabado_s.value.length == 0) {
			jAlert('Debe ingresar la hora de salida del d\xEDa s\xE1bado.', 'Error')
			return false
		}
	}
	if(formulario.domingo.checked) {
		if(formulario.domingo_e.value.length == 0) {
			jAlert('Debe ingresar la hora de entrada del d\xEDa domingo.', 'Error')
			return false
		}
		if(formulario.domingo_s.value.length == 0) {
			jAlert('Debe ingresar la hora de salida del d\xEDa domingo.', 'Error')
			return false
		}
	}
}