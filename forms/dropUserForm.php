<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Activar/Iactivar usuarios</title>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<link href="../css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script language="javascript" src="../js/jquery.alerts.js"></script>
		<script type='text/javascript'> 
			function confirma(op) {
				if(op=="Activo") {
					jConfirm('Inactivar el usuario no permitirá que entre al sistema. Está seguro de inactivarlo?', 'Atención', function(r) { if( r ) { document.forms["baja"].submit(); }})
					return false
				}
				else {
					if(op=="Inactivo") {
						jConfirm('Activar el usuario le permitirá entrar nuevamente al sistema. ¿Está seguro de activarlo?', 'Atención', function(r) { if( r ) { document.forms["baja"].submit(); }})
						return false
					}
				}
			}
		</script>
    </head>
	<body onLoad="document.getElementById('name').focus()"> 
		<br><fieldset class="frame">
			<div id="legend">Activar/Inactivar usuarios</div>
			<br><form id="formulario" name="formulario" method="get" action="">
				<label>Usuario:</label>
				<span class="select-box">
					<select name='usuario' class="inputs" onChange="document.getElementById('formulario').submit()">
						<option value="0">Selecciona el usuario...</option>
						<?php
							$SQL = "SELECT id_usuario, nombre_usuario FROM usuario WHERE id_usuario!=1";
							$QUERY =  mysqli_query ($conn,$SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
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
				$privs = $row['privilegios'];
				echo ("<div align = 'center'>
					<form method='post' action='../php/dropUser.php' name='baja' onSubmit='return confirma(&quot;$row[status]&quot;)'>
					<br><table id='hor-minimalist-b'>
					");
				echo(
					"<tr><th>Nombre:</th><td>".$row["nombre"]."</td></tr>".
					"<tr><th>Usuario:</th><td>".$row["nombre_usuario"]."</td></tr>".
					"<tr><th>Estado:</th><td>".$row["status"]."</td></tr>".
					"<tr><th>Privilegios</th><td style='width:500px'>"
				);
				if ($privs[0]==1) { echo "Alta de alumnos, "; }
				if ($privs[1]==1) { echo "Cambiar estado de alumno, "; }
				if ($privs[2]==1) { echo "Modificar alumnos, "; }
				if ($privs[3]==1) { echo "Asignar y cambiar proyectos, "; }
				if ($privs[4]==1) { echo "Desasignar proyectos, "; }
				if ($privs[5]==1) { echo "Cambiar contrse&ntilde;as de alumnos, "; }
				if ($privs[6]==1) { echo "Eliminar alumnos, "; }
				if ($privs[7]==1) { echo "Consultar alumnos, "; }
				if ($privs[8]==1) { echo "Alta de instituciones, "; }
				if ($privs[9]==1) { echo "Modificar instituciones, "; }
				if ($privs[10]==1) { echo "Eliminar instituciones, "; }
				if ($privs[11]==1) { echo "Consultar instituciones, "; }
				if ($privs[12]==1) { echo "Alta de proyectos, "; }
				if ($privs[13]==1) { echo "Modificar proyectos, "; }
				if ($privs[14]==1) { echo "Terminar proyectos, "; }
				if ($privs[15]==1) { echo "Consultar proyectos, "; }
				if ($privs[16]==1) { echo "Consultar asistencias, "; }
				if ($privs[17]==1) { echo "Alta de usuarios, "; }
				if ($privs[18]==1) { echo "Modificar usuarios, "; }
				if ($privs[19]==1) { echo "Cambiar estado de usuarios, "; }
				if ($privs[20]==1) { echo "Eliminar usuarios, "; }
				if ($privs[21]==1) { echo "Cambiar privilegios de usuarios, "; }
				if ($privs[22]==1) { echo "Consultar usuarios, "; }
				if ($privs[23]==1) { echo "Cambiar contrase&ntilde;a de perfil, "; }
				if ($privs[24]==1) { echo "Respaldar la base de datos, "; }
				if ($privs[25]==1) { echo "Generar graficas de alumnos, "; }
				if ($privs[26]==1) { echo "Generar carta de aceptaci&oacute;n, "; }
				if ($privs[27]==1) { echo "Generar carta de terminaci&oacute;n, "; }
				if ($privs[28]==1) { echo "Historial de comentarios del alumno, "; }
				if ($privs[29]==1) { echo "Asignar y cambiar horario al alumno, "; }
				if ($privs[30]==1) { echo "Generar incidencias, "; }
				if ($privs[31]==1) { echo "Ver log de alumno, "; }
				echo ("</td></tr></table>".
					"<input type='hidden' name='status' value='$row[status]'>".
					"<input type='hidden' name='id_usuario' value='$row[id_usuario]'>"
				);
				if($row['status'] == "activo") {
					echo "<input type='image' class='submit' src='../images/user_lock.png' title='Inactivar'/><p>";
				}
				else {
					echo "<input type='image' class='submit' src='../images/user_unlock.png' title='Activar'/><p>";
				}
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
			echo "<script language='javascript' type='text/javascript'>jAlert('Se ha inactivado el usuario correctamente.', 'Atención')</script>";
		}
		if($_GET['a']=="A0002") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se ha activado el usuario correctamente.', 'Atención')</script>";
		}
	}
?>
