function valida(formulario) {
	if(formulario.nombre.value.length == 0) {
		jAlert('Debe ingresar el nombre del usuario.', 'Error')
		return false
	}
	if(formulario.user.value.length == 0) {
		jAlert('Debe ingresar el nombre de usuario.', 'Error')
		return false
	}
	if(formulario.pass.value.length == 0) {
		jAlert('Debe ingresar la contrase\xF1a del usuario.', 'Error')
		return false
	}
	if(formulario.pass_Confirm.value.length == 0) {
		jAlert('Debe confirmar la contrase\xF1a del usuario.', 'Error')
		return false
	}
	if(formulario.pass.value != formulario.pass_Confirm.value) {
		jAlert('La contrase\xF1a debe ser igual a la confirmaci\xF3n.', 'Error')
		return false
	}
}