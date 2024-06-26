<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Alta de alumno</title>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<script language="javascript" src="../js/validateNS.js"></script>
		<link href="../css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script language="javascript" src="../js/jquery.alerts.js"></script>
		<script type="text/javascript" src = "../js/yahoo-dom-event.js"></script>
		<script type="text/javascript" src = "../js/ie-select-width-fix.js"></script>
		<script type="text/javascript">
			new YAHOO.Hack.FixIESelectWidth( 'colegio' );
		</script>
    </head>
	<body onLoad="document.getElementById('name').focus()"> 
		<br><fieldset class="frame">
			<div id="legend">Alta de alumno</div>
			<form method="post" action="../php/newStudent.php" name="formulario" id="formulario" onSubmit="return valida(this)">
				<br><table border='0' align="center">
					<tr>
						<td>
							<fieldset>
								<label>Nombre:</label><br>
								<input type="text" name="nombre" class="inputs" id="name"><br>
								<label>Apellido Paterno:</label><br>
								<input type="text" name="apellidoP" class="inputs"><br>
								<label>Apellido Materno:</label><br>
								<input type="text" name="apellidoM" class="inputs"><br>
								<label>Matr&iacute;cula o n&uacute;mero de control:</label><br>
								<input type="text" name="matricula" class="inputs"><br>
								<label>Direcci&oacute;n:</label><br>
								<input type="text" name="direccion" class="inputs"><br>
								<label>Tel&eacute;fono:</label><br>
								<input type="text" name="tel" class="inputs"><br>
								<label>e-mail:</label><br>
								<input type="text" name="mail" class="inputs"><br>
							</fieldset>
						</td>
						<td>
							<fieldset>
								<label>Escolaridad:</label><br>
								<select name="escolaridad" class="inputs" style="height:23px">
									<option value="Bachillerato">Bachillerato</option>
									<option value="Universidad">Universidad</option>
									<option value="Especialidad">Especialidad</option>
								</select><br>
								<label>Semestre:</label><br>
								<input type="text" name="sem" class="inputs"><br>
								<label>Instituci&oacute;n:<br></label>
								<span class="select-box">
									<select name='colegio' id="colegio" class="inputs" style="height:23px;">
										<option value=0>Selecciona una instituci&oacute;n</option>
										<?php
											$SQL = "SELECT * FROM colegio";
											$QUERY =  mysqli_query ($conn, $SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
											while ( $resultado = mysqli_fetch_array($QUERY)){
												print ("<option value=$resultado[id_colegio]>$resultado[colegios]</option>");
											}
											mysqli_close($conn) or header("Location:error.php?emysql=".mysqli_error($conn));
										?>
									</select>
								</span><br>
								<a href="../forms/newSchoolForm.php" target="content" style="float:right;padding-top:5px;">Otra instituci&oacute;n</a><br>
								<label>Carrera:</label><br>
								<input type="text" name="carrera" class="inputs"><br>
								<label>Documentaci&oacute;n:</label><br>
								<select name="documen" class="inputs" style="height:23px">
									<option value="Completa">Completa</option>
									<option value="Incompleta" selected="selected">Incompleta</option>
								</select><br>
								<label>Comentarios:</label><br>
								<textarea name="coments" cols="10" rows="2" class="comment"></textarea>
							</fieldset>                                
						</td>
					</tr>
				</table>
				<input type="image" class="submit" src="../images/user_add.png" title="Agregar alumno"/>
			</form>
		</fieldset>
    </body>
</html>
<?php
	if(isset($_GET['a'])&&isset($_GET['pass'])&&isset($_GET['id'])) {
		if($_GET['a']=="A0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se ha registrado al alumno correctamente. Su id es: <b>$_GET[id]</b> y su contrase&ntilde;a es: <b>$_GET[pass]</b>', 'Atención', function(r) { if( r ) window.location='allocateProjectForm.php?id=$_GET[id]' })</script>";
		}
	}
	if(isset($_GET['e'])){
		if($_GET['e'] == "DUPLICATED"){
			echo "<script language='javascript' type='text/javascript'>jAlert('El nombre, apellido y matricula ya existen.', 'Error')</script>";
		}
	}
?>
