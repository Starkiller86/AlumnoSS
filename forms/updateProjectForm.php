<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Modificar proyectos</title>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<script language="javascript" src="../js/validateNP.js"></script>
		<link href="../css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script language="javascript" src="../js/jquery.alerts.js"></script>
		<script type="text/javascript" src = "../js/yahoo-dom-event.js"></script>
		<script type="text/javascript" src = "../js/ie-select-width-fix.js"></script>
		<script type="text/javascript">
			new YAHOO.Hack.FixIESelectWidth( 'proyecto' );
		</script>
    </head>
	<body onLoad="document.getElementById('name').focus()"> 
		<br><fieldset class="frame">
			<div id="legend">Modificar proyectos</div>
			<br><form id="formulario" name="formulario" method="get" action="">
				<label>Proyecto:</label>
				<span class="select-box">
					<select name='proyecto' id="proyecto" class="inputs" onChange="document.getElementById('formulario').submit()">
						<option value="0">Selecciona el proyecto...</option>
						<?php
							$SQL = "SELECT id_proyecto, nombre_proyecto FROM proyecto WHERE status!='Terminado'";
							$QUERY =  mysqli_query ($conn, $SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
							while ( $resultado = mysqli_fetch_array($QUERY)){
								if(isset($_GET['proyecto'])){
									if($_GET['proyecto'] == $resultado['id_proyecto']){
										print ("<option value=$resultado[id_proyecto] selected='selected'>$resultado[nombre_proyecto]</option>");
									}
									else {
										print ("<option value=$resultado[id_proyecto]>$resultado[nombre_proyecto]</option>");
									}
								}
								else {
									print ("<option value=$resultado[id_proyecto]>$resultado[nombre_proyecto]</option>");
								}
							}
						?>
					</select>
				</span>
			</form>
		</fieldset>
		<?php
			if(isset($_GET['proyecto'])&&$_GET['proyecto']!=0){
				$SQL = "SELECT * FROM proyecto WHERE id_proyecto=$_GET[proyecto]";
				$QUERY =  mysqli_query ($conn, $SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
				$resultado = mysqli_fetch_array($QUERY);
		?>
		<br><fieldset class="frame">
			<form method="post" action="../php/updateProject.php" name="updateForm" id="updateForm" onSubmit="return valida(this)">
				<br><table border='0' align="center">
					<tr>
						<td>
							<fieldset>
								<label>Nombre:</label><br>
								<input type="text" name="nombre_proyecto" class="inputs" id="name" style="width:100%" value="<?php echo $resultado['nombre_proyecto']; ?>"><br>
								<label>&Aacute;rea:</label><br>
								<select name='area' class="inputs" style="width:100%">
									<option value="0" <?php if($resultado['area']==0) echo "selected='selected'"; ?>>Seleccione un area...</option>
                                    <option value="Biblioteca infantil" <?php if($resultado['area']=="Biblioteca infantil") echo "selected='selected'"; ?>>Biblioteca infantil</option>
									<option value="Biblioteca adultos" <?php if($resultado['area']=="Biblioteca adultos") echo "selected='selected'"; ?>>Biblioteca adultos</option>
									<option value="RCI adultos" <?php if($resultado['area']=="RCI adultos") echo "selected='selected'"; ?>>RCI adultos</option>
									<option value="RCI niños" <?php if($resultado['area']=="RCI niños") echo "selected='selected'"; ?>>RCI niños</option>
									<option value="Planeación y promoción" <?php if($resultado['area']=="Planeación y promoción") echo "selected='selected'"; ?>>Planeación y promoción</option>
								</select><br>
								<label>Alumnos requeridos:</label>
								<input type="text" name="lugares" class="inputs" value="<?php echo $resultado['lugares_requeridos']; ?>"><br><br>
								<label>Descripci&oacute;n:</label><br>
								<textarea name="descripcion" cols="10" rows="2" class="comment" style="height:150px;width:335px"><?php echo $resultado['descripcion']; ?></textarea>
								<input type='hidden' name='id' value='<?php echo $_GET['proyecto']; ?>'>
							</fieldset>
						</td>
					</tr>
				</table>
				<input type="image" class="submit" src="../images/document_edit.png" title="Modificar proyecto"/>
			</form>
		</fieldset>
		<?php
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
	if(isset($_GET['e'])) {
		if($_GET['e']=="E0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Ya se encuentra un proyecto activo dado de alta con las mismas especificaciones.', 'Error')</script>";
		}
		if($_GET['e']=="E0002") {
			echo "<script language='javascript' type='text/javascript'>jAlert('El proyecto tiene más lugares asignados de los que requiere.', 'Error')</script>";
		}
	}
	if(isset($_GET['a'])) {
		if($_GET['a']=="A0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se ha actualizado el proyecto correctamente.', 'Atención')</script>";
		}
	}
?>
