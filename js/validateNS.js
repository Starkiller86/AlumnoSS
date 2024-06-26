function valida(formulario) {
  if(formulario.nombre.value.length == 0){
    jAlert("Debe ingresar el nombre del alumno/a.", "Error");
    formulario.nombre.focus();
    return false;
  } 
  var er_nombre = /^[A-Za-zÀàÁáÉéÍíÓóÚúÑñü\s]*$/;
  if(!er_nombre.test(formulario.nombre.value)){
    jAlert("Debe ingresar un nombre valido de alumno/a.", "Error");
    formulario.nombre.focus();
    return false;
  }
  if (formulario.apellidoP.value.length == 0) {
    jAlert("Debe ingresar el apellido paterno del alumno/a.", "Error");
    return false;
  }
  var er_apellidoP = /^[A-Za-zÀàÁáÉéÍíÓóÚúÑñü\s]*$/;
  if(!er_apellidoP.test(formulario.apellidoP.value)){
    jAlert("Debe ingresar un apellido paterno valido de alumno/a.", "Error")
    return false;
  }
  if (formulario.apellidoM.value.length == 0) {
    jAlert("Debe ingresar el apellido materno del alumno/a.", "Error");
    return false;
  }
  var er_apellidoM = /^[A-Za-zÀàÁáÉéÍíÓóÚúÑñü\s]*$/;
  if(!er_apellidoM.test(formulario.apellidoM.value)){
    jAlert("Debe ingresar un apellido materno valido de alumno/a.", "Error");
    return false;
  }
  if (formulario.matricula.value.length == 0) {
    jAlert("Debe ingresar la matricula del alumno/a.", "Error");
    formulario.matricula.focus();
    return false;
  }
  var er_matri = /^[a-zA-Z0-9]*$/;
  if (!er_matri.test(formulario.matricula.value)) {
    jAlert("Debe ingresar una matricula valida.", "Error");
    formulario.matricula.focus();
    return false;
  }
  if (formulario.direccion.value.length == 0) {
    jAlert("Debe ingresar la direcci\xF3n del alumno/a.", "Error");
    return false;
  }
  var er_direccion = /^[0-9A-Za-zÀàÁáÉéÍíÓóÚúÑñü\s]*$/;
  if(!er_direccion.test(formulario.direccion.value)){
    jAlert("Debe ingresar una direccion valida.", "Error");
    formulario.direccion.focus();
    return false;
  }
  if (formulario.tel.value.length == 0) {
    jAlert("Debe ingresar el tel\xE9fono del alumno/a.", "Error");
    return false;
  }
  var er_telefono = /^([0-9]){7,}$/;
  if (!er_telefono.test(formulario.tel.value)) {
    jAlert("Debe ingresar un tel\xE9fono v\xE1lido.", "Error");
    return false;
  }
  if (formulario.mail.value.length == 0) {
    jAlert("Debe ingresar el correo electr\xF3nico del alumno/a.", "Error");
    return false;
  }
  var er_email = /^(.+\@.+\..+)$/;
  if (!er_email.test(formulario.mail.value)) {
    jAlert("Debe ingresar un correo electr\xF3nico v\xE1lido.", "Error");
    return false;
  }
  if (formulario.sem.value.length == 0) {
    jAlert("Debe ingresar el semestre del alumno/a.", "Error");
    return false;
  }
  if (isNaN(formulario.sem.value)) {
    jAlert("El semestre del alumno debe ser num\xE9rico.", "Error");
    formulario.sem.focus();
    return false;
  }
  if (formulario.colegio.value == 0) {
    jAlert("Debe seleccionar una instituci\xF3n.", "Error");
    return false;
  }
  if (formulario.carrera.value.length == 0) {
    jAlert("Debe ingresar la carrera del alumno alumno/a.", "Error");
    return false;
  }
}
