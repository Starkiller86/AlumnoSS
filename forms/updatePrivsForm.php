<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Asignar privilegios</title>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>	
		<link rel="stylesheet" href="../css/styleTable.css" type="text/css" media="print, projection, screen" />
		<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="../js/jquery.tablesorter.pager.js"></script>
		<link href="../css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="../js/jquery.alerts.js"></script>
		<script type="text/javascript">
			$(function() {
				$("table")
					.tablesorter({widthFixed: true, widgets: ['zebra']})
					.tablesorterPager({container: $("#pager")});
			});
		</script>
    </head>
	<body>
		<br><fieldset class="frame">
			<div id="legend">Asignar Privilegios</div>
			<br><form id="formulario" name="formulario" method="get" action="">
				<label>Usuario:</label>
				<span class="select-box">
					<select name='usuario' class="inputs" onChange="document.getElementById('formulario').submit()">
						<option value="0">Selecciona el usuario...</option>
						<?php
							$SQL = "SELECT id_usuario, nombre_usuario FROM usuario WHERE id_usuario!=1 AND status='Activo'";
							$QUERY =  mysqli_query ($conn, $SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
							while ( $resultado = mysqli_fetch_array($QUERY)){
								if(isset($_GET['usuario'])){
									if($_GET['usuario'] == $resultado['id_usuario']){
										print ("<option value=$resultado[id_usuario] selected='selected'>$resultado[nombre_usuario]</option>");
									}
									else {
										print ("<option value=$resultado[id_usuario]>$resultado[nombre_usuario]</option>");
									}
								}
								else {
									print ("<option value=$resultado[id_usuario]>$resultado[nombre_usuario]</option>");
								}
							}
						?>
					</select>
				</span>
			</form>
		</fieldset>
		<?php
			if(isset($_GET['usuario'])&&$_GET['usuario']!=0){
				$SQL = "SELECT * FROM usuario WHERE id_usuario=$_GET[usuario]";
				$QUERY =  mysqli_query ($conn, $SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
				$row = mysqli_fetch_array($QUERY);
				echo ("<div align = 'center'>
					<form method='post' action='../php/updatePrivs.php' name='actualizar'>
					<br><table id='hor-minimalist-b'>
					");
				$privs = $row['privilegios'];
				if ($privs[0]==1) { echo "<tr><th>Alta de alumnos:</th><td><input type='checkbox' name='p0' checked></td></tr>"; } else { echo "<tr><th>Alta de alumnos:</th><td><input type='checkbox' name='p0'></td></tr>"; }
				if ($privs[1]==1) { echo "<tr><th>Cambiar estado de alumnos:</th><td><input type='checkbox' name='p1' checked></td></tr>"; } else { echo "<tr><th>Cambiar estado de alumnos:</th><td><input type='checkbox' name='p1'></td></tr>"; }
				if ($privs[2]==1) { echo "<tr><th>Modificar alumnos:</th><td><input type='checkbox' name='p2' checked></td></tr>"; } else { echo "<tr><th>Modificar alumnos:</th><td><input type='checkbox' name='p2'></td></tr>"; }
				if ($privs[3]==1) { echo "<tr><th>Asignar y cambiar proyectos</th><td><input type='checkbox' name='p3' checked></td></tr>"; } else { echo "<tr><th>Asignar y cambiar proyectos</th><td><input type='checkbox' name='p3'></td></tr>"; }
				if ($privs[4]==1) { echo "<tr><th>Desasignar proyectos:</th><td><input type='checkbox' name='p4' checked></td></tr>"; } else { echo "<tr><th>Desasignar proyectos:</th><td><input type='checkbox' name='p4'></td></tr>"; }
				if ($privs[5]==1) { echo "<tr><th>Cambiar contrase&ntilde;as de alumnos:</th><td><input type='checkbox' name='p5' checked></td></tr>"; } else { echo "<tr><th>Cambiar contrase&ntilde;as de alumnos:</th><td><input type='checkbox' name='p5'></td></tr>"; }
				if ($privs[6]==1) { echo "<tr><th>Eliminar alumnos:</th><td><input type='checkbox' name='p6' checked></td></tr>"; } else { echo "<tr><th>Eliminar alumnos:</th><td><input type='checkbox' name='p6'></td></tr>"; }
				if ($privs[7]==1) { echo "<tr><th>Consultar alumnos:</th><td><input type='checkbox' name='p7' checked></td></tr>"; } else { echo "<tr><th>Consultar alumnos:</th><td><input type='checkbox' name='p7'></td></tr>"; }
				if ($privs[8]==1) { echo "<tr><th>Alta de instituciones:</th><td><input type='checkbox' name='p8' checked></td></tr>"; } else { echo "<tr><th>Alta de instituciones:</th><td><input type='checkbox' name='p8'></td></tr>"; }
				if ($privs[9]==1) { echo "<tr><th>Modificar instituciones:</th><td><input type='checkbox' name='p9' checked></td></tr>"; } else { echo "<tr><th>Modificar instituciones:</th><td><input type='checkbox' name='p9'></td></tr>"; }
				if ($privs[10]==1) { echo "<tr><th>Eliminar instituciones:</th><td><input type='checkbox' name='p10' checked></td></tr>"; } else { echo "<tr><th>Eliminar instituciones:</th><td><input type='checkbox' name='p10'></td></tr>"; }
				if ($privs[11]==1) { echo "<tr><th>Consultar instituciones:</th><td><input type='checkbox' name='p11' checked></td></tr>"; } else { echo "<tr><th>Consultar instituciones:</th><td><input type='checkbox' name='p11'></td></tr>"; }
				if ($privs[12]==1) { echo "<tr><th>Alta de proyectos:</th><td><input type='checkbox' name='p12' checked></td></tr>"; } else { echo "<tr><th>Alta de proyectos:</th><td><input type='checkbox' name='p12'></td></tr>"; }
				if ($privs[13]==1) { echo "<tr><th>Modificar proyectos:</th><td><input type='checkbox' name='p13' checked></td></tr>"; } else { echo "<tr><th>Modificar proyectos:</th><td><input type='checkbox' name='p13'></td></tr>"; }
				if ($privs[14]==1) { echo "<tr><th>Terminar proyectos:</th><td><input type='checkbox' name='p14' checked></td></tr>"; } else { echo "<tr><th>Terminar proyectos:</th><td><input type='checkbox' name='p14'></td></tr>"; }
				if ($privs[15]==1) { echo "<tr><th>Consultar proyectos:</th><td><input type='checkbox' name='p15' checked></td></tr>"; } else { echo "<tr><th>Consultar proyectos:</th><td><input type='checkbox' name='p15'></td></tr>"; }
				if ($privs[16]==1) { echo "<tr><th>Consultar asistencias de alumnos:</th><td><input type='checkbox' name='p16' checked></td></tr>"; } else { echo "<tr><th>Consultar asistencias de alumnos:</th><td><input type='checkbox' name='p16'></td></tr>"; }
				if ($privs[17]==1) { echo "<tr><th>Alta de usuarios</th><td><input type='checkbox' name='p17' checked></td></tr>"; } else { echo "<tr><th>Alta de usuarios:</th><td><input type='checkbox' name='p17'></td></tr>"; }
				if ($privs[18]==1) { echo "<tr><th>Modificar usuarios:</th><td><input type='checkbox' name='p18' checked></td></tr>"; } else { echo "<tr><th>Modificar usuarios:</th><td><input type='checkbox' name='p18'></td></tr>"; }
				if ($privs[19]==1) { echo "<tr><th>Cambiar estado de usuarios:</th><td><input type='checkbox' name='p19' checked></td></tr>"; } else { echo "<tr><th>Cambiar estado de usuarios:</th><td><input type='checkbox' name='p19'></td></tr>"; }
				if ($privs[20]==1) { echo "<tr><th>Eliminar usuarios:</th><td><input type='checkbox' name='p20' checked></td></tr>"; } else { echo "<tr><th>Eliminar usuarios:</th><td><input type='checkbox' name='p20'></td></tr>"; }
				if ($privs[21]==1) { echo "<tr><th>Cambiar privilegios de usuarios:</th><td><input type='checkbox' name='p21' checked></td></tr>"; } else { echo "<tr><th>Cambiar provilegios de usuarios:</th><td><input type='checkbox' name='p21'></td></tr>"; }
				if ($privs[22]==1) { echo "<tr><th>Consultar usuarios:</th><td><input type='checkbox' name='p22' checked></td></tr>"; } else { echo "<tr><th>Consultar usuarios:</th><td><input type='checkbox' name='p22'></td></tr>"; }
				if ($privs[23]==1) { echo "<tr><th>Cambiar contrase&ntilde;a de perfil:</th><td><input type='checkbox' name='p23' checked></td></tr>"; } else { echo "<tr><th>Cambiar contrase&ntilde;a de perfil:</th><td><input type='checkbox' name='p23'></td></tr>"; }
				if ($privs[24]==1) { echo "<tr><th>Respaldar la base de datos:</th><td><input type='checkbox' name='p24' checked></td></tr>"; } else { echo "<tr><th>Respaldar la base de datos:</th><td><input type='checkbox' name='p24'></td></tr>"; }
				if ($privs[25]==1) { echo "<tr><th>Generar graficas de alumnos:</th><td><input type='checkbox' name='p25' checked></td></tr>"; } else { echo "<tr><th>Generar graficas de alumnos:</th><td><input type='checkbox' name='p25'></td></tr>"; }
				if ($privs[26]==1) { echo "<tr><th>Generar carta de aceptaci&oacute;n:</th><td><input type='checkbox' name='p26' checked></td></tr>"; } else { echo "<tr><th>Generar carta de aceptaci&oacute;n:</th><td><input type='checkbox' name='p26'></td></tr>"; }
				if ($privs[27]==1) { echo "<tr><th>Generar carta de terminaci&oacute;n:</th><td><input type='checkbox' name='p27' checked></td></tr>"; } else { echo "<tr><th>Generar carta de terminaci&oacute;n:</th><td><input type='checkbox' name='p27'></td></tr>"; }
				if ($privs[28]==1) { echo "<tr><th>Historial de comentarios del alumno:</th><td><input type='checkbox' name='p28' checked></td></tr>"; } else { echo "<tr><th>Historial de comentarios del alumno:</th><td><input type='checkbox' name='p28'></td></tr>"; }
				if ($privs[29]==1) { echo "<tr><th>Asignar y cambiar horario al alumno:</th><td><input type='checkbox' name='p29' checked></td></tr>"; } else { echo "<tr><th>Asignar y cambiar horario al alumno:</th><td><input type='checkbox' name='p29'></td></tr>"; }
				if ($privs[30]==1) { echo "<tr><th>Incidencias:</th><td><input type='checkbox' name='p30' checked></td></tr>"; } else { echo "<tr><th>Incidencias:</th><td><input type='checkbox' name='p30'></td></tr>"; }
				if ($privs[31]==1) { echo "<tr><th>Ver log de alumno:</th><td><input type='checkbox' name='p31' checked></td></tr>"; } else { echo "<tr><th>Ver log de alumno:</th><td><input type='checkbox' name='p31'></td></tr>"; }
				echo "</table>";
				echo "<input type='hidden' name='id' value='$row[id_usuario]'>";
				echo "<input type='image' class='submit' src='../images/security_keyandlock.png' title='Dar de baja'/><p>";
				echo "</form>";
			}
			mysqli_close($conn) or header("Location:error.php?emysql=".mysqli_error($conn));
		?>
	</body>
</html>
<?php
	if(isset($_GET['emysql'])) {
		$error =  str_replace("%20"," ",$_GET['emysql']);
		$error =  str_replace("'","\'",$error);
		echo "<script language='javascript' type='text/javascript'>jAlert('$error', 'MySQL Error')</script>";
	}
	if(isset($_GET['a'])) {
		if($_GET['a']=="A0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se han actualizado correctamente los privilegios.', 'Atención')</script>";
		}
	}
?>
