
<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
	<head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Desasignar proyecto</title>
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
			function confirma() {
				jConfirm('\xBFEst\xE1 seguro de desasignar el proyecto al alumno?', 'Atención', function(r) { if( r ) { document.forms["eliminar"].submit(); }})
				return false
			}
		</script>
	</head>
    <body>
		<br><fieldset class="frame">
			<div id="legend">Desasignar proyecto</div>
			<form id="formulario" name="formulario" method="get" action="">
				<br><label>Alumno</label>
				<span class="select-box">
					<select name='id' class="inputs" id="nombre" onChange="document.getElementById('formulario').submit()">
						<option value="0">Seleccione el alumno...</option>
						<?php
							$SQL = "SELECT alumno.id_alumno, alumno.nombre, alumno.apellido_paterno, alumno.apellido_materno FROM alumno, alumno_servicio WHERE alumno.id_alumno=alumno_servicio.id_alumno AND alumno_servicio.status='Activo' AND alumno.status='Activo' ORDER BY alumno.apellido_paterno, alumno.apellido_materno, alumno.nombre";
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
				$alumno=mysqli_fetch_array($res);
				$query="SELECT * FROM alumno_servicio where id_alumno=$_GET[id] AND status='Activo'";
				$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
				echo ("<div align = 'center'>
					<form method='post' id='eliminar' action='../php/deallocateProject.php' name='baja' onSubmit='return confirma()'>
					<br><table id='hor-minimalist-b'>
					");
				$servicio = mysqli_fetch_array($res);
				$query="SELECT * FROM proyecto WHERE id_proyecto=$servicio[id_proyecto] AND status!='Terminado'";
				$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
				$proyecto = mysqli_fetch_array($res);
				$query="SELECT * FROM colegio WHERE id_colegio=$alumno[id_colegio]";
				$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
				$colegio = mysqli_fetch_array($res);
					if($alumno["documentos"]=="incompleta"){
						echo ("<tr><h1>(DOCUMENTACION INCOMPLETA)"."</h1></tr><hr> ");
					}
					echo(
						"<tr><th>Nombre:</th><td>".$alumno["nombre"]." ".$alumno["apellido_paterno"]." ".$alumno["apellido_materno"]."</td></tr>".
						"<tr><th>Escolaridad:</th><td>".$alumno["escolaridad"]."</td></tr>".
						"<tr><th>Instituci&oacute;n:</th><td>".$colegio["colegios"]."</td></tr>".
						"<tr><th>Carrera:</th><td>".$alumno["carrera"]."</td></tr>".
						"<tr><th>Proyecto:</th><td>".$proyecto["area"]." - ".$proyecto["nombre_proyecto"]."</td></tr>".
						"<tr><th>Tipo:</th><td>".$servicio["tipo_servicio"]."</td></tr>".
						"<tr><th>Fecha de inicio:</th><td>".$servicio["fecha_inicio"]."</td></tr>".
						"<tr><th>Fecha de t&eacute;rmino:</th><td>".$servicio["fecha_termino"]."</td></tr>".
						"</table>".
						"<input type='hidden' name='id_proyecto' value='$servicio[id_proyecto]'>".
						"<input type='hidden' name='id_alumno' value='$alumno[id_alumno]'>"
					);
					echo "<input type='image' class='submit' src='../images/user_deallocate.png' title='Desasignar proyecto'/><p>";
					echo "</form>";
			}
			mysqli_close($conn) or header("Location:error.php?emysql=".mysqli_error($conn));
		?>
	</body>
</html>
<?php
	if(isset($_GET['a'])) {
		if($_GET['a']=="A0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se ha desasignado el proyecto correctamente.', 'Mensaje')</script>";
		}
	}
	if(isset($_GET['e'])) {
		if($_GET['e']=="E0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('El proyecto ya se encuentra terminado.', 'Error')</script>";
		}
	}
?>
