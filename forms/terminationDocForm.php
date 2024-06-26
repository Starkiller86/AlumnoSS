<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Generar carta de terminaci&oacute;n</title>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<link href="../css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script language="javascript" src="../js/jquery.alerts.js"></script>
		<script type="text/javascript" src = "../js/yahoo-dom-event.js"></script>
		<script type="text/javascript" src = "../js/ie-select-width-fix.js"></script>
		<script type="text/javascript">
			new YAHOO.Hack.FixIESelectWidth( 'nombre' );
		</script>
    </head>
	<body onLoad="document.getElementById('name').focus()">
		<br><fieldset class="frame">
			<div id="legend">Generar carta de terminaci&oacute;n</div>
			<form id="formulario" name="formulario" method="get" action="">
				<br><label>Alumno</label>
				<span class="select-box">
					<select name='id' class="inputs" id="nombre" onChange="document.getElementById('formulario').submit()">
						<option value="0">Seleccione el alumno...</option>
						<?php
							$SQL = "SELECT DISTINCT alumno.id_alumno, nombre, apellido_paterno, apellido_materno FROM alumno, alumno_servicio WHERE (alumno.status='Activo' OR alumno.status='Terminado')  AND alumno.id_alumno=alumno_servicio.id_alumno  ORDER BY apellido_paterno, apellido_materno, nombre";
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
			</form>
		</fieldset>
		<?php
			if(isset($_GET['id'])&&$_GET['id']!=0){
				$query="SELECT no_horas, status FROM alumno_servicio WHERE id_alumno=$_GET[id]";
				$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
				$horas=mysqli_fetch_array($res);
				$query="SELECT SUM(HOUR(horas_reales)) AS hora, SUM(MINUTE(horas_reales)) AS minutos FROM asistencia WHERE asistencia.id_alumno=$_GET[id]";
				$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
				$row=mysqli_fetch_array($res);
				$horasx = $row["hora"];
				$min = $row["minutos"];
				$minutosx = $min%60;
				$h=(int)($min/60);
				$horasx+=$h;
		?>
		<br><fieldset class="frame">
			<?php
				echo "<br><center><span style='font-size:11pt;font-weight:bold;'>Total de horas acumuladas: $horasx h $minutosx m</span></center>";
				if ($horas['status']=="Activo") {
					if($horasx>=$horas['no_horas']) {
						echo "<br><center><span style='font-size:10pt;font-weight:bold;'>El alumno ya ha cumplido el total de las horas</span></center><br>";
						echo "<a href='../php/terminateStudent.php?id=$_GET[id]' target='content'><img src='../images/notification_done.png' style='border:0' title='Terminar servicio y generar carta de terminaci&oacute;n'></a><br>";
					}
					else {
						echo "<br><center><span style='font-size:10pt;font-weight:bold;'>El alumno no ha cumplido el total de las horas</span></center><br>";
						echo "<img src='../images/notification_error.png'>&nbsp;";
						echo "<a href='../php/terminateStudent.php?id=$_GET[id]' target='content'><img src='../images/notification_done.png' style='border:0' title='Terminar servicio y generar carta de terminaci&oacute;n'></a><br>";
					}
				}
				else {
					if ($horas['status']=="Terminado") {
						echo "<br><a href='../php/documents.php?id=$_GET[id]&doc=terminacion' target='content'><img src='../images/documents.png' style='border:0' title='Generar carta de terminaci&oacute;n'></a><br>";
					}
				}
			?>
		</fieldset>
		<?php
			}
			mysqli_close($conn) or header("Location:error.php?emysql=".mysqli_error($conn));
		?>
    </body>
</html>
<?php
	if(isset($_GET['a'])) {
		if($_GET['a']=="A0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se terminado correctamente el servicio del alumno.', 'Mensaje')</script>";
		}
	}
?>