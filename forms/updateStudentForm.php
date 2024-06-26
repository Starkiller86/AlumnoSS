<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Modificar alumno</title>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<script language="javascript" src="../js/validateNS.js"></script>
		<link href="../css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script language="javascript" src="../js/jquery.alerts.js"></script>
		<script type="text/javascript" src = "../js/yahoo-dom-event.js"></script>
		<script type="text/javascript" src = "../js/ie-select-width-fix.js"></script>
		<script type="text/javascript">
			new YAHOO.Hack.FixIESelectWidth( 'nombre' );
			new YAHOO.Hack.FixIESelectWidth( 'colegio' );
		</script>
    </head>
	<body onLoad="document.getElementById('name').focus()">
		<br><fieldset class="frame">
			<div id="legend">Modificar alumno</div>
			<form id="formulario" name="formulario" method="get" action="">
				<br><label>Alumno</label>
				<span class="select-box">
					<select name='id' class="inputs" id="nombre" onChange="document.getElementById('formulario').submit()">
						<option value="0">Seleccione el alumno...</option>
						<?php
							$SQL = "SELECT DISTINCT id_alumno, nombre, apellido_paterno, apellido_materno FROM alumno WHERE status='Activo'  ORDER BY apellido_paterno, apellido_materno, nombre";
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
				$query="SELECT * FROM alumno where id_alumno=$_GET[id]";
				$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
				$row = mysqli_fetch_array($res);
		?>
		<br><fieldset class="frame">
			<form method="post" action="../php/updateStudent.php" name="updateForm" id="updateForm" onSubmit="return valida(this)">
				<br><table border='0' align="center">
					<tr>
						<td>
							<fieldset style="height:300px">
								<label>Nombre:</label><br>
								<input type="text" name="nombre" class="inputs" id="name" value="<?php echo $row['nombre'];?>" ><br>
								<label>Apellido Paterno:</label><br>
								<input type="text" name="apellidoP" class="inputs" value="<?php echo $row['apellido_paterno'];?>" ><br>
								<label>Apellido Materno:</label><br>
								<input type="text" name="apellidoM" class="inputs" value="<?php echo $row['apellido_materno'];?>" ><br>
								<label>Matr&iacute;cula  o n&uacute;mero de control:</label><br>
								<input type="text" name="matricula" class="inputs" value="<?php echo $row['matricula'];?>" ><br>
								<label>Direcci&oacute;n:</label><br>
								<input type="text" name="direccion" class="inputs"  value="<?php echo $row['direccion'];?>" ><br>
								<label>Tel&eacute;fono:</label><br>
								<input type="text" name="tel" class="inputs" value="<?php echo $row['telefono'];?>" ><br>
							</fieldset>
						</td>
						<td>
							<fieldset style="height:300px">
								<label>e-mail:</label><br>
								<input type="text" name="mail" class="inputs" value="<?php echo $row['e_mail'];?>" ><br>
								<label>Escolaridad:</label><br>
								<select name="escolaridad" class="inputs" style="height:23px">
									<option value="Bachillerato" <?php if($row['escolaridad']=="Bachillerato") echo "selected='selected'"; ?>>Bachillerato</option>
									<option value="Universidad" <?php if($row['escolaridad']=="Universidad") echo "selected='selected'"; ?>>Universidad</option>
									<option value="Especialidad" <?php if($row['escolaridad']=="Especialidad") echo "selected='selected'"; ?>>Especialidad</option>
								</select><br>
								<label>Semestre:</label><br>
								<input type="text" name="sem" class="inputs" value="<?php echo $row['semestre'];?>" ><br>
								<label>Instituci&oacute;n:<br></label>
								<span class="select-box">
									<select name='colegio' id="colegio" class="inputs" style="height:23px">
										<option>Selecciona una instituci&oacute;n</option>
										<?php
											$SQL = "SELECT * FROM colegio";
											$QUERY =  mysqli_query ($conn, $SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
											while ( $resultado = mysqli_fetch_array($QUERY)){
												if($resultado['id_colegio']==$row['id_colegio']) {
													print ("<option selected='selected' value=$resultado[id_colegio]>$resultado[colegios]</option>");
												}
												else {
													print ("<option value=$resultado[id_colegio]>$resultado[colegios]</option>");
												}
											}
											mysqli_close($conn) or header("Location:error.php?emysql=".mysqli_error($conn));
										?>
									</select>
								</span><br>
								<a href="addesc.php" style="float:right;padding-top:5px;">Otra instituci&oacute;n</a><br>
								<label>Carrera:</label><br>
								<input type="text" name="carrera" class="inputs" value="<?php echo $row['carrera'];?>" ><br>
								<label>Documentaci&oacute;n:</label><br>
								<select name="documen" class="inputs" style="height:23px">
									<option value="Completa" <?php if($row['documentos']=="Completa") echo "selected='selected'"; ?> >Completa</option>
									<option value="Incompleta" <?php if($row['documentos']=="Incompleta") echo "selected='selected'"; ?> >Incompleta</option>
								</select><br>
								<input type="hidden" name="id_alumno" value="<?php echo $_GET['id']; ?>">
							</fieldset>                                
						</td>
					</tr>
				</table>
				<input type="image" class="submit" src="../images/user_update.png" title="Modificar alumno"/>
			</form>
		</fieldset>
		<?php
			}
		?>
    </body>
</html>
<?php
	if(isset($_GET['a'])) {
		if($_GET['a']=="A0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se han modificado los datos del alumno correctamente.', 'Mensaje')</script>";
		}
	}
?>