<?php
	require "../php/security.php";
	require "../db/connectDB.php";
?>
<html>
    <head>
		<meta content="610" http-equiv="REFRESH"> </meta>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Modificar instituci&oacute;n</title>
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<script language="javascript" src="../js/validateUC.js"></script>
		<link href="../css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script language="javascript" src="../js/jquery.alerts.js"></script>
		<script type="text/javascript" src = "../js/yahoo-dom-event.js"></script>
		<script type="text/javascript" src = "../js/ie-select-width-fix.js"></script>
		<script type="text/javascript">
			new YAHOO.Hack.FixIESelectWidth( 'colegio' );
		</script>
    </head>
	<body onLoad="document.getElementById('name').focus()"> 
		<br><fieldset class="frame">
			<div id="legend">Modificar instituci&oacute;n</div>
			<br><form id="formulario" name="formulario" method="get" action="">
				<label>Instituci&oacute;n:</label>
				<span class="select-box">
					<select name='colegio' id="colegio" class="inputs" onChange="document.getElementById('formulario').submit()">
						<option value="0">Selecciona la instituci&oacute;n...</option>
						<?php
							$SQL = "SELECT * FROM colegio";
							$QUERY =  mysqli_query ($conn, $SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
							while ( $resultado = mysqli_fetch_array($QUERY)){
								if(isset($_GET['colegio'])){
									if($_GET['colegio'] == $resultado['id_colegio']){
										print ("<option value=$resultado[id_colegio] selected='selected'>$resultado[colegios]</option>");
									}
									else {
										print ("<option value=$resultado[id_colegio]>$resultado[colegios]</option>");
									}
								}
								else {
									print ("<option value=$resultado[id_colegio]>$resultado[colegios]</option>");
								}
							}
						?>
					</select>
				</span>
			</form>
		</fieldset>
		<?php
			if(isset($_GET['colegio'])&&$_GET['colegio']!=0){
				$SQL = "SELECT * FROM colegio WHERE id_colegio=$_GET[colegio]";
				$QUERY =  mysqli_query ($conn, $SQL) or header("Location:error.php?emysql=".mysqli_error($conn));
				$resultado = mysqli_fetch_array($QUERY);
		?>
		<br><fieldset class="frame">
			<form method="post" action="../php/updateSchool.php" name="formulario" id="formulario" onSubmit="return valida(this)">
				<br><table border='0' align="center">
					<tr>
						<td>
							<fieldset>
								<label>Nombre:</label><br>
								<input type="text" name="nombre_colegio" class="inputs" id="name" value="<?php echo $resultado['colegios']; ?>"><br>
								<label>Responsable de la instituci&oacute;n:</label><br>
								<input type="text" name="res" class="inputs" value="<?php echo $resultado['responsable']; ?>"><br>
								<label>Cargo del responsable:</label><br>
								<input type="text" name="cargoRes" class="inputs" value="<?php echo $resultado['cargo_responsable']; ?>"><br>
							</fieldset>
						</td>
					</tr>
				</table>
				<input type="hidden" name="id" value="<?php echo $_GET['colegio']; ?>">
				<input type="image" class="submit" src="../images/folder_edit.png" title="Modificar instituci&oacute;n"/>
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
			echo "<script language='javascript' type='text/javascript'>jAlert('Ya se encuentra dada de alta una instituci&oacute;n con ese nombre.', 'Error')</script>";
		}
	}
	if(isset($_GET['a'])) {
		if($_GET['a']=="A0001") {
			echo "<script language='javascript' type='text/javascript'>jAlert('Se ha actualizado correctamente la instituci&oacute;n.', 'Atención')</script>";
		}
	}
?>
