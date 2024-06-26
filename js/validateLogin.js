
function validar(formulario) {
	if(formulario.user.value.length == 0) {
		jAlert('Debe llenar el campo de usuario.', 'Error')
		return false
	}
	if(formulario.pass.value.length == 0) {
		jAlert('Debe llenar el campo contraseña.', 'Error')
		return false
	}
	return true;
}
