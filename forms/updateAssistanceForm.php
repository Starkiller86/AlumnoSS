<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Modificar asistencia</title>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<script language="javascript" src="../js/validateCP.js"></script>
		<link href="../css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script language="javascript" src="../js/jquery.alerts.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/jquery.ptTimeSelect.css" />
		<link rel="stylesheet" type="text/css" href="../css/ui.theme.css" />
		<link rel="stylesheet" type="text/css" href="../css/ui.core.css" />
		<script type="text/javascript" src="../js/jquery.ptTimeSelect.js"></script>
    </head>
	<body onLoad="document.getElementById('password').focus()"> 
		<br><fieldset class="frame">
			<div id="legend">Modificar asistencia</div>
			<form method="post" action="../php/updateAssistance.php" name="formulario" id="formulario" onSubmit="return valida(this)">
				<br><table border='0' align="center">
					<tr>
						<td>
							<fieldset>
								<?php
									$hora_entrada=date("g:i A",strtotime($_GET['hora_e']));
									$hora_salida=date("g:i A",strtotime($_GET['hora_s']));
									$query="SELECT id_alumno, nombre, apellido_paterno, apellido_materno FROM alumno where id_alumno=$_GET[id]";
									$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
									$row=mysqli_fetch_array($res);
								?>
								<label>Alumno:</label><br>
								<input type="text" name="alumno" class="inputs" value="<?php echo $row['nombre']." ".$row['apellido_paterno']." ".$row['apellido_materno']; ?>" onKeyPress="return false"><br>
								<label>Fecha:</label><br>
								<input type="text" name="fecha" class="inputs" value="<?php echo $_GET['fecha']; ?>" onKeyPress="return false"><br>
								<label>Hora de entrada:</label><br>
								<input type="text" name="hora_e" class="inputs" id="hora1" readonly="readonly" value="<?php echo $hora_entrada; ?>"><br>
								<label>Hora de salida:</label><br>
								<input type="text" name="hora_s" class="inputs" id="hora2" readonly="readonly" value="<?php echo $hora_salida; ?>"><br>
								<script type="text/javascript">
									$('#hora1, #hora2').ptTimeSelect({
										hoursLabel: "Horas",
										minutesLabel: "Minutos",
										setButtonLabel: "Seleccionar",
										containerWidth: "300px"
									});
								</script>
								<center><label>Retardo:</label><input type='checkbox' name='retardo' <?php if ($_GET['retardo']=="R") { echo "checked"; } ?> ><br></center>
								<input type="hidden" name="id" value="<?php echo $row['id_alumno']; ?>">
								<input type="hidden" name="entrada_anterior" value="<?php echo $_GET['hora_e']; ?>">
								<input type="hidden" name="salida_anterior" value="<?php echo $_GET['hora_s']; ?>">
							</fieldset>
						</td>
					</tr>
				</table>
				<input type="image" class="submit" src="../images/user_assistance.png" title="Cambiar asistencia"/>
			</form>
		</fieldset>
    </body>
</html>
<?php
	if(isset($_GET['a'])) {
		if($_GET['a']=="A0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se ha actualizado la asistencia correctamente.', 'Atención')</script>";
		}
	}
?>
