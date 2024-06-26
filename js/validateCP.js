function valida(formulario) {
	if(formulario.password.value.length == 0) {
		jAlert('Debe llenar el campo contraseña.', 'Error')
		return false
	}
	if(formulario.new_password.value.length == 0) {
		jAlert('Debe llenar el campo nueva contraseña.', 'Error')
		return false
	}
	if(formulario.new_password_confirm.value.length == 0) {
		jAlert('Debe llenar el campo confirmar nueva contraseña.', 'Error')
		return false
	}
	if(formulario.new_password.value != formulario.new_password_confirm.value) {
		jAlert('La nueva contraseña debe ser igual a la confirmación.', 'Error')
		return false
	}
}
