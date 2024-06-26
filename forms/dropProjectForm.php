<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Terminaci&oacute;n de proyectos</title>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<link href="../css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script language="javascript" src="../js/jquery.alerts.js"></script>
		<script type="text/javascript" src = "../js/yahoo-dom-event.js"></script>
		<script type="text/javascript" src = "../js/ie-select-width-fix.js"></script>
		<script type="text/javascript">
			new YAHOO.Hack.FixIESelectWidth( 'proyecto' );
		</script>
		<script type='text/javascript'> 
			function confirma() {
				jConfirm('Al terminar el proyecto, los alumnos asignados tendrán que ser reasignados a otro proyecto si no han cumplido sus horas o podrán solicitar la terminación de su servicio.  Está seguro terminar el proyecto?', 'Atención', function(r) { if( r ) { document.forms["eliminar"].submit(); }})
				return false
			}
		</script>
    </head>
    <body>
		<br><fieldset class="frame">
			<div id="legend">Terminaci&oacute;n de proyectos</div>
			<form id="formulario" name="formulario" method="get" action="">
				<br><label>Proyecto</label>
				<span class="select-box">
					<select name='id' class="inputs" id="proyecto" onChange="document.getElementById('formulario').submit()">
						<option value="0">Seleccione el proyecto...</option>
						<?php
							$SQL = "SELECT id_proyecto, nombre_proyecto, area FROM proyecto WHERE status != 'Terminado' ORDER BY area, nombre_proyecto";
							$QUERY =  mysqli_query ($conn, $SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
							while ( $resultado = mysqli_fetch_array($QUERY)){
								if(isset($_GET['id'])){
									if($_GET['id'] == $resultado['id_proyecto']){
										print ("<option value=$resultado[id_proyecto] selected='selected'>$resultado[area] - $resultado[nombre_proyecto]</option>");
									}
									else {
										print ("<option value=$resultado[id_proyecto]>$resultado[area] - $resultado[nombre_proyecto]</option>");
									}
								}
								else {
									print ("<option value=$resultado[id_proyecto]>$resultado[area] - $resultado[nombre_proyecto]</option>");
								}
							}
						?>
					</select>
				</span>
			</form>
		</fieldset>
		<?php
			if(isset($_GET['id'])){
				$query="SELECT * FROM proyecto WHERE id_proyecto=$_GET[id] AND status != 'Terminado'";
				$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
				echo ("<div align = 'center'>
					<form method='post' id='eliminar' action='../php/dropProject.php' name='baja' onSubmit='return confirma()'>
					<br><table id='hor-minimalist-b'>
					");
				While ($row = mysqli_fetch_array($res)){
					echo(
						"<tr><th>Nombre:</th><td>".$row["nombre_proyecto"]."</td></tr>".
						"<tr><th>&Aacute;rea:</th><td>".$row["area"]."</td></tr>".
						"<tr><th>Estado:</th><td>".$row["status"]."</td></tr>".
						"<tr><th>Descipci&oacute;n:</th><td>".$row["descripcion"]."</td></tr>".
						"<tr><th>Alumnos requeridos:</th><td>".$row["lugares_requeridos"]."</td></tr>".
						"<tr><th>Alumnos asignados:</th><td>".$row["lugares_asignados"]."</td></tr>".
						"</table>".
						"<input type='hidden' name='id' value='$row[id_proyecto]'>".
						"<input type='image' class='submit' src='../images/document_delete.png' title='Terminar'/><p>".
						"</form>"
					);
				}
				$query="SELECT id_alumno FROM alumno_servicio WHERE id_proyecto=$_GET[id] AND status='Activo'";
				$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
				if(mysqli_num_rows($res)>0){
					echo "<script language='javascript' type='text/javascript'>jAlert('El proyecto tiene alumnos activos.', 'Atención')</script>";
				}
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
			echo "<script language='javascript' type='text/javascript'>jAlert('Se ha terminado el proyecto correctamente.', 'Atención')</script>";
		}
	}
?>
