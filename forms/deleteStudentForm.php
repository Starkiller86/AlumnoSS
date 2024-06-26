<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
	<head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Eliminar alumno</title>
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
				jConfirm('Eliminar el alumno, borrara permanentemente toda la informaci�n del mismo. \xBFEst\xE1 seguro de eliminar al alumno?', 'Atención', function(r) { if( r ) { document.forms["eliminar"].submit(); }})
				return false
			}
		</script>
	</head>
    <body>
		<br><fieldset class="frame">
			<div id="legend">Eliminar alumno</div>
			<form id="formulario" name="formulario" method="get" action="">
				<br><label>Alumno</label>
				<span class="select-box">
					<select name='id' class="inputs" id="nombre" onChange="document.getElementById('formulario').submit()">
						<option value="0">Seleccione el alumno...</option>
						<?php
							$SQL = "SELECT id_alumno, nombre, apellido_paterno, apellido_materno FROM alumno ORDER BY apellido_paterno, apellido_materno, nombre";
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
				echo ("<div align = 'center'>
					<form method='post' id='eliminar' action='../php/deleteStudent.php' name='baja' onSubmit='return confirma()'>
					<br><table id='hor-minimalist-b'>
					");
				$row = mysqli_fetch_array($res);
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
					"<tr><th>Especialidad:</th><td>".$row["carrera"]."</td></tr>".
					"<tr><th>Estado:</th><td>".$row["status"]."</td></tr>".
					"<tr><th>Fecha de creaci&oacute;n:</th><td>".$row["fecha"]."</td></tr>".
					"</table>".
					"<input type='hidden' name='id_alumno' value='$row[id_alumno]'>"
				);
				echo "<input type='image' class='submit' src='../images/user_delete.png' title='Eliminar'/><p>";
				$query="SELECT id_proyecto FROM alumno_servicio WHERE id_alumno=$_GET[id]";
				$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
				if(mysqli_num_rows($res)>0){
					$id_proyecto=mysqli_fetch_array($res);
					$query="SELECT * FROM proyecto WHERE id_proyecto=$id_proyecto[id_proyecto]";
					$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
					$proyecto=mysqli_fetch_array($res);
					if ($proyecto['status']!="Terminado") {
						echo "<input type='hidden' name='lugares_requeridos' value='$proyecto[lugares_requeridos]'>";
						echo "<input type='hidden' name='lugares_asignados' value='$proyecto[lugares_asignados]'>";
						echo "<input type='hidden' name='proyecto' value='$proyecto[id_proyecto]'>";
						echo "<input type='hidden' name='status' value='$proyecto[status]'>";
						echo "<script language='javascript' type='text/javascript'>jAlert('El alumno está asignado al proyecto: \"$proyecto[nombre_proyecto]\" que se encuentra activo.', 'Atención')</script>";
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
			echo "<script language='javascript' type='text/javascript'>jAlert('Se ha eliminado el alumno correctamente.', 'Mensaje')</script>";
		}
	}
?>
