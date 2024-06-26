<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
	<head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Inactivar/Activar alumno</title>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<link href="../css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script language="javascript" src="../js/jquery.alerts.js"></script>
		<script type="text/javascript" src = "../js/yahoo-dom-event.js"></script>
		<script type="text/javascript" src = "../js/ie-select-width-fix.js"></script>
		<script type="text/javascript">
			new YAHOO.Hack.FixIESelectWidth( 'nombre' );
		</script>
		<script type='text/javascript'> 
			function confirma(op) {
				if(op=="Activo") {
					jConfirm('Inactivar el alumno no permitirá que registre su asistencia. ¿Está seguro de inactivarlo?', 'Atención', function(r) { if( r ) { document.forms["baja"].submit(); }})
					return false
				}
				else {
					if(op=="Inactivo") {
						jConfirm('Activar el alumno le permitirá registrar nuevamente sus asistencias. ¿Está seguro de activarlo?', 'Atención', function(r) { if( r ) { document.forms["baja"].submit(); }})
						return false
					}
				}
			}
		</script>
	</head>
    <body>
		<br><fieldset class="frame">
			<div id="legend">Activar/Inactivar alumno</div>
			<form id="formulario" name="formulario" method="get" action="">
				<br><label>Alumno</label>
				<span class="select-box">
					<select name='id' class="inputs" id="nombre" onChange="document.getElementById('formulario').submit()">
						<option value="0">Seleccione el alumno...</option>
						<?php
							$SQL = "SELECT id_alumno, nombre, apellido_paterno, apellido_materno FROM alumno WHERE status!='Terminado' ORDER BY apellido_paterno, apellido_materno, nombre";
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
			if(isset($_GET['id']) && $_GET['id']!=0){
				$query="SELECT * FROM alumno where id_alumno=$_GET[id]";
				$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
				$row = mysqli_fetch_array($res);
				echo ("<div align = 'center'>
					<form method='post' id='baja' action='../php/dropStudent.php' name='baja' onSubmit='return confirma(&quot;$row[status]&quot;)'>
					<br><table id='hor-minimalist-b'>
					");
				$query="SELECT colegios FROM colegio where id_colegio=$row[id_colegio]";
				$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
				$colegio = mysqli_fetch_array($res);
					if($row["documentos"]=="Incompleta"){
						echo ("<tr><h1>(DOCUMENTACI&Oacute;N INCOMPLETA)"."</h1></tr><hr> ");
					}
					echo(
						"<tr><th>Direcci&oacute;n:</th><td>".$row["direccion"]."</td></tr>".
						"<tr><th>Tel&eacute;fono:</th><td>".$row["telefono"]."</td></tr>".
						"<tr><th>e-mail:</th><td>".$row["e_mail"]."</td></tr>".
						"<tr><th>Escolaridad:</th><td>".$row["escolaridad"]."</td></tr>".
						"<tr><th>Escuela:</th><td>".$colegio["colegios"]."</td></tr>".
						"<tr><th>Carrera:</th><td>".$row["carrera"]."</td></tr>".
						"<tr><th>Semestre:</th><td>".$row["semestre"]."</td></tr>".
						"<tr><th>Estado:</th><td>".$row["status"]."</td></tr>".
						"<tr><th>Fecha de creaci&oacute;n:</th><td>".$row["fecha"]."</td></tr>".
						"</table>".
						"<input type='hidden' name='status' value='$row[status]'>".
						"<input type='hidden' name='id_alumno' value='$row[id_alumno]'>"
					);
						if($row['status'] == "Activo") {
							echo "<input type='image' class='submit' src='../images/user_lock.png' title='Inactivar'/><p>";
						}
						else {
							if($row['status'] == "Inactivo") {
								echo "<input type='image' class='submit' src='../images/user_unlock.png' title='Reactivar'/><p>";
							}
						}
					echo "</form>";
			}
			mysqli_close($conn) or header("Location:error.php?emysql=".mysqli_error($conn));
		?>
	</body>
</html>
<?php
	if(isset($_GET['a'])) {
		if($_GET['a']=="A0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se ha deshabilitado el alumno correctamente.', 'Mensaje')</script>";
		}
		else if($_GET['a']=="A0002") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se ha reactivado el alumno correctamente.', 'Mensaje')</script>";
		}
	}
?>
