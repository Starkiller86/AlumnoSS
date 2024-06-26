<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Generar carta de aceptaci&oacute;n</title>
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
	<body> 
		<br><fieldset class="frame">
			<div id="legend">Generar carta de aceptaci&oacute;n</div>
			<form id="formulario" name="formulario" method="get" action="">
				<br><label>Alumno</label>
				<span class="select-box">
					<select name='id' class="inputs" id="nombre" onChange="document.getElementById('formulario').submit()">
						<option value="0">Seleccione el alumno...</option>
						<?php
							$SQL = "SELECT id_alumno, nombre, apellido_paterno, apellido_materno FROM alumno WHERE status='Activo' ORDER BY apellido_paterno, apellido_materno, nombre";
							$QUERY =  mysqli_query ($conn, $SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
							while ($resultado = mysqli_fetch_array($QUERY)){
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
				$query="SELECT alumno_servicio.status FROM alumno_servicio, alumno WHERE alumno_servicio.id_alumno=$_GET[id] AND alumno_servicio.id_alumno=alumno.id_alumno";
				$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
		?>
		<br><fieldset class="frame">
		<?php
				if (mysqli_num_rows($res)>0) {
					$status=mysqli_fetch_array($res);
					if($status['status']=="Activo") {
						echo "<br><center><span style='font-size:10pt;font-weight:bold;'>Imprimir carta de aceptaci&oacute;n</span></center><br>";
						echo "<a href='../php/documents.php?id=$_GET[id]&doc=aceptacion' target='content'><img src='../images/documents.png' style='border:0' title='Generar carta de aceptaci&oacute;n'></a><br>";
					}
					else {
						echo "<br><center><span style='font-size:10pt;font-weight:bold;'>El alumno no tiene asignado un proyecto activo</span></center><br>";
						echo "<img src='../images/notification_error.png'>";
					}
				}
				else {
					echo "<br><center><span style='font-size:10pt;font-weight:bold;'>El alumno no tiene asignado proyecto</span></center><br>";
					echo "<img src='../images/notification_error.png'>";
				}
		?>
		</fieldset>
		<?php
			}
			mysqli_close($conn) or header("Location:error.php?emysql=".mysqli_error($conn));
		?>
    </body>
</html>