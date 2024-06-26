<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Asignaci&oacute;n de contrase&ntilde;a</title>
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
			<div id="legend">Asignaci&oacute;n de contrase&ntilde;a</div>
			<form id="formulario" name="formulario" method="post" action="../php/allocatePassword.php">
				<br><label>Alumno</label>
				<span class="select-box">
					<select name='id' class="inputs" id="nombre">
						<option value="0">Seleccione el alumno...</option>
						<?php
						$SQL = "SELECT id_alumno, nombre, apellido_paterno, apellido_materno FROM alumno WHERE status='Activo'  ORDER BY apellido_paterno, apellido_materno, nombre";
							$QUERY =  mysqli_query ($conn,$SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
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
				<br><br><input type="image" class="submit" src="../images/security_key.png" title="Cambiar contrase&ntilde;a"/>
			</form>
		</fieldset>
		<?php
			mysqli_close($conn) or header("Location:error.php?emysql=".mysqli_error($conn));
		?>
    </body>
</html>
<?php
	if(isset($_GET['a'])&&isset($_GET['pass'])) {
		if($_GET['a']=="A0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se ha actualizado la contrase&ntilde;a correctamente. La nueva contrase&ntilde;a es: <b>$_GET[pass]</b>', 'Atención')</script>";
		}
	}
?>
