<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Asignaci&oacute;n de Proyecto</title>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<script language="javascript" src="../js/validateAP.js"></script>
		<link href="../css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script language="javascript" src="../js/jquery.alerts.js"></script>
		<script src="../js/jscal2.js"></script>
		<script src="../js/es.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/jscal2.css" />
		<link rel="stylesheet" type="text/css" href="../css/reduce-spacing.css" />
		<link rel="stylesheet" type="text/css" href="../css/jquery.ptTimeSelect.css" />
		<link rel="stylesheet" type="text/css" href="../css/ui.theme.css" />
		<link rel="stylesheet" type="text/css" href="../css/ui.core.css" />
		<script type="text/javascript" src="../js/jquery.ptTimeSelect.js"></script>
		<script type="text/javascript" src = "../js/yahoo-dom-event.js"></script>
		<script type="text/javascript" src = "../js/ie-select-width-fix.js"></script>
		<script type="text/javascript">
			new YAHOO.Hack.FixIESelectWidth( 'alumno' );
			new YAHOO.Hack.FixIESelectWidth( 'proyecto' );
			new YAHOO.Hack.FixIESelectWidth( 'servicio' );
		</script>
    </head>
	<body>
		<br><fieldset class="frame">
			<div id="legend">Asignaci&oacute;n de proyecto</div>
			<form id="formulario" name="formulario" method="get" action="">
				<br><label>Alumno</label>
				<span class="select-box">
					<select name='id' class="inputs" id="nombre" onChange="document.getElementById('formulario').submit()">
						<option value="0">Seleccione el alumno...</option>
						<?php
							$SQL = "SELECT id_alumno, nombre, apellido_paterno, apellido_materno FROM alumno WHERE status='Activo' ORDER BY apellido_paterno, apellido_materno, nombre";
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
				$query="SELECT * FROM alumno_servicio where id_alumno=$_GET[id] and status='Activo'";
				$res=mysqli_query($conn, $query) or header("Location:error.php?emysql=".mysqli_error($conn));
				if(mysqli_num_rows($res)>0){
					$row=mysqli_fetch_array($res);
					if(!(isset($_GET['a']))||!(isset($_GET['e']))) {
						echo "<script language='javascript' type='text/javascript'>jAlert('El alumno ya tiene asignado un proyecto.', 'atención');</script>";
					}
				}
		?>
		<br><fieldset class="frame">
			<form method="post" action="../php/allocateProject.php" name="formulario" id="formulario" onSubmit="return valida(this)">
				<br><table border='0' align="center">
					<tr>
						<td>
							<fieldset style="height:240px;">
								<label>Proyecto:</label><br>
								<span class="select-box">
									<select name='proyecto' id="proyecto" class="inputs" >
										<option value="0">Selecciona el proyecto...</option>
										<?php
											$SQL = "SELECT id_proyecto, nombre_proyecto, area FROM proyecto WHERE status != 'Terminado' ORDER BY area, nombre_proyecto";
											$QUERY =  mysqli_query ($conn, $SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
											while ( $resultado = mysqli_fetch_array($QUERY)){
												if(isset($row)){
													if($row['id_proyecto']==$resultado['id_proyecto']){
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
								</span><br><br>
								<label>Jefe Directo:</label><br>
								<input type="text" name="jefe" class="inputs" value="<?php if(isset($row)) echo $row['jefe_directo']; ?>"><br>
								<label>Fecha de inicio:</label><br>
								<input type="text" name="fecha_i" class="inputs" style="width:175px" id="f_date1" readonly="readonly" <?php if(isset($row)) echo "value='$row[fecha_inicio]'"; ?>>   <img src="../images/calendar.png" width="20px" height="20px" align="middle" id="f_btn1" style="cursor:pointer"><br>
								<label>Fecha de termino:</label><br>
								<input type="text" name="fecha_t" class="inputs" style="width:175px" id="f_date2" readonly="readonly" <?php if(isset($row)) echo "value='$row[fecha_termino]'"; ?>>   <img src="../images/calendar.png" width="20px" height="20px" align="middle" id="f_btn2" style="cursor:pointer"><br>
								<script type="text/javascript">
									var cal = Calendar.setup({
										onSelect: function(cal) { cal.hide() },
										showTime: false
									});
									cal.manageFields("f_btn1", "f_date1", "%Y-%m-%d");
									cal.manageFields("f_btn2", "f_date2", "%Y-%m-%d");
								</script>
							</fieldset>
						</td>
						<td>
							<fieldset style="height:240px">
								<label>Horas a realizar:</label><br>
								<input type="text" name="horas" class="inputs" <?php if(isset($row)) echo "value='$row[no_horas]'"; ?>><br>
								<label>Tipo de horas:</label><br>
								<select name="tipo_horas" id="tipo_horas" class="inputs">
									<option value="0" <?php if(isset($row)) { if($row['tipo_horas']==0) echo "selected='selected'"; } ?>> Selecciona el tipo de horas...</option>
									<option value="1" <?php if(isset($row)) { if($row['tipo_horas']==1) echo "selected='selected'"; } ?>> Normales</option>
									<option value="2" <?php if(isset($row)) { if($row['tipo_horas']==2) echo "selected='selected'"; } ?>> Dobles</option>
								</select><br>
								<label>Tipo de servicio:</label><br>
								<span class="select-box">
									<select name="tipo_servicio" id="tipo_servicio" class="inputs">
										<option value="0" <?php if(isset($row)) { if($row['tipo_servicio']==0) echo "selected='selected'"; } ?>> Selecciona el tipo de servicio...</option>
										<option value="Servicio social" <?php if(isset($row)) { if($row['tipo_servicio']=="Servicio social") echo "selected='selected'"; } ?>> Servicio social</option>
										<option value="Prácticas profesionales" <?php if(isset($row)) { if($row['tipo_servicio']=="Prácticas profesionales") echo "selected='selected'"; } ?>> Prácticas profesionales</option>
										<option value="Estancia" <?php if(isset($row)) { if($row['tipo_servicio']=="Estancia") echo "selected='selected'"; } ?>> Estancia</option>
										<option value="Estancia I" <?php if(isset($row)) { if($row['tipo_servicio']=="Estancia I") echo "selected='selected'"; } ?>> Estancia I</option>
										<option value="Estancia II" <?php if(isset($row)) { if($row['tipo_servicio']=="Estancia II") echo "selected='selected'"; } ?>> Estancia II</option>
										<option value="Estadia" <?php if(isset($row)) { if($row['tipo_servicio']=="Estadía") echo "selected='selected'"; } ?>> Estadía</option><br>
									</select>
								</span>
							</fieldset>                                
						</td>
					</tr>
				</table>
				<?php if(isset($row)) { echo "<input type='image' class='submit' src='../images/user_document_edit.png' title='Cambiar informaci&oacute;n de proyecto'/>"; } else { echo "<input type='image' class='submit' src='../images/user_document.png' title='Asignar proyecto'/>"; }?>
				<?php if (isset($_GET['id'])) { echo "<input type='hidden' name='id' value='$_GET[id]'>"; } if(isset($row)) { echo "<input type='hidden' name='update' value='$row[id_proyecto]'>"; } ?>
			</form>
		</fieldset>
		<?php
			}
			mysqli_close($conn) or header("Location:error.php?emysql=".mysqli_error($conn));
		?>
    </body>
</html>
<?php
	if(isset($_GET['e'])) {
		if($_GET['e']=="E0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Ya están ocupados todos los lugares del proyecto.', 'Error');</script>";
		}
	}
	if(isset($_GET['e'])) {
		if($_GET['e']=="E0002") {
			echo "<script language='javascript' type='text/javascript'>jAlert('El proyecto ya no se encuentra activo.', 'Error');</script>";
		}
	}
	if(isset($_GET['a'])) {
		if($_GET['a']=="A0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se ha asignado el proyecto correctamente.', 'Atención', function(r) { if( r ) window.location='scheduleUpdateForm.php?id=$_GET[id]' })</script>";
		}
	}
	if(isset($_GET['a'])) {
		if($_GET['a']=="A0002") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se ha actualizado el proyecto correctamente.', 'Atención');</script>";
		}
	}
?>
