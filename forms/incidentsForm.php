<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Incidencias</title>
		<script language="javascript" src="../js/validateIS.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<link href="../css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script language="javascript" src="../js/jquery.alerts.js"></script>
		<script src="../js/jscal2.js"></script>
		<script src="../js/es.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/jscal2.css" />
		<link rel="stylesheet" type="text/css" href="../css/reduce-spacing.css" />
		<script type="text/javascript" src = "../js/yahoo-dom-event.js"></script>
		<script type="text/javascript" src = "../js/ie-select-width-fix.js"></script>
		<script type="text/javascript">
			new YAHOO.Hack.FixIESelectWidth( 'id' );
		</script>
    </head>
	<body onLoad="document.getElementById('name').focus()">
		<br><fieldset class="frame">
			<div id="legend">Incidencias</div>
			<form id="formulario" name="formulario" method="POST" action="../php/incidents.php" onSubmit="return valida(this)">
				<br><br><label>Alumno</label>
				<span class="select-box">
					<select name='id' class="inputs" id="id">
						<option value="0">Seleccione el alumno...</option>
						<?php
							$SQL = "SELECT DISTINCT alumno.id_alumno, nombre, apellido_paterno, apellido_materno FROM alumno, alumno_servicio WHERE alumno.status='Activo' AND alumno_servicio.status='Activo' ORDER BY apellido_paterno, apellido_materno, nombre";
							$QUERY =  mysqli_query ($conn, $SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
							while ( $resultado = mysqli_fetch_array($QUERY)){
								if(isset($_GET['id'])){
									if($_GET['id'] == $resultado['id_alumno']){
										print ("<option value=$resultado[id_alumno] selected='selected'>$resultado[apellido_paterno] $resultado[apellido_materno] $resultado[nombre]</option>");
									}
									else {
										print ("<option value=$resultado[id_alumno]>$resultado[apellido_paterno] $resultado[apellido_materno] $resultado[nombre]</option>");
									}
								}
								else {
									print ("<option value=$resultado[id_alumno]>$resultado[apellido_paterno] $resultado[apellido_materno] $resultado[nombre]</option>");
								}
							}
						?>
					</select>
				</span>
				<label>Fecha de inicio:</label>
				<input type="text" name="fecha_i" class="inputs" id="f_date1" style="width:100px;text-align:center" readonly="readonly" value="<?php if(isset($_GET['fecha_i'])) { echo $_GET['fecha_i']; } ?>">
				<label>Fecha de t&eacute;rmino:</label>
				<input type="text" name="fecha_t" class="inputs" id="f_date2" style="width:100px;text-align:center" readonly="readonly" value="<?php if(isset($_GET['fecha_t'])) { echo $_GET['fecha_t']; } ?>">
				<script type="text/javascript">
					var cal = Calendar.setup({
						onSelect: function(cal) { cal.hide() },
						showTime: false
					});
					cal.manageFields("f_date1", "f_date1", "%Y-%m-%d");
					cal.manageFields("f_date2", "f_date2", "%Y-%m-%d");
				</script><br><br>
				<input type="image" name="agregar" class="submit" src="../images/schedule_add.png" title="Agregar asistencias"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="image" name="eliminar" id='eliminar' class="submit" src="../images/schedule_delete.png" title="Eliminar asistencias"/>
			</form>
		</fieldset>
    </body>
</html>
<?php
	if(isset($_GET['a'])) {
		if($_GET['a']=="A0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se han agregado las asistencias correctamente.', 'Mensaje')</script>";
		}
		if($_GET['a']=="A0002") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se han eliminado las asistencias correctamente.', 'Mensaje')</script>";
		}
	}
?>